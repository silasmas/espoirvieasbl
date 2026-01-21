<?php

namespace App\Mail;

use App\Models\NewsletterSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscriptionEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public NewsletterSubscription $subscription
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue dans la newsletter d\'Espoir Vie ASBL',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter-subscription',
            with: [
                'subscription' => $this->subscription,
                'unsubscribeUrl' => route('newsletter.unsubscribe', ['token' => $this->subscription->subscription_token]),
                'contactUrl' => route('contact'),
            ],
        );
    }
}
