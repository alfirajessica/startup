<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidtransData extends Model
{
    use HasFactory;
    protected $table = "midtrans_data";
    protected $fillable = [
        'invest_id','payment_type','bank','va_numbers','gross_amount','transaction_time','transaction_status','settlement_time'
    ];

   

}
