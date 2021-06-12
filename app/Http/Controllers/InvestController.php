<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\DetailUser;
use App\Models\DetailProductKas;
use App\Models\HeaderProduct;
use App\Models\HeaderInvest;
use App\Models\DetailInvest;
use Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


class InvestController extends Controller
{
    //midtrans -- sandbox
    public $snapToken;
    //public $projectInvest;
    public $MIDTRANS_SERVER_KEY = 'SB-Mid-server-prYkvSccGV27NceSR_YIgIQo';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $this->MIDTRANS_SERVER_KEY;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    
    public function investTo(Request $req, $id, $invest)
    {
        $token=0;
        $user = auth()->user();

        //Cek dulu apa ada id product dan user id yang sama sebelumnya di tabel header_invests
        $isExist = HeaderInvest::where('user_id', '=', $user->id)->where('project_id', '=', $id)->where('status_transaction', '=', 'pending')->first();

        //kalau ada yang sama, cek apa statusnya
        //jika statusnya pending : maka beri alert minta pelunasan untuk transaksi pada product tsb
        //artinya tidak bisa invest
        if (HeaderInvest::where('user_id', '=', $user->id)->where('project_id', '=', $id)->where('status_transaction', '=', 'pending')->exists()) //available
        {
            return 0;
        }
        else if ($isExist == null){
            //jika statusnya selain pending, ia bisa invest ini lagi

            $projectInvest = HeaderProduct::find($id);
            $invest_id = mt_rand();
            $item_details = ["id" => $id, "price" => $invest, "quantity"=> 1, "name"=>$req->nama_project];

            $params = array(
                'transaction_details' => array(
                    'order_id' => $invest_id,
                    'gross_amount' => $invest,
                ),
                'item_details' => array(
                    $item_details
                ),
                'customer_details' => array(
                    'first_name' => $user->id,
                    'last_name' => $user->name,
                    'email' => $user->email,
                    'phone' => '08111222333',
                ),
            );
        
            //insert ke table header_invest jika melakukan pembayaran
            $newHeader = new HeaderInvest;
            $newHeader->user_id = $user->id;
            $newHeader->project_id = $id;
            $newHeader->invest_id = $invest_id; //sama dengan order_id di midtrans
            $newHeader->jumlah_invest = $invest;
            $newHeader->jumlah_final = $invest - (($invest * 1)/100);
            $newHeader->status_transaction = '-';  //status yang didapat dari midtrans  
            $newHeader->status_invest = '0';    //(0-menunggu konfirmasi), (1-aktif/sdh dikonfirmasi), (2-tdk invest lagi)
            $newHeader->invest_expire = $req->invest_exp_date; 
            $query = $newHeader->save();

            DB::table('header_products')
             ->where('id','=',$id)
             ->update([
                 'status' => '2',
             ]);
            
            $this->snapToken = \Midtrans\Snap::getSnapToken($params);
            return $this->snapToken;
        }
        
    }

    //note: investor tdk bisa menonaktifkan investasi yang sudah berhasil

    //status_invest -- 0(Menunggu konfirmasi admin), (1-aktif invst/dikonfirmasi), (2-tdk aktif oleh inv), 4(tdk aktif krna gagal byr/cancle/expire), 5 (investasi sudah finished/melewati masa kontrak)

    public function listInvestPending(Request $req)
    {
        $user = auth()->user();
       
        $listInvestPending = DB::table('header_invests')
                    ->leftJoin('header_products', 'header_products.id','=','header_invests.project_id')
                    ->select('header_invests.id', 'header_products.name_product', 'header_invests.invest_id','header_invests.status_transaction', 'header_invests.invest_expire')
                    ->where('header_invests.user_id', '=', $user->id)
                    ->where('header_invests.status_transaction','=','pending')
                    ->orWhere('header_invests.status_transaction','=','settlement')
                    ->Where('header_invests.status_invest','=','0')
                    ->get();
        if($req->ajax()){
            return datatables()->of($listInvestPending)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                        $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Kirim" class="btn btn-danger btn-sm sudahKirim" data-tr="tr_{{$product->id}}" >Sudah Kirim</a>';

                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('inv.listInvest');
    }

    public function listInvestSettlement(Request $req)
    {
        $user = auth()->user();
       
        $listInvestSettlement = DB::table('header_invests')
                    ->leftJoin('header_products', 'header_products.id','=','header_invests.project_id')
                    ->select('header_invests.id', 'header_products.name_product', 'header_invests.invest_id','header_invests.status_transaction')
                    ->where('header_invests.user_id', '=', $user->id)
                    ->where('header_invests.status_transaction','=','settlement')
                    ->where('header_invests.status_invest','=','1')
                    ->get();
         
        if($req->ajax()){
            return datatables()->of($listInvestSettlement)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                        // $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEvent" data-tr="tr_{{$product->id}}" >Sudah Kirim</a>';
    
                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('inv.listInvest');
    }

    public function listInvestCancel(Request $req)
    {
        $user = auth()->user();
       
        $listInvestCancel = DB::table('header_invests')
        ->leftJoin('header_products', 'header_products.id','=','header_invests.project_id')
        ->select('header_invests.id', 'header_products.name_product', 'header_invests.invest_id','header_invests.status_transaction')
        ->where('header_invests.user_id', '=', $user->id)
        ->where('header_invests.status_transaction','=','cancel')
        ->orWhere('header_invests.status_transaction','=','expire')
        ->orWhere('header_invests.status_invest','=','2')
        ->get();
        
       
        if($req->ajax()){
            return datatables()->of($listInvestCancel)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('inv.listInvest');
    }

    public function listInvestFinished(Request $req)
    {
        $user = auth()->user();
       
        $listInvestFinished = DB::table('header_invests')
        ->leftJoin('header_products', 'header_products.id','=','header_invests.project_id')
        ->select('header_invests.id', 'header_products.name_product', 'header_invests.invest_id','header_invests.status_transaction')
        ->where('header_invests.user_id', '=', $user->id)
        ->where('header_invests.status_transaction','=','settlement')
        ->where('header_invests.status_invest','=','5')
        ->get();
        
       
        if($req->ajax()){
            return datatables()->of($listInvestFinished)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-warning btn-sm detailProject">Detail</a>';

                        return $btn;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

    }



    //detail laporan keuangan inv di inv/invest/listInvestasi
    public function detailFinance(Request $req, $id)
    {
        $data = HeaderInvest::find($id);
        $projectID = $data->project_id;
        $date_inv_awal = $data->created_at->format('Y-m-01') ." 00:00:00";
        $date_inv_exp = \Carbon\Carbon::parse($data->invest_expire)->format('Y-m-01'). " 23:59:59";
       // dd($date_inv_awal);

        if($req->ajax()){

            if ($req->getTabel == "#table_pemasukkan_inv") {
                $list_kas0 = DB::table('detail_product_kas')
                    ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                    ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                    ->where('detail_product_kas.id_headerproduct','=',$projectID)
                    ->whereBetween('detail_product_kas.created_at', [$date_inv_awal, $date_inv_exp])
                    ->orderBy('detail_product_kas.created_at','asc')
                    ->get();
            }
            
            if ($req->getTabel == "#table_pengeluaran_inv") {
                $list_kas0 = DB::table('detail_product_kas')
                    ->leftJoin('type_trans', 'detail_product_kas.id_typetrans', '=', 'type_trans.id')
                    ->select('detail_product_kas.id','detail_product_kas.tipe','detail_product_kas.created_at','type_trans.keterangan','detail_product_kas.jumlah','detail_product_kas.status')
                    ->where('detail_product_kas.id_headerproduct','=',$projectID)
                    ->where('detail_product_kas.tipe','=','2')
                    ->whereBetween('detail_product_kas.created_at', [$date_inv_awal, $date_inv_exp])
                    ->get();
            }

            return datatables()->of($list_kas0)
            ->addColumn('action', function($data){
            $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#ubahJumlah"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKas">Ubah</a>';
            return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    }
    
}
