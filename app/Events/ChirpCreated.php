<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Chirp;
class ChirpCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channelName = "ChirpCreated";
    /**
     * Create a new event instance.
     */
    public function __construct(public Chirp $chirp)
    {
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return [new Channel($this->channelName)];
    }
    public function broadcastWith(): array
    {
        return ['chirp' => $this->chirp::with('user:id,name')->latest()->first(),
    'chirps'=>$this->chirp::with('user:id,name')->latest()->get()];
    }
}
