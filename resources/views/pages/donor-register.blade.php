@extends('layouts.public')

@section('title', 'Devenir membre - Espoir Vie ASBL')

@section('content')

    <x-breadcrumb
        title="Devenir membre"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Devenir membre']
        ]"
    />

<section class="ul-section-spacing">
    <div class="ul-section-heading justify-content-center text-center">
        <div>
            <span class="ul-section-sub-title">Devenir membre</span>
            <h2 class="ul-section-title">Créez votre compte donateur</h2>
            <p class="mt-3">Suivez vos dons, consultez vos reçus et vos rapports d'activités.</p>
        </div>
    </div>

    <div class="ul-container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="ul-auth-card ul-auth-card-wide">
                    <form action="{{ route('donor.register') }}" method="POST" class="ul-donation-details-form" autocomplete="off">
                        @csrf
                        <div class="ul-donation-details-personal-info">
                            @if($errors->any())
                                <div class="async-notification error" style="display:block; margin-bottom:20px;">
                                    @foreach($errors->all() as $msg)
                                        <div>{{ $msg }}</div>
                                    @endforeach
                                </div>
                            @endif
                            @if(session('donor_registered'))
                                <div class="async-notification success" style="display:block; margin-bottom:20px;">
                                    {{ session('donor_registered_message') }}
                                </div>
                            @endif
                            <div class="ul-donation-details-personal-info-form">
                                <div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nom complet *" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Adresse email *" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select name="country" id="donor-country-select" required class="form-select">
                                                <option value="">Rechercher un pays *</option>
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
                                                    <option value="{{ $country }}" {{ old('country') === $country ? 'selected' : '' }}>{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Numéro de téléphone *" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label style="font-size: 14px; color:#64748b; margin-bottom:8px; display:block;">Date de début du don *</label>
                                            <input type="text" name="donation_period" id="donor-donation-period" value="{{ old('donation_period') }}" placeholder="Choisir une date" required readonly class="form-control flatpickr-date">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select name="donation_type" id="donor-donation-type" required class="form-select">
                                                <option value="">Type de don *</option>
                                                <option value="espece" {{ old('donation_type') === 'espece' ? 'selected' : '' }}>En espèces (argent)</option>
                                                <option value="nature" {{ old('donation_type') === 'nature' ? 'selected' : '' }}>En nature (biens matériels / autres)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12" id="donor-amount-group">
                                        <div class="form-group">
                                            <div style="display:flex; gap:12px; align-items:center; flex-wrap: wrap;">
                                                <select name="donation_currency" class="form-select" style="max-width:120px;">
                                                    <option value="USD" {{ old('donation_currency') === 'USD' ? 'selected' : '' }}>USD</option>
                                                    <option value="CDF" {{ old('donation_currency') === 'CDF' ? 'selected' : '' }}>CDF</option>
                                                </select>
                                                <input type="number" name="donation_amount" value="{{ old('donation_amount') }}" min="1" step="0.01" placeholder="Montant à donner *" class="form-control" style="flex:1; min-width:140px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" id="donor-nature-group" style="display:none;">
                                        <div class="form-group">
                                            <textarea name="donation_nature_description" rows="3" placeholder="Précisez votre don en nature (biens, matériel, services...)" class="form-control">{{ old('donation_nature_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ul-donation-details-form-bottom" style="margin-top: 28px;">
                                <button type="submit" class="ul-auth-btn">
                                    <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                                    <span>Créer mon compte donateur</span>
                                </button>
                                <p class="ul-auth-hint">
                                    Vous recevrez un email avec un mot de passe provisoire et un lien de connexion.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var donorTypeSelect = document.getElementById('donor-donation-type');
    var donorAmountGroup = document.getElementById('donor-amount-group');
    var donorNatureGroup = document.getElementById('donor-nature-group');
    function updateDonorTypeFields() {
        if (!donorTypeSelect || !donorAmountGroup || !donorNatureGroup) return;
        var value = donorTypeSelect.value;
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

    if (typeof SlimSelect !== 'undefined') {
        new SlimSelect({
            select: '#donor-country-select',
            settings: {
                showSearch: true,
                searchPlaceholder: 'Rechercher un pays...',
                searchText: 'Aucun résultat',
                searchingText: 'Recherche...'
            }
        });
    }

    if (typeof flatpickr !== 'undefined') {
        flatpickr('#donor-donation-period', {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd/m/Y',
            allowInput: false,
            disableMobile: false
        });
    }
});
</script>
@endsection
