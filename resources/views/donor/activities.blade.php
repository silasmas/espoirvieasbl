@extends('layouts.public')

@section('title', 'Activités - Espoir Vie ASBL')

@section('content')
    <x-breadcrumb
        title="Mes activités"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['route' => 'monProfil', 'label' => 'Mon profil'],
            ['label' => 'Activités'],
        ]"
    />

    <section class="ul-section-spacing">
        <div class="ul-container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ul-donor-card">
                        <h2 class="ul-donor-card-title">Activités soutenues</h2>
                        <p class="ul-donor-card-subtitle">
                            Bientôt, vous pourrez suivre ici les projets et activités que vous avez contribué à financer.
                        </p>

                        <div class="ul-donor-empty">
                            <i class="flaticon-calendar"></i>
                            <h3>Aucune activité liée pour l’instant</h3>
                            <p>
                                Lorsque vos dons seront associés à des projets précis, vous verrez ici leur avancement et les rapports correspondants.
                            </p>
                            <a href="{{ route('events') }}" class="ul-btn">
                                <i class="flaticon-right-arrow"></i>
                                <span>Découvrir nos événements</span>
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

