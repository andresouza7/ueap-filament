<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ServiceAccessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $service;
    public $actionType;
    public $targetRecord;
    public $details;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, string $service, string $actionType, ?string $targetRecord = null, ?array $details = null)
    {
        $this->user = $user;
        $this->service = $service;
        $this->actionType = $actionType;
        $this->targetRecord = $targetRecord;
        $this->details = $details;
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
