<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecurringDonation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'donor_id',
        'amount',
        'currency',
        'frequency',
        'start_date',
        'end_date',
        'next_donation_date',
        'payment_method',
        'payment_reference',
        'subscription_id',
        'status',
        'total_donations',
        'failed_attempts',
        'last_donation_date',
        'notes',
        'metadata',
        'cancelled_at',
        'cancellation_reason',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'next_donation_date' => 'date',
        'last_donation_date' => 'date',
        'cancelled_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function reminders(): HasMany
    {
        return $this->hasMany(DonationReminder::class);
    }
}
