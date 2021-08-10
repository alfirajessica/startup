<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotConfirmProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_headerproduct',
        'reason',
    ];

    protected $table = "not_confirm_products";

    public function headerproduct(){
        return $this->belongsTo(HeaderProduct::class);
    }

}
