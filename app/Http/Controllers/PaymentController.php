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

class PaymentController extends Controller
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

    //GAK DIPAKAI
    public $snapToken;
    public $projectInvest;

    public function investTo(Request $req, $id, $invest)
    {
        $token=0;
        $user = auth()->user();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-prYkvSccGV27NceSR_YIgIQo';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $this->projectInvest = HeaderProduct::find($id);

        $params = array(
            'transaction_details' => array(
                'order_id' => $id+mt_rand(),
                'gross_amount' => $invest,
            ),
            'customer_details' => array(
                'first_name' => $user->id,
                'last_name' => $user->name,
                'email' => $user->email,
                'phone' => '08111222333',
            ),
        );
       

        //insert ke table header_invest jika melakukan pembayaran
        // $newHeader = new HeaderInvest;
        // $newHeader->user_id = $user->id;
        // $newHeader->project_id = $id;
        // $newHeader->invest_id = $id+mt_rand();
        // $newHeader->jumlah = $invest;
        // $newHeader->profit = 0;
        // $newHeader->status = '1';   //status masih invest apa tidak
        // $query = $newHeader->save();

        
        
        $this->snapToken = \Midtrans\Snap::getSnapToken($params);
        return $this->snapToken;
        //echo $this->snapToken;
        dd($this->snapToken);
        
    }
    public function mount()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-prYkvSccGV27NceSR_YIgIQo';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );
 
        $this->snapToken = \Midtrans\Snap::getSnapToken($params);
        //dd($this->snapToken);
    }
}
