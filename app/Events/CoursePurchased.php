<?php

namespace App\Events;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CoursePurchased
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public Kelas $kelas;
    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Kelas $kelas)
    {
        $this->user = $user;
        $this->kelas = $kelas;
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
