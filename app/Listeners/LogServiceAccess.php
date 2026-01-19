<?php

namespace App\Listeners;

use App\Events\ServiceAccessed;
use App\Models\ServiceAccessLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogServiceAccess
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ServiceAccessed $event): void
    {
        ServiceAccessLog::create([
            'user_id' => $event->user->id,
            'service' => $event->service,
            'action_type' => $event->actionType,
            'target_record' => $event->targetRecord,
            'details' => $event->details,
        ]);
    }
}
