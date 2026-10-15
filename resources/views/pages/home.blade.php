@extends('layouts.public')

@section('title', 'Accueil - Espoir Vie ASBL')

@section('content')
    @if(site_visible('home.banner'))
    <!-- BANNER SECTION START -->
    <section class="ul-banner">
        <div class="ul-banner-container">
            <div class="row gy-4 row-cols-lg-2 row-cols-1 align-items-center flex-column-reverse flex-lg-row">
                <!-- banner text -->
                <div class="col">
                    <div class="ul-banner-txt">
                        <div class="wow animate__fadeInUp">
                            <span class="ul-banner-sub-title ul-section-sub-title">{{ site_text('home.banner', 'subtitle', 'Enfant joyeux, sourire retrouvé.') }}</span>
                            <h1 class="ul-banner-title">{{ site_text('home.banner', 'title', 'Redonner espoir aux enfants orphelins et vulnérables') }}</h1>
                            <p class="ul-banner-descr">{{ site_text('home.banner', 'body') }}</p>
                            <div class="ul-banner-btns">
                                <a href="{{ site_link('home.banner', 'donate') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ site_text('home.banner', 'button_label', 'Faire un don') }}</a>

                                @if(site_extra('home.banner', 'stat_number') !== '')
                                <div class="ul-banner-stat">
                                    <div class="imgs">
                                        <img src="{{ asset('assets/img/1.jpg.jpeg') }}" alt="Personne">
                                        <img src="{{ asset('assets/img/2.jpg.jpeg') }}" alt="Personne">
                                        <img src="{{ asset('assets/img/3.jpg.jpeg') }}" alt="Personne">
                                        <span class="number">{{ site_extra('home.banner', 'stat_number') }}</span>
                                    </div>
                                    <span class="txt">{{ site_extra('home.banner', 'stat_label', 'Enfants accompagnés') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <img src="{{ asset('assets/img/vector-img.png') }}" alt="Vecteur" class="ul-banner-txt-vector">
                    </div>
                </div>

                <!-- img -->
                <div class="col align-self-start">
                    <div class="ul-banner-img">
                        <div class="img-wrapper">
                            <img src="{{ site_image('home.banner', 'assets/img/960x1000-.jpg.jpeg') }}" alt="{{ site_text('home.banner', 'title', 'Espoir Vie') }}">
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
    @endif


    @if(site_visible('home.about'))
    <!-- ABOUT SECTION START -->
    <section class="ul-about ul-section-spacing wow animate__fadeInUp">
        <div class="ul-container">
            <div class="row row-cols-md-2 row-cols-1 align-items-center gy-4 ul-about-row">
                <div class="col">
                    <div class="ul-about-imgs">
                        <div class="img-wrapper">
                            <img src="{{ site_image('home.about', 'assets/img/690x612.jpg.jpeg') }}" alt="{{ site_text('home.about', 'title', 'À propos') }}">
                        </div>
                        <div class="ul-about-imgs-vectors">
                            <img src="{{ asset('assets/img/about-img-vector-1.svg') }}" alt="Illustration" class="vector-1">
                            <img src="{{ asset('assets/img/about-img-vector-2.svg') }}" alt="Illustration" class="vector-2">
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="ul-about-txt">
                        <span class="ul-section-sub-title ul-section-sub-title--2">{{ site_text('home.about', 'subtitle', 'À propos de nous') }}</span>
                        <h2 class="ul-section-title">{{ site_text('home.about', 'title') }}</h2>
                        <p class="ul-section-descr">{{ site_text('home.about', 'body') }}</p>

                        <div class="ul-about-block">
                            <div class="block-left">
                                <div class="block-heading">
                                    <div class="icon"><i class="flaticon-love"></i></div>
                                    <h3 class="block-title">{{ site_extra('home.about', 'block_title', 'Notre engagement') }}</h3>
                                </div>
                                <ul class="block-list">
                                    @foreach(site_items('home.about') as $item)
                                        @if(($item['text'] ?? '') !== '')
                                            <li>{{ $item['text'] }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="block-right">
                                <img src="{{ asset('assets/img/330x73-equipe.jpg.jpeg') }}" alt="Illustration à propos">
                            </div>
                        </div>

                        <div class="ul-about-bottom">
                            <a href="{{ site_link('home.about', 'about') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ site_text('home.about', 'button_label', 'En savoir plus') }}</a>

                            @if(site_phone() !== '')
                            <div class="ul-about-call">
                                <div class="icon"><i class="flaticon-telephone-call"></i></div>
                                <div class="txt">
                                    <span class="call-title">Appelez-nous</span>
                                    <a href="tel:{{ preg_replace('/\s+/', '', site_phone()) }}">{{ site_phone() }}</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ul-about-vectors">
            <img src="{{ asset('assets/img/about-vector-1.png') }}" alt="vecteur" class="vector-1">
        </div>
    </section>
    <!-- ABOUT SECTION END -->
    @endif


    @if(site_visible('home.donations'))
    <!-- DONTATIONS SECTION START -->
    <section class="ul-donations ul-section-spacing overflow-hidden">
        <!-- heading -->
        <div class="ul-container">
            <div class="ul-section-heading ul-donations-heading justify-content-between text-center">
                <div class="left">
                    <span class="ul-section-sub-title"><span class="txt">{{ site_text('home.donations', 'subtitle', 'Aidez-nous et faites un don') }}</span></span>
                    <h2 class="ul-section-title">{{ site_text('home.donations', 'title', 'Soutenir les enfants orphelins et les familles vulnérables') }}</h2>
                </div>

                @if(site_extra('home.donations', 'stat_number') !== '')
                <div class="flex-shrink-0">
                    <div class="ul-banner-stat">
                        <div class="imgs">
                            <img src="{{ asset('assets/img/user-1.png') }}" alt="Personne">
                            <img src="{{ asset('assets/img/user-3.png') }}" alt="Personne">
                            <img src="{{ asset('assets/img/user-2.png') }}" alt="Personne">
                            <span class="number">{{ site_extra('home.donations', 'stat_number') }}</span>
                        </div>
                        <span class="txt text-white">{{ site_extra('home.donations', 'stat_label', 'Enfants accompagnés') }}</span>
                    </div>
                </div>
                @endif
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
    @endif


    @if(site_visible('home.donate_cta'))
    <div class="ul-section-spacing">
        <div class="ul-container">
            <div class="ul-donate-form-section">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6 position-relative">
                        <div class="ul-donate-form-wrapper">
                            <h3 class="ul-donate-form-title">{{ site_text('home.donate_cta', 'title', 'Soutenez les enfants orphelins et vulnérables') }}</h3>
                            <p class="ul-section-descr">{{ site_text('home.donate_cta', 'body') }}</p>
                            <a href="javascript:void(0);" class="ul-btn spontaneous-donation-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ site_text('home.donate_cta', 'button_label', 'Faire un don') }}</a>
                        </div>
                        <img src="{{ asset('assets/img/donate-form-vector.svg') }}" alt="vecteur" class="ul-donate-form-vector">
                    </div>

                    <div class="col-xl-5 col-lg-6">
                        <div class="ul-donate-form-section-txt">
                            <span class="ul-section-sub-title text-white">{{ site_text('home.donate_cta', 'subtitle', 'Faire un don maintenant') }}</span>
                            <h2 class="ul-section-title text-white">{{ site_text('home.donate_cta', 'title') }}</h2>
                            @if(site_extra('home.donate_cta', 'raised') !== '' && site_extra('home.donate_cta', 'goal') !== '')
                            <div class="ul-donation-progress">
                                <div class="ul-donation-progress-labels">
                                    <span class="ul-donation-progress-label">Collecté : {{ site_extra('home.donate_cta', 'raised') }}</span>
                                    <span class="ul-donation-progress-label">Objectif : {{ site_extra('home.donate_cta', 'goal') }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


    @include('parties.site-stats')


    @if(site_visible('home.events'))
    <!-- EVENTS SECTION START -->
    <section class="ul-events ul-section-spacing pt-0">
        <div class="ul-container">
            <!-- heading -->
            <div class="ul-section-heading align-items-center wow animate__fadeInUp">
                <div class="left">
                    <span class="ul-section-sub-title">{{ site_text('home.events', 'subtitle', 'Événements à venir') }}</span>
                    <h2 class="ul-section-title text-white">{{ site_text('home.events', 'title', 'Les rendez-vous d\'Espoir Vie') }}</h2>
                </div>
                <a href="{{ site_link('home.events', 'events') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ site_text('home.events', 'button_label', 'Voir les événements') }}</a>
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
    @endif


    @if(site_visible('home.why_join'))
    <!-- WHY JOIN SECTION START -->
    <section class="ul-why-join ul-section-spacing">
        <div class="ul-why-join-wrapper ul-section-spacing">
            <div class="ul-container">
                <div class="row row-cols-md-2 row-cols-1 gy-4 align-items-center">
                    <div class="col">
                        <div class="ul-why-join-img">
                            <img src="{{ site_image('home.why_join', 'assets/img/660X632.jpg.jpeg') }}" alt="{{ site_text('home.why_join', 'title', 'Pourquoi soutenir Espoir Vie') }}">
                        </div>
                    </div>

                    <div class="col">
                        <div class="ul-why-join-txt">
                            <span class="ul-section-sub-title">{{ site_text('home.why_join', 'subtitle', 'Rejoignez-nous') }}</span>
                            <h2 class="ul-section-title">{{ site_text('home.why_join', 'title', 'Pourquoi soutenir Espoir Vie') }}</h2>
                            <p class="ul-section-descr">{{ site_text('home.why_join', 'body') }}</p>

                            <div class="ul-accordion">
                                @foreach(site_items('home.why_join') as $index => $item)
                                    <div class="ul-single-accordion-item {{ $index === 0 ? 'open' : '' }}">
                                        <div class="ul-single-accordion-item__header">
                                            <div class="left">
                                                <h3 class="ul-single-accordion-item__title">{{ $item['title'] ?? '' }}</h3>
                                            </div>
                                            <span class="icon"><i class="flaticon-next"></i></span>
                                        </div>
                                        <div class="ul-single-accordion-item__body">
                                            <p>{{ $item['text'] ?? '' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- WHY JOIN SECTION END -->
    @endif


    @if(site_visible('home.team'))
    <!-- TEAM SECTION START -->
    <section class="ul-team ul-section-spacing pt-0">
        <div class="ul-container">
            <div class="ul-section-heading justify-content-between">
                <div class="left">
                    <span class="ul-section-sub-title">{{ site_text('home.team', 'subtitle', 'Notre équipe') }}</span>
                    <h2 class="ul-section-title">{{ site_text('home.team', 'title', 'Des personnes engagées auprès des enfants vulnérables') }}</h2>
                </div>
                <div>
                    <a href="{{ site_link('home.team', 'team') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ site_text('home.team', 'button_label', 'Voir toute l\'équipe') }}</a>
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
                    <div class="col">
                        <p class="ul-section-descr">Les membres visibles se renseignent dans l'espace d'administration.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- TEAM SECTION END -->
    @endif


    @if(site_visible('home.testimonials'))
    <!-- TESTIMONIAL SECTION START -->
    <section class="ul-testimonial ul-section-spacing">
        <div class="ul-testimonial-container">
            <div class="ul-section-heading text-center">
                <div>
                    <span class="ul-section-sub-title">{{ site_text('home.testimonials', 'subtitle', 'Témoignages') }}</span>
                    <h2 class="ul-section-title">{{ site_text('home.testimonials', 'title', 'La parole de celles et ceux qui nous accompagnent') }}</h2>
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
                        <div class="swiper-slide">
                            <div class="ul-review">
                                <p class="ul-review-descr">Les témoignages publiés par l'association apparaîtront ici.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="ul-testimonial-slider-pagination"></div>
            </div>
        </div>
    </section>
    <!-- TESTIMONIAL SECTION END -->
    @endif


    @if(site_visible('home.blog'))
    <!-- BLOG SECTION START -->
    <section class="ul-blogs ul-section-spacing">
        <div class="ul-blogs-container wow animate__fadeInUp">
            <div class="row gy-3">
                <div class="col-sm-5">
                    <div class="ul-section-heading">
                        <div class="left">
                            <span class="ul-section-sub-title">{{ site_text('home.blog', 'subtitle', 'Derniers articles') }}</span>
                            <h2 class="ul-section-title">{{ site_text('home.blog', 'title', 'Les actions et les nouvelles d\'Espoir Vie') }}</h2>
                            <p class="ul-section-descr">{{ site_text('home.blog', 'body') }}</p>
                            <div class="ul-blogs-slider-nav ul-slider-nav">
                                <button class="prev"><i class="flaticon-back"></i></button>
                                <button class="next"><i class="flaticon-next"></i></button>
                            </div>
                            <a href="{{ site_link('home.blog', 'articles') }}" class="ul-btn" style="margin-top: 20px;"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ site_text('home.blog', 'button_label', 'Voir tous les articles') }}</a>
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
                                <div class="swiper-slide">
                                    <p class="ul-section-descr">Les articles publiés apparaîtront ici.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BLOG SECTION END -->
    @endif

    @if(site_visible('home.gallery'))
    <div class="ul-gallery overflow-hidden ul-section-spacing mx-auto pt-0">
        <div class="ul-gallery-slider swiper">
            <div class="swiper-wrapper">
                @foreach(site_gallery_urls() as $galleryUrl)
                    <div class="ul-gallery-item swiper-slide">
                        <img src="{{ $galleryUrl }}" alt="Photo Espoir Vie">
                        <div class="ul-gallery-item-btn-wrapper">
                            <a href="{{ $galleryUrl }}" data-fslightbox="gallery"><i class="flaticon-instagram"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endsection
