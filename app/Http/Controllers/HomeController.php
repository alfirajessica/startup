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
            
            return view('investor.home'); 
        }
        // //admin
        // else{
            
        //     return view('investor.home');
        // }
        
    }

    
}
