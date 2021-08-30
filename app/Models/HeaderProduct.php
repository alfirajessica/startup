<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderProduct extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_product',
        'id_detailcategory',
        'id_substartuptag',
        'url',
        'rilis',
        'desc',
        'team',
        'reason',
        'benefit',
        'status',
    ];

    protected $table = "header_products";

    public function users(){
      return $this->belongsTo(Users::class);
    }

    //setiap header produk memiliki 1 id_detailcategory
    public function subcategory(){
      return $this->hasOne(detailCategoryProduct::class);
    }

    //setiap header produk memiliki 1 id_substartuptag
    public function substartupcategory(){
      return $this->hasOne(SubStartupTag::class);
    }

    public function detailproductkas(){
		  return $this->hasMany(DetailProductKas::class);
	  }

    public function reviews(){
		  return $this->hasMany(Review::class);
	  }

    public function headerinvest(){
		  return $this->hasMany(HeaderInvest::class);
	  }
}
