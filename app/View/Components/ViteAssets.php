<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ViteAssets extends Component
{
    /**
     * Vérifie si le manifest Vite existe
     */
    public function hasViteManifest(): bool
    {
        $manifestPath = public_path('build/manifest.json');
        return file_exists($manifestPath);
    }

    /**
     * Créer une nouvelle instance du composant.
     */
    public function __construct()
    {
        //
    }

    /**
     * Obtenir la vue qui représente le composant.
     */
    public function render()
    {
        return view('components.vite-assets');
    }
}
