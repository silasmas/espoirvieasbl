<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'phone',
        'country',
        'donation_period',
        'donation_amount',
        'donation_currency',
        'donation_type',
        'donation_description',
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
        ];
    }

    /**
     * Relation pratique vers le "vrai" profil donateur.
     *
     * On relie l'utilisateur connecté à l'enregistrement de la table donors
     * en se basant sur l'email. Cela permet d'utiliser toutes les relations
     * métiers (donations, recurringDonations, rapports, etc.) à partir du
     * modèle Donor, tout en conservant l'authentification sur le modèle User.
     */
    public function donor()
    {
        // hasOne(Donor::class, 'colonne_dans_donors', 'colonne_dans_users')
        return $this->hasOne(Donor::class, 'email', 'email');
    }
}
