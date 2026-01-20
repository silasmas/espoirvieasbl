<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonationReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'recurring_donation_id',
        'donor_id',
        'type',
        'scheduled_date',
        'donation_due_date',
        'sent_at',
        'status',
        'email_subject',
        'email_content',
        'email_id',
        'email_opened',
        'email_clicked',
        'email_opened_at',
        'error_message',
        'notes',
        'metadata',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'donation_due_date' => 'date',
        'sent_at' => 'datetime',
        'email_opened' => 'boolean',
        'email_clicked' => 'boolean',
        'email_opened_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function recurringDonation(): BelongsTo
    {
        return $this->belongsTo(RecurringDonation::class);
    }

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }
}
