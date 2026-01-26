<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'position',
        'bio',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'is_team_visible',
        'team_order',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_team_visible' => 'boolean',
            'team_order' => 'integer',
        ];
    }

    /**
     * Relation avec les articles
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /**
     * Scope pour les membres d'équipe visibles
     */
    public function scopeTeamVisible($query)
    {
        return $query->where('is_team_visible', true);
    }

    /**
     * Scope pour l'ordre d'affichage de l'équipe
     */
    public function scopeTeamOrdered($query)
    {
        return $query->orderBy('team_order')->orderBy('name');
    }

    /**
     * Vérifie si l'admin a des réseaux sociaux
     */
    public function hasSocialLinks(): bool
    {
        return $this->facebook_url || $this->twitter_url || $this->linkedin_url || $this->instagram_url;
    }
}
