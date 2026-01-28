<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Espoir Vie ASBL'))</title>

        <!-- Fonts -->
    <!--
            Pour commenter rapidement ce que vous avez sélectionné dans la plupart des éditeurs de code (comme VS Code, Sublime Text, etc) :
            - Windows/Linux : Ctrl + /
            - Mac : Cmd + /
        -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/icon/flaticon_charitics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/splide/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slim-select/slimselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate-wow/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}">

    <!-- custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
        <!-- Scripts -->
    {{-- <x-vite-assets /> --}}
    </head>

<body>
    <div class="preloader" id="preloader">
        <div class="loader"></div>
                            </div>

    <!-- SIDEBAR SECTION START -->
    <div class="ul-sidebar">
        <!-- header -->
        <div class="ul-sidebar-header">
            <div class="ul-sidebar-header-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/lg.jpg') }}" alt="Espoir Vie ASBL" class="logo">
                </a>
            </div>
            <!-- sidebar closer -->
            <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
        </div>

        <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>


        <!-- sidebar footer -->
        <div class="ul-sidebar-footer">
            <span class="ul-sidebar-footer-title">Suivez-nous</span>

            <div class="ul-sidebar-footer-social">
                <a href="#"><i class="flaticon-facebook"></i></a>
                <a href="#"><i class="flaticon-twitter"></i></a>
                <a href="#"><i class="flaticon-instagram"></i></a>
                <a href="#"><i class="flaticon-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- SIDEBAR SECTION END -->

    <!-- SEARCH MODAL SECTION START -->
    <div class="ul-search-form-wrapper flex-grow-1 flex-shrink-0">
        <button class="ul-search-closer"><i class="flaticon-close"></i></button>

        <form action="#" class="ul-search-form" id="global-search-form" data-search-url="{{ route('api.search') }}">
            <div class="ul-search-form-right">
                <input type="search" name="search" id="ul-search" placeholder="Rechercher articles, événements, équipe..." autocomplete="off">
                <button type="submit"><span class="icon"><i class="flaticon-search"></i></span></button>
            </div>
            <!-- Résultats de recherche (injecté par JS) -->
            <div id="search-results" class="search-results-dropdown"></div>
        </form>
    </div>
    <!-- SEARCH MODAL SECTION END -->

    <!-- HEADER SECTION START -->
    <header class="ul-header">
        <div class="ul-header-bottom to-be-sticky">
            <div class="ul-header-bottom-wrapper ul-header-container">
                <div class="logo-container">
                    <a href="{{ route('home') }}" class="d-inline-block">
                        <img src="{{ asset('assets/img/lg.png') }}" height="50px" width="50px" alt="Espoir Vie ASBL"
                            class="logo"></a>
                </div>

                <!-- header nav -->
                <div class="ul-header-nav-wrapper">
                    <div class="to-go-to-sidebar-in-mobile">
                        <nav class="ul-header-nav">
                            <a href="{{ route('home') }}">Accueil</a>
                            <a href="{{ route('about') }}">À propos</a>
                            <a href="{{ route('team') }}">Notre équipe</a>
                            <a href="{{ route('events') }}">Événements</a>
                            <a href="{{ route('articles') }}">Articles</a>
                            <a href="{{ route('donate') }}">Faire un don</a>
                            <a href="{{ route('contact') }}">Nous contacter</a>
                        </nav>
                    </div>
                </div>

                <!-- actions -->
                <div class="ul-header-actions">
                    <button class="ul-header-search-opener"><i class="flaticon-search"></i></button>

                    @guest
                        <!-- Bouton "Se connecter" pour les donateurs / comptes utilisateurs -->
                        <a href="{{ route('login') }}" class="ul-btn ul-btn-login d-none d-md-inline-flex">
                            <i class="flaticon-account"></i> <span>Se connecter</span>
                        </a>
                    @else
                        <!-- Menu profil lorsqu'un utilisateur est connecté -->
                        <div class="ul-profile-dropdown-wrapper d-none d-md-flex">
                            @php
                                $currentUser = auth()->user();
                                $initials = '';
                                if ($currentUser && $currentUser->name) {
                                    $parts = preg_split('/\s+/', trim($currentUser->name));
                                    $first = $parts[0] ?? '';
                                    $second = $parts[1] ?? '';
                                    $initials = mb_strtoupper(mb_substr($first, 0, 1) . mb_substr($second, 0, 1));
                                }
                            @endphp
                            <button class="ul-profile-toggle" type="button" aria-label="Menu profil">
                                <span class="ul-profile-avatar">
                                    @if($currentUser && $currentUser->photo)
                                        @if(Str::startsWith($currentUser->photo, ['http://', 'https://']))
                                            <img src="{{ $currentUser->photo }}" alt="{{ $currentUser->name }}">
                                        @else
                                            <img src="{{ asset('storage/' . $currentUser->photo) }}" alt="{{ $currentUser->name }}">
                                        @endif
                                    @else
                                        {{ $initials ?: 'EV' }}
                                    @endif
                                </span>
                            </button>
                            <div class="ul-profile-dropdown">
                                <a href="{{ route('monProfil') }}">Mon profil</a>
                                <a href="{{ route('donor.donations') }}">Mes dons</a>
                                <a href="{{ route('donor.activities') }}">Activités</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Déconnexion</button>
                                </form>
                            </div>
                        </div>
                    @endguest

                    <!-- Bouton "Faire un don" qui ouvre le popup de don spontané -->
                    <a href="javascript:void(0);" id="spontaneous-donation-btn" class="ul-btn d-sm-inline-flex d-none spontaneous-donation-btn">
                        <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> faire un don
                    </a>
                    <button class="ul-header-sidebar-opener d-lg-none d-inline-flex"><i class="flaticon-menu"></i></button>
                </div>

                <!-- Modal Pop Up pour le don spontané -->
                <div id="spontaneous-donation-modal" class="ul-modal">
                    <div class="ul-modal-content">
                        <button type="button" id="spontaneous-donation-modal-close">&times;</button>
                        <div class="modal-header-content">
                            <h2>Faire un don</h2>
                            <p>Merci pour votre générosité ! Choisissez entre un don ponctuel ou la création d'un compte donateur.</p>
                        </div>

                        <!-- Onglets Don spontané / Devenir donateur -->
                        <div class="ul-donation-tabs">
                            <button type="button" class="ul-donation-tab active" data-target="#spontaneous-donation-wrapper">Don spontané</button>
                            <button type="button" class="ul-donation-tab" data-target="#donor-register-wrapper">Devenir donateur</button>
                        </div>

                        <!-- Formulaire de don spontané -->
                        <div id="spontaneous-donation-wrapper" class="ul-donation-tab-pane active">
                        <form id="spontaneous-donation-form" action="{{ route('donate.processSpontaneous') }}" method="POST" class="ul-donation-details-form" autocomplete="off">
                            @csrf

                            <!-- Montant à donner -->
                            <div class="ul-donation-details-donate-form-wrapper modal-donation-form-wrapper">
                                <div class="selected-amount"><span class="currency">€</span> <span class="number" id="spontaneous-selected-amount-display">10.00</span></div>
                                <div class="ul-donate-form">
                                    <div>
                                        <input type="radio" name="donate-amount" id="spontaneous-donate-amount-1" value="10" checked hidden>
                                        <label for="spontaneous-donate-amount-1" class="ul-donate-form-label">10 €</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="donate-amount" id="spontaneous-donate-amount-2" value="20" hidden>
                                        <label for="spontaneous-donate-amount-2" class="ul-donate-form-label">20 €</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="donate-amount" id="spontaneous-donate-amount-3" value="30" hidden>
                                        <label for="spontaneous-donate-amount-3" class="ul-donate-form-label">30 €</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="donate-amount" id="spontaneous-donate-amount-4" value="40" hidden>
                                        <label for="spontaneous-donate-amount-4" class="ul-donate-form-label">40 €</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="donate-amount" id="spontaneous-donate-amount-5" value="50" hidden>
                                        <label for="spontaneous-donate-amount-5" class="ul-donate-form-label">50 €</label>
                                    </div>
                                    <div class="custom-amount-wrapper">
                                        <input type="radio" name="donate-amount" id="spontaneous-custom-amount" value="custom">
                                        <label for="spontaneous-donate-amount-custom" class="ul-donate-form-label">
                                            <input type="number" name="custom-amount" id="spontaneous-donate-amount-custom" placeholder="Montant personnalisé" class="ul-donate-form-custom-input" min="1" step="0.01">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Type de don -->
                            <div class="ul-donation-details-donation-type modal-donation-type">
                                <h3 class="ul-donation-details-personal-info-title">Type de don</h3>
                                <div class="ul-donation-details-payment-methods-form">
                                    <div class="ul-radio">
                                        <label for="spontaneous-donation-type-1">
                                            <input type="radio" name="donation_type" id="spontaneous-donation-type-1" value="non-anonymous" checked>
                                            <span class="checkmark"></span>
                                            <span>Don non anonyme</span>
                                        </label>
                                    </div>
                                    <div class="ul-radio">
                                        <label for="spontaneous-donation-type-2">
                                            <input type="radio" name="donation_type" id="spontaneous-donation-type-2" value="anonymous">
                                            <span class="checkmark"></span>
                                            <span>Don anonyme</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Méthode de paiement -->
                            <div class="ul-donation-details-payment-methods">
                                <h3 class="ul-donation-details-payment-methods-title">Sélectionner la méthode de paiement</h3>
                                <div class="ul-donation-details-payment-methods-form">
                                    <div class="ul-radio">
                                        <label for="spontaneous-method-1">
                                            <input type="radio" name="payment_method" id="spontaneous-method-1" value="mobile_money" checked>
                                            <span class="checkmark"></span>
                                            <span>Mobile Money</span>
                                        </label>
                                    </div>
                                    <div class="ul-radio">
                                        <label for="spontaneous-method-2">
                                            <input type="radio" name="payment_method" id="spontaneous-method-2" value="card">
                                            <span class="checkmark"></span>
                                            <span>Carte bancaire</span>
                                        </label>
                                    </div>
                                </div>
                                <!-- Liste des moyens Mobile Money (visible uniquement quand Mobile Money est sélectionné) -->
                                <div id="spontaneous-mobile-money-options" class="modal-mobile-money-options">
                                    <h4>Choisissez votre opérateur Mobile Money</h4>
                                    <div class="ul-donation-details-payment-methods-form">
                                        <div class="ul-radio">
                                            <label for="spontaneous-mobile-1">
                                                <input type="radio" name="mobile_money_provider" id="spontaneous-mobile-1" value="orange_money" checked>
                                                <span class="checkmark"></span>
                                                <span>Orange Money</span>
                                            </label>
                                        </div>
                                        <div class="ul-radio">
                                            <label for="spontaneous-mobile-2">
                                                <input type="radio" name="mobile_money_provider" id="spontaneous-mobile-2" value="mtn_mobile_money">
                                                <span class="checkmark"></span>
                                                <span>MTN Mobile Money</span>
                                            </label>
                                        </div>
                                        <div class="ul-radio">
                                            <label for="spontaneous-mobile-3">
                                                <input type="radio" name="mobile_money_provider" id="spontaneous-mobile-3" value="airtel_money">
                                                <span class="checkmark"></span>
                                                <span>Airtel Money</span>
                                            </label>
                                        </div>
                                        <div class="ul-radio">
                                            <label for="spontaneous-mobile-4">
                                                <input type="radio" name="mobile_money_provider" id="spontaneous-mobile-4" value="moov_money">
                                                <span class="checkmark"></span>
                                                <span>Moov Money</span>
                                            </label>
                                        </div>
                                    </div>
                            </div>
                        </div>

                            <!-- Informations personnelles (cache si don anonyme sélectionné) -->
                            <div id="spontaneous-personal-info-section" class="ul-donation-details-personal-info">
                                <h3 class="ul-donation-details-personal-info-title">Informations personnelles</h3>
                                <p class="ul-donation-details-personal-info-sub-title">Votre adresse email ne sera pas publiée. Les champs marqués * sont obligatoires.</p>
                                <div class="ul-donation-details-personal-info-form">
                                    <div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" name="first_name" id="spontaneous_first_name" placeholder="Prénom *">
                                                <span class="error-message" id="spontaneous-error-first_name"></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" name="last_name" id="spontaneous_last_name" placeholder="Nom *">
                                                <span class="error-message" id="spontaneous-error-last_name"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="email" name="email" id="spontaneous_donation_email" placeholder="Adresse email *">
                                                <span class="error-message" id="spontaneous-error-email"></span>
                                            </div>
                                        </div>
                                        <div class="col-12" id="spontaneous-phone-field">
                                            <div class="form-group">
                                                <input type="tel" name="phone" id="spontaneous_phone" placeholder="Numéro de téléphone (Mobile Money) *">
                                                <span class="error-message" id="spontaneous-error-phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ul-donation-details-form-bottom">
                                    <button type="submit" id="spontaneous-donation-submit-btn" class="ul-btn">
                                        <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                                        <span>Faire un don maintenant</span>
                                    </button>
                                    <span class="donation-total">Total du don : <span class="number" id="spontaneous-donation-total-amount">10</span> €</span>
                                </div>
                        </div>

                            <!-- Bouton pour dons anonymes (affiché uniquement si anonyme) -->
                            <div id="spontaneous-anonymous-submit-section" class="ul-donation-details-form-bottom modal-anonymous-submit-section">
                                <button type="submit" id="spontaneous-donation-submit-btn-anonymous" class="ul-btn">
                                    <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                                    <span>Faire un don maintenant</span>
                            </button>
                                <span class="donation-total">Total du don : <span class="number" id="spontaneous-donation-total-amount-anonymous">10</span> €</span>
                            </div>
                        </form>
                        </div>

                        <!-- Formulaire "Devenir donateur" -->
                        <div id="donor-register-wrapper" class="ul-donation-tab-pane" style="display: none;">
                            <form action="{{ route('donor.register') }}" method="POST" class="ul-donation-details-form" autocomplete="off">
                                @csrf
                                <div class="ul-donation-details-personal-info">
                                    <h3 class="ul-donation-details-personal-info-title">Créer un compte donateur</h3>
                                    <p class="ul-donation-details-personal-info-sub-title">
                                        Créez un compte pour suivre vos dons, recevoir des rapports d'activités et des notifications personnalisées.
                                    </p>
                                    @if($errors->has('donor_register'))
                                        <div class="async-notification error" style="display:block; margin-bottom:15px;">
                                            {{ $errors->first('donor_register') }}
                                        </div>
                                    @endif
                                    @if(session('donor_registered'))
                                        <div class="async-notification success" style="display:block; margin-bottom:15px;">
                                            {{ session('donor_registered_message') }}
                                        </div>
                                    @endif
                                    <div class="ul-donation-details-personal-info-form">
                                        <div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nom complet *" required>
                                                    @error('name')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Adresse email *" required>
                                                    @error('email')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select name="country" required class="form-select">
                                                        <option value="">Pays *</option>
                                                        @php
                                                            $countries = [
                                                                'Afghanistan', 'Afrique du Sud', 'Albanie', 'Algérie', 'Allemagne', 'Andorre', 'Angola', 'Arabie Saoudite',
                                                                'Argentine', 'Arménie', 'Australie', 'Autriche', 'Azerbaïdjan', 'Belgique', 'Bénin', 'Bolivie', 'Bosnie-Herzégovine',
                                                                'Botswana', 'Brésil', 'Bulgarie', 'Burkina Faso', 'Burundi', 'Cameroun', 'Canada', 'Cap-Vert', 'Chili', 'Chine',
                                                                'Chypre', 'Colombie', 'Comores', 'Congo-Brazzaville', 'Congo-Kinshasa', 'Corée du Sud', 'Costa Rica', 'Côte d\'Ivoire',
                                                                'Croatie', 'Danemark', 'Djibouti', 'Égypte', 'Émirats Arabes Unis', 'Équateur', 'Érythrée', 'Espagne', 'Estonie',
                                                                'Eswatini', 'États-Unis', 'Éthiopie', 'Finlande', 'France', 'Gabon', 'Gambie', 'Géorgie', 'Ghana', 'Grèce',
                                                                'Guatemala', 'Guinée', 'Guinée-Bissau', 'Guinée équatoriale', 'Haïti', 'Honduras', 'Hongrie', 'Inde', 'Indonésie',
                                                                'Irak', 'Iran', 'Irlande', 'Islande', 'Israël', 'Italie', 'Jamaïque', 'Japon', 'Jordanie', 'Kazakhstan', 'Kenya',
                                                                'Kirghizistan', 'Kosovo', 'Koweït', 'Laos', 'Lesotho', 'Lettonie', 'Liban', 'Liberia', 'Libye', 'Liechtenstein',
                                                                'Lituanie', 'Luxembourg', 'Madagascar', 'Malaisie', 'Malawi', 'Mali', 'Maroc', 'Maurice', 'Mauritanie', 'Mexique',
                                                                'Moldavie', 'Monaco', 'Mongolie', 'Mozambique', 'Namibie', 'Népal', 'Nicaragua', 'Niger', 'Nigeria', 'Norvège',
                                                                'Nouvelle-Zélande', 'Ouganda', 'Ouzbékistan', 'Pakistan', 'Palestine', 'Panama', 'Paraguay', 'Pays-Bas', 'Pérou',
                                                                'Philippines', 'Pologne', 'Portugal', 'Qatar', 'République Centrafricaine', 'République Dominicaine',
                                                                'République Tchèque', 'Roumanie', 'Royaume-Uni', 'Russie', 'Rwanda', 'Saint-Marin', 'Salvador', 'Sénégal',
                                                                'Serbie', 'Sierra Leone', 'Singapour', 'Slovaquie', 'Slovénie', 'Somalie', 'Soudan', 'Soudan du Sud', 'Sri Lanka',
                                                                'Suède', 'Suisse', 'Syrie', 'Tanzanie', 'Tchad', 'Thaïlande', 'Togo', 'Tunisie', 'Turquie', 'Ukraine', 'Uruguay',
                                                                'Venezuela', 'Viêt Nam', 'Yémen', 'Zambie', 'Zimbabwe',
                                                            ];
                                                        @endphp
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country }}" {{ old('country') === $country ? 'selected' : '' }}>
                                                                {{ $country }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('country')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Numéro de téléphone *" required>
                                                    @error('phone')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label style="font-size: 13px; color:#666; margin-bottom:4px;">Date de début du don *</label>
                                                    <input type="date" name="donation_period" value="{{ old('donation_period') }}" required class="form-control">
                                                    @error('donation_period')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select name="donation_type" id="donor-donation-type" required class="form-select">
                                                        <option value="">Type de don *</option>
                                                        <option value="espece" {{ old('donation_type') === 'espece' ? 'selected' : '' }}>En espèces (argent)</option>
                                                        <option value="nature" {{ old('donation_type') === 'nature' ? 'selected' : '' }}>En nature (biens matériels / autres)</option>
                                                    </select>
                                                    @error('donation_type')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12" id="donor-amount-group">
                                                <div class="form-group">
                                                    <div style="display:flex; gap:8px; align-items:center;">
                                                        <select name="donation_currency" class="form-select" style="max-width:110px;">
                                                            <option value="USD" {{ old('donation_currency') === 'USD' ? 'selected' : '' }}>USD</option>
                                                            <option value="CDF" {{ old('donation_currency') === 'CDF' ? 'selected' : '' }}>CDF</option>
                                                        </select>
                                                        <input type="number" name="donation_amount" value="{{ old('donation_amount') }}" min="1" step="0.01" placeholder="Montant à donner *" class="form-control">
                                                    </div>
                                                    @error('donation_amount')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                    @error('donation_currency')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12" id="donor-nature-group" style="display:none;">
                                                <div class="form-group">
                                                    <textarea name="donation_nature_description" rows="3" placeholder="Précisez votre don en nature (biens, matériel, services...)" class="form-control">{{ old('donation_nature_description') }}</textarea>
                                                    @error('donation_nature_description')
                                                        <span class="error-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-details-form-bottom" style="margin-top: 10px;">
                                        <button type="submit" class="ul-btn">
                                            <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                                            <span>Créer mon compte donateur</span>
                                        </button>
                                        <p style="margin-top: 10px; font-size: 13px; color: #666;">
                                            Vous recevrez un email avec un mot de passe provisoire et un lien de connexion.
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="ul-donation-details-notice modal-donation-notice">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M14.0003 20.6667C14.3781 20.6667 14.695 20.5387 14.951 20.2827C15.207 20.0267 15.3345 19.7103 15.3337 19.3334C15.3328 18.9565 15.2048 18.6401 14.9497 18.3841C14.6945 18.1281 14.3781 18.0001 14.0003 18.0001C13.6225 18.0001 13.3061 18.1281 13.051 18.3841C12.7959 18.6401 12.6679 18.9565 12.667 19.3334C12.6661 19.7103 12.7941 20.0272 13.051 20.2841C13.3079 20.541 13.6243 20.6685 14.0003 20.6667ZM14.0003 15.3334C14.3781 15.3334 14.695 15.2054 14.951 14.9494C15.207 14.6934 15.3345 14.377 15.3337 14.0001V8.66675C15.3337 8.28897 15.2057 7.97253 14.9497 7.71741C14.6937 7.4623 14.3772 7.3343 14.0003 7.33341C13.6234 7.33253 13.307 7.46053 13.051 7.71741C12.795 7.9743 12.667 8.29075 12.667 8.66675V14.0001C12.667 14.3779 12.795 14.6947 13.051 14.9507C13.307 15.2067 13.6234 15.3343 14.0003 15.3334ZM14.0003 27.3334C12.1559 27.3334 10.4226 26.9832 8.80033 26.2827C7.17811 25.5823 5.76699 24.6325 4.56699 23.4334C3.36699 22.2343 2.41722 20.8232 1.71766 19.2001C1.01811 17.577 0.667883 15.8436 0.666994 14.0001C0.666105 12.1565 1.01633 10.4232 1.71766 8.80008C2.41899 7.17697 3.36877 5.76586 4.56699 4.56675C5.76522 3.36764 7.17633 2.41786 8.80033 1.71741C10.4243 1.01697 12.1577 0.666748 14.0003 0.666748C15.843 0.666748 17.5763 1.01697 19.2003 1.71741C20.8243 2.41786 22.2354 3.36764 23.4337 4.56675C24.6319 5.76586 25.5821 7.17697 26.2843 8.80008C26.9865 10.4232 27.3363 12.1565 27.3337 14.0001C27.331 15.8436 26.9808 17.577 26.283 19.2001C25.5852 20.8232 24.6354 22.2343 23.4337 23.4334C22.2319 24.6325 20.8208 25.5827 19.2003 26.2841C17.5799 26.9854 15.8465 27.3352 14.0003 27.3334Z" fill="var(--ul-primary)" /></svg>
                            <p>
                                <strong>Note</strong>&nbsp;: Mode test activé. En mode test, aucun don réel n'est traité.
                            </p>
                        </div>
                    </div>
                </div>

                <script>
                // Affichage du modal de don spontané avec animations
                document.addEventListener('DOMContentLoaded', function () {
                    var donateBtn = document.getElementById('spontaneous-donation-btn');
                    var modal = document.getElementById('spontaneous-donation-modal');
                    var closeModalBtn = document.getElementById('spontaneous-donation-modal-close');

                    // Fonction pour ouvrir le modal avec animation
                    function openModal() {
                        modal.style.display = 'flex';
                        document.body.style.overflow = 'hidden';
                        // Forcer le reflow pour déclencher l'animation
                        void modal.offsetWidth;
                        // Ajouter la classe pour l'animation
                        setTimeout(function() {
                            modal.classList.add('show');
                        }, 10);
                    }

                    // Fonction pour fermer le modal avec animation
                    function closeModal() {
                        modal.classList.remove('show');
                        // Attendre la fin de l'animation avant de cacher
                        setTimeout(function() {
                            modal.style.display = 'none';
                            document.body.style.overflow = '';
                        }, 300);
                    }

                    if(donateBtn && modal && closeModalBtn){
                        // Ouvrir le modal au clic sur le bouton
                        donateBtn.addEventListener('click', function(e){
                            e.preventDefault();
                            openModal();
                        });

                        // Fermer le modal au clic sur le bouton de fermeture
                        closeModalBtn.addEventListener('click', function(e){
                            e.preventDefault();
                            closeModal();
                        });

                        // Fermer le modal en cliquant sur le fond (hors du contenu)
                        modal.addEventListener('mousedown', function(e){
                            if(e.target === modal){
                                closeModal();
                            }
                        });

                        // Fermer le modal avec la touche Escape
                        document.addEventListener('keydown', function(e){
                            if(e.key === 'Escape' && modal.classList.contains('show')){
                                closeModal();
                            }
                        });
                    }

                    // Logique d'affichage des champs anonymes/non-anonymes
                    let typeNonAnon = document.getElementById('spontaneous-donation-type-1');
                    let typeAnon = document.getElementById('spontaneous-donation-type-2');
                    let personalSection = document.getElementById('spontaneous-personal-info-section');
                    let anonSection = document.getElementById('spontaneous-anonymous-submit-section');
                    function toggleAnonSection(){
                        if(typeAnon.checked){
                            personalSection.style.display = 'none';
                            anonSection.style.display = '';
                        }else{
                            personalSection.style.display = '';
                            anonSection.style.display = 'none';
                        }
                    }
                    if(typeNonAnon && typeAnon){
                        typeNonAnon.addEventListener('change', toggleAnonSection);
                        typeAnon.addEventListener('change', toggleAnonSection);
                        toggleAnonSection();
                    }

                    // Update montant affiché
                    function updateMontant(_ev){
                        let current = document.querySelector('input[name="donate-amount"]:checked');
                        let val = 10;
                        if(current){
                            if(current.value === 'custom'){
                                let cval = parseFloat(document.getElementById('spontaneous-donate-amount-custom').value.replace(',','.'));
                                val = isNaN(cval)||!cval?10:parseFloat(cval);
                            } else {
                                val = parseFloat(current.value);
                            }
                        }
                        document.getElementById('spontaneous-selected-amount-display').innerText = val.toFixed(2);
                        document.getElementById('spontaneous-donation-total-amount').innerText = val;
                        document.getElementById('spontaneous-donation-total-amount-anonymous').innerText = val;
                    }
                    let radios = document.querySelectorAll('.ul-modal input[name="donate-amount"]');
                    radios.forEach(function(r){
                        r.addEventListener('change', updateMontant);
                    });
                    let customInput = document.getElementById('spontaneous-donate-amount-custom');
                    if(customInput){
                        customInput.addEventListener('input', function(){
                            let customRadio = document.getElementById('spontaneous-custom-amount');
                            if(customRadio) customRadio.checked = true;
                            updateMontant();
                        });
                    }

                    // Affichage/retrait des opérateurs Mobile Money + champ téléphone
                    let methodMM = document.getElementById('spontaneous-method-1');
                    let methodCard = document.getElementById('spontaneous-method-2');
                    let mmOptions = document.getElementById('spontaneous-mobile-money-options');
                    let phoneField = document.getElementById('spontaneous-phone-field');
                    function updateMMOptions(){
                        if(methodMM && mmOptions){
                            const isMM = methodMM.checked;
                            mmOptions.style.display = isMM ? 'block' : 'none';
                            if (phoneField) {
                                phoneField.style.display = isMM ? 'block' : 'none';
                            }
                        }
                    }
                    if(methodMM && methodCard){
                        methodMM.addEventListener('change', updateMMOptions);
                        methodCard.addEventListener('change', updateMMOptions);
                        updateMMOptions();
                    }
                });

                // Gestion des onglets Don spontané / Devenir donateur
                const donationTabs = document.querySelectorAll('.ul-donation-tab');
                const donationPanes = document.querySelectorAll('.ul-donation-tab-pane');

                donationTabs.forEach(tab => {
                    tab.addEventListener('click', function () {
                        const targetSelector = this.getAttribute('data-target');
                        if (!targetSelector) return;

                        // Activer l'onglet
                        donationTabs.forEach(t => t.classList.remove('active'));
                        this.classList.add('active');

                        // Afficher le bon panneau
                        donationPanes.forEach(pane => {
                            if ('#' + pane.id === targetSelector) {
                                pane.style.display = 'block';
                                pane.classList.add('active');
                            } else {
                                pane.style.display = 'none';
                                pane.classList.remove('active');
                            }
                        });
                    });
                });

                // Formulaire "Devenir donateur" : bascule champs selon type de don
                const donorTypeSelect = document.getElementById('donor-donation-type');
                const donorAmountGroup = document.getElementById('donor-amount-group');
                const donorNatureGroup = document.getElementById('donor-nature-group');

                function updateDonorTypeFields() {
                    if (!donorTypeSelect || !donorAmountGroup || !donorNatureGroup) return;
                    const value = donorTypeSelect.value;
                    if (value === 'espece') {
                        donorAmountGroup.style.display = 'block';
                        donorNatureGroup.style.display = 'none';
                    } else if (value === 'nature') {
                        donorAmountGroup.style.display = 'none';
                        donorNatureGroup.style.display = 'block';
                    } else {
                        donorAmountGroup.style.display = 'none';
                        donorNatureGroup.style.display = 'none';
                    }
                }

                if (donorTypeSelect) {
                    donorTypeSelect.addEventListener('change', updateDonorTypeFields);
                    updateDonorTypeFields();
                }
                </script>
                    </div>
                </div>
    </header>
    <!-- HEADER SECTION END -->


            <!-- Main Content -->
    <main class="overflow-hidden">
                @yield('content')
            </main>

    <!-- FOOTER SECTION START -->
    <footer class="ul-footer">
        <div class="ul-footer-top">
            <div class="ul-footer-container">
                <div class="ul-footer-top-contact-infos">
                    <!-- single info -->
                    <div class="ul-footer-top-contact-info">
                        <!-- icon -->
                        <div class="ul-footer-top-contact-info-icon">
                            <div class="ul-footer-top-contact-info-icon-inner">
                                <i class="flaticon-pin"></i>
                            </div>
                        </div>
                        <!-- txt -->
                        <div class="ul-footer-top-contact-info-txt">
                            <span class="ul-footer-top-contact-info-label">Adresse</span>
                            <h5 class="ul-footer-top-contact-info-address">4648 Rocky Road Philadelphia PA, 1920</h5>
                        </div>
                    </div>

                    <!-- single info -->
                    <div class="ul-footer-top-contact-info">
                        <!-- icon -->
                        <div class="ul-footer-top-contact-info-icon">
                            <div class="ul-footer-top-contact-info-icon-inner">
                                <i class="flaticon-email"></i>
                            </div>
                        </div>
                        <!-- txt -->
                        <div class="ul-footer-top-contact-info-txt">
                            <span class="ul-footer-top-contact-info-label">Envoyer un email</span>
                            <h5 class="ul-footer-top-contact-info-address"><a
                                    href="mailto:info@exmple.com">info@exmple.com</a></h5>
                        </div>
                    </div>

                    <!-- single info -->
                    <div class="ul-footer-top-contact-info">
                        <!-- icon -->
                        <div class="ul-footer-top-contact-info-icon">
                            <div class="ul-footer-top-contact-info-icon-inner">
                                <i class="flaticon-telephone-call-1"></i>
                            </div>
                        </div>
                        <!-- txt -->
                        <div class="ul-footer-top-contact-info-txt">
                            <span class="ul-footer-top-contact-info-label">Appel d'urgence</span>
                            <h5 class="ul-footer-top-contact-info-address"><a href="tel:88012365499">+88 0123 654
                                    99</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ul-footer-middle">
            <div class="ul-footer-container">
                <div class="ul-footer-middle-wrapper wow animate__fadeInUp">
                    <div class="ul-footer-about">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/lg.png') }}"
                            height="80px" width="80px" alt="Espoir Vie ASBL" class="logo"></a>
                        <p class="ul-footer-about-txt">Espoir Vie ASBL est une organisation à but non lucratif dédiée à améliorer la vie des personnes dans le besoin. Ensemble, créons un avenir meilleur pour tous.</p>
                        <div class="ul-footer-socials">
                            <a href="#"><i class="flaticon-facebook"></i></a>
                            <a href="#"><i class="flaticon-twitter"></i></a>
                            <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                            <a href="#"><i class="flaticon-youtube"></i></a>
                        </div>
                    </div>

                    <div class="ul-footer-widget">
                        <h3 class="ul-footer-widget-title">Liens rapides</h3>

                        <div class="ul-footer-widget-links">
                            <a href="{{ route('about') }}">À propos</a>
                            <a href="{{ route('team') }}">Notre équipe</a>
                            <a href="{{ route('events') }}">Événements</a>
                            <a href="{{ route('articles') }}">Articles</a>
                            <a href="{{ route('donate') }}">Faire un don</a>
                            <a href="{{ route('contact') }}">Nous contacter</a>
                        </div>
                    </div>

                    <div class="ul-footer-widget ul-footer-recent-posts">
                        <h3 class="ul-footer-widget-title">Articles récents</h3>

                        <div class="ul-blog-sidebar-posts">
                            @if(isset($footerRecentArticles) && $footerRecentArticles->count() > 0)
                                @foreach($footerRecentArticles as $index => $recentArticle)
                                    <div class="ul-blog-sidebar-post ul-footer-post">
                                        <div class="img">
                                            @if($recentArticle->image)
                                                @if(Str::startsWith($recentArticle->image, ['http://', 'https://']))
                                                    <img src="{{ $recentArticle->image }}" alt="{{ $recentArticle->title }}">
                                                @else
                                                    <img src="{{ asset('storage/' . $recentArticle->image) }}" alt="{{ $recentArticle->title }}">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/img/blog-' . (($index % 3) + 1) . '.jpg') }}" alt="{{ $recentArticle->title }}">
                                            @endif
                                        </div>

                                        <div class="txt">
                                            <span class="date">
                                                <span class="icon"><i class="flaticon-calendar"></i></span>
                                                <span>
                                                    {{ $recentArticle->published_at ? $recentArticle->published_at->translatedFormat('d M Y') : $recentArticle->created_at->translatedFormat('d M Y') }}
                                                </span>
                                            </span>

                                            <h4 class="title">
                                                <a href="{{ route('article.show', $recentArticle->slug) }}">
                                                    {{ Str::limit($recentArticle->title, 60) }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback statique si aucun article n'est disponible -->
                                <div class="ul-blog-sidebar-post ul-footer-post">
                                    <div class="img">
                                        <img src="{{ asset('assets/img/blog-1.jpg') }}" alt="Article par défaut">
                                    </div>
                                    <div class="txt">
                                        <span class="date">
                                            <span class="icon"><i class="flaticon-calendar"></i></span>
                                            <span>{{ now()->translatedFormat('d M Y') }}</span>
                                        </span>
                                        <h4 class="title">
                                            <a href="{{ route('articles') }}">Découvrez nos derniers articles</a>
                                        </h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="ul-footer-widget ul-nwsltr-widget">
                        <h3 class="ul-footer-widget-title">Nous contacter</h3>
                        <div class="ul-footer-widget-links ul-footer-contact-links">
                            <a href="mailto:info@example.com"><i class="flaticon-mail"></i> info@example.com</a>
                            <a href="tel:123-456-7890"><i class="flaticon-telephone-call"></i> 123-456-7890</a>
                        </div>
                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="ul-nwsltr-form">
                            @csrf
                            <div class="top">
                                <input type="email" name="email" id="nwsltr-email"
                                    placeholder="Votre adresse email" class="ul-nwsltr-input" required>
                                <button type="submit"><i class="flaticon-next"></i></button>
                            </div>

                            <div class="agreement">
                                <label for="nwsltr-agreement" class="ul-checkbox-wrapper">
                                    <input type="checkbox" name="agreement" id="nwsltr-agreement" value="1" required>
                                    {{-- <span class="ul-checkbox"><i class="flaticon-tick"></i></span> --}}
                                    <span class="ul-checkbox-txt">J'accepte la <a href="{{ route('privacy') }}">Politique de confidentialité</a></span>
                                </label>
                            </div>
                            <span class="error-message" id="error-nwsltr-email" style="display: none;"></span>
                        </form>
                        </div>
                        </div>
                        </div>
                    </div>

        <!-- footer bottom -->
        <div class="ul-footer-bottom">
            <div class="ul-footer-container">
                <div class="ul-footer-bottom-wrapper">
                    <p class="copyright-txt">&copy;
                        <span id="footer-copyright-year"></span> Espoir Vie ASBL. Tous droits réservés.
                    </p>
                    <div class="ul-footer-bottom-nav">
                        <a href="{{ route('terms') }}">Conditions d'utilisation</a>
                        <a href="{{ route('privacy') }}">Politique de confidentialité</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- vector -->
        <div class="ul-footer-vectors">
            <img src="{{ asset('assets/img/footer-vector-img.png') }}" alt="Image du footer" class="ul-footer-vector-1">
        </div>
            </footer>
    <!-- FOOTER SECTION END -->
    <!-- libraries JS -->
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide-extension-auto-scroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slim-select/slimselect.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/animate-wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splittype/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/mixitup/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fslightbox/fslightbox.js') }}"></script>
    <script src="{{ asset('assets/vendor/flatpickr/flatpickr.js') }}"></script>

    <!-- custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/tab.js') }}"></script>
    <script src="{{ asset('assets/js/accordion.js') }}"></script>
    <script src="{{ asset('assets/js/progressbar.js') }}"></script>
    <script src="{{ asset('assets/js/donate-form.js') }}"></script>
    <script src="{{ asset('assets/js/async-forms.js') }}"></script>

        </div>
    </body>

</html>
