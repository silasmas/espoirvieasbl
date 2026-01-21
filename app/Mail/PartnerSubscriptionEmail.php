<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PartnerSubscriptionEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $partnerData
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre demande de partenariat - Espoir Vie ASBL',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.partner-subscription',
            with: [
                'partner' => $this->partnerData,
                'contactUrl' => route('contact'),
            ],
        );
    }
}
