<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class DatatablesController extends Controller
{
    //
    public function getUser()
    {
        $query = User::select('id', 'name', 'email');
        return datatables($query)->make(true);
    }
}
