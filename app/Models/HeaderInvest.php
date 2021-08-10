<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderInvest extends Model
{
    use HasFactory;
    protected $table = "header_invests";

    protected $fillable = [
        'user_id',
        'project_id',
        'invest_id',
        'jumlah_invest',
        'jumlah_final','status_transaction','status_invest','invest_expire'
    ];

    public function users(){
        return $this->belongsTo(Users::class);
    }

    public function headerproduct(){
        return $this->belongsTo(HeaderProduct::class);
    }
}
