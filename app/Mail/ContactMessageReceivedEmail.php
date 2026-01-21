<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceivedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactMessage $message
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de réception de votre message - Espoir Vie ASBL',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message-received',
            with: [
                'contactMessage' => $this->message,
                'contactUrl' => route('contact'),
            ],
        );
    }
}
