<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return view('developer.home'); 
        }
        //investor
        else if ($user_role == "2") {
            return view('investor.home'); 
        }
        //admin
        else{
            return view('investor.home');
        }
        
    }

    
}
