<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'status',
        'ip_address',
        'subscription_token',
        'subscribed_at',
        'unsubscribed_at',
        'last_email_sent_at',
        'emails_received',
        'emails_opened',
        'links_clicked',
        'source',
        'metadata',
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
        'last_email_sent_at' => 'datetime',
        'metadata' => 'array',
    ];

    /**
     * Boot du modèle
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            if (empty($subscription->subscription_token)) {
                $subscription->subscription_token = Str::random(64);
            }
            if (empty($subscription->subscribed_at)) {
                $subscription->subscribed_at = now();
            }
            if (empty($subscription->status)) {
                $subscription->status = 'active';
            }
        });
    }
}
