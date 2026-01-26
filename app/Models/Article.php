<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'tags',
        'author_id',
        'author_name',
        'is_published',
        'is_featured',
        'published_at',
        'views_count',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    /**
     * Génère automatiquement le slug à partir du titre
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    /**
     * Relation avec l'auteur (admin)
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    /**
     * Récupère le nom de l'auteur
     */
    public function getAuthorDisplayNameAttribute(): string
    {
        if ($this->author) {
            return $this->author->name;
        }
        return $this->author_name ?? 'Équipe Espoir Vie';
    }

    /**
     * Scope pour les articles publiés
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    /**
     * Scope pour les articles mis en avant
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope pour les articles récents
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc')->orderBy('created_at', 'desc');
    }
}
