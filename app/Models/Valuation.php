<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valuation extends Model
{
    use HasFactory;
    protected $table = "valuations";

    public function d_valuations(){
        return $this->hasMany(DValuation::class);
    }
}
