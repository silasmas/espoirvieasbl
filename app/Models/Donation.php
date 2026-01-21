<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'donor_id',
        'recurring_donation_id',
        'activity_id',
        'amount',
        'currency',
        'type',
        'status',
        'payment_method',
        'payment_reference',
        'transaction_id',
        'paid_at',
        'tax_receipt_sent',
        'tax_receipt_sent_at',
        'tax_receipt_number',
        'notes',
        'source',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'tax_receipt_sent' => 'boolean',
        'tax_receipt_sent_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }

    public function recurringDonation(): BelongsTo
    {
        return $this->belongsTo(RecurringDonation::class);
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
