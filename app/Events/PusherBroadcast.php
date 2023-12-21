<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public string $two_letters;
    public string $name;
    public string $date;

    /**
     * Create a new event instance.
     */
    public function __construct(string $message , string $two_letters , string $name , string $date)
    {
        $this->message = $message;
        $this->two_letters = $two_letters;
        $this->name = $name;
        $this->date = $date;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            'public'
        ];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
