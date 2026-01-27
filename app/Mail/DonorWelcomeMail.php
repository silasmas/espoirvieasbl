<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonorWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $plainPassword;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject('Bienvenue en tant que donateur Espoir Vie ASBL')
            ->markdown('emails.donor_welcome', [
                'user' => $this->user,
                'plainPassword' => $this->plainPassword,
            ]);
    }
}

