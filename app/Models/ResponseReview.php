<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseReview extends Model
{
    use HasFactory;
    protected $table = "response_reviews";
    protected $fillable = [
        'id_reviews',
        'response',
        'status',
    ];

    public function reviews(){
        return $this->belongsTo(Review::class);
    }
}
