<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'activity_id',
        'title',
        'description',
        'amount',
        'currency',
        'category',
        'subcategory',
        'expense_date',
        'payment_date',
        'payment_method',
        'payment_reference',
        'vendor',
        'invoice_number',
        'invoice_date',
        'attachments',
        'status',
        'approved_by',
        'approved_at',
        'notes',
        'metadata',
        'is_public',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
        'payment_date' => 'date',
        'invoice_date' => 'date',
        'attachments' => 'array',
        'approved_at' => 'datetime',
        'metadata' => 'array',
        'is_public' => 'boolean',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }
}
