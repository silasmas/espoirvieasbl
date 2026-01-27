<?php

namespace App\Providers;

use App\Models\Article;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Partager les articles récents pour le footer sur toutes les vues publiques
        View::composer('*', function ($view) {
            try {
                $footerRecentArticles = Article::published()
                    ->recent()
                    ->limit(2)
                    ->get();
            } catch (\Throwable $e) {
                // En cas de problème de connexion à la DB (ex : migrations non exécutées),
                // on évite de casser le rendu du site.
                $footerRecentArticles = collect();
            }

            $view->with('footerRecentArticles', $footerRecentArticles);
        });
    }
}
