<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevController extends Controller
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
    public function product()
    {
        return view('developer.product');
    }

    public function akun()
    {
        return view('developer.akun');
    }

    public function event(){
        return view('developer.event');
    }

    public function detailsEvent(){
        return view('developer.event.detailsEvent');
    }

    public function review()
    {
        return view('developer.review');
    }

    
}
