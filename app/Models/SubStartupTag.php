<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubStartupTag extends Model
{
    use HasFactory;
    protected $table = "sub_startup_tags";

    public function hstartuptag(){
        return $this->belongsTo(hstartuptag::class);
    }
}
