<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'type',
        'start_date',
        'end_date',
        'content',
        'activities_summary',
        'financial_summary',
        'pdf_path',
        'images',
        'total_donations',
        'total_expenses',
        'activities_count',
        'beneficiaries_count',
        'status',
        'is_public',
        'published_at',
        'notes',
        'metadata',
        'views_count',
        'downloads_count',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'activities_summary' => 'array',
        'financial_summary' => 'array',
        'images' => 'array',
        'total_donations' => 'decimal:2',
        'total_expenses' => 'decimal:2',
        'is_public' => 'boolean',
        'published_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function donorReports(): HasMany
    {
        return $this->hasMany(DonorReport::class);
    }
}
