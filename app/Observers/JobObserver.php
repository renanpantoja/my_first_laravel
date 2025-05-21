<?php

namespace App\Observers;

use App\Models\Job;
use App\Events\JobCreated;

class JobObserver
{
    public function created(Job $job): void
    {
        $employer = $job->employer;
        
        $employer->job_count = $employer->jobs()->count();
        $employer->save();

        JobCreated::dispatch($job);
    }

    public function deleted(Job $job): void
    {
        $employer = $job->employer;
        $employer->job_count = $employer->jobs()->count();
        $employer->save();
    }
}