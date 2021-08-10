<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailCategoryProduct extends Model
{
    use HasFactory;
    protected $table = "detail_category_products";

    protected $fillable = [
        'name',
        'status',
    ];

    public function category(){
        return $this->belongsTo(CategoryProduct::class);
    }

    //setiap subdetail category dimiliki banyak produk
    public function headerproduct(){
        return $this->hasMany(HeaderProduct::class);
    }
}
