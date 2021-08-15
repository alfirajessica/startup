<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = "reviews";
    protected $fillable = [
        'user_id',
        'project_id',
        'rating',
        'isi_review','status'
    ];

    public function users(){
        return $this->belongsTo(Users::class);
    }

    public function headerproduct(){
        return $this->belongsTo(HeaderProduct::class);
    }

    public function responsereviews(){
        return $this->hasMany(ResponseReview::class);
    }


}
