<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'type',
        'category',
        'tags',
        'start_date',
        'end_date',
        'location',
        'country',
        'budget',
        'amount_raised',
        'amount_spent',
        'status',
        'is_featured',
        'is_public',
        'include_in_reports',
        'image',
        'images',
        'video_url',
        'results',
        'impact',
        'beneficiaries_count',
        'impact_metrics',
        'notes',
        'metadata',
        'views_count',
        'likes_count',
    ];

    protected $casts = [
        'tags' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
        'amount_raised' => 'decimal:2',
        'amount_spent' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_public' => 'boolean',
        'include_in_reports' => 'boolean',
        'images' => 'array',
        'impact_metrics' => 'array',
        'metadata' => 'array',
    ];

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
