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
