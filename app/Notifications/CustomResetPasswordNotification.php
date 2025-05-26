<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Reset Your Password')
            ->view('emails.password-reset', [
                'url' => $resetUrl,
                'user' => $notifiable,
            ]);
    }
    
}