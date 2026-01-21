@extends('layouts.public')

@section('title', 'Événements - Espoir Vie ASBL')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <x-breadcrumb
        title="Nos événements"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Événements']
        ]"
    />
    <!-- EVENTS SECTION START -->
    <section class="ul-section-spacing">
        <div class="ul-container">
            <!-- Affichage des filtres actifs -->
            @if(request('search') || request('category') || request('tag'))
            <div class="ul-events-filters-active" style="margin-bottom: 30px; padding: 15px; background: #f0f9ff; border-radius: 8px; border-left: 4px solid #0172b8;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <strong style="color: #0172b8;">Filtres actifs :</strong>
                        @if(request('search'))
                        <span style="display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; background: white; border-radius: 20px; font-size: 14px;">
                            Recherche : "{{ request('search') }}"
                            <a href="{{ route('events', array_merge(request()->except('search'), ['page' => 1])) }}" style="color: #666; text-decoration: none; margin-left: 5px;">&times;</a>
                        </span>
                        @endif
                        @if(request('category'))
                        <span style="display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; background: white; border-radius: 20px; font-size: 14px;">
                            Catégorie : {{ request('category') }}
                            <a href="{{ route('events', array_merge(request()->except('category'), ['page' => 1])) }}" style="color: #666; text-decoration: none; margin-left: 5px;">&times;</a>
                        </span>
                        @endif
                        @if(request('tag'))
                        <span style="display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; background: white; border-radius: 20px; font-size: 14px;">
                            Tag : {{ request('tag') }}
                            <a href="{{ route('events', array_merge(request()->except('tag'), ['page' => 1])) }}" style="color: #666; text-decoration: none; margin-left: 5px;">&times;</a>
                        </span>
                        @endif
                    </div>
                    <a href="{{ route('events') }}" class="ul-btn" style="padding: 8px 20px; font-size: 14px;">
                        <i class="flaticon-back"></i> Réinitialiser
                    </a>
                </div>
            </div>
            @endif

            <!-- Résultats de recherche -->
            @if(request('search') || request('category') || request('tag'))
            <div style="margin-bottom: 20px; color: #666;">
                <strong>{{ $events->total() }}</strong> événement{{ $events->total() > 1 ? 's' : '' }} trouvé{{ $events->total() > 1 ? 's' : '' }}
            </div>
            @endif

            <!-- events -->
            <div class="ul-events-wrapper">
                @if($events->count() > 0)
                <div class="row ul-bs-row row-cols-lg-2 row-cols-1">
                    @foreach($events as $event)
                    <!-- single event -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-event ul-event--inner">
                            <div class="ul-event-img">
                                @if($event->image)
                                    <img src="{{ activity_image_url($event->image) }}" alt="{{ $event->title }}">
                                @else
                                    <img src="{{ asset('assets/img/event-img.jpg') }}" alt="{{ $event->title }}">
                                @endif
                                @php
                                    $eventDate = \Carbon\Carbon::parse($event->start_date);
                                    $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                                @endphp
                                <span class="date">{{ $eventDate->format('d') }} <span>{{ $months[$eventDate->month - 1] }}</span></span>
                            </div>
                            <div class="ul-event-txt">
                                <h3 class="ul-event-title">
                                    <a href="{{ route('events.show', $event) }}">{{ $event->title }}</a>
                                </h3>
                                <p class="ul-event-descr">{{ Str::limit($event->short_description ?? $event->description ?? 'Découvrez cet événement', 100) }}</p>
                                <div class="ul-event-info">
                                    <span class="ul-event-info-title">Lieu</span>
                                    <p class="ul-event-info-descr">
                                        @if($event->location)
                                            {{ $event->location }}
                                            @if($event->country)
                                                , {{ $event->country }}
                                            @endif
                                        @else
                                            À déterminer
                                        @endif
                                    </p>
                                </div>
                                @if($event->status === 'planned')
                                    <span class="badge" style="display: inline-block; background: #3b82f6; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; margin-bottom: 10px;">À venir</span>
                                @elseif($event->status === 'ongoing')
                                    <span class="badge" style="display: inline-block; background: #10b981; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; margin-bottom: 10px;">En cours</span>
                                @elseif($event->status === 'completed')
                                    <span class="badge" style="display: inline-block; background: #6b7280; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; margin-bottom: 10px;">Terminé</span>
                                @endif
                                @if($event->amount_raised && $event->amount_raised > 0)
                                    <p style="font-size: 14px; color: #666; margin-bottom: 10px;">
                                        <strong>Collecté :</strong> {{ number_format($event->amount_raised, 0, ',', ' ') }} €
                                    </p>
                                @endif
                                <a href="{{ route('events.show', $event) }}" class="ul-btn">
                                    <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Détails de l'événement
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center" style="padding: 60px 20px;">
                    @if(request('search') || request('category') || request('tag'))
                        <p style="font-size: 18px; color: #666;">Aucun événement ne correspond à vos critères de recherche.</p>
                        <a href="{{ route('events') }}" class="ul-btn" style="margin-top: 20px;">
                            <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Voir tous les événements
                        </a>
                    @else
                        <p style="font-size: 18px; color: #666;">Aucun événement disponible pour le moment.</p>
                        <a href="{{ route('home') }}" class="ul-btn" style="margin-top: 20px;">
                            <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Retour à l'accueil
                        </a>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <!-- pagination -->
        @if($events->hasPages())
            {{ $events->links('pagination.custom') }}
        @endif
    </section>
    <!-- EVENTS SECTION END -->
@endsection
