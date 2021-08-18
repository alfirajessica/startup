<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvestorReview implements ShouldBroadcast
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
        //$this->message  = "Menerima ulasan dari {$userName}";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('investor-review.'.$this->newNotif->user_to_notify1);
        //return ['investor-review'];
    }
}
