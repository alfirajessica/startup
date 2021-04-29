<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\HeaderEvent;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
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

        // //update details events berdasarkan id diatas
        //  for ($i=0; $i < count($get_id); $i++) {
             
        //  }
        
    }
    
}
