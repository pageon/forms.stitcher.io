<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var \App\User */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this
            ->subject('Activate Your Account')
            ->view('mail.activate', [
                'user' => $this->user,
                'activationLink' => route('user.activate', $this->user->activation_token),
            ]);
    }
}
