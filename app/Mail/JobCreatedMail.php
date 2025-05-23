<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Job;

class JobCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

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
