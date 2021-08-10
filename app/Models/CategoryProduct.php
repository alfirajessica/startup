<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_category',
        'status',
    ];

    protected $table = "category_products";

    public function subcategory(){
        return $this->hasMany(detailCategoryProduct::class);
    }
}
