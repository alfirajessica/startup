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
            $newHeader->jumlah = $invest;
            $newHeader->profit = 0;
            $newHeader->status_transaction = '-';  //status yang didapat dari midtrans  
            $newHeader->status_invest = '0';    //(0-menunggu konfirmasi), (1-aktif/sdh dikonfirmasi), (2-tdk invest lagi)
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

    public function updStatusTrans()
    {
        $data = HeaderInvest::all()->toArray();
        for ($i=0; $i < count($data); $i++) { 

            //get status dari midtrans berdasarkan order_id nya
            $status = \Midtrans\Transaction::status($data[$i]['invest_id']);
            $status = json_decode(json_encode($status),true);

             DB::table('header_invests')->
             where('invest_id','=',$data[$i]['invest_id'])->
             update([
                 'status_transaction' => $status['transaction_status'],
             ]);
        }
    }

    //status_invest -- 0(Menunggu konfirmasi admin), (1-aktif invst/dikonfirmasi), (2-tdk aktif)

    public function listInvestPending(Request $req)
    {
        $user = auth()->user();
       
        $listInvestPending = DB::table('header_invests')
                    ->leftJoin('header_products', 'header_products.id','=','header_invests.project_id')
                    ->select('header_invests.id', 'header_products.name_product', 'header_invests.invest_id','header_invests.status_transaction')
                    ->where('header_invests.user_id', '=', $user->id)
                    ->where('header_invests.status_transaction','=','pending')
                    ->orWhere('header_invests.status_invest','=','0')
                    ->get();
        if($req->ajax()){
            return datatables()->of($listInvestPending)
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTrans" data-id="'.$data->id.'" data-original-title="Detail" class="detail btn btn-primary btn-sm detailProject">Detail</a>';

                        $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEvent" data-tr="tr_{{$product->id}}" >Sudah Kirim</a>';
    
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
                         $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                         $button .= '&nbsp;&nbsp;';
                         $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                         return $button;
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
                         $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                         $button .= '&nbsp;&nbsp;';
                         $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                         return $button;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('inv.listInvest');
    }

    public function detailInvest($id)
    {

        $data = HeaderInvest::find($id);
        $investID = $data->invest_id;
        $projectID = $data->project_id;
       
        
        //get status dari midtrans berdasarkan order_id nya
        $status = \Midtrans\Transaction::status($investID);
        $status = json_decode(json_encode($status),true);

        return response()->json($status);

    }

    public function detailStatusInvest($id)
    {
        $data = HeaderInvest::find($id);
        $statusInvest = $data->status_invest;

        return $statusInvest;
    }

    public function projectdetailInvest(Request $req, $id)
    {
        $data = HeaderInvest::find($id);
        $projectID = $data->project_id;

        $detail = DB::table('header_products')
                    ->leftJoin('detail_category_products', 'detail_category_products.id','=','header_products.id_detailcategory')
                    ->leftJoin('header_invests','header_invests.project_id','=','header_products.id')
                    ->leftJoin('users','users.id','=','header_products.user_id')
                    ->select('header_products.id','header_products.name_product','detail_category_products.name','header_invests.jumlah', 'users.name as nama_dev', 'users.email')
                    ->where('header_products.id', '=', $projectID)
                    ->where('header_invests.id','=',$id)
                    ->get();
        if($req->ajax()){
            return datatables()->of($detail)
                    ->addColumn('action', function($data){
                         $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                         $button .= '&nbsp;&nbsp;';
                         $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                         return $button;
                     })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
    }

    
}
