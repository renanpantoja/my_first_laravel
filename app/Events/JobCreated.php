<?php

namespace App\Events;

use App\Models\Job;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Job $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}
