<?php

namespace App\Events;

use App\Message;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendMessage implements ShouldBroadcast
{

    use SerializesModels;

    /**
     * @var Message
     */
    public $message;
    public $user;

    /**
     * SendMessage constructor.
     * @param $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->user = Auth::user();
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new PresenceChannel("room.{$this->message->room_id}");
    }
}