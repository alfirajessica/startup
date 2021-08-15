<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingInvest extends Model
{
    use HasFactory;
    protected $table = "rating_invests";
    protected $fillable = [
        'id_headerinvest',
        'rating','review',
    ];

    public function headerinvests(){
        return $this->belongsTo(HeaderInvest::class);
    }
}
