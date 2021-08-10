<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;
    protected $table = "detail_users";

    protected $fillable = [
        'id_user',
        'desc',
        'team',
        'benefit',
        'target',
    ];

    public function users(){
        return $this->belongsTo(Users::class);
    }
}
