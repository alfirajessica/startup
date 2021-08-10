<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProductKas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "detail_product_kas";
    protected $fillable = [
        'id_headerproduct',
        'id_typetrans',
        'jumlah',
        'status',
    ];

    //punya 1 typetrans
    public function typetrans(){
        return $this->belongsTo(TypeTrans::class);
    }

    //dimiliki setiap product
    public function headerproduct(){
        return $this->belongsTo(HeaderProduct::class);
    }

}
