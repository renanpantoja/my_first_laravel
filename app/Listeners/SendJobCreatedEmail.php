<?php

namespace App\Listeners;

use App\Events\JobCreated;
use App\Mail\JobCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendJobCreatedEmail
{
    public function handle(JobCreated $event): void
    {
        $job = $event->job;

        $user = $job->employer->user;

        Mail::to($user->email)->queue(new JobCreatedMail($job));
    }
}
