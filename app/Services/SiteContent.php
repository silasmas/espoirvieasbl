<?php

namespace App\Services;

use App\Models\SiteSection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Throwable;

/**
 * Accès mis en cache aux rubriques du site public.
 *
 * Le cache est invalidé par le modèle SiteSection à chaque enregistrement.
 */
class SiteContent
{
    private const CACHE_KEY = 'site_sections.v1';

    /**
     * Retourne toutes les rubriques indexées par leur clé.
     *
     * @return Collection<string, SiteSection>
     */
    public static function all(): Collection
    {
        try {
            return Cache::remember(self::CACHE_KEY, 3600, function (): Collection {
                return SiteSection::query()->get()->keyBy('key');
            });
        } catch (Throwable) {
            return collect();
        }
    }

    /**
     * Retourne une rubrique, ou null si elle n'existe pas encore.
     */
    public static function find(string $key): ?SiteSection
    {
        $section = self::all()->get($key);

        return $section instanceof SiteSection ? $section : null;
    }

    /**
     * Indique si la rubrique doit être affichée.
     * Une rubrique absente reste visible, pour ne pas vider le site avant le seed.
     */
    public static function visible(string $key, bool $default = true): bool
    {
        $section = self::find($key);

        if ($section === null) {
            return $default;
        }

        return (bool) $section->is_visible;
    }

    /**
     * Vide le cache des rubriques.
     */
    public static function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
