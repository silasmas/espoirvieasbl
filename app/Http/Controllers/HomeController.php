<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Admin;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscription;
use App\Models\Donor;
use App\Models\Donation;
use App\Models\User;
use App\Mail\DonorWelcomeMail;
use App\Models\Testimonial;
use App\Mail\NewsletterSubscriptionEmail;
use App\Mail\ContactMessageReceivedEmail;
use App\Services\MailService;
use App\Services\FlexPayService;
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

        // Récupérer les activités pour le slider de donations (projets avec budget)
        $donationActivities = Activity::where('is_public', true)
            ->where('status', '!=', 'cancelled')
            ->whereNotNull('budget')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Récupérer les événements à venir (max 4)
        $upcomingEvents = Activity::where('is_public', true)
            ->where('type', 'event')
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) {
                $query->where('status', 'planned')
                    ->orWhere('status', 'ongoing');
            })
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->limit(4)
            ->get();

        // Récupérer les membres de l'équipe visibles
        $teamMembers = Admin::teamVisible()
            ->teamOrdered()
            ->limit(4)
            ->get();

        // Récupérer les témoignages actifs
        $testimonials = Testimonial::active()
            ->ordered()
            ->limit(6)
            ->get();

        // Récupérer les articles récents publiés
        $articles = Article::published()
            ->recent()
            ->limit(6)
            ->get();

        return view('pages.home', compact(
            'featuredActivities',
            'recentActivities',
            'donationActivities',
            'upcomingEvents',
            'teamMembers',
            'testimonials',
            'articles'
        ));
    }

    /**
     * Affiche la page À propos
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Affiche la page Notre équipe
     */
    public function team()
    {
        // Récupérer tous les membres de l'équipe visibles
        $teamMembers = Admin::teamVisible()
            ->teamOrdered()
            ->get();

        return view('pages.team', compact('teamMembers'));
    }

    /**
     * Affiche la page des événements
     */
    public function events()
    {
        // Construire la requête de base
        $query = Activity::where('is_public', true)
            ->where('type', 'event')
            ->where('status', '!=', 'cancelled');

        // Filtre par recherche (titre ou description)
        if (request()->has('search') && !empty(request('search'))) {
            $searchTerm = request('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('short_description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filtre par catégorie
        if (request()->has('category') && !empty(request('category'))) {
            $query->where('category', request('category'));
        }

        // Filtre par tag
        if (request()->has('tag') && !empty(request('tag'))) {
            $tag = request('tag');
            $query->whereJsonContains('tags', $tag);
        }

        // On priorise les événements à venir, puis en cours, puis passés
        $events = $query->orderByRaw("CASE
                WHEN status = 'planned' AND start_date >= CURDATE() THEN 1
                WHEN status = 'ongoing' THEN 2
                WHEN status = 'completed' THEN 3
                ELSE 4
            END")
            ->orderBy('start_date', 'desc')
            ->paginate(12)
            ->withQueryString(); // Préserve les paramètres de requête dans la pagination

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

        // Récupérer les catégories des événements
        $categories = Activity::where('is_public', true)
            ->where('type', 'event')
            ->whereNotNull('category')
            ->selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        // Récupérer les événements récents (hors l'événement actuel)
        $recentEvents = Activity::where('is_public', true)
            ->where('type', 'event')
            ->where('status', '!=', 'cancelled')
            ->where('id', '!=', $activity->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Récupérer tous les tags uniques des événements
        $allTags = Activity::where('is_public', true)
            ->where('type', 'event')
            ->whereNotNull('tags')
            ->get()
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->take(8);

        return view('pages.event-detail', compact('activity', 'categories', 'recentEvents', 'allTags'));
    }

    /**
     * Affiche la page Faire un don (liste des projets)
     */
    public function donate()
    {
        // Récupérer les activités qui acceptent des dons
        $activities = Activity::where('is_public', true)
            ->where('status', '!=', 'cancelled')
            ->whereNotNull('budget')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('pages.donate', compact('activities'));
    }

    /**
     * Affiche le détail d'un projet pour faire un don
     */
    public function showDonationDetail(Activity $activity)
    {
        // Vérifier que l'activité est publique
        if (!$activity->is_public || $activity->status === 'cancelled') {
            abort(404);
        }

        // Calculer le pourcentage collecté
        $progressPercentage = 0;
        if ($activity->budget > 0) {
            $progressPercentage = min(100, ($activity->amount_raised / $activity->budget) * 100);
        }

        return view('pages.detailDonate', compact('activity', 'progressPercentage'));
    }

    /**
     * Traite un don spontané (sans projet spécifique)
     * Montant : depuis "amount" ou depuis "donate-amount" / "custom-amount".
     * Devise : donation_currency (USD ou CDF).
     * Mobile Money : mpesa, airtel_money, orange_money, afrimoney.
     */
    public function processSpontaneousDonation(Request $request): JsonResponse
    {
        // Normaliser le montant : le formulaire envoie donate-amount (ou custom-amount si personnalisé)
        $amount = $request->input('amount');
        if ($amount === null || $amount === '') {
            $donateAmount = $request->input('donate-amount');
            if ($donateAmount === 'custom') {
                $amount = $request->input('custom-amount');
            } else {
                $amount = $donateAmount;
            }
        }
        $request->merge(['amount' => $amount]);

        // Devise : USD ou CDF (par défaut USD)
        $currency = $request->input('donation_currency', 'USD');
        if (!in_array($currency, ['USD', 'CDF'], true)) {
            $currency = 'USD';
        }
        $request->merge(['donation_currency' => $currency]);

        // Validation des règles de base
        $rules = [
            'amount' => 'required|numeric|min:1',
            'donation_currency' => 'nullable|string|in:USD,CDF',
            'payment_method' => 'required|string|in:mobile_money,card',
            'donation_type' => 'required|string|in:anonymous,non-anonymous',
        ];

        // Si le don n'est pas anonyme, les informations personnelles sont requises
        if ($request->donation_type !== 'anonymous') {
            $rules['first_name'] = 'required|string|max:255';
            $rules['last_name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
        }

        // Si la méthode de paiement est mobile_money : opérateur (Mpesa, Airtel, Orange) et téléphone requis
        if ($request->payment_method === 'mobile_money') {
            $rules['mobile_money_provider'] = 'required|string|in:mpesa,airtel_money,orange_money';
            $rules['phone'] = [
                'required',
                'string',
                'max:30',
                function (string $attribute, mixed $value, \Closure $fail) use ($request): void {
                    $digits = preg_replace('/\D/', '', $value);
                    if (strlen($digits) === 0) {
                        return;
                    }
                    if (!str_starts_with($digits, '243')) {
                        $fail('Le numéro doit commencer par 243 (ex: 243 81 123 4567).');
                        return;
                    }
                    $phone = $digits;
                    if (strlen($phone) < 12) {
                        $fail('Le numéro doit commencer par 243 suivi de 9 chiffres (ex: 243 81 123 4567).');
                        return;
                    }
                    $prefix = substr($phone, 3, 2);
                    $provider = $request->mobile_money_provider;
                    $validPrefixes = [
                        'mpesa' => ['81', '82', '83'],
                        'airtel_money' => ['97', '98', '99'],
                        'orange_money' => ['84', '85', '89'],
                    ];
                    if (!isset($validPrefixes[$provider]) || !in_array($prefix, $validPrefixes[$provider], true)) {
                        $fail('Le numéro ne correspond pas à l\'opérateur sélectionné. Mpesa: 81/82/83, Airtel: 97/98/99, Orange: 84/85/89.');
                    }
                },
            ];
        }

        $validator = Validator::make($request->all(), $rules, [
            'amount.required' => 'Le montant est requis.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant minimum est de 1€.',
            'first_name.required' => 'Le prénom est requis.',
            'last_name.required' => 'Le nom est requis.',
            'email.required' => 'L\'adresse email est requise.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'payment_method.required' => 'La méthode de paiement est requise.',
            'donation_type.required' => 'Le type de don est requis.',
            'mobile_money_provider.required' => 'Veuillez sélectionner un opérateur Mobile Money.',
            'phone.required' => 'Le numéro de téléphone est requis pour les paiements Mobile Money.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'success' => false,
                'message' => $errors->first(),
                'errors' => $errors,
            ], 422);
        }

        try {
            $donor = null;

            // Si le don n'est pas anonyme, créer ou récupérer le donateur
            if ($request->donation_type !== 'anonymous') {
                $donor = \App\Models\Donor::firstOrCreate(
                    ['email' => strtolower(trim($request->email))],
                    [
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'phone' => $request->phone ?? null,
                        'status' => 'active',
                    ]
                );

                // Mettre à jour le nom si nécessaire
                if (!$donor->wasRecentlyCreated) {
                    $donor->update([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'phone' => $request->phone ?? $donor->phone,
                    ]);
                }
            }

            $paymentReference = 'SPON-' . time() . '-' . strtoupper(substr(md5(uniqid()), 0, 8));
            $donationPhone = $request->payment_method === 'mobile_money' ? ($request->phone ? trim($request->phone) : null) : null;
            $metadata = [
                'donation_type' => $request->donation_type,
                'mobile_money_provider' => $request->mobile_money_provider ?? null,
                'phone' => $donationPhone,
            ];

            // Si Mobile Money et FlexPay activé : appeler l'API FlexPay Payment Service avant de confirmer
            $flexpayOrderNumber = null;
            $flexpayMessage = null;
            $flexpayResponse = null;
            $flexpayRedirectUrl = null;
            if ($request->payment_method === 'mobile_money' && config('flexpay.enabled')) {
                Log::info('FlexPay: envoi de la requête de paiement', [
                    'reference' => $paymentReference,
                    'phone' => $request->phone,
                    'amount' => $request->amount,
                    'currency' => $request->donation_currency ?? 'USD',
                ]);
                $callbackUrl = url()->route('flexpay.callback');
                $flexPay = new FlexPayService();
                $result = $flexPay->payment(
                    $paymentReference,
                    $request->phone,
                    (float) $request->amount,
                    $request->donation_currency ?? 'USD',
                    $callbackUrl,
                    '1' // type 1 = mobile money
                );
                $flexpayResponse = $result;
                if (!$result['success']) {
                    return response()->json([
                        'success' => false,
                        'message' => $result['message'] ?? 'Une erreur est survenue. Veuillez réessayer.',
                        'flexpay_code' => $result['code'] ?? null,
                        'flexpay_response' => $flexpayResponse,
                    ], 422);
                }
                $flexpayOrderNumber = $result['orderNumber'];
                $flexpayMessage = $result['message'];
                $metadata['flexpay_order_number'] = $flexpayOrderNumber;
                Log::info('FlexPay: requête envoyée avec succès', ['orderNumber' => $flexpayOrderNumber]);
            }

            // Si Carte bancaire et FlexPay activé : initier le paiement carte avant de créer le don
            if ($request->payment_method === 'card' && config('flexpay.enabled')) {
                Log::info('FlexPay: initiation paiement carte', [
                    'reference' => $paymentReference,
                    'amount' => $request->amount,
                    'currency' => $request->donation_currency ?? 'USD',
                ]);
                $flexPay = new FlexPayService();
                $cardResult = $flexPay->initiateCardPayment(
                    (float) $request->amount,
                    $request->donation_currency ?? 'USD',
                    $paymentReference,
                    'Don spontané – Espoir Vie ASBL'
                );
                if (!$cardResult['success']) {
                    return response()->json([
                        'success' => false,
                        'message' => $cardResult['message'] ?? 'Une erreur est survenue. Veuillez réessayer.',
                    ], 422);
                }
                $flexpayRedirectUrl = $cardResult['url'];
                if ($cardResult['orderNumber']) {
                    $metadata['flexpay_order_number'] = $cardResult['orderNumber'];
                }
                Log::info('FlexPay: paiement carte initié', ['url' => $flexpayRedirectUrl]);
            }

            // Créer le don (sans activité spécifique)
            $donation = \App\Models\Donation::create([
                'donor_id' => $donor ? $donor->id : null,
                'activity_id' => null,
                'phone' => $donationPhone,
                'amount' => $request->amount,
                'currency' => $request->donation_currency ?? 'USD',
                'type' => 'one_time',
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_reference' => $paymentReference,
                'paid_at' => null,
                'source' => 'website_spontaneous',
                'metadata' => $metadata,
            ]);

            // Envoyer un email de confirmation si le don n'est pas anonyme (hors attente FlexPay)
            if ($donor && !$flexpayOrderNumber) {
                try {
                    $mailService = new MailService();
                    $mailService->sendDonationConfirmation([
                        'donor_name' => $donor->first_name . ' ' . $donor->last_name,
                        'amount' => $request->amount,
                        'currency' => $request->donation_currency ?? 'USD',
                        'reference' => $donation->payment_reference,
                        'activity_title' => 'Don spontané',
                        'payment_method' => $request->payment_method,
                    ], $donor->email);
                } catch (\Exception $mailException) {
                    Log::error('Erreur lors de l\'envoi de l\'email de confirmation de don spontané : ' . $mailException->getMessage());
                }
            }

            if ($flexpayRedirectUrl) {
                $message = 'Redirection vers la page de paiement par carte.';
            } elseif ($flexpayOrderNumber) {
                $message = $flexpayMessage ?: 'Transaction envoyée. Veuillez valider le push message sur votre téléphone.';
            } elseif ($request->payment_method === 'mobile_money') {
                $message = 'Don enregistré. Le paiement Mobile Money requiert une configuration FlexPay.';
            } elseif ($request->payment_method === 'card') {
                $message = 'Don enregistré. Le paiement par carte requiert une configuration FlexPay.';
            } else {
                $message = $request->donation_type === 'anonymous'
                    ? 'Votre don spontané anonyme a été enregistré avec succès ! Merci pour votre générosité.'
                    : 'Votre don spontané a été enregistré avec succès ! Un email de confirmation vous a été envoyé.';
            }

            $json = [
                'success' => true,
                'message' => $message,
                'payment_pending' => (bool) $flexpayOrderNumber,
                'flexpay_order_number' => $flexpayOrderNumber,
                'redirect_url' => $flexpayRedirectUrl,
                'donation' => [
                    'reference' => $donation->payment_reference,
                    'amount' => $donation->amount,
                ],
            ];
            if ($flexpayResponse !== null) {
                $json['flexpay_response'] = $flexpayResponse;
            }
            return response()->json($json);
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            Log::error('Erreur lors du traitement du don spontané : ' . $errorMsg);
            $message = config('app.debug') ? $errorMsg : 'Une erreur est survenue lors du traitement de votre don. Veuillez réessayer plus tard.';
            return response()->json([
                'success' => false,
                'message' => $message,
            ], 500);
        }
    }

    /**
     * Vérifie le statut d'une transaction FlexPay (Check transaction).
     * Utilisé par le JS pour le polling après envoi du push Mobile Money.
     */
    public function donationStatus(string $orderNumber): JsonResponse
    {
        if (!config('flexpay.enabled')) {
            return response()->json(['success' => false, 'paid' => false, 'message' => 'Service de paiement non configuré.'], 400);
        }
        $flexPay = new FlexPayService();
        $result = $flexPay->checkTransaction($orderNumber);
        return response()->json([
            'success' => $result['success'],
            'paid' => $result['paid'] ?? false,
            'message' => $result['message'] ?? null,
            'transaction' => $result['transaction'] ?? null,
        ]);
    }

    /**
     * Retour FlexPay carte : success, cancel ou decline.
     * Met à jour le don et affiche une page de confirmation.
     */
    public function paymentReturn(string $reference, string $amount, string $currency, string $status)
    {
        $donation = \App\Models\Donation::where('payment_reference', $reference)->first();

        if (!$donation) {
            Log::warning('FlexPay carte: don introuvable pour référence ' . $reference);
            return redirect()->route('home')->with('error', 'Don introuvable.');
        }

        if ($status === 'success') {
            $donation->update([
                'status' => 'completed',
                'paid_at' => now(),
            ]);
            Log::info('FlexPay carte: paiement confirmé', ['reference' => $reference]);
            return redirect()->route('home')->with('success', 'Merci ! Votre paiement par carte a bien été enregistré.');
        }

        if ($status === 'cancel') {
            Log::info('FlexPay carte: paiement annulé par l\'utilisateur', ['reference' => $reference]);
            return redirect()->route('home')->with('info', 'Le paiement a été annulé. Vous pouvez refaire un don à tout moment.');
        }

        // decline
        $donation->update(['status' => 'failed']);
        Log::info('FlexPay carte: paiement refusé', ['reference' => $reference]);
        return redirect()->route('home')->with('error', 'Le paiement a été refusé. Veuillez réessayer ou utiliser une autre carte.');
    }

    /**
     * Inscrit un nouveau donateur (compte utilisateur simple)
     */
    public function registerDonor(Request $request)
    {
        // On valide désormais l'unicité sur la table "donors" (référence métier des donateurs)
        // plutôt que sur "users". Le modèle User reste utilisé pour l'authentification,
        // mais les informations de donateur sont centralisées dans la table "donors".
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:donors,email'],
            'phone' => ['required', 'string', 'max:30', 'unique:donors,phone'],
            'country' => ['required', 'string', 'max:100'],
            'donation_period' => ['required', 'date'],
            'donation_type' => ['required', 'string', 'in:espece,nature'],
            'donation_amount' => ['nullable', 'numeric', 'min:1', 'required_if:donation_type,espece'],
            'donation_currency' => ['nullable', 'string', 'in:USD,CDF', 'required_if:donation_type,espece'],
            'donation_nature_description' => ['nullable', 'string', 'max:1000', 'required_if:donation_type,nature'],
        ], [
            'name.required' => 'Le nom complet est requis.',
            'email.required' => 'L\'adresse email est requise.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'email.unique' => 'Un compte existe déjà avec cette adresse email.',
            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.unique' => 'Un compte existe déjà avec ce numéro de téléphone.',
            'country.required' => 'Le pays est requis.',
            'donation_period.required' => 'La date de don est requise.',
            'donation_period.date' => 'Veuillez fournir une date valide.',
            'donation_type.required' => 'Le type de don est requis.',
            'donation_type.in' => 'Le type de don doit être soit en espèces, soit en nature.',
            'donation_amount.required_if' => 'Le montant est requis pour un don en espèces.',
            'donation_amount.numeric' => 'Le montant doit être un nombre.',
            'donation_amount.min' => 'Le montant minimum est de 1.',
            'donation_currency.required_if' => 'La devise est requise pour un don en espèces.',
            'donation_currency.in' => 'La devise doit être USD ou CDF.',
            'donation_nature_description.required_if' => 'Veuillez préciser votre don en nature.',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Veuillez corriger les erreurs dans le formulaire.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            // Mot de passe aléatoire qui sera envoyé au donateur
            $plainPassword = Str::random(10);

            // 1) Créer ou mettre à jour le "vrai" profil donateur dans la table donors
            // On utilise l'email comme clé fonctionnelle, ce qui aligne cette inscription
            // avec les autres endroits qui créent des Donor (processDonation, don spontané…).
            $donor = Donor::updateOrCreate(
                ['email' => strtolower($validated['email'])],
                [
                    // Ici, le formulaire expose un champ "name" complet.
                    // Si tu veux séparer prénom/nom, tu pourras adapter plus tard.
                    'first_name' => $validated['name'],
                    'last_name' => '',
                    'phone' => $validated['phone'],
                    'country' => $validated['country'],
                    'status' => 'active',
                    // On garde une trace de la première intention de don dans les notes internes.
                    'notes' => sprintf(
                        'Inscription via formulaire "devenir donateur" le %s, type de don: %s',
                        now()->toDateTimeString(),
                        $validated['donation_type']
                    ),
                ]
            );

            // 2) Créer ou mettre à jour le compte utilisateur technique (auth)
            // L'utilisateur sert à la connexion au dashboard public.
            $user = User::updateOrCreate(
                ['email' => $donor->email],
                [
                    'name' => $validated['name'],
                    'password' => $plainPassword, // sera hashé automatiquement via le cast "hashed"
                    'phone' => $validated['phone'],
                    'country' => $validated['country'],
                    'donation_period' => $validated['donation_period'],
                    'donation_type' => $validated['donation_type'],
                    'donation_amount' => $validated['donation_type'] === 'espece'
                        ? $validated['donation_amount']
                        : null,
                    'donation_currency' => $validated['donation_type'] === 'espece'
                        ? $validated['donation_currency']
                        : null,
                    'donation_description' => $validated['donation_type'] === 'nature'
                        ? $validated['donation_nature_description']
                        : null,
                ]
            );

            try {
                Mail::to($user->email)->send(new DonorWelcomeMail($user, $plainPassword));
            } catch (\Exception $mailException) {
                Log::error('Erreur lors de l\'envoi de l\'email de bienvenue donateur : ' . $mailException->getMessage());
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Votre compte donateur a été créé avec succès. Vérifiez votre email pour vos identifiants de connexion.',
                ]);
            }

            return back()->with('donor_registered', true)
                ->with('donor_registered_message', 'Votre compte donateur a été créé avec succès. Vérifiez votre email pour vos identifiants de connexion.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'inscription du donateur : ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur interne est survenue lors de la création de votre compte.',
                    // Infos supplémentaires utiles en développement (visible dans l’onglet Réseau)
                    'debug' => $e->getMessage(),
                ], 500);
            }

            return back()->withErrors([
                'donor_register' => 'Une erreur interne est survenue lors de la création de votre compte. Veuillez vérifier les paramètres de votre base de données ou contacter l’administrateur.',
            ])->withInput();
        }
    }

    /**
     * Traite le don
     */
    public function processDonation(Request $request): JsonResponse
    {
        // Validation des règles de base
        $rules = [
            'activity_id' => 'required|exists:activities,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|in:mobile_money,card',
            'donation_type' => 'required|string|in:anonymous,non-anonymous',
        ];

        // Si le don n'est pas anonyme, les informations personnelles sont requises
        if ($request->donation_type !== 'anonymous') {
            $rules['first_name'] = 'required|string|max:255';
            $rules['last_name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
        }

        // Si la méthode de paiement est mobile_money, le fournisseur est requis
        if ($request->payment_method === 'mobile_money') {
            $rules['mobile_money_provider'] = 'required|string|in:orange_money,mtn_mobile_money,airtel_money,moov_money';
        }

        $validator = Validator::make($request->all(), $rules, [
            'activity_id.required' => 'Le projet est requis.',
            'activity_id.exists' => 'Le projet sélectionné n\'existe pas.',
            'amount.required' => 'Le montant est requis.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant minimum est de 1€.',
            'first_name.required' => 'Le prénom est requis.',
            'last_name.required' => 'Le nom est requis.',
            'email.required' => 'L\'adresse email est requise.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'payment_method.required' => 'La méthode de paiement est requise.',
            'donation_type.required' => 'Le type de don est requis.',
            'mobile_money_provider.required' => 'Veuillez sélectionner un opérateur Mobile Money.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez corriger les erreurs dans le formulaire.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $donor = null;

            // Si le don n'est pas anonyme, créer ou récupérer le donateur
            if ($request->donation_type !== 'anonymous') {
                $donor = \App\Models\Donor::firstOrCreate(
                    ['email' => strtolower(trim($request->email))],
                    [
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'status' => 'active',
                    ]
                );

                // Mettre à jour le nom si nécessaire
                if (!$donor->wasRecentlyCreated) {
                    $donor->update([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                    ]);
                }
            }

            // Récupérer l'activité
            $activity = Activity::findOrFail($request->activity_id);

            // Créer le don
            $donation = \App\Models\Donation::create([
                'donor_id' => $donor ? $donor->id : null,
                'activity_id' => $activity->id,
                'amount' => $request->amount,
                'currency' => 'EUR',
                'type' => 'one_time',
                'status' => 'pending', // Les dons sont maintenant toujours en attente
                'payment_method' => $request->payment_method,
                'payment_reference' => 'DON-' . time() . '-' . strtoupper(substr(md5(uniqid()), 0, 8)),
                'paid_at' => null,
                'source' => 'website',
                'metadata' => [
                    'donation_type' => $request->donation_type,
                    'mobile_money_provider' => $request->mobile_money_provider ?? null,
                ],
            ]);

            // Envoyer l'email de confirmation si le don n'est pas anonyme
            if ($donor) {
                try {
                    $mailService = new MailService();
                    $mailService->sendDonationConfirmation([
                        'donor_name' => $donor->first_name . ' ' . $donor->last_name,
                        'amount' => $request->amount,
                        'currency' => 'EUR',
                        'reference' => $donation->payment_reference,
                        'activity_title' => $activity->title,
                        'payment_method' => $request->payment_method,
                    ], $donor->email);
                } catch (\Exception $mailException) {
                    Log::error('Erreur lors de l\'envoi de l\'email de confirmation de don : ' . $mailException->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => $request->donation_type === 'anonymous'
                    ? 'Votre don anonyme a été enregistré avec succès ! Merci pour votre générosité.'
                    : 'Votre don a été enregistré avec succès ! Un email de confirmation vous a été envoyé.',
                'donation' => [
                    'reference' => $donation->payment_reference,
                    'amount' => $donation->amount,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement du don : ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors du traitement de votre don. Veuillez réessayer plus tard.'
            ], 500);
        }
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
     * Recherche globale (articles, événements, équipe)
     */
    public function globalSearch(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'results' => [],
                'message' => 'Veuillez saisir au moins 2 caractères.'
            ]);
        }

        $results = [];

        // Recherche dans les articles
        $articles = Article::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('excerpt', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%");
            })
            ->limit(5)
            ->get();

        foreach ($articles as $article) {
            $results[] = [
                'type' => 'article',
                'type_label' => 'Article',
                'id' => $article->id,
                'title' => $article->title,
                'description' => Str::limit($article->excerpt ?? strip_tags($article->content), 80),
                'image' => $article->image ? (Str::startsWith($article->image, ['http://', 'https://']) ? $article->image : asset('storage/' . $article->image)) : asset('assets/img/blog-1.jpg'),
                'url' => route('article.show', $article->slug),
                'category' => $article->category,
            ];
        }

        // Recherche dans les événements
        $events = Activity::where('is_public', true)
            ->where('type', 'event')
            ->where('status', '!=', 'cancelled')
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('short_description', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('location', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%");
            })
            ->limit(5)
            ->get();

        foreach ($events as $event) {
            $imageUrl = $event->image;
            if ($imageUrl && !Str::startsWith($imageUrl, ['http://', 'https://'])) {
                $imageUrl = asset('storage/' . $imageUrl);
            } elseif (!$imageUrl) {
                $imageUrl = asset('assets/img/event-img.jpg');
            }

            $results[] = [
                'type' => 'event',
                'type_label' => 'Événement',
                'id' => $event->id,
                'title' => $event->title,
                'description' => Str::limit($event->short_description ?? $event->description, 80),
                'image' => $imageUrl,
                'url' => route('events.show', $event),
                'category' => $event->category,
                'date' => $event->start_date ? $event->start_date->format('d/m/Y') : null,
            ];
        }

        // Recherche dans les membres de l'équipe
        $teamMembers = Admin::teamVisible()
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('position', 'LIKE', "%{$query}%")
                  ->orWhere('bio', 'LIKE', "%{$query}%");
            })
            ->limit(5)
            ->get();

        foreach ($teamMembers as $member) {
            $imageUrl = $member->photo;
            if ($imageUrl && !Str::startsWith($imageUrl, ['http://', 'https://'])) {
                $imageUrl = asset('storage/' . $imageUrl);
            } elseif (!$imageUrl) {
                $imageUrl = asset('assets/img/member-1.jpg');
            }

            $results[] = [
                'type' => 'team',
                'type_label' => 'Équipe',
                'id' => $member->id,
                'title' => $member->name,
                'description' => $member->position ?? 'Membre de l\'équipe',
                'image' => $imageUrl,
                'url' => route('team') . '#member-detail-' . $member->id,
                'category' => $member->position,
            ];
        }

        return response()->json([
            'success' => true,
            'results' => $results,
            'total' => count($results),
            'query' => $query,
        ]);
    }

    /**
     * Affiche la liste des articles
     */
    public function articles()
    {
        $articles = Article::published()
            ->recent()
            ->paginate(12);

        return view('pages.articles', compact('articles'));
    }

    /**
     * Affiche un article spécifique
     */
    public function showArticle(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Incrémenter le compteur de vues
        $article->increment('views_count');

        // Récupérer les articles récents (hors l'article actuel)
        $recentArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->recent()
            ->limit(3)
            ->get();

        return view('pages.article-detail', compact('article', 'recentArticles'));
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
