<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     */
    public function index()
    {
        // Récupérer les activités mises en avant pour l'accueil
        $featuredActivities = Activity::where('is_public', true)
            ->where('is_featured', true)
            ->where('status', '!=', 'cancelled')
            ->orderBy('start_date', 'desc')
            ->limit(6)
            ->get();

        // Récupérer les dernières activités
        $recentActivities = Activity::where('is_public', true)
            ->where('status', '!=', 'cancelled')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('pages.home', compact('featuredActivities', 'recentActivities'));
    }

    /**
     * Affiche la page À propos
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Affiche la page des événements
     */
    public function events()
    {
        // Récupérer tous les événements publics
        $events = Activity::where('is_public', true)
            ->where('type', 'event')
            ->where('status', '!=', 'cancelled')
            ->orderBy('start_date', 'desc')
            ->paginate(12);

        return view('pages.events', compact('events'));
    }

    /**
     * Affiche un événement spécifique
     */
    public function showEvent(Activity $activity)
    {
        // Vérifier que c'est bien un événement public
        if ($activity->type !== 'event' || !$activity->is_public || $activity->status === 'cancelled') {
            abort(404);
        }

        // Incrémenter le compteur de vues
        $activity->increment('views_count');

        return view('pages.event-detail', compact('activity'));
    }
}
