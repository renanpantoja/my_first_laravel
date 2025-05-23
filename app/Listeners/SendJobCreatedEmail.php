<?php

namespace App\Listeners;

use App\Events\JobCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\JobCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendJobCreatedEmail
{
    public function handle(JobCreated $event): void
    {
        $job = $event->job;

        // Exemplo: enviar email para o employer dono da vaga
        $user = $job->employer->user;

        Mail::to($user->email)->queue(new JobCreatedMail($job));
    }
}
