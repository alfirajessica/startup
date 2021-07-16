<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HStartupTag extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_startup_tag',
    ];

    protected $table = "h_startup_tags";

    public function substartuptag(){
        return $this->hasMany(SubStartupTag::class);
    }
}
