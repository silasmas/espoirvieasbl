@extends('layouts.public')

@section('title', 'Mes dons - Espoir Vie ASBL')

@section('content')
    <x-breadcrumb
        title="Mes dons"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['route' => 'monProfil', 'label' => 'Mon profil'],
            ['label' => 'Mes dons'],
        ]"
    />

    <section class="ul-section-spacing">
        <div class="ul-container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ul-donor-card">
                        <h2 class="ul-donor-card-title">Historique de mes dons</h2>
                        <p class="ul-donor-card-subtitle">
                            Cette section affichera prochainement le détail de tous vos dons effectués via la plateforme.
                        </p>

                        <div class="ul-donor-empty">
                            <i class="flaticon-donation"></i>
                            <h3>Aucun don enregistré pour le moment</h3>
                            <p>
                                Dès que vous effectuerez un don, vous retrouverez ici le montant, la date et le projet soutenu.
                            </p>

                            <a href="{{ route('donate') }}" class="ul-btn">
                                <i class="flaticon-right-arrow"></i>
                                <span>Faire mon premier don</span>
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
@endsection

