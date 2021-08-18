<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvestorGiveReview extends Notification implements ShouldQueue
{
    use Queueable;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id_notif_type' => $this->id,
            'user_to_notify1' =>$this->user->id,
            'user_to_notify2'=>$this->user->id,
            'user_fired_event' =>$this->user->id,
            'data' => [
                'follower_id' => $this->user->id,
                'follower_name' => $this->user->name,
            ],
            'read_at' => 0,
        ];
    }
}
