<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotConfirmProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'reason',
    ];

    protected $table = "not_confirm_products";
}
