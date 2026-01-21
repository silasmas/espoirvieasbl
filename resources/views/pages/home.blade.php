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
                                        <img src="{{ asset('assets/img/user-1.png') }}" alt="Personne">
                                        <img src="{{ asset('assets/img/user-3.png') }}" alt="Personne">
                                        <img src="{{ asset('assets/img/user-2.png') }}" alt="Personne">
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
                            <img src="{{ asset('assets/img/960x1000.jpg.jpeg') }}" alt="Image de la bannière">
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
                            <img src="{{ asset('assets/img/about-img.png') }}" alt="Image à propos">
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
                        <span class="ul-section-sub-title ul-section-sub-title--2">À propos de nous</span>
                        <h2 class="ul-section-title">S'entraider peut rendre le monde meilleur</h2>
                        <p class="ul-section-descr">Espoir Vie ASBL est une organisation dédiée à améliorer les conditions de vie des personnes dans le besoin. Nous croyons que chaque individu mérite une chance de vivre dans la dignité avec espoir en l'avenir. Rejoignez-nous pour créer un impact durable.</p>

                        <div class="ul-about-block">
                            <div class="block-left">
                                <div class="block-heading">
                                    <div class="icon"><i class="flaticon-love"></i></div>
                                    <h3 class="block-title">Rejoignez notre équipe</h3>
                                </div>

                                <ul class="block-list">
                                    <li>De nombreuses façons d'aider et de faire la différence</li>
                                </ul>
                            </div>
                            <div class="block-right"><img src="{{ asset('assets/img/about-block-img.jpg') }}" alt="Illustration à propos"></div>
                        </div>

                        <div class="ul-about-bottom">
                            <a href="{{ route('about') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> En savoir plus</a>

                            <div class="ul-about-call">
                                <div class="icon"><i class="flaticon-telephone-call"></i></div>
                                <div class="txt">
                                    <span class="call-title">Appelez-nous à tout moment</span>
                                    <a href="tel:+612345678990">+61 2345 678 990</a>
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
                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-1.jpg') }}" alt="Image du don">
                                <span class="tag">Alimentation</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="55">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Collecté : 25 000 €</span>
                                        <span class="ul-donation-progress-label">Objectif : 30 000 €</span>
                                    </div>
                                </div>
                                <a href="{{ route('donate') }}" class="ul-donation-title">Sauver des vies d'enfants en Afrique du Sud</a>
                                <p class="ul-donation-descr">Nous travaillons ensemble pour faire une différence durable en aidant les personnes dans le besoin. Avec gentillesse et travail acharné.</p>
                                <a href="{{ route('donate') }}" class="ul-donation-btn">Faire un don maintenant <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-2.jpg') }}" alt="Image du don">
                                <span class="tag">Alimentation</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="95">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Collecté : 25 000 €</span>
                                        <span class="ul-donation-progress-label">Objectif : 30 000 €</span>
                                    </div>
                                </div>
                                <a href="{{ route('donate') }}" class="ul-donation-title">Sauver des vies d'enfants en Afrique du Sud</a>
                                <p class="ul-donation-descr">Nous travaillons ensemble pour faire une différence durable en aidant les personnes dans le besoin. Avec gentillesse et travail acharné.</p>
                                <a href="{{ route('donate') }}" class="ul-donation-btn">Faire un don maintenant <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-3.jpg') }}" alt="Image du don">
                                <span class="tag">Alimentation</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="50">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Collecté : 25 000 €</span>
                                        <span class="ul-donation-progress-label">Objectif : 30 000 €</span>
                                    </div>
                                </div>
                                <a href="{{ route('donate') }}" class="ul-donation-title">Sauver des vies d'enfants en Afrique du Sud</a>
                                <p class="ul-donation-descr">Nous travaillons ensemble pour faire une différence durable en aidant les personnes dans le besoin. Avec gentillesse et travail acharné.</p>
                                <a href="{{ route('donate') }}" class="ul-donation-btn">Faire un don maintenant <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-4.jpg') }}" alt="Image du don">
                                <span class="tag">Alimentation</span>
                            </div>
                            <div class="ul-donation-txt">
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
                                <a href="{{ route('donate') }}" class="ul-donation-title">Sauver des vies d'enfants en Afrique du Sud</a>
                                <p class="ul-donation-descr">Nous travaillons ensemble pour faire une différence durable en aidant les personnes dans le besoin. Avec gentillesse et travail acharné.</p>
                                <a href="{{ route('donate') }}" class="ul-donation-btn">Faire un don maintenant <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-1.jpg') }}" alt="Image du don">
                                <span class="tag">Alimentation</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="80">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Collecté : 25 000 €</span>
                                        <span class="ul-donation-progress-label">Objectif : 30 000 €</span>
                                    </div>
                                </div>
                                <a href="{{ route('donate') }}" class="ul-donation-title">Sauver des vies d'enfants en Afrique du Sud</a>
                                <p class="ul-donation-descr">Nous travaillons ensemble pour faire une différence durable en aidant les personnes dans le besoin. Avec gentillesse et travail acharné.</p>
                                <a href="{{ route('donate') }}" class="ul-donation-btn">Faire un don maintenant <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-2.jpg') }}" alt="Image du don">
                                <span class="tag">Alimentation</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="95">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Collecté : 25 000 €</span>
                                        <span class="ul-donation-progress-label">Objectif : 30 000 €</span>
                                    </div>
                                </div>
                                <a href="{{ route('donate') }}" class="ul-donation-title">Sauver des vies d'enfants en Afrique du Sud</a>
                                <p class="ul-donation-descr">Nous travaillons ensemble pour faire une différence durable en aidant les personnes dans le besoin. Avec gentillesse et travail acharné.</p>
                                <a href="{{ route('donate') }}" class="ul-donation-btn">Faire un don maintenant <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-3.jpg') }}" alt="Image du don">
                                <span class="tag">Alimentation</span>
                            </div>
                            <div class="ul-donation-txt">
                                <div class="ul-donation-progress">
                                    <div class="donation-progress-container ul-progress-container">
                                        <div class="donation-progressbar ul-progressbar" data-ul-progress-value="50">
                                            <div class="donation-progress-label ul-progress-label"></div>
                                        </div>
                                    </div>
                                    <div class="ul-donation-progress-labels">
                                        <span class="ul-donation-progress-label">Collecté : 25 000 €</span>
                                        <span class="ul-donation-progress-label">Objectif : 30 000 €</span>
                                    </div>
                                </div>
                                <a href="{{ route('donate') }}" class="ul-donation-title">Sauver des vies d'enfants en Afrique du Sud</a>
                                <p class="ul-donation-descr">Nous travaillons ensemble pour faire une différence durable en aidant les personnes dans le besoin. Avec gentillesse et travail acharné.</p>
                                <a href="{{ route('donate') }}" class="ul-donation-btn">Faire un don maintenant <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- single item -->
                    <div class="swiper-slide">
                        <div class="ul-donation">
                            <div class="ul-donation-img">
                                <img src="{{ asset('assets/img/donation-4.jpg') }}" alt="Image du don">
                                <span class="tag">Alimentation</span>
                            </div>
                            <div class="ul-donation-txt">
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
                                <a href="{{ route('donate') }}" class="ul-donation-title">Sauver des vies d'enfants en Afrique du Sud</a>
                                <p class="ul-donation-descr">Nous travaillons ensemble pour faire une différence durable en aidant les personnes dans le besoin. Avec gentillesse et travail acharné.</p>
                                <a href="{{ route('donate') }}" class="ul-donation-btn">Faire un don maintenant <i class="flaticon-up-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>
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
                    <!-- single event -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-event">
                            <div class="ul-event-img">
                                <img src="{{ asset('assets/img/event-img.jpg') }}" alt="Image de l'événement">
                                <span class="date">29 <span>Juillet</span></span>
                            </div>
                            <div class="ul-event-txt">
                                <h3 class="ul-event-title"><a href="{{ route('events') }}">Événement solidaire pour les familles dans le besoin</a></h3>
                                <p class="ul-event-descr">Rejoignez-nous pour cet événement exceptionnel dédié à l'amélioration des conditions de vie des familles et des enfants dans le besoin.</p>
                                <div class="ul-event-info">
                                    <span class="ul-event-info-title">Lieu</span>
                                    <p class="ul-event-info-descr">Bruxelles, Belgique</p>
                                </div>
                                <a href="{{ route('events') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Détails de l'événement</a>
                            </div>
                        </div>
                    </div>

                    <!-- single event -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-event">
                            <div class="ul-event-img">
                                <img src="{{ asset('assets/img/blog-b-1.jpg') }}" alt="Image de l'événement">
                                <span class="date">29 <span>Juillet</span></span>
                            </div>
                            <div class="ul-event-txt">
                                <h3 class="ul-event-title"><a href="{{ route('events') }}">Événement solidaire pour les familles dans le besoin</a></h3>
                                <p class="ul-event-descr">Rejoignez-nous pour cet événement exceptionnel dédié à l'amélioration des conditions de vie des familles et des enfants dans le besoin.</p>
                                <div class="ul-event-info">
                                    <span class="ul-event-info-title">Lieu</span>
                                    <p class="ul-event-info-descr">Bruxelles, Belgique</p>
                                </div>
                                <a href="{{ route('events') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Détails de l'événement</a>
                            </div>
                        </div>
                    </div>

                    <!-- single event -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-event">
                            <div class="ul-event-img">
                                <img src="{{ asset('assets/img/blog-2.jpg') }}" alt="Event Image">
                                <span class="date">29 <span>Juillet</span></span>
                            </div>
                            <div class="ul-event-txt">
                                <h3 class="ul-event-title"><a href="{{ route('events') }}">Événement solidaire pour les familles dans le besoin</a></h3>
                                <p class="ul-event-descr">Rejoignez-nous pour cet événement exceptionnel dédié à l'amélioration des conditions de vie des familles et des enfants dans le besoin.</p>
                                <div class="ul-event-info">
                                    <span class="ul-event-info-title">Lieu</span>
                                    <p class="ul-event-info-descr">Bruxelles, Belgique</p>
                                </div>
                                <a href="{{ route('events') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Détails de l'événement</a>
                            </div>
                        </div>
                    </div>

                    <!-- single event -->
                    <div class="col wow animate__fadeInUp">
                        <div class="ul-event">
                            <div class="ul-event-img">
                                <img src="{{ asset('assets/img/blog-b-3.jpg') }}" alt="Event Image">
                                <span class="date">29 <span>Juillet</span></span>
                            </div>
                            <div class="ul-event-txt">
                                <h3 class="ul-event-title"><a href="{{ route('events') }}">Événement solidaire pour les familles dans le besoin</a></h3>
                                <p class="ul-event-descr">Rejoignez-nous pour cet événement exceptionnel dédié à l'amélioration des conditions de vie des familles et des enfants dans le besoin.</p>
                                <div class="ul-event-info">
                                    <span class="ul-event-info-title">Lieu</span>
                                    <p class="ul-event-info-descr">Bruxelles, Belgique</p>
                                </div>
                                <a href="{{ route('events') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Détails de l'événement</a>
                            </div>
                        </div>
                    </div>
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
                            <img src="{{ asset('assets/img/why-join.jpg') }}" alt="Image pourquoi nous rejoindre">
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
                    <a href="{{ route('contact') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous rejoindre</a>
                </div>
            </div>

            <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-team-row justify-content-center">
                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-1.jpg') }}" alt="Photo du membre de l'équipe">
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

                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-2.jpg') }}" alt="Team Member Image">
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

                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-3.jpg') }}" alt="Team Member Image">
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

                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-4.jpg') }}" alt="Team Member Image">
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
                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Espoir Vie ASBL a fait une différence incroyable dans ma vie et celle de ma famille. Leur dévouement et leur compassion sont vraiment remarquables. Je suis reconnaissant pour tout ce qu'ils font.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-1.jpg') }}" alt="Photo du témoin"></div>
                                    <div>
                                        <h3 class="reviewer-name">Marie Dupont</h3>
                                        <span class="reviewer-role">Bénévole</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Merci à Espoir Vie ASBL pour leur engagement exceptionnel. Votre travail fait vraiment une différence dans notre communauté. Je suis fier de soutenir votre cause.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-2.jpg') }}" alt="Photo du témoin"></div>
                                    <div>
                                        <h3 class="reviewer-name">Pierre Dubois</h3>
                                        <span class="reviewer-role">Donateur</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Espoir Vie ASBL transforme des vies chaque jour. Leur transparence et leur dévouement sont exemplaires. Continuez votre excellent travail !</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-3.jpg') }}" alt="Photo du témoin"></div>
                                    <div>
                                        <h3 class="reviewer-name">Claire Bernard</h3>
                                        <span class="reviewer-role">Partenaire</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Grâce à Espoir Vie ASBL, j'ai pu redonner espoir à ma famille. Leur aide a été déterminante dans une période difficile de notre vie. Merci pour votre générosité.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-4.jpg') }}" alt="Photo du témoin"></div>
                                    <div>
                                        <h3 class="reviewer-name">Sophie Martin</h3>
                                        <span class="reviewer-role">Bénévole</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <!-- single slide -->
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-1"></i>
                            </div>
                            <p class="ul-review-descr">Espoir Vie ASBL a fait une différence incroyable dans ma vie et celle de ma famille. Leur dévouement et leur compassion sont vraiment remarquables. Je suis reconnaissant pour tout ce qu'ils font.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img src="{{ asset('assets/img/member-1.jpg') }}" alt="Photo du témoin"></div>
                                    <div>
                                        <h3 class="reviewer-name">Marie Dupont</h3>
                                        <span class="reviewer-role">Bénévole</span>
                                    </div>
                                </div>

                                <!-- icon -->
                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>
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
                        </div>
                    </div>
                </div>

                <!-- blog slider -->
                <div class="col-sm-7">
                    <div class="ul-blogs-slider swiper">
                        <div class="swiper-wrapper">
                            <!-- single blog -->
                            <div class="swiper-slide">
                                <div class="ul-blog">
                                    <div class="ul-blog-img"><img src="{{ asset('assets/img/blog-1.jpg') }}" alt="Image de l'article">
                                        <div class="date">
                                            <span class="number">15</span>
                                            <span class="txt">Déc</span>
                                        </div>
                                    </div>
                                    <div class="ul-blog-txt">
                                        <div class="ul-blog-infos">
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-account"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Par l'équipe</span>
                                            </div>
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Don</span>
                                            </div>
                                        </div>
                                        <a href="#" class="ul-blog-title">Donner l'éducation, c'est le plus beau cadeau que l'on puisse offrir</a>
                                        <a href="#" class="ul-blog-btn">Lire la suite <span class="icon"><i class="flaticon-next"></i></span></a>
                                    </div>
                                </div>
                            </div>

                            <!-- single blog -->
                            <div class="swiper-slide">
                                <div class="ul-blog">
                                    <div class="ul-blog-img"><img src="{{ asset('assets/img/blog-2.jpg') }}" alt="Image de l'article">
                                        <div class="date">
                                            <span class="number">15</span>
                                            <span class="txt">Déc</span>
                                        </div>
                                    </div>
                                    <div class="ul-blog-txt">
                                        <div class="ul-blog-infos">
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-account"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Par l'équipe</span>
                                            </div>
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Don</span>
                                            </div>
                                        </div>
                                        <a href="#" class="ul-blog-title">Ne traitons pas les océans comme des poubelles universelles</a>
                                        <a href="#" class="ul-blog-btn">Lire la suite <span class="icon"><i class="flaticon-next"></i></span></a>
                                    </div>
                                </div>
                            </div>

                            <!-- single blog -->
                            <div class="swiper-slide">
                                <div class="ul-blog">
                                    <div class="ul-blog-img"><img src="{{ asset('assets/img/blog-3.jpg') }}" alt="Image de l'article">
                                        <div class="date">
                                            <span class="number">15</span>
                                            <span class="txt">Déc</span>
                                        </div>
                                    </div>
                                    <div class="ul-blog-txt">
                                        <div class="ul-blog-infos">
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-account"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Par l'équipe</span>
                                            </div>
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Don</span>
                                            </div>
                                        </div>
                                        <a href="#" class="ul-blog-title">Protéger nos plages pour les générations futures</a>
                                        <a href="#" class="ul-blog-btn">Lire la suite <span class="icon"><i class="flaticon-next"></i></span></a>
                                    </div>
                                </div>
                            </div>

                            <!-- single blog -->
                            <div class="swiper-slide">
                                <div class="ul-blog">
                                    <div class="ul-blog-img"><img src="{{ asset('assets/img/blog-1.jpg') }}" alt="Image de l'article">
                                        <div class="date">
                                            <span class="number">15</span>
                                            <span class="txt">Déc</span>
                                        </div>
                                    </div>
                                    <div class="ul-blog-txt">
                                        <div class="ul-blog-infos">
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-account"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Par l'équipe</span>
                                            </div>
                                            <!-- single info -->
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                <span class="text font-normal text-[14px] text-etGray">Don</span>
                                            </div>
                                        </div>
                                        <a href="#" class="ul-blog-title">Protéger nos plages pour les générations futures</a>
                                        <a href="#" class="ul-blog-btn">Lire la suite <span class="icon"><i class="flaticon-next"></i></span></a>
                                    </div>
                                </div>
                            </div>
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
