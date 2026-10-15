<?php

if (!function_exists('activity_image_url')) {
    /**
     * Retourne l'URL complète d'une image d'activité.
     * Si l'image est une URL complète (http:// ou https://), elle est retournée telle quelle.
     * Sinon, elle est considérée comme une image locale et le chemin storage est ajouté.
     *
     * @param string|null $image
     * @return string|null
     */
    function activity_image_url(?string $image): ?string
    {
        if (empty($image)) {
            return null;
        }

        // Vérifier si c'est une URL complète (http:// ou https://)
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        // Sinon, c'est une image locale, ajouter le chemin storage
        return asset('storage/' . $image);
    }
}

if (!function_exists('site_section')) {
    /**
     * Retourne une rubrique du site, ou null si elle n'est pas encore en base.
     *
     * @param  string  $key  Clé stable, par exemple home.banner
     */
    function site_section(string $key): ?\App\Models\SiteSection
    {
        return \App\Services\SiteContent::find($key);
    }
}

if (!function_exists('site_visible')) {
    /**
     * Indique si une rubrique est affichée sur le site public.
     *
     * @param  string  $key  Clé de la rubrique
     * @param  bool  $default  Valeur utilisée si la rubrique n'existe pas
     */
    function site_visible(string $key, bool $default = true): bool
    {
        return \App\Services\SiteContent::visible($key, $default);
    }
}

if (!function_exists('site_text')) {
    /**
     * Lit un texte de rubrique (subtitle, title, body, button_label, button_url).
     *
     * @param  string  $key  Clé de la rubrique
     * @param  string  $field  Nom du champ
     * @param  string  $default  Texte affiché si le champ est vide
     */
    function site_text(string $key, string $field, string $default = ''): string
    {
        $section = site_section($key);
        $value = $section?->{$field} ?? null;

        if ($value === null || $value === '') {
            return $default;
        }

        return (string) $value;
    }
}

if (!function_exists('site_extra')) {
    /**
     * Lit une information complémentaire (téléphone, e-mail, réseau social, etc.).
     *
     * @param  string  $key  Clé de la rubrique
     * @param  string  $field  Clé dans le JSON extra
     * @param  string  $default  Valeur de repli
     */
    function site_extra(string $key, string $field, string $default = ''): string
    {
        $section = site_section($key);

        if ($section === null) {
            return $default;
        }

        return $section->extraValue($field, $default);
    }
}

if (!function_exists('site_items')) {
    /**
     * Retourne la liste d'éléments d'une rubrique (chiffres, puces, accordéon).
     *
     * @param  string  $key  Clé de la rubrique
     * @return list<array<string, mixed>>
     */
    function site_items(string $key): array
    {
        $items = site_section($key)?->items;

        return is_array($items) ? array_values($items) : [];
    }
}

if (!function_exists('site_media_url')) {
    /**
     * Transforme un chemin d'image (stockage ou URL) en adresse affichable.
     *
     * @param  string|null  $path  Chemin relatif storage, URL absolue, ou vide
     * @param  string  $fallbackAsset  Chemin sous public/, utilisé si $path est vide
     */
    function site_media_url(?string $path, string $fallbackAsset): string
    {
        if ($path === null || $path === '') {
            return asset($fallbackAsset);
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }
}

if (!function_exists('site_image')) {
    /**
     * URL de l'image principale d'une rubrique, ou image de repli du thème.
     *
     * @param  string  $key  Clé de la rubrique
     * @param  string  $fallbackAsset  Image du thème si aucune photo n'est enregistrée
     */
    function site_image(string $key, string $fallbackAsset): string
    {
        return site_media_url(site_section($key)?->image, $fallbackAsset);
    }
}

if (!function_exists('site_link')) {
    /**
     * Résout le lien d'un bouton : URL, chemin, ou nom de route Laravel.
     *
     * @param  string  $key  Clé de la rubrique
     * @param  string  $defaultRoute  Nom de route utilisé si le champ est vide
     */
    function site_link(string $key, string $defaultRoute): string
    {
        $url = site_text($key, 'button_url');

        if ($url === '') {
            return route($defaultRoute);
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, '/')) {
            return $url;
        }

        if (\Illuminate\Support\Facades\Route::has($url)) {
            return route($url);
        }

        return $url;
    }
}

if (!function_exists('site_phone')) {
    /**
     * Numéro de téléphone public. Chaîne vide si l'administrateur ne l'a pas renseigné.
     */
    function site_phone(): string
    {
        return site_extra('global.contact', 'phone');
    }
}

if (!function_exists('site_email')) {
    /**
     * Adresse e-mail publique de l'association.
     */
    function site_email(): string
    {
        return site_extra('global.contact', 'email', 'info@espoirvieasbl.org');
    }
}

if (!function_exists('site_address')) {
    /**
     * Adresse publique affichée dans le pied de page et la page contact.
     */
    function site_address(): string
    {
        return site_extra('global.contact', 'address', 'Kinshasa, République démocratique du Congo');
    }
}

if (!function_exists('site_map_embed')) {
    /**
     * URL d'intégration de la carte de la page contact.
     */
    function site_map_embed(): string
    {
        return site_extra(
            'global.contact',
            'map_embed',
            'https://maps.google.com/maps?q=Kinshasa,%20RDC&z=12&output=embed'
        );
    }
}

if (!function_exists('site_menu')) {
    /**
     * Liens de navigation visibles, dans l'ordre du menu.
     *
     * @return list<array{route: string, label: string}>
     */
    function site_menu(): array
    {
        $defaults = [
            ['key' => 'menu.home', 'route' => 'home', 'label' => 'Accueil'],
            ['key' => 'menu.about', 'route' => 'about', 'label' => 'À propos'],
            ['key' => 'menu.team', 'route' => 'team', 'label' => 'Notre équipe'],
            ['key' => 'menu.events', 'route' => 'events', 'label' => 'Événements'],
            ['key' => 'menu.articles', 'route' => 'articles', 'label' => 'Articles'],
            ['key' => 'menu.donate', 'route' => 'donate', 'label' => 'Faire un don'],
            ['key' => 'menu.contact', 'route' => 'contact', 'label' => 'Nous contacter'],
        ];

        $items = [];

        foreach ($defaults as $item) {
            if (! site_visible($item['key'])) {
                continue;
            }

            $items[] = [
                'route' => $item['route'],
                'label' => site_text($item['key'], 'title', $item['label']),
            ];
        }

        return $items;
    }
}

if (!function_exists('site_social_links')) {
    /**
     * Réseaux sociaux renseignés par l'administrateur.
     *
     * @return list<array{url: string, icon: string, label: string}>
     */
    function site_social_links(): array
    {
        $networks = [
            ['field' => 'facebook', 'icon' => 'flaticon-facebook', 'label' => 'Facebook'],
            ['field' => 'twitter', 'icon' => 'flaticon-twitter', 'label' => 'X'],
            ['field' => 'instagram', 'icon' => 'flaticon-instagram', 'label' => 'Instagram'],
            ['field' => 'linkedin', 'icon' => 'flaticon-linkedin-big-logo', 'label' => 'LinkedIn'],
            ['field' => 'youtube', 'icon' => 'flaticon-youtube', 'label' => 'YouTube'],
        ];

        $links = [];

        foreach ($networks as $network) {
            $url = site_extra('global.social', $network['field']);

            if ($url === '' || $url === '#') {
                continue;
            }

            $links[] = [
                'url' => $url,
                'icon' => $network['icon'],
                'label' => $network['label'],
            ];
        }

        return $links;
    }
}

if (!function_exists('site_gallery_urls')) {
    /**
     * Photos de la galerie d'accueil. Repli sur les images du thème si aucune n'est chargée.
     *
     * @return list<string>
     */
    function site_gallery_urls(): array
    {
        $urls = [];

        foreach (site_items('home.gallery') as $item) {
            $image = $item['image'] ?? null;

            if (is_array($image)) {
                $image = $image[0] ?? null;
            }

            if (is_string($image) && $image !== '') {
                $urls[] = site_media_url($image, 'assets/img/gallery-item-1.png');
            }
        }

        if ($urls !== []) {
            return $urls;
        }

        $fallbacks = [];

        for ($index = 1; $index <= 6; $index++) {
            $fallbacks[] = asset('assets/img/gallery-item-' . $index . '.png');
        }

        return $fallbacks;
    }
}
