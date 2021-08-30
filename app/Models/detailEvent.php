<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailEvent extends Model
{
    use HasFactory;
    protected $table = "detail_events";
    protected $fillable = [
        'id_header_events',
        'id_participant',
        'status',
    ];
    
    function headerevent(){
		return $this->belongsTo(HeaderEvent::class);
	}

    function users(){
		return $this->belongsTo(User::class);
	}
}
