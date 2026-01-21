<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscription;
use App\Mail\NewsletterSubscriptionEmail;
use App\Mail\ContactMessageReceivedEmail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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

    /**
     * Affiche la page Faire un don
     */
    public function donate()
    {
        return view('pages.donate');
    }

    /**
     * Affiche la page Nous contacter
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Enregistre un message de contact
     */
    public function storeContactMessage(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Le nom est requis.',
            'email.required' => 'L\'adresse email est requise.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'subject.required' => 'Le sujet est requis.',
            'message.required' => 'Le message est requis.',
            'message.max' => 'Le message ne peut pas dépasser 5000 caractères.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez corriger les erreurs dans le formulaire.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'status' => 'new',
            ]);

            // Envoyer un email de confirmation au visiteur
            try {
                Mail::to($request->email)->send(new ContactMessageReceivedEmail($contactMessage));
            } catch (\Exception $mailException) {
                // Logger l'erreur mais ne pas bloquer la réponse
                Log::error('Erreur lors de l\'envoi de l\'email de confirmation : ' . $mailException->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.'
            ], 500);
        }
    }

    /**
     * Enregistre une inscription à la newsletter
     */
    public function subscribeNewsletter(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'agreement' => 'required|in:1,true,on,yes',
        ], [
            'email.required' => 'L\'adresse email est requise.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'agreement.required' => 'Vous devez accepter la politique de confidentialité.',
            'agreement.in' => 'Vous devez accepter la politique de confidentialité.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez corriger les erreurs dans le formulaire.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $email = strtolower(trim($request->email));

            // Vérifier si l'email existe déjà
            $existing = NewsletterSubscription::where('email', $email)->first();

            if ($existing) {
                // Si l'utilisateur était désabonné, le réactiver
                if ($existing->status === 'unsubscribed') {
                    $existing->update([
                        'status' => 'active',
                        'subscribed_at' => now(),
                        'unsubscribed_at' => null,
                        'ip_address' => $request->ip(),
                        'source' => 'website',
                    ]);

                    // Envoyer un email de bienvenue
                    try {
                        Mail::to($email)->send(new NewsletterSubscriptionEmail($existing));
                    } catch (\Exception $mailException) {
                        Log::error('Erreur lors de l\'envoi de l\'email de newsletter : ' . $mailException->getMessage());
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Votre inscription à la newsletter a été réactivée avec succès !'
                    ]);
                } else {
                    // Déjà inscrit
                    return response()->json([
                        'success' => true,
                        'message' => 'Vous êtes déjà inscrit à notre newsletter !'
                    ]);
                }
            }

            // Créer une nouvelle inscription
            $subscription = NewsletterSubscription::create([
                'email' => $email,
                'status' => 'active',
                'ip_address' => $request->ip(),
                'subscribed_at' => now(),
                'subscription_token' => Str::random(64),
                'source' => 'website',
            ]);

            // Envoyer un email de bienvenue
            try {
                Mail::to($email)->send(new NewsletterSubscriptionEmail($subscription));
            } catch (\Exception $mailException) {
                Log::error('Erreur lors de l\'envoi de l\'email de newsletter : ' . $mailException->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Votre inscription à la newsletter a été enregistrée avec succès ! Vous recevrez désormais nos dernières actualités par email.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer plus tard.'
            ], 500);
        }
    }

    /**
     * Désabonnement de la newsletter
     */
    public function unsubscribeNewsletter(string $token)
    {
        try {
            $subscription = NewsletterSubscription::where('subscription_token', $token)
                ->where('status', 'active')
                ->first();

            if (!$subscription) {
                return view('pages.newsletter-unsubscribe', [
                    'success' => false,
                    'message' => 'Le lien de désabonnement est invalide ou a expiré.',
                ]);
            }

            $subscription->update([
                'status' => 'unsubscribed',
                'unsubscribed_at' => now(),
            ]);

            return view('pages.newsletter-unsubscribe', [
                'success' => true,
                'message' => 'Vous avez été désabonné de notre newsletter avec succès. Nous sommes désolés de vous voir partir.',
                'email' => $subscription->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors du désabonnement : ' . $e->getMessage());
            return view('pages.newsletter-unsubscribe', [
                'success' => false,
                'message' => 'Une erreur est survenue lors du désabonnement. Veuillez réessayer plus tard.',
            ]);
        }
    }
}
