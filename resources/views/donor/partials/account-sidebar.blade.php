<aside class="ul-donor-aside">
    <div class="ul-donor-aside-card">
        <h3>Navigation rapide</h3>
        <ul>
            <li><a href="{{ route('monProfil') }}" class="{{ request()->routeIs('monProfil') ? 'active' : '' }}">Mon profil</a></li>
            <li><a href="{{ route('donor.donations') }}" class="{{ request()->routeIs('donor.donations') ? 'active' : '' }}">Mes dons</a></li>
            <li><a href="{{ route('donor.activities') }}" class="{{ request()->routeIs('donor.activities') ? 'active' : '' }}">Activités</a></li>
            <li><a href="javascript:void(0);" id="donor-password-link">Modifier mon mot de passe</a></li>
        </ul>
    </div>

    <div class="ul-donor-aside-card ul-donor-highlight">
        <h3>Merci pour votre engagement</h3>
        <p>
            Votre soutien permet à Espoir Vie ASBL de mener des actions concrètes sur le terrain.
        </p>
        <a href="{{ route('donate') }}" class="ul-btn">
            <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don
        </a>
    </div>

    <div class="ul-donor-aside-card ul-donor-highlight-secondary">
        <h3>Envoyer mon don</h3>
        <p>
            Finalisez votre don en nous envoyant les détails et, si nécessaire, le reçu correspondant.
        </p>
        <a href="javascript:void(0);" id="donor-send-donation-btn" class="ul-btn">
            <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Envoyer mon don
        </a>
    </div>

    <div class="ul-donor-aside-card ul-donor-danger">
        <h3>Supprimer mon compte</h3>
        <p>
            Cette action est irréversible. Toutes vos informations de compte seront définitivement supprimées.
        </p>
        <a href="javascript:void(0);" id="donor-delete-account-btn" class="ul-btn ul-btn-light">
            <i class="flaticon-close"></i> Supprimer mon compte
        </a>
    </div>
</aside>

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
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Nouveau mot de passe</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
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
@php
    /** @var \App\Models\User $user */
    $profileDonationType = $user->donation_type;
@endphp
<div id="donor-send-donation-modal" class="ul-modal">
    <div class="ul-modal-content">
        <button type="button" id="donor-send-donation-modal-close">&times;</button>
        <div class="modal-header-content">
            <h2>Envoyer mon don</h2>
            @if($profileDonationType === 'nature')
                <p>Joignez la capture de votre reçu ou de la remise en nature, ainsi qu'une description détaillée.</p>
            @elseif($profileDonationType === 'espece')
                <p>Indiquez le mode de paiement utilisé et joignez, si possible, le reçu de paiement.</p>
            @else
                <p>Précisez ci-dessous les détails de votre don et, si possible, joignez un reçu.</p>
            @endif
        </div>

        <form method="POST" action="{{ route('donor.sendDonation') }}" class="ul-donation-details-form" enctype="multipart/form-data">
            @csrf

            <div class="ul-donation-details-personal-info-form">
                @if($profileDonationType === 'espece' || $profileDonationType === 'nature')
                    <input type="hidden" name="donation_type" value="{{ $profileDonationType }}">
                    <p style="font-size:13px; margin-bottom:12px;">
                        Type de don enregistré dans votre profil :
                        <strong>{{ $profileDonationType === 'espece' ? 'En espèces' : 'En nature' }}</strong>
                    </p>
                @else
                    <div class="form-group">
                        <label for="donation_type_send" class="form-label">Type de don</label>
                        <select id="donation_type_send" name="donation_type" class="form-select">
                            <option value="espece">En espèces</option>
                            <option value="nature">En nature</option>
                        </select>
                    </div>
                @endif

                @php
                    $showEspece = $profileDonationType === 'espece';
                    $showNature = $profileDonationType === 'nature';
                @endphp

                <div id="send-donation-espece" class="send-donation-section" @if($profileDonationType === 'nature') style="display:none;" @endif>
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

                <div id="send-donation-nature" class="send-donation-section" @if($profileDonationType === 'espece') style="display:none;" @endif>
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

