<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubStartupTag extends Model
{
    use HasFactory;
    protected $table = "sub_startup_tags";
    protected $fillable = [
        'name_subtag',
        'status',
    ];

    public function hstartuptag(){
        return $this->belongsTo(Hstartuptag::class);
    }

    //setiap sub startup tag dimiliki banyak produk
    public function headerproduct(){
        return $this->hasMany(HeaderProduct::class);
    }
}
