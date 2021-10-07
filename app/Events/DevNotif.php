<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DevNotif implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userName, $startupName;

    public $newNotif, $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($newNotif, $userName, $startupName)
    {
       
        $this->newNotif  = $newNotif;
        $this->userName = $userName;
        $this->startupName = $startupName;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        //notif untuk developer
        return new Channel('dev-notif.'.$this->newNotif->user_to_notify1);
        
    }
}
