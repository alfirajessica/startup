<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTrans extends Model
{
    use HasFactory;
    protected $table = "type_trans";
    protected $fillable = [
        'tipe',
        'keterangan','status'
    ];

    //setiap type trans dimiliki banyak produk
    public function detailproductkas(){
        return $this->hasMany(DetailProductKas::class);
    }

    //setiap type trans dimiliki banyak produk
    public function headerproduct(){
        return $this->hasMany(HeaderProduct::class);
    }

}
