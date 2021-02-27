<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvController extends Controller
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
    public function event()
    {
        return view('investor.event');
    }

    public function buatEvent(){
        $user_role = auth()->user()->id;
    }

    public function startup()
    {
        return view('investor.startup');
    }

    public function detailstartup(){
        return view('investor.detailstartup');
    }

    public function akun()
    {
        return view('investor.akun');
    }
}
