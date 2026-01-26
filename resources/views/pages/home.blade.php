@extends('layouts.public')

@section('title', 'Accueil - Espoir Vie ASBL')

@section('content')
    <!-- BANNER SECTION START -->
    <section class="ul-banner">
        <div class="ul-banner-container">
            <div class="row gy-4 row-cols-lg-2 row-cols-1 align-items-center flex-column-reverse flex-lg-row">
                <!-- banner text -->
                <div class="col">
                    <div class="ul-banner-txt">
                        <div class="wow animate__fadeInUp">
                            <span class="ul-banner-sub-title ul-section-sub-title">Changeons le monde ensemble</span>
                            <h1 class="ul-banner-title">Pour les personnes et les causes qui vous tiennent à cœur</h1>
                            <p class="ul-banner-descr">Rejoignez-nous dans notre mission pour créer un impact positif et durable dans la vie de nombreuses personnes. Ensemble, nous pouvons faire la différence.</p>
                            <div class="ul-banner-btns">
                                <a href="{{ route('donate') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don</a>

                                <div class="ul-banner-stat">
                                    <div class="imgs">
                                        <img src="{{ asset('assets/img/1.jpg.jpeg') }}" alt="Personne">
                                        <img src="{{ asset('assets/img/2.jpg.jpeg') }}" alt="Personne">
                                        <img src="{{ asset('assets/img/3.jpg.jpeg') }}" alt="Personne">
                                        <span class="number">2.M</span>
                                    </div>
                                    <span class="txt">Donateurs actifs</span>
                                </div>
                            </div>
                        </div>

                        <img src="{{ asset('assets/img/vector-img.png') }}" alt="Vecteur" class="ul-banner-txt-vector">
                    </div>
                </div>

                <!-- img -->
                <div class="col align-self-start">
                    <div class="ul-banner-img">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/img/960x1000-.jpg.jpeg') }}" alt="Image de la bannière">
                            <!-- <div class="ul-banner-video-btn">
                                <a href=""></a>
                            </div> -->
                        </div>
                        <div class="ul-banner-img-vectors">
                            <img src="{{ asset('assets/img/banner-img-vector-1.png') }}" alt="vecteur" class="vector-1 wow animate__fadeInRight">
                            <img src="{{ asset('assets/img/banner-img-vector-2.png') }}" alt="vecteur" class="vector-2 wow animate__fadeInDown">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BANNER SECTION END -->


    <!-- ABOUT SECTION START -->
    <section class="ul-about ul-section-spacing wow animate__fadeInUp">
        <div class="ul-container">
            <div class="row row-cols-md-2 row-cols-1 align-items-center gy-4 ul-about-row">
                <div class="col">
                    <div class="ul-about-imgs">
                        <div class="img-wrapper">
                            @if(isset($about) && $about->image)
                                <img src="{{ asset('storage/' . $about->image) }}" alt="Image à propos">
                            @else
                                <img src="{{ asset('assets/img/690x612.jpg.jpeg') }}" alt="Image à propos par défaut">
                            @endif
                        </div>
                        <div class="ul-about-imgs-vectors">
                            <img src="{{ asset('assets/img/about-img-vector-1.svg') }}" alt="Illustration" class="vector-1">
                            <img src="{{ asset('assets/img/about-img-vector-2.svg') }}" alt="Illustration" class="vector-2">
                        </div>
                    </div>
                </div>

                <!-- txt -->
                <div class="col">
                    <div class="ul-about-txt">
                        <span class="ul-section-sub-title ul-section-sub-title--2">
                            {{ isset($about) && $about->subtitle ? $about->subtitle : 'À propos de nous' }}
                        </span>
                        <h2 class="ul-section-title">
                            {{ isset($about) && $about->title ? $about->title : "S'entraider peut rendre le monde meilleur" }}
                        </h2>
                        <p class="ul-section-descr">
                            {{ isset($about) && $about->description ? $about->description : "Espoir Vie ASBL est une organisation dédiée à améliorer les conditions de vie des personnes dans le besoin. Nous croyons que chaque individu mérite une chance de vivre dans la dignité avec espoir en l'avenir. Rejoignez-nous pour créer un impact durable." }}
                        </p>

                        <div class="ul-about-block">
                            <div class="block-left">
                                <div class="block-heading">
                                    <div class="icon"><i class="flaticon-love"></i></div>
                                    <h3 class="block-title">
                                        {{ isset($about) && $about->block_title ? $about->block_title : "Rejoignez notre équipe" }}
                                    </h3>
                                </div>
                                <ul class="block-list">
                                    @if(isset($about) && $about->block_list)
                                        @foreach($about->block_list as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    @else
                                        <li>De nombreuses façons d'aider et de faire la différence</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="block-right">
                                @if(isset($about) && $about->block_image)
                                    <img src="{{ asset('storage/' . $about->block_image) }}" alt="Illustration à propos">
                                @else
                                    <img src="{{ asset('assets/img/330x73-equipe.jpg.jpeg') }}" alt="Illustration à propos par défaut">
                                @endif
                            </div>
                        </div>

                        <div class="ul-about-bottom">
                            <a href="{{ route('about') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> En savoir plus</a>

                            <div class="ul-about-call">
                                <div class="icon"><i class="flaticon-telephone-call"></i></div>
                                <div class="txt">
                                    <span class="call-title">
                                        {{ isset($about) && $about->call_title ? $about->call_title : 'Appelez-nous à tout moment' }}
                                    </span>
                                    <a href="tel:{{ isset($about) && $about->call_phone ? $about->call_phone : '+612345678990' }}">
                                        {{ isset($about) && $about->call_phone ? $about->call_phone : '+61 2345 678 990' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- vector -->
        <div class="ul-about-vectors">
            <img src="{{ asset('assets/img/about-vector-1.png') }}" alt="vecteur" class="vector-1">
        </div>
    </section>
    <!-- ABOUT SECTION END -->


    <!-- DONTATIONS SECTION START -->
    <section class="ul-donations ul-section-spacing overflow-hidden">
        <!-- heading -->
        <div class="ul-container">
            <div class="ul-section-heading ul-donations-heading justify-content-between text-center">
                <div class="left">
                    <span class="ul-section-sub-title"><span class="txt">Aidez-nous et faites un don</span></span>
                    <h2 class="ul-section-title">Inspirer et aider pour un meilleur style de vie</h2>
                </div>

                <div class="flex-shrink-0">
                    <div class="ul-banner-stat">
                        <div class="imgs">
                            <img src="{{ asset('assets/img/user-1.png') }}" alt="Personne">
                            <img src="{{ asset('assets/img/user-3.png') }}" alt="Personne">
                            <img src="{{ asset('assets/img/user-2.png') }}" alt="Personne">
                            <span class="number">2.M</span>
                        </div>
                        <span class="txt text-white">Donateurs actifs</span>
                    </div>
                </div>
                <div class="ul-slider-nav ul-donations-slider-nav">
                    <button class="prev"><i class="flaticon-back"></i></button>
                    <button class="next"><i class="flaticon-next"></i></button>
                </div>
            </div>
        </div>

        <!-- DONTATIONS slider -->
        <div class="ul-container wow animate__fadeInUp">
            <div class="ul-donations-slider swiper overflow-visible">
                <div class="swiper-wrapper">
                    @if($donationActivities && $donationActivities->count() > 0)
                        @foreach($donationActivities as $activity)
                            <div class="swiper-slide">
                                <div class="ul-donation">
                                    <div class="ul-donation-img">
                                        @if($activity->image)
                                            <img src="{{ activity_image_url($activity->image) }}" alt="{{ $activity->title }}" style="width: 282px; height: 188px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/img/donation-1.jpg') }}" alt="{{ $activity->title }}" style="width: 282px; height: 188px; object-fit: cover;">
                                        @endif
                                        @if($activity->category)
                                            <span class="tag">{{ $activity->category }}</span>
                                        @endif
                                    </div>
                                    <div class="ul-donation-txt">
                                        @if($activity->budget > 0)
                                            @php
                                                $progressPercentage = min(100, (($activity->amount_raised ?? 0) / $activity->budget) * 100);
                                            @endphp
                                            <div class="ul-donation-progress">
                                                <div class="donation-progress-container ul-progress-container">
                                                    <div class="donation-progressbar ul-progressbar" data-ul-progress-value="{{ round($progressPercentage) }}">
                                                        <div class="donation-progress-label ul-progress-label"></div>
                                                    </div>
                                                </div>
                                                <div class="ul-donation-progress-labels">
                                                    <span class="ul-donation-progress-label">Collecté : {{ number_format($activity->amount_raised ?? 0, 0, ',', ' ') }} €</span>
                                                    <span class="ul-donation-progress-label">Objectif : {{ number_format($activity->budget, 0, ',', ' ') }} €</span>
                                                </div>
                                            </div>
                                        @endif
                                        <a href="{{ route('donate.detail', $activity) }}" class="ul-donation-title">{{ $activity->title }}</a>
                                        <p class="ul-donation-descr">{{ Str::limit($activity->short_description ?? $activity->description ?? 'Aidez-nous à réaliser ce projet', 100) }}</p>
                                        <a href="{{ route('donate.detail', $activity) }}" class="ul-donation-btn">Faire un don <i class="flaticon-up-right-arrow"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="swiper-slide">
                            <div class="ul-donation">
                                <div class="ul-donation-img">
                                    <img src="{{ asset('assets/img/donation-1.jpg') }}" alt="Image du don" style="width: 282px; height: 188px; object-fit: cover;">
                                    <span class="tag">Aucun projet</span>
                                </div>
                                <div class="ul-donation-txt">
                                    <p class="ul-donation-descr">Aucun projet de dons disponible pour le moment. Revenez bientôt !</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="ul-dontations-slider-pagination d-none"></div>
            </div>
        </div>
    </section>
    <!-- DONTATIONS SECTION END -->


    <!-- DONATE SECTION START -->
    <div class="ul-section-spacing">
        <div class="ul-container">
            <div class="ul-donate-form-section">
                <div class="row justify-content-between align-items-center">
                    <!-- donate form -->
                    <div class="col-lg-6 position-relative">
                        <div class="ul-donate-form-wrapper">
                            <h3 class="ul-donate-form-title">Faire un don personnalisé</h3>
                            <form action="#" class="ul-donate-form">
                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-1" checked hidden>
                                    <label for="donate-amount-1" class="ul-donate-form-label">10 €</label>
                                </div>

                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-2" hidden>
                                    <label for="donate-amount-2" class="ul-donate-form-label">20 €</label>
                                </div>

                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-3" hidden>
                                    <label for="donate-amount-3" class="ul-donate-form-label">30 €</label>
                                </div>

                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-4" hidden>
                                    <label for="donate-amount-4" class="ul-donate-form-label">40 €</label>
                                </div>

                                <div>
                                    <input type="radio" name="donate-amount" id="donate-amount-5" hidden>
                                    <label for="donate-amount-5" class="ul-donate-form-label">50 €</label>
                                </div>

                                <div class="custom-amount-wrapper">
                                    <input type="radio" name="donate-amount" id="custom-amount">
                                    <label for="donate-amount-custom" class="ul-donate-form-label">
                                        <input type="number" name="custom-amount" id="donate-amount-custom" placeholder="Montant personnalisé" class="ul-donate-form-custom-input">
                                    </label>
                                </div>

                                <div>
                                    <button type="submit" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don maintenant</button>
                                </div>
                            </form>
                        </div>
                        <img src="{{ asset('assets/img/donate-form-vector.svg') }}" alt="vecteur" class="ul-donate-form-vector">
                    </div>

                    <!-- donate form  -->
                    <div class="col-xl-5 col-lg-6">
                        <div class="ul-donate-form-section-txt">
                            <span class="ul-section-sub-title text-white">Faire un don maintenant</span>
                            <h2 class="ul-section-title text-white">Soutenez les enfants en faisant un don précieux</h2>

                            <div class="ul-donation-progress">
                                <div class="donation-progress-container ul-progress-container">
                                    <div class="donation-progressbar ul-progressbar" data-ul-progress-value="64">
                                        <div class="donation-progress-label ul-progress-label"></div>
                                    </div>
                                </div>
                                <div class="ul-donation-progress-labels">
                                    <span class="ul-donation-progress-label">Collecté : 25 000 €</span>
                                    <span class="ul-donation-progress-label">Objectif : 30 000 €</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- DONATE SECTION END -->


    <!-- STATS SECTION START -->
    <div class="ul-stats ul-section-spacing">
        <div class="ul-container">
            <div class="ul-stats-wrapper wow animate__fadeInUp">
                <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-bs-row justify-content-center">
                    <div class="col">
                        <div class="ul-stats-item">
                            <i class="flaticon-costumer"></i>
                            <span class="number">260+</span>
                            <span class="txt">Enfants aidés</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="ul-stats-item">
                            <i class="flaticon-team"></i>
                            <span class="number">110+</span>
                            <span class="txt">Nos bénévoles</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="ul-stats-item">
                            <i class="flaticon-package"></i>
                            <span class="number">190+</span>
                            <span class="txt">Projets et activités</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="ul-stats-item">
                            <i class="flaticon-relationship"></i>
                            <span class="number">560+</span>
                            <span class="txt">Donateurs dans le monde</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- STATS SECTION END -->


    <!-- EVENTS SECTION START -->
    <section class="ul-events ul-section-spacing pt-0">
        <div class="ul-container">
            <!-- heading -->
            <div class="ul-section-heading align-items-center wow animate__fadeInUp">
                <div class="left">
                    <span class="ul-section-sub-title">Événements à venir</span>
                    <h2 class="ul-section-title text-white">Calendrier des événements Espoir Vie</h2>
                </div>
                <a href="{{ route('events') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> En savoir plus</a>
            </div>

            <!-- events -->
            <div class="ul-events-wrapper">
                <div class="row ul-bs-row row-cols-lg-2 row-cols-1">
                    @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
                        @foreach($upcomingEvents as $event)
                            <div class="col wow animate__fadeInUp">
                                <div class="ul-event">
                                    <div class="ul-event-img">
                                        @if($event->image)
                                            <img src="{{ activity_image_url($event->image) }}" alt="{{ $event->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/img/event-img.jpg') }}" alt="{{ $event->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                                        @endif
                                        <span class="date">{{ $event->start_date->format('d') }} <span>{{ $event->start_date->translatedFormat('M') }}</span></span>
                                    </div>
                                    <div class="ul-event-txt">
                                        <h3 class="ul-event-title"><a href="{{ route('events.show', $event) }}">{{ $event->title }}</a></h3>
                                        <p class="ul-event-descr">{{ Str::limit($event->short_description ?? $event->description, 150) }}</p>
                                        <div class="ul-event-info">
                                            <span class="ul-event-info-title">Lieu</span>
                                            <p class="ul-event-info-descr">{{ $event->location ?? 'À déterminer' }}{{ $event->country ? ', ' . $event->country : '' }}</p>
                                        </div>
                                        <a href="{{ route('events.show', $event) }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Détails de l'événement</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Affichage par défaut si aucun événement -->
                        <div class="col wow animate__fadeInUp">
                            <div class="ul-event">
                                <div class="ul-event-img">
                                    <img src="{{ asset('assets/img/event-img.jpg') }}" alt="Aucun événement">
                                    <span class="date">-- <span>---</span></span>
                                </div>
                                <div class="ul-event-txt">
                                    <h3 class="ul-event-title"><a href="{{ route('events') }}">Aucun événement à venir</a></h3>
                                    <p class="ul-event-descr">Restez connecté ! De nouveaux événements seront bientôt annoncés. Consultez régulièrement notre calendrier.</p>
                                    <a href="{{ route('events') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Voir tous les événements</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <!-- vectors -->
        <div class="ul-events-vectors">
            <img src="{{ asset('assets/img/events-vector-1.png') }}" alt="Image des événements" class="vector-1">
            <img src="{{ asset('assets/img/events-vector-2.svg') }}" alt="Image des événements" class="vector-2">
        </div>
    </section>
    <!-- EVENTS SECTION END -->


    <!-- WHY JOIN SECTION START -->
    <section class="ul-why-join ul-section-spacing">
        <div class="ul-why-join-wrapper ul-section-spacing">
            <div class="ul-container">
                <div class="row row-cols-md-2 row-cols-1 gy-4 align-items-center">
                    <div class="col">
                        <div class="ul-why-join-img">
                            <img src="{{ asset('assets/img/660X632.jpg.jpeg') }}" alt="Image pourquoi nous rejoindre">
                        </div>
                    </div>

                    <!-- txt -->
                    <div class="col">
                        <div class="ul-why-join-txt">
                            <span class="ul-section-sub-title">Rejoignez-nous</span>
                            <h2 class="ul-section-title">Pourquoi avons-nous besoin de vous comme bénévole</h2>
                            <p class="ul-section-descr">Votre engagement fait la différence. Ensemble, nous développons des stratégies de responsabilité sociale puissantes et créons un impact durable dans nos communautés.</p>

                            <div class="ul-accordion">
                                <div class="ul-single-accordion-item open">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title">Reconnaissance et accomplissement</h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-next"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>Rejoignez une équipe dédiée qui reconnaît et valorise votre contribution. Participez à des projets significatifs qui ont un impact réel sur la vie des personnes dans le besoin.</p>
                                    </div>
                                </div>

                                <div class="ul-single-accordion-item">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title">Pourquoi nous rejoindre comme bénévole ?</h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-next"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>Devenez bénévole pour développer vos compétences, rencontrer des personnes partageant les mêmes valeurs, et contribuer à des causes qui vous tiennent à cœur. Votre temps et votre énergie font toute la différence.</p>
                                    </div>
                                </div>

                                <div class="ul-single-accordion-item">
                                    <div class="ul-single-accordion-item__header">
                                        <div class="left">
                                            <h3 class="ul-single-accordion-item__title">Faire partie d'une communauté</h3>
                                        </div>
                                        <span class="icon"><i class="flaticon-next"></i></span>
                                    </div>

                                    <div class="ul-single-accordion-item__body">
                                        <p>Rejoignez une communauté de personnes engagées qui partagent votre passion pour aider les autres. Ensemble, nous créons un réseau de solidarité et d'entraide.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- WHY JOIN SECTION END -->


    <!-- TEAM SECTION START -->
    <section class="ul-team ul-section-spacing pt-0">
        <div class="ul-container">
            <!-- Heading -->
            <div class="ul-section-heading justify-content-between">
                <div class="left">
                    <span class="ul-section-sub-title">Notre équipe</span>
                    <h2 class="ul-section-title">Des professionnels dévoués à votre service</h2>
                </div>
                <div>
                    <a href="{{ route('team') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Voir toute l'équipe</a>
                </div>
            </div>

            <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-team-row justify-content-center">
                @if(isset($teamMembers) && $teamMembers->count() > 0)
                    @foreach($teamMembers as $index => $member)
                        <div class="col">
                            <div class="ul-team-member">
                                <div class="ul-team-member-img">
                                    @if($member->photo)
                                        @if(Str::startsWith($member->photo, ['http://', 'https://']))
                                            <img src="{{ $member->photo }}" alt="{{ $member->name }}">
                                        @else
                                            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/img/member-' . (($index % 4) + 1) . '.jpg') }}" alt="{{ $member->name }}">
                                    @endif
                                    @if($member->hasSocialLinks())
                                        <div class="ul-team-member-socials">
                                            @if($member->facebook_url)
                                                <a href="{{ $member->facebook_url }}" target="_blank" rel="noopener"><i class="flaticon-facebook"></i></a>
                                            @endif
                                            @if($member->twitter_url)
                                                <a href="{{ $member->twitter_url }}" target="_blank" rel="noopener"><i class="flaticon-twitter"></i></a>
                                            @endif
                                            @if($member->linkedin_url)
                                                <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener"><i class="flaticon-linkedin-big-logo"></i></a>
                                            @endif
                                            @if($member->instagram_url)
                                                <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener"><i class="flaticon-instagram"></i></a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="ul-team-member-info">
                                    <h3 class="ul-team-member-name"><a href="#">{{ $member->name }}</a></h3>
                                    <p class="ul-team-member-designation">{{ $member->position ?? 'Membre de l\'équipe' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Affichage par défaut si aucun membre -->
                    @for($i = 1; $i <= 4; $i++)
                        <div class="col">
                            <div class="ul-team-member">
                                <div class="ul-team-member-img">
                                    <img src="{{ asset('assets/img/member-' . $i . '.jpg') }}" alt="Membre de l'équipe">
                                    <div class="ul-team-member-socials">
                                        <a href="#"><i class="flaticon-facebook"></i></a>
                                        <a href="#"><i class="flaticon-twitter"></i></a>
                                        <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                                        <a href="#"><i class="flaticon-instagram"></i></a>
                                    </div>
                                </div>
                                <div class="ul-team-member-info">
                                    <h3 class="ul-team-member-name"><a href="#">Membre de l'équipe</a></h3>
                                    <p class="ul-team-member-designation">Bénévole</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
    <!-- TEAM SECTION END -->


    <!-- TESTIMONIAL SECTION START -->
    <section class="ul-testimonial ul-section-spacing">
        <div class="ul-testimonial-container">
            <div class="ul-section-heading text-center">
                <div>
                    <span class="ul-section-sub-title">Témoignages</span>
                    <h2 class="ul-section-title">Ce qu'ils disent d'Espoir Vie</h2>
                </div>
            </div>

            <div class="ul-testimonial-slider swiper">
                <div class="swiper-wrapper">
                    @if(isset($testimonials) && $testimonials->count() > 0)
                        @foreach($testimonials as $index => $testimonial)
                            <div class="swiper-slide">
                                <div class="ul-review">
                                    <div class="ul-review-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                                <i class="flaticon-star"></i>
                                            @else
                                                <i class="flaticon-star-1"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="ul-review-descr">{{ $testimonial->content }}</p>
                                    <div class="ul-review-bottom">
                                        <div class="ul-review-reviewer">
                                            <div class="reviewer-image">
                                                @if($testimonial->photo)
                                                    @if(Str::startsWith($testimonial->photo, ['http://', 'https://']))
                                                        <img src="{{ $testimonial->photo }}" alt="{{ $testimonial->name }}">
                                                    @else
                                                        <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('assets/img/member-' . (($index % 4) + 1) . '.jpg') }}" alt="{{ $testimonial->name }}">
                                                @endif
                                            </div>
                                            <div>
                                                <h3 class="reviewer-name">{{ $testimonial->name }}</h3>
                                                <span class="reviewer-role">{{ $testimonial->role ?? 'Membre' }}</span>
                                            </div>
                                        </div>

                                        <!-- icon -->
                                        <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Témoignages par défaut si aucun en DB -->
                        @php
                            $defaultTestimonials = [
                                ['name' => 'Marie Dupont', 'role' => 'Bénévole', 'content' => 'Espoir Vie ASBL a fait une différence incroyable dans ma vie et celle de ma famille. Leur dévouement et leur compassion sont vraiment remarquables.'],
                                ['name' => 'Pierre Dubois', 'role' => 'Donateur', 'content' => 'Merci à Espoir Vie ASBL pour leur engagement exceptionnel. Votre travail fait vraiment une différence dans notre communauté.'],
                                ['name' => 'Claire Bernard', 'role' => 'Partenaire', 'content' => 'Espoir Vie ASBL transforme des vies chaque jour. Leur transparence et leur dévouement sont exemplaires.'],
                            ];
                        @endphp
                        @foreach($defaultTestimonials as $index => $testimonial)
                            <div class="swiper-slide">
                                <div class="ul-review">
                                    <div class="ul-review-rating">
                                        <i class="flaticon-star"></i>
                                        <i class="flaticon-star"></i>
                                        <i class="flaticon-star"></i>
                                        <i class="flaticon-star"></i>
                                        <i class="flaticon-star-1"></i>
                                    </div>
                                    <p class="ul-review-descr">{{ $testimonial['content'] }}</p>
                                    <div class="ul-review-bottom">
                                        <div class="ul-review-reviewer">
                                            <div class="reviewer-image"><img src="{{ asset('assets/img/member-' . ($index + 1) . '.jpg') }}" alt="{{ $testimonial['name'] }}"></div>
                                            <div>
                                                <h3 class="reviewer-name">{{ $testimonial['name'] }}</h3>
                                                <span class="reviewer-role">{{ $testimonial['role'] }}</span>
                                            </div>
                                        </div>
                                        <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="ul-testimonial-slider-pagination"></div>
            </div>
        </div>
    </section>
    <!-- TESTIMONIAL SECTION END -->


    <!-- BLOG SECTION START -->
    <section class="ul-blogs ul-section-spacing">
        <div class="ul-blogs-container wow animate__fadeInUp">
            <div class="row gy-3">
                <!-- section heading -->
                <div class="col-sm-5">
                    <div class="ul-section-heading">
                        <div class="left">
                            <span class="ul-section-sub-title">Derniers articles</span>
                            <h2 class="ul-section-title">Lisez nos dernières actualités</h2>
                            <p class="ul-section-descr">Découvrez nos dernières actions, nos projets en cours et les témoignages de ceux que nous aidons. Restez informé de nos activités et de notre impact.</p>
                            <div class="ul-blogs-slider-nav ul-slider-nav">
                                <button class="prev"><i class="flaticon-back"></i></button>
                                <button class="next"><i class="flaticon-next"></i></button>
                            </div>
                            <a href="{{ route('articles') }}" class="ul-btn" style="margin-top: 20px;"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Voir tous les articles</a>
                        </div>
                    </div>
                </div>

                <!-- blog slider -->
                <div class="col-sm-7">
                    <div class="ul-blogs-slider swiper">
                        <div class="swiper-wrapper">
                            @if(isset($articles) && $articles->count() > 0)
                                @foreach($articles as $index => $article)
                                    <div class="swiper-slide">
                                        <div class="ul-blog">
                                            <div class="ul-blog-img">
                                                @if($article->image)
                                                    @if(Str::startsWith($article->image, ['http://', 'https://']))
                                                        <img src="{{ $article->image }}" alt="{{ $article->title }}">
                                                    @else
                                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('assets/img/blog-' . (($index % 3) + 1) . '.jpg') }}" alt="{{ $article->title }}">
                                                @endif
                                                <div class="date">
                                                    <span class="number">{{ $article->published_at ? $article->published_at->format('d') : $article->created_at->format('d') }}</span>
                                                    <span class="txt">{{ $article->published_at ? $article->published_at->translatedFormat('M') : $article->created_at->translatedFormat('M') }}</span>
                                                </div>
                                            </div>
                                            <div class="ul-blog-txt">
                                                <div class="ul-blog-infos">
                                                    <div class="ul-blog-info">
                                                        <span class="icon"><i class="flaticon-account"></i></span>
                                                        <span class="text font-normal text-[14px] text-etGray">Par {{ $article->author_display_name }}</span>
                                                    </div>
                                                    @if($article->category)
                                                        <div class="ul-blog-info">
                                                            <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                            <span class="text font-normal text-[14px] text-etGray">{{ $article->category }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <a href="{{ route('article.show', $article->slug) }}" class="ul-blog-title">{{ Str::limit($article->title, 60) }}</a>
                                                <a href="{{ route('article.show', $article->slug) }}" class="ul-blog-btn">Lire la suite <span class="icon"><i class="flaticon-next"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Articles par défaut si aucun en DB -->
                                @php
                                    $defaultArticles = [
                                        ['title' => 'Donner l\'éducation, c\'est le plus beau cadeau que l\'on puisse offrir', 'category' => 'Éducation'],
                                        ['title' => 'Ne traitons pas les océans comme des poubelles universelles', 'category' => 'Environnement'],
                                        ['title' => 'Protéger nos plages pour les générations futures', 'category' => 'Environnement'],
                                    ];
                                @endphp
                                @foreach($defaultArticles as $index => $article)
                                    <div class="swiper-slide">
                                        <div class="ul-blog">
                                            <div class="ul-blog-img"><img src="{{ asset('assets/img/blog-' . ($index + 1) . '.jpg') }}" alt="{{ $article['title'] }}">
                                                <div class="date">
                                                    <span class="number">15</span>
                                                    <span class="txt">Déc</span>
                                                </div>
                                            </div>
                                            <div class="ul-blog-txt">
                                                <div class="ul-blog-infos">
                                                    <div class="ul-blog-info">
                                                        <span class="icon"><i class="flaticon-account"></i></span>
                                                        <span class="text font-normal text-[14px] text-etGray">Par l'équipe</span>
                                                    </div>
                                                    <div class="ul-blog-info">
                                                        <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                        <span class="text font-normal text-[14px] text-etGray">{{ $article['category'] }}</span>
                                                    </div>
                                                </div>
                                                <a href="#" class="ul-blog-title">{{ $article['title'] }}</a>
                                                <a href="#" class="ul-blog-btn">Lire la suite <span class="icon"><i class="flaticon-next"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BLOG SECTION END -->


    <!-- GALLERY SECTION START -->
    <div class="ul-gallery overflow-hidden ul-section-spacing mx-auto pt-0">
        <div class="ul-gallery-slider swiper">
            <div class="swiper-wrapper">
                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-1.png') }}" alt="Image de la galerie">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-1.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-2.png') }}" alt="Image de la galerie">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-2.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-3.png') }}" alt="Image de la galerie">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-3.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-4.png') }}" alt="Image de la galerie">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-4.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-5.png') }}" alt="Image de la galerie">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-5.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-6.png') }}" alt="Image de la galerie">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-6.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-1.png') }}" alt="Image de la galerie">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-1.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>

                <!-- single gallery item -->
                <div class="ul-gallery-item swiper-slide">
                    <img src="{{ asset('assets/img/gallery-item-2.png') }}" alt="Image de la galerie">
                    <div class="ul-gallery-item-btn-wrapper">
                        <a href="{{ asset('assets/img/gallery-item-2.png') }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- GALLERY SECTION END -->
@endsection
