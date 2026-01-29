<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Devonab\FilamentEasyFooter\EasyFooterPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel = $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->authGuard('admin')
            ->authPasswordBroker('admins')
            ->colors([
                // Couleurs alignées sur le logo et le site public (--ul-primary: #0172b8)
                'primary' => '#0172b8',
                'secondary' => '#005a8c',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);

        /**
         * Intégration du plugin Easy Footer.
         *
         * On protège l’appel avec class_exists pour éviter toute erreur
         * si le package n’est pas encore installé localement.
         */
        if (class_exists(EasyFooterPlugin::class)) {
            $panel->plugins([
                EasyFooterPlugin::make()
                    // Position du footer (bas de page Filament).
                    ->withFooterPosition('footer')
                    // Logo personnalisé : on réutilise le logo public du site.
                    // - 1er paramètre : URL du logo
                    // - 2e paramètre : URL du lien (page d’accueil du site public)
                    // - 3e paramètre : texte affiché à côté du logo
                    // - 4e paramètre : hauteur du logo en pixels
                    ->withLogo(
                        asset('assets/img/lg.png'),
                        url('/'),
                        'Espoir Vie ASBL',
                        40
                    )
                    // Phrase personnalisée cohérente avec l’identité du site.
                    ->withSentence('Espoir Vie ASBL – Ensemble, redonnons espoir à des vies.')
                    // Petite bordure supérieure pour séparer le footer du contenu.
                    ->withBorder(),
            ]);
        }

        return $panel;
    }
}
