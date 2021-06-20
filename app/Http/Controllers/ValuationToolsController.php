<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValuationToolsController extends Controller
{
    public function valuation()
    {
        return view('guest.valTools');
    }

    public function addnew()
    {
        dd("ok");
    }
}
