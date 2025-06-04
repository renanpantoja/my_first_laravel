<?php

namespace App\Events;

use App\Models\Job;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Job $job) {}
}