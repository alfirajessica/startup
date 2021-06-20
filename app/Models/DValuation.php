<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DValuation extends Model
{
    use HasFactory;
    protected $table = "d_valuations";

    public function valuation(){
        return $this->belongsTo(valuation::class);
    }
}
