<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'ip_address',
        'read_at',
        'replied_at',
        'admin_notes',
        'admin_id',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    /**
     * Relation avec l'administrateur qui a traité le message
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
