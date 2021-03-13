<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailCategoryProduct extends Model
{
    use HasFactory;
    protected $table = "detail_category_products";

    public function category(){
        return $this->belongsTo(CategoryProduct::class);
    }
}
