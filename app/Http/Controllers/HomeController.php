<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\HeaderEvent;
use App\Models\HeaderInvest;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public $MIDTRANS_SERVER_KEY = 'SB-Mid-server-prYkvSccGV27NceSR_YIgIQo';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('guest');
        // $this->middleware('guest:admin');

        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user_role = auth()->user()->role;
        //dd($user_role);

        //developer
        if ($user_role == "1") {
            $header_events['header_events'] = DB::table("header_events")
                   ->whereDate('created_at', '>', Carbon::now()->subDays(30))
                   ->get();
            return view('developer.home', $header_events); 
        }
        //investor
        else if ($user_role == "2") {
            
             $get_id = DB::table('header_events')->select('id')->where('status','=','2')->get();
            // dd($get_id);
             /*for ($i=0; $i <=count($get_id) ; $i++) { 
                 dd($get_id);
                 
             }*/

            /*UPDATE detail_events SET status=2
            WHERE (SELECT id FROM header_events 
            WHERE header_events.id=detail_events.id_header_events AND
            header_events.status=2)

             $upd_details = 
             DB::table('detail_events')
                ->where(
                    DB::table('header_events')
                    ->where('header_events.id','=','detail_events.id_header_events')
                    ->where('header_events.status','=','2')
                )
                ->update([
                    'detail_events.status' =>'2',
                ]);

            */
            return view('investor.home'); 
        }
        // //admin
        // else{
            
        //     return view('investor.home');
        // }
        
    }

    //check event if has passed
    public function event_haspassed()
    {
       
        //get date now
        $date = Carbon::now();

        //update status yang ada di header_events
        $list_event = DB::table('header_events')
                    ->where('event_schedule','<',$date->toDateString())
                    ->update([
                        'status' =>'2',
                    ]);
        
        //get id yang tadinya di update status nya menjadi 2
        $get_id = DB::table('header_events')->select('id')->where('status','=','2')->get();
        dd($get_id);
        
        $upd_details = 
             DB::table('detail_events')
                ->join('header_events')
                ->where('detail_events.id_header_events','=','header_events.id')
                ->where('header_events.status','=','2')
                ->update([
                    'status' =>'2',
                ]);
    }


    public function updStatusTrans()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $this->MIDTRANS_SERVER_KEY;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
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

             DB::table('header_products')
             ->leftJoin('header_invests','header_invests.project_id','=','header_products.id')
             ->where('header_invests.invest_id','=',$data[$i]['invest_id'])
             ->where('header_invests.status_transaction','=','pending')
             ->where('header_invests.status_transaction','=','settlement')
             ->update([
                 'header_products.status' => '2',
             ]);
        }
    }


    
}
