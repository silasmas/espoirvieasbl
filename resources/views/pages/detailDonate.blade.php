@extends('layouts.public')

@section('title', 'Faire un don : ' . $activity->title . ' - Espoir Vie ASBL')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')

        <!-- BREADCRUMBS SECTION START -->
        <section class="ul-breadcrumb ul-section-spacing">
            <div class="ul-container">
                <h2 class="ul-breadcrumb-title">Détail du projet</h2>
                <ul class="ul-breadcrumb-nav">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><span class="separator"><i class="flaticon-right"></i></span></li>
                    <li><a href="{{ route('donate') }}">Faire un don</a></li>
                    <li><span class="separator"><i class="flaticon-right"></i></span></li>
                    <li>{{ Str::limit($activity->title, 30) }}</li>
                </ul>
            </div>
        </section>
        <!-- BREADCRUMBS SECTION END -->


        <div class="ul-container ul-section-spacing">
            <div class="row gx-0 gy-4 flex-column-reverse flex-lg-row">
                <!-- left sidebar -->
                <div class="col-lg-4">
                    <div class="ul-inner-sidebar">
                        <!-- single widget / Project Info -->
                        <div class="ul-inner-sidebar-widget">
                            <h3 class="ul-inner-sidebar-widget-title">Informations du projet</h3>
                            <div class="ul-inner-sidebar-widget-content">
                                <div class="ul-inner-sidebar-project-info">
                                    @if($activity->start_date)
                                    <p><strong>Date de début :</strong><br>{{ $activity->start_date->format('d/m/Y') }}</p>
                                    @endif
                                    @if($activity->location)
                                    <p><strong>Lieu :</strong><br>{{ $activity->location }}</p>
                                    @endif
                                    @if($activity->budget > 0)
                                    <p><strong>Budget :</strong><br>{{ number_format($activity->budget, 0, ',', ' ') }} €</p>
                                    @endif
                                    @if($activity->status)
                                    <p><strong>Statut :</strong><br>
                                        @if($activity->status === 'planned')
                                            Planifié
                                        @elseif($activity->status === 'ongoing')
                                            En cours
                                        @elseif($activity->status === 'completed')
                                            Terminé
                                        @else
                                            {{ ucfirst($activity->status) }}
                                        @endif
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- single widget / Other Projects -->
                        <div class="ul-inner-sidebar-widget">
                            <h3 class="ul-inner-sidebar-widget-title">Autres projets</h3>
                            <div class="ul-inner-sidebar-widget-content">
                                <div class="ul-inner-sidebar-posts">
                                    @php
                                        $otherActivities = \App\Models\Activity::where('is_public', true)
                                            ->where('id', '!=', $activity->id)
                                            ->where('status', '!=', 'cancelled')
                                            ->limit(3)
                                            ->get();
                                    @endphp
                                    @foreach($otherActivities as $otherActivity)
                                    <div class="ul-inner-sidebar-post">
                                        <div class="img">
                                            @if($otherActivity->image)
                                                <img src="{{ activity_image_url($otherActivity->image) }}" alt="{{ $otherActivity->title }}">
                                            @else
                                                <img src="{{ asset('assets/img/blog-2.jpg') }}" alt="{{ $otherActivity->title }}">
                                            @endif
                                        </div>
                                        <div class="txt">
                                            <h4 class="title"><a href="{{ route('donate.detail', $otherActivity) }}">{{ Str::limit($otherActivity->title, 50) }}</a></h4>
                                            <span class="date">
                                                <span>{{ $otherActivity->created_at->format('d/m/Y') }}</span>
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- donation details content -->
                <div class="col-lg-8">
                    <div class="ul-donation-details">
                        @if($activity->image)
                            <div class="ul-donation-details-img">
                                <img src="{{ activity_image_url($activity->image) }}" alt="{{ $activity->title }}">
                            </div>
                        @else
                            <div class="ul-donation-details-img">
                                <img src="{{ asset('assets/img/donation-details-img.jpg') }}" alt="{{ $activity->title }}">
                            </div>
                        @endif

                        @if($activity->budget > 0)
                        @php
                            $progressPercentage = min(100, (($activity->amount_raised ?? 0) / $activity->budget) * 100);
                        @endphp
                        <h2 class="ul-donation-details-raised">{{ number_format($activity->amount_raised ?? 0, 0, ',', ' ') }} € <span class="target">sur {{ number_format($activity->budget, 0, ',', ' ') }} € collectés</span></h2>
                        <div class="ul-donation-progress ul-donation-progress-2">
                            <div class="donation-progress-container ul-progress-container">
                                <div class="donation-progressbar ul-progressbar" data-ul-progress-value="{{ round($progressPercentage) }}">
                                    <div class="donation-progress-label ul-progress-label"></div>
                                </div>
                            </div>
                        </div>
                        @else
                        <h2 class="ul-donation-details-raised">{{ number_format($activity->amount_raised ?? 0, 0, ',', ' ') }} € <span class="target">collectés</span></h2>
                        @endif

                        <div class="ul-donation-details-notice">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.0003 20.6667C14.3781 20.6667 14.695 20.5387 14.951 20.2827C15.207 20.0267 15.3345 19.7103 15.3337 19.3334C15.3328 18.9565 15.2048 18.6401 14.9497 18.3841C14.6945 18.1281 14.3781 18.0001 14.0003 18.0001C13.6225 18.0001 13.3061 18.1281 13.051 18.3841C12.7959 18.6401 12.6679 18.9565 12.667 19.3334C12.6661 19.7103 12.7941 20.0272 13.051 20.2841C13.3079 20.541 13.6243 20.6685 14.0003 20.6667ZM14.0003 15.3334C14.3781 15.3334 14.695 15.2054 14.951 14.9494C15.207 14.6934 15.3345 14.377 15.3337 14.0001V8.66675C15.3337 8.28897 15.2057 7.97253 14.9497 7.71741C14.6937 7.4623 14.3772 7.3343 14.0003 7.33341C13.6234 7.33253 13.307 7.46053 13.051 7.71741C12.795 7.9743 12.667 8.29075 12.667 8.66675V14.0001C12.667 14.3779 12.795 14.6947 13.051 14.9507C13.307 15.2067 13.6234 15.3343 14.0003 15.3334ZM14.0003 27.3334C12.1559 27.3334 10.4226 26.9832 8.80033 26.2827C7.17811 25.5823 5.76699 24.6325 4.56699 23.4334C3.36699 22.2343 2.41722 20.8232 1.71766 19.2001C1.01811 17.577 0.667883 15.8436 0.666994 14.0001C0.666105 12.1565 1.01633 10.4232 1.71766 8.80008C2.41899 7.17697 3.36877 5.76586 4.56699 4.56675C5.76522 3.36764 7.17633 2.41786 8.80033 1.71741C10.4243 1.01697 12.1577 0.666748 14.0003 0.666748C15.843 0.666748 17.5763 1.01697 19.2003 1.71741C20.8243 2.41786 22.2354 3.36764 23.4337 4.56675C24.6319 5.76586 25.5821 7.17697 26.2843 8.80008C26.9865 10.4232 27.3363 12.1565 27.3337 14.0001C27.331 15.8436 26.9808 17.577 26.283 19.2001C25.5852 20.8232 24.6354 22.2343 23.4337 23.4334C22.2319 24.6325 20.8208 25.5827 19.2003 26.2841C17.5799 26.9854 15.8465 27.3352 14.0003 27.3334Z" fill="var(--ul-primary)" />
                            </svg>
                            <p>
                                <strong>Note</strong>: Mode test activé. En mode test, aucun don réel n'est traité.
                            </p>
                        </div>

                        <!-- Zone de notification -->
                        <div id="donation-notification" class="async-notification" style="display: none; margin-bottom: 20px;"></div>

                        <form id="donation-form" action="{{ route('donate.process') }}" method="POST" class="ul-donation-details-form">
                            @csrf
                            <input type="hidden" name="activity_id" value="{{ $activity->id }}">

                            <!-- selct amount -->
                            <div class="ul-donation-details-donate-form-wrapper">
                                <div class="selected-amount"><span class="currency">€</span> <span class="number" id="selected-amount-display">10.00</span></div>
                                <div class="ul-donate-form">
                                    <div>
                                        <input type="radio" name="donate-amount" id="donate-amount-1" value="10" checked hidden>
                                        <label for="donate-amount-1" class="ul-donate-form-label">10 €</label>
                                    </div>

                                    <div>
                                        <input type="radio" name="donate-amount" id="donate-amount-2" value="20" hidden>
                                        <label for="donate-amount-2" class="ul-donate-form-label">20 €</label>
                                    </div>

                                    <div>
                                        <input type="radio" name="donate-amount" id="donate-amount-3" value="30" hidden>
                                        <label for="donate-amount-3" class="ul-donate-form-label">30 €</label>
                                    </div>

                                    <div>
                                        <input type="radio" name="donate-amount" id="donate-amount-4" value="40" hidden>
                                        <label for="donate-amount-4" class="ul-donate-form-label">40 €</label>
                                    </div>

                                    <div>
                                        <input type="radio" name="donate-amount" id="donate-amount-5" value="50" hidden>
                                        <label for="donate-amount-5" class="ul-donate-form-label">50 €</label>
                                    </div>

                                    <div class="custom-amount-wrapper">
                                        <input type="radio" name="donate-amount" id="custom-amount" value="custom">
                                        <label for="donate-amount-custom" class="ul-donate-form-label">
                                            <input type="number" name="custom-amount" id="donate-amount-custom" placeholder="Montant personnalisé" class="ul-donate-form-custom-input" min="1" step="0.01">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Type de don : Anonyme ou Non anonyme -->
                            <div class="ul-donation-details-donation-type" style="margin: 20px 0;">
                                <h3 class="ul-donation-details-personal-info-title">Type de don</h3>
                                <div class="ul-donation-details-payment-methods-form">
                                    <div class="ul-radio">
                                        <label for="donation-type-1">
                                            <input type="radio" name="donation_type" id="donation-type-1" value="non-anonymous" checked>
                                            <span class="checkmark"></span>
                                            <span>Don non anonyme</span>
                                        </label>
                                    </div>
                                    <div class="ul-radio">
                                        <label for="donation-type-2">
                                            <input type="radio" name="donation_type" id="donation-type-2" value="anonymous">
                                            <span class="checkmark"></span>
                                            <span>Don anonyme</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- select payment methods -->
                            <div class="ul-donation-details-payment-methods">
                                <h3 class="ul-donation-details-payment-methods-title">Sélectionner la méthode de paiement</h3>
                                <div class="ul-donation-details-payment-methods-form">
                                    <div class="ul-radio">
                                        <label for="method-1">
                                            <input type="radio" name="payment_method" id="method-1" value="mobile_money" checked>
                                            <span class="checkmark"></span>
                                            <span>Mobile Money</span>
                                        </label>
                                    </div>
                                    <div class="ul-radio">
                                        <label for="method-2">
                                            <input type="radio" name="payment_method" id="method-2" value="card">
                                            <span class="checkmark"></span>
                                            <span>Carte bancaire</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Liste des moyens Mobile Money (visible uniquement quand Mobile Money est sélectionné) -->
                                <div id="mobile-money-options" style="margin-top: 15px; padding: 15px; background-color: #f9f9f9; border-radius: 8px; display: block;">
                                    <h4 style="font-size: 14px; margin-bottom: 10px; font-weight: 600;">Choisissez votre opérateur Mobile Money</h4>
                                    <div class="ul-donation-details-payment-methods-form">
                                        <div class="ul-radio">
                                            <label for="mobile-1">
                                                <input type="radio" name="mobile_money_provider" id="mobile-1" value="orange_money" checked>
                                                <span class="checkmark"></span>
                                                <span>Orange Money</span>
                                            </label>
                                        </div>
                                        <div class="ul-radio">
                                            <label for="mobile-2">
                                                <input type="radio" name="mobile_money_provider" id="mobile-2" value="mtn_mobile_money">
                                                <span class="checkmark"></span>
                                                <span>MTN Mobile Money</span>
                                            </label>
                                        </div>
                                        <div class="ul-radio">
                                            <label for="mobile-3">
                                                <input type="radio" name="mobile_money_provider" id="mobile-3" value="airtel_money">
                                                <span class="checkmark"></span>
                                                <span>Airtel Money</span>
                                            </label>
                                        </div>
                                        <div class="ul-radio">
                                            <label for="mobile-4">
                                                <input type="radio" name="mobile_money_provider" id="mobile-4" value="moov_money">
                                                <span class="checkmark"></span>
                                                <span>Moov Money</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- enter personal info (caché si don anonyme) -->
                            <div id="personal-info-section" class="ul-donation-details-personal-info">
                                <h3 class="ul-donation-details-personal-info-title">Informations personnelles</h3>
                                <p class="ul-donation-details-personal-info-sub-title">Votre adresse email ne sera pas publiée. Les champs marqués * sont obligatoires.</p>
                                <div class="ul-donation-details-personal-info-form">
                                    <div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" name="first_name" id="first_name" placeholder="Prénom *" required>
                                                <span class="error-message" id="error-first_name"></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" name="last_name" id="last_name" placeholder="Nom *" required>
                                                <span class="error-message" id="error-last_name"></span>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="email" name="email" id="donation-email" placeholder="Adresse email *" required>
                                                <span class="error-message" id="error-email"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="ul-donation-details-form-bottom">
                                    <button type="submit" id="donation-submit-btn" class="ul-btn">
                                        <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                                        <span id="donation-btn-text">Faire un don maintenant</span>
                                    </button>
                                    <span class="donation-total">Total du don : <span class="number" id="donation-total-amount">10</span> €</span>
                                </div>
                            </div>

                            <!-- Bouton de soumission pour les dons anonymes -->
                            <div id="anonymous-submit-section" class="ul-donation-details-form-bottom" style="display: none; margin-top: 20px;">
                                <button type="submit" id="donation-submit-btn-anonymous" class="ul-btn">
                                    <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                                    <span id="donation-btn-text-anonymous">Faire un don maintenant</span>
                                </button>
                                <span class="donation-total">Total du don : <span class="number" id="donation-total-amount-anonymous">10</span> €</span>
                            </div>
                        </form>

                        <div class="ul-donation-details-summary">
                            <h3 class="ul-donation-details-summary-title">Résumé du projet</h3>
                            <div class="ul-donation-details-summary-txt">
                                <h4>{{ $activity->title }}</h4>
                                <p>{{ $activity->description ?? 'Aidez-nous à réaliser ce projet qui changera la vie de nombreuses personnes.' }}</p>

                                @if($activity->impact)
                                <h5 style="margin-top: 20px; margin-bottom: 10px;">Impact prévu :</h5>
                                <p>{{ $activity->impact }}</p>
                                @endif

                                @if($activity->beneficiaries_count)
                                <p style="margin-top: 15px;"><strong>Nombre de bénéficiaires :</strong> {{ number_format($activity->beneficiaries_count, 0, ',', ' ') }} personnes</p>
                                @endif

                                @if($activity->results)
                                <h5 style="margin-top: 20px; margin-bottom: 10px;">Résultats attendus :</h5>
                                <div>{!! nl2br(e($activity->results)) !!}</div>
                                @endif

                                @if($activity->images && is_array($activity->images) && count($activity->images) > 0)
                                <div class="ul-donation-details-summary-imgs" style="margin-top: 20px;">
                                    @foreach(array_slice($activity->images, 0, 2) as $img)
                                    <img src="{{ activity_image_url($img) }}" alt="Image du projet">
                                    @endforeach
                                </div>
                                @endif

                                @if($activity->location || $activity->start_date)
                                <div style="margin-top: 20px; padding: 15px; background-color: #EFF6FF; border-left: 4px solid #2563EB;">
                                    @if($activity->location)
                                    <p style="margin: 0;"><strong>📍 Lieu :</strong> {{ $activity->location }}</p>
                                    @endif
                                    @if($activity->start_date)
                                    <p style="margin: 10px 0 0 0;"><strong>📅 Date de début :</strong> {{ $activity->start_date->format('d/m/Y') }}</p>
                                    @endif
                                    @if($activity->end_date)
                                    <p style="margin: 10px 0 0 0;"><strong>📅 Date de fin :</strong> {{ $activity->end_date->format('d/m/Y') }}</p>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<style>
    .error-message {
        display: block;
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }
    .form-group input.error {
        border-color: #dc3545;
    }
    #donation-submit-btn:disabled,
    #donation-submit-btn-anonymous:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>

@endsection
