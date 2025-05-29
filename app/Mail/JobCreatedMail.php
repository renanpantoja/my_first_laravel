<?php

namespace App\Mail;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function build()
    {
        return $this->subject('Nova vaga criada!')
            ->view('emails.job-created');
    }
}
