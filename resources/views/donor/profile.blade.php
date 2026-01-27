@extends('layouts.public')

@section('title', 'Mon profil - Espoir Vie ASBL')

@section('content')
    <x-breadcrumb
        title="Mon profil"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Mon profil'],
        ]"
    />

    <section class="ul-section-spacing">
        <div class="ul-container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ul-donor-card">
                        <h2 class="ul-donor-card-title">Informations du compte</h2>
                        <p class="ul-donor-card-subtitle">
                            Retrouvez ici les informations principales liées à votre compte donateur.
                        </p>

                        <div class="ul-donor-card-body">
                            <div class="ul-donor-row">
                                <span class="label">Nom complet</span>
                                <span class="value" id="profile-name-value">{{ $user->name }}</span>
                            </div>
                            <div class="ul-donor-row">
                                <span class="label">Adresse email</span>
                                <span class="value" id="profile-email-value">{{ $user->email }}</span>
                            </div>
                            <div class="ul-donor-row">
                                <span class="label">Téléphone</span>
                                <span class="value" id="profile-phone-value">{{ $user->phone ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="ul-donor-row">
                                <span class="label">Pays</span>
                                <span class="value" id="profile-country-value">{{ $user->country ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="ul-donor-row">
                                <span class="label">Type de don choisi</span>
                                <span class="value" id="profile-donation-type-value">
                                    @if($user->donation_type === 'espece')
                                        En espèces ({{ $user->donation_currency ?? 'Devise non définie' }})
                                    @elseif($user->donation_type === 'nature')
                                        En nature
                                    @else
                                        Non défini
                                    @endif
                                </span>
                            </div>
                            @if($user->donation_type === 'espece' && $user->donation_amount)
                                <div class="ul-donor-row" id="profile-donation-amount-row">
                                    <span class="label">Montant prévu</span>
                                    <span class="value" id="profile-donation-amount-value">
                                        {{ number_format($user->donation_amount, 2, ',', ' ') }} {{ $user->donation_currency ?? '' }}
                                    </span>
                                </div>
                            @endif
                            @if($user->donation_type === 'nature' && $user->donation_description)
                                <div class="ul-donor-row" id="profile-donation-nature-row">
                                    <span class="label">Don en nature</span>
                                    <span class="value" id="profile-donation-nature-value">{{ $user->donation_description }}</span>
                                </div>
                            @endif
                            @if($user->donation_period)
                                <div class="ul-donor-row" id="profile-donation-period-row">
                                    <span class="label">Date de début du don</span>
                                    <span class="value" id="profile-donation-period-value">{{ \Carbon\Carbon::parse($user->donation_period)->format('d/m/Y') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="ul-donor-card-footer">
                            <a href="javascript:void(0);" id="donor-edit-profile-btn" class="ul-btn">
                                <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Mettre à jour mes informations
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    @include('donor.partials.account-sidebar', ['user' => $user])
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL MISE À JOUR PROFIL -->
    <div id="donor-profile-modal" class="ul-modal">
        <div class="ul-modal-content">
            <button type="button" id="donor-profile-modal-close">&times;</button>
            <div class="modal-header-content">
                <h2>Mettre à jour mes informations</h2>
                <p>Modifiez vos informations de compte donateur, puis enregistrez les changements.</p>
            </div>

            <form method="POST" action="{{ route('donor.profile.update') }}" class="ul-donation-details-form" id="donor-profile-form">
                @csrf
                @method('PATCH')

                <div class="async-notification" id="donor-profile-notification" style="display:none;"></div>

                <div class="ul-donation-details-personal-info-form">
                    <div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="modal_name" class="form-label">Nom complet *</label>
                                <input type="text" id="modal_name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="modal_email" class="form-label">Adresse email *</label>
                                <input type="email" id="modal_email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="modal_country" class="form-label">Pays</label>
                                <input type="text" id="modal_country" name="country" value="{{ old('country', $user->country) }}">
                                @error('country')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="modal_phone" class="form-label">Téléphone</label>
                                <input type="tel" id="modal_phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="modal_donation_period" class="form-label">Date de début du don</label>
                                <input
                                    type="date"
                                    id="modal_donation_period"
                                    name="donation_period"
                                    value="{{ old('donation_period', $user->donation_period ? \Carbon\Carbon::parse($user->donation_period)->format('Y-m-d') : '') }}"
                                >
                                @error('donation_period')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="modal_donation_type" class="form-label">Type de don</label>
                                <select id="modal_donation_type" name="donation_type" class="form-select">
                                    <option value="">— Non défini —</option>
                                    <option value="espece" {{ old('donation_type', $user->donation_type) === 'espece' ? 'selected' : '' }}>En espèces (argent)</option>
                                    <option value="nature" {{ old('donation_type', $user->donation_type) === 'nature' ? 'selected' : '' }}>En nature (biens matériels / autres)</option>
                                </select>
                                @error('donation_type')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12" id="modal_donation_amount_group" @if(old('donation_type', $user->donation_type) !== 'espece') style="display:none;" @endif>
                            <div class="form-group">
                                <label class="form-label">Montant prévu</label>
                                <div style="display:flex; gap:8px; align-items:center;">
                                    <select name="donation_currency" class="form-select" style="max-width:110px;">
                                        <option value="">Devise</option>
                                        <option value="USD" {{ old('donation_currency', $user->donation_currency) === 'USD' ? 'selected' : '' }}>USD</option>
                                        <option value="CDF" {{ old('donation_currency', $user->donation_currency) === 'CDF' ? 'selected' : '' }}>CDF</option>
                                    </select>
                                    <input
                                        type="number"
                                        name="donation_amount"
                                        value="{{ old('donation_amount', $user->donation_amount) }}"
                                        min="1"
                                        step="0.01"
                                        placeholder="Montant"
                                        class="form-control"
                                    >
                                </div>
                                @error('donation_amount')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                                @error('donation_currency')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12" id="modal_donation_nature_group" @if(old('donation_type', $user->donation_type) !== 'nature') style="display:none;" @endif>
                            <div class="form-group">
                                <label for="modal_donation_description" class="form-label">Détail du don en nature</label>
                                <textarea
                                    id="modal_donation_description"
                                    name="donation_description"
                                    rows="3"
                                    class="form-control"
                                    placeholder="Précisez votre don en nature (biens, matériel, services...)"
                                >{{ old('donation_description', $user->donation_description) }}</textarea>
                                @error('donation_description')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ul-donation-details-form-bottom" style="margin-top: 12px;">
                    <button type="submit" class="ul-btn">
                        <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                        <span>Enregistrer les modifications</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL MOT DE PASSE -->
    <div id="donor-password-modal" class="ul-modal">
        <div class="ul-modal-content">
            <button type="button" id="donor-password-modal-close">&times;</button>
            <div class="modal-header-content">
                <h2>Modifier mon mot de passe</h2>
                <p>Saisissez votre mot de passe actuel puis choisissez un nouveau mot de passe sécurisé.</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="ul-donation-details-form">
                @csrf
                @method('PUT')

                <div class="ul-donation-details-personal-info-form">
                    <div class="form-group">
                        <label for="current_password" class="form-label">Mot de passe actuel</label>
                        <input id="current_password" type="password" name="current_password" required autocomplete="current-password">
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Nouveau mot de passe</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="ul-donation-details-form-bottom" style="margin-top: 12px;">
                    <button type="submit" class="ul-btn">
                        <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                        <span>Mettre à jour le mot de passe</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL ENVOI DE DON / PREUVE -->
    <div id="donor-send-donation-modal" class="ul-modal">
        <div class="ul-modal-content">
            <button type="button" id="donor-send-donation-modal-close">&times;</button>
            <div class="modal-header-content">
                <h2>Envoyer mon don</h2>
                @if($user->donation_type === 'nature')
                    <p>Joignez la capture de votre reçu ou de la remise en nature, ainsi qu'une description détaillée.</p>
                @elseif($user->donation_type === 'espece')
                    <p>Indiquez le mode de paiement utilisé et joignez, si possible, le reçu de paiement.</p>
                @else
                    <p>Précisez ci-dessous les détails de votre don et, si possible, joignez un reçu.</p>
                @endif
            </div>

            <form method="POST" action="{{ route('donor.sendDonation') }}" class="ul-donation-details-form" enctype="multipart/form-data">
                @csrf

                <div class="ul-donation-details-personal-info-form">
                    <div class="form-group">
                        <label for="donation_type_send" class="form-label">Type de don</label>
                        <select id="donation_type_send" name="donation_type" class="form-select">
                            <option value="espece" {{ $user->donation_type === 'espece' ? 'selected' : '' }}>En espèces</option>
                            <option value="nature" {{ $user->donation_type === 'nature' ? 'selected' : '' }}>En nature</option>
                        </select>
                    </div>

                    <div id="send-donation-espece" class="send-donation-section">
                        <div class="form-group">
                            <label for="payment_method" class="form-label">Mode de paiement</label>
                            <select id="payment_method" name="payment_method" class="form-select">
                                <option value="mobile_money">Mobile Money</option>
                                <option value="carte_bancaire">Carte bancaire</option>
                                <option value="cash">Cash / espèces</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="receipt_file_espece" class="form-label">Reçu de paiement (image, optionnel)</label>
                            <input type="file" id="receipt_file_espece" name="receipt_file_espece" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="details_espece" class="form-label">Détails du don (montant, date, référence...)</label>
                            <textarea id="details_espece" name="details_espece" rows="3" class="form-control"></textarea>
                        </div>
                    </div>

                    <div id="send-donation-nature" class="send-donation-section" style="display:none;">
                        <div class="form-group">
                            <label for="receipt_file_nature" class="form-label">Capture du reçu / preuve de don</label>
                            <input type="file" id="receipt_file_nature" name="receipt_file_nature" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="details_nature" class="form-label">Détails du don en nature</label>
                            <textarea id="details_nature" name="details_nature" rows="3" class="form-control" placeholder="Décrivez les biens, quantités, date de remise, etc."></textarea>
                        </div>
                    </div>
                </div>

                <div class="ul-donation-details-form-bottom" style="margin-top: 12px;">
                    <button type="submit" class="ul-btn">
                        <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                        <span>Envoyer</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL SUPPRESSION DE COMPTE -->
    <div id="donor-delete-account-modal" class="ul-modal">
        <div class="ul-modal-content">
            <button type="button" id="donor-delete-account-modal-close">&times;</button>
            <div class="modal-header-content">
                <h2>Supprimer mon compte</h2>
                <p>Confirmez votre mot de passe pour supprimer définitivement votre compte. Cette action ne peut pas être annulée.</p>
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}" class="ul-donation-details-form">
                @csrf
                @method('DELETE')

                <div class="ul-donation-details-personal-info-form">
                    <div class="form-group">
                        <label for="delete_password" class="form-label">Mot de passe</label>
                        <input id="delete_password" type="password" name="password" required autocomplete="current-password">
                        @error('userDeletion.password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="ul-donation-details-form-bottom" style="margin-top: 12px;">
                    <button type="submit" class="ul-btn" style="background:#dc2626; border-color:#dc2626;">
                        <i class="flaticon-close"></i>
                        <span>Confirmer la suppression</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

