<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonorReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'report_id',
        'status',
        'sent_at',
        'opened_at',
        'clicked_at',
        'downloaded_at',
        'email_opened',
        'link_clicked',
        'report_viewed',
        'pdf_downloaded',
        'view_count',
        'email_id',
        'email_subject',
        'error_message',
        'notes',
        'metadata',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'opened_at' => 'datetime',
        'clicked_at' => 'datetime',
        'downloaded_at' => 'datetime',
        'email_opened' => 'boolean',
        'link_clicked' => 'boolean',
        'report_viewed' => 'boolean',
        'pdf_downloaded' => 'boolean',
        'metadata' => 'array',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
