<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'postal_code',
        'country',
        'wants_reports',
        'wants_newsletter',
        'is_anonymous',
        'tax_id',
        'company_name',
        'status',
        'notes',
        'last_donation_at',
        'total_donated',
    ];

    protected $casts = [
        'wants_reports' => 'boolean',
        'wants_newsletter' => 'boolean',
        'is_anonymous' => 'boolean',
        'last_donation_at' => 'datetime',
        'total_donated' => 'decimal:2',
    ];

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function recurringDonations(): HasMany
    {
        return $this->hasMany(RecurringDonation::class);
    }

    public function donorReports(): HasMany
    {
        return $this->hasMany(DonorReport::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
