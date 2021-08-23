<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notifications";
    protected $fillable = [
        'id_notif_type',
        'user_to_notify1',
        'name_user_to_notify1',
        'read_to_notify1',
        'user_to_notify2',
        'user_fired_event',
        'name_user_fired_event',
        'name_product',
        'data',
        'read_to_notify2',
    ];
    
    public function notificationtypes(){
        return $this->belongsTo(NotificationType::class);
    }

}
