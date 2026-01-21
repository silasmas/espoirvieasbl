@extends('layouts.public')

@section('title', $activity->title . ' - Espoir Vie ASBL')

@section('content')


    <x-breadcrumb
        title="Détail de l'événement"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['route' => 'events', 'label' => 'Événements'],
            ['label' => Str::limit($activity->title, 30)]
        ]"
    />

    <div class="ul-container ul-section-spacing">
        <div class="row gx-0 gy-4 flex-column-reverse flex-lg-row">
            <!-- left sidebar -->
            <div class="col-lg-4">
                <div class="ul-inner-sidebar">
                    <!-- single widget /search -->
                    <div class="ul-inner-sidebar-widget ul-inner-sidebar-search">
                        <h3 class="ul-inner-sidebar-widget-title">Rechercher</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <form action="{{ route('events') }}" method="GET" class="ul-blog-search-form">
                                <input type="search" name="search" id="ul-blog-search" placeholder="Rechercher un événement" value="{{ request('search') }}">
                                <button type="submit"><span class="icon"><i class="flaticon-search"></i></span></button>
                            </form>
                        </div>
                    </div>

                    <!-- single widget / Categories -->
                    @if($categories->count() > 0)
                    <div class="ul-inner-sidebar-widget categories">
                        <h3 class="ul-inner-sidebar-widget-title">Catégories</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <div class="ul-inner-sidebar-categories">
                                @foreach($categories as $category)
                                <a href="{{ route('events', ['category' => $category->category]) }}">
                                    {{ $category->category }} <span>({{ $category->count }})</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- single widget / Recent Posts -->
                    @if($recentEvents->count() > 0)
                    <div class="ul-inner-sidebar-widget posts">
                        <h3 class="ul-inner-sidebar-widget-title">Événements récents</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <div class="ul-inner-sidebar-posts">
                                @foreach($recentEvents as $recentEvent)
                                <!-- single post -->
                                <div class="ul-inner-sidebar-post">
                                    <div class="img">
                                        @if($recentEvent->image)
                                            <img src="{{ activity_image_url($recentEvent->image) }}" alt="{{ $recentEvent->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/blog-2.jpg') }}" alt="{{ $recentEvent->title }}">
                                        @endif
                                    </div>
                                    <div class="txt">
                                        <h4 class="title">
                                            <a href="{{ route('events.show', $recentEvent) }}">{{ Str::limit($recentEvent->title, 50) }}</a>
                                        </h4>
                                        <span class="date">
                                            <span>{{ \Carbon\Carbon::parse($recentEvent->start_date)->format('d M, Y') }}</span>
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- single widget / Tags -->
                    @if($allTags->count() > 0)
                    <div class="ul-inner-sidebar-widget tags">
                        <h3 class="ul-inner-sidebar-widget-title">Nuage de tags</h3>
                        <div class="ul-inner-sidebar-widget-content">
                            <div class="ul-inner-sidebar-tags">
                                @foreach($allTags as $tag)
                                <a href="{{ route('events', ['tag' => $tag]) }}">{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- event details content -->
            <div class="col-lg-8">
                <div class="ul-event-details ul-donation-details">
                    @if($activity->image)
                    <div class="ul-event-details-img">
                        <img src="{{ activity_image_url($activity->image) }}" alt="{{ $activity->title }}">
                    </div>
                    @endif
                    <div class="ul-event-details-infos">
                        <!-- single info -->
                        <div class="ul-event-details-info">
                            <span class="icon"><i class="flaticon-account"></i></span>
                            <span class="text">Par l'équipe</span>
                        </div>
                        @if($activity->category)
                        <!-- single info -->
                        <div class="ul-event-details-info">
                            <span class="icon"><i class="flaticon-price-tag"></i></span>
                            <span class="text">{{ $activity->category }}</span>
                        </div>
                        @endif
                    </div>
                    <h2 class="ul-event-details-title">{{ $activity->title }}</h2>
                    @if($activity->short_description)
                    <p class="ul-event-details-descr">{{ $activity->short_description }}</p>
                    @endif
                    @if($activity->description)
                    <div class="ul-event-details-descr">
                        {!! nl2br(e($activity->description)) !!}
                    </div>
                    @endif

                    @if($activity->impact)
                    <h3 class="ul-event-details-inner-title">Notre mission pour cet événement</h3>
                    <div class="ul-event-details-descr">
                        {!! nl2br(e($activity->impact)) !!}
                    </div>
                    @endif

                    @if($activity->results)
                    <h3 class="ul-event-details-inner-title">Résultats</h3>
                    <div class="ul-event-details-descr">
                        {!! nl2br(e($activity->results)) !!}
                    </div>
                    @endif

                    @if($activity->location)
                    <h3 class="ul-event-inner-title">Notre localisation</h3>
                    <div class="ul-event-details-map">
                        @php
                            $locationQuery = urlencode($activity->location . ($activity->country ? ', ' . $activity->country : ''));
                        @endphp
                        <iframe
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dPWTgaQZ1jR0gE&q={{ $locationQuery }}"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            style="width: 100%; height: 400px; border: 0;">
                        </iframe>
                    </div>
                    @endif

                    <h3 class="ul-event-inner-title">Nous contacter</h3>
                    <p>Votre adresse email ne sera pas publiée. Les champs obligatoires sont marqués *</p>

                    <!-- Zone de notification -->
                    <div id="event-contact-notification" class="async-notification" style="display: none; margin-bottom: 20px;"></div>

                    <form action="{{ route('contact.store') }}" method="POST" class="ul-contact-form ul-form" id="event-contact-form">
                        @csrf
                        <input type="hidden" name="subject" value="Question concernant : {{ $activity->title }}">
                        <div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="name" id="event-contact-name" placeholder="Votre nom *" required>
                                    <span class="error-message" id="error-event-name"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="email" name="email" id="event-contact-email" placeholder="Adresse email *" required>
                                    <span class="error-message" id="error-event-email"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="message" id="event-contact-msg" placeholder="Tapez votre message *" required></textarea>
                                    <span class="error-message" id="error-event-message"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" id="event-contact-submit-btn" class="ul-btn">
                                    <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                                    <span id="event-btn-text">Envoyer le message</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
