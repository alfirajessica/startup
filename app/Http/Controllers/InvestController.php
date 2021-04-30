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
        
        $this->snapToken = \Midtrans\Snap::getSnapToken($params);
        return $this->snapToken;
        //echo $this->snapToken;
          

        //dd($this->snapToken);
        
        

        
        
    }

    //nanti ganti jadi function global yang dipanggil pertama pas load
    public function saveToDbHeaderInvests($id)
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

    public function listInvestAktif(Request $req)
    {
        $user = auth()->user();
         //select * from header_invest where user_id=id

        $list_InvestAktif = DB::table('header_invests')
                    ->where('user_id', '=', $user->id)
                    //->where('status','=','1')
                    ->get();
        if($req->ajax()){
            return datatables()->of($list_InvestAktif)
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

        $status = \Midtrans\Transaction::status('622002438');
        dd($status);

        return view('inv.listInvest');
    }

    public function listInvestTdkAktif(Request $req)
    {
        $user = auth()->user();
         //select * from header_invest where user_id=id

        $list_InvestTdkAktif = DB::table('header_invests')
                    ->where('user_id', '=', $user->id)
                    //->where('status','=','0')
                    ->get();
        if($req->ajax()){
            return datatables()->of($list_InvestTdkAktif)
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

    
}
