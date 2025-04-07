<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatedCustomerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $companyData;

    /**
     * Create a new event instance.
     */
    public function __construct($dataEvent)
    {
        //
        $this->user = $dataEvent['user'];
        $this->companyData = $dataEvent['companyData'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
