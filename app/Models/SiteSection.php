<?php

namespace App\Models;

use App\Services\SiteContent;
use Illuminate\Database\Eloquent\Model;

/**
 * Rubrique éditable du site public (texte, image, visibilité).
 *
 * Chaque enregistrement correspond à un bloc identifié par une clé stable
 * (par exemple global.contact ou home.banner). L'administrateur peut en
 * modifier le contenu et choisir de l'afficher ou de le masquer.
 */
class SiteSection extends Model
{
    /**
     * Pages proposées dans l'administration, de la plus simple à la plus détaillée.
     *
     * @var array<string, string>
     */
    public const PAGES = [
        'global' => '1. Infos de base',
        'menu' => '2. Menu du site',
        'home' => '3. Accueil',
        'about' => '4. À propos',
        'contact' => '5. Contact',
        'team' => '6. Équipe',
        'events' => '7. Événements',
        'articles' => '8. Articles',
        'donate' => '9. Dons',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'key',
        'page',
        'label',
        'help_text',
        'is_visible',
        'sort_order',
        'subtitle',
        'title',
        'body',
        'image',
        'button_label',
        'button_url',
        'items',
        'extra',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'sort_order' => 'integer',
            'items' => 'array',
            'extra' => 'array',
        ];
    }

    /**
     * Vide le cache public dès qu'une rubrique est enregistrée ou supprimée.
     */
    protected static function booted(): void
    {
        static::saved(function (): void {
            SiteContent::flush();
        });

        static::deleted(function (): void {
            SiteContent::flush();
        });
    }

    /**
     * Libellé français de la page à laquelle appartient la rubrique.
     */
    public function pageLabel(): string
    {
        return self::PAGES[$this->page] ?? $this->page;
    }

    /**
     * Lit une valeur du champ JSON extra.
     *
     * @param  string  $field  Clé recherchée (phone, email, address, etc.)
     * @param  string  $default  Valeur renvoyée si la clé est absente ou vide
     */
    public function extraValue(string $field, string $default = ''): string
    {
        $value = $this->extra[$field] ?? null;

        if ($value === null || $value === '') {
            return $default;
        }

        return (string) $value;
    }
}
