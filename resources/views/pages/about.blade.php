@extends('layouts.public')

@section('title', 'À propos - Espoir Vie ASBL')

@section('content')
    <x-breadcrumb
        title="À propos de nous"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'À propos']
        ]"
    />


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
                        <p class="ul-section-descr">Espoir Vie ASBL est une organisation dédiée à améliorer les conditions de vie des personnes dans le besoin. Nous croyons que chaque individu mérite une chance de vivre dans la dignité avec espoir en l'avenir. Rejoignez-nous pour créer un impact durable dans nos communautés.</p>

                        <div class="ul-about-block">
                            <div class="block-left">
                                <div class="block-heading">
                                    <div class="icon"><i class="flaticon-love"></i></div>
                                    <h3 class="block-title">Rejoignez notre équipe</h3>
                                </div>

                                <ul class="block-list">
                                    <li>De nombreuses façons d'aider et de faire la différence</li>
                                    <li>Participez à nos projets et événements</li>
                                    <li>Créez un impact positif dans votre communauté</li>
                                </ul>
                            </div>
                            <div class="block-right"><img src="{{ asset('assets/img/about-block-img.jpg') }}" alt="Illustration à propos"></div>
                        </div>

                        <div class="ul-about-bottom">
                            <a href="{{ route('donate') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don</a>

                            <div class="ul-about-call">
                                <div class="icon"><i class="flaticon-telephone-call"></i></div>
                                <div class="txt">
                                    <span class="call-title">Appelez-nous à tout moment</span>
                                    <a href="tel:+442045770077">+44 204 577 0077</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- vector -->
        <div class="ul-about-vectors">
            <img src="{{ asset('assets/img/about-vector-1.png') }}" alt="Vecteur" class="vector-1">
        </div>
    </section>
    <!-- ABOUT SECTION END -->


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


    <!-- MISSION, VISION, HISTORY SECTION START -->
    <section class="ul-about-tabs ul-events ul-section-spacing pt-0">
        <div class="ul-container">
            <!-- heading -->
            <div class="ul-section-heading align-items-center wow animate__fadeInUp">
                <div class="left">
                    <span class="ul-section-sub-title">Notre histoire</span>
                    <h2 class="ul-section-title text-white">Découvrez notre mission, notre vision et notre histoire</h2>
                </div>
                <a href="{{ route('donate') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don</a>
            </div>

            <!-- tab group -->
            <div class="tab-group">
                <!-- tabs -->
                <div class="ul-about-tabs-wrapper">
                    <div id="tab-mission" class="ul-tab ul-about-tab active">
                        <div class="ul-about-tab-img">
                            <img src="{{ asset('assets/img/mission-img.jpg') }}" alt="Notre mission">
                        </div>

                        <div class="ul-about-tab-txt">
                            <h3 class="ul-about-tab-title">Notre Mission</h3>
                            <p class="ul-about-tab-descr">Notre mission est de créer un impact positif et durable dans la vie des personnes en situation de précarité. Nous nous engageons à améliorer leurs conditions de vie en répondant à leurs besoins essentiels et en favorisant leur autonomie et leur développement personnel.</p>
                            <ul class="ul-about-tab-list">
                                <li>Fournir une aide humanitaire d'urgence aux personnes dans le besoin</li>
                                <li>Développer des programmes éducatifs pour favoriser l'autonomie</li>
                                <li>Organiser des événements pour sensibiliser et mobiliser la communauté</li>
                                <li>Créer un réseau de solidarité et d'entraide durable</li>
                            </ul>
                            <p class="ul-about-tab-descr">Nous croyons en la force de l'action collective et en la capacité de chacun à faire la différence. Chaque projet, chaque don, chaque geste de solidarité contribue à construire un monde meilleur pour tous.</p>
                        </div>
                    </div>

                    <!-- tab 02 / vision -->
                    <div id="tab-vision" class="ul-tab ul-about-tab">
                        <div class="ul-about-tab-img">
                            <img src="{{ asset('assets/img/why-join.jpg') }}" alt="Notre vision">
                        </div>

                        <div class="ul-about-tab-txt">
                            <h3 class="ul-about-tab-title">Notre Vision</h3>
                            <p class="ul-about-tab-descr">Nous aspirons à un monde où chaque personne, quelle que soit sa situation, a accès aux ressources essentielles pour vivre dans la dignité et développer son plein potentiel. Notre vision est celle d'une société plus équitable où la solidarité et l'entraide sont des valeurs fondamentales.</p>
                            <ul class="ul-about-tab-list">
                                <li>Un monde où aucun enfant ne souffre de faim ou de privation</li>
                                <li>Des communautés autonomes capables de prendre en charge leur développement</li>
                                <li>Un accès équitable à l'éducation et aux soins de santé pour tous</li>
                                <li>Des générations futures conscientes et engagées pour un monde meilleur</li>
                                <li>Un réseau mondial de solidarité et de partage</li>
                                <li>Une transparence totale dans la gestion des ressources et des actions</li>
                                <li>Un impact mesurable et durable sur les communautés que nous servons</li>
                                <li>Une reconnaissance de la dignité et des droits de chaque individu</li>
                            </ul>
                        </div>
                    </div>

                    <!-- tab 03 / history -->
                    <div id="tab-history" class="ul-tab ul-about-tab">
                        <div class="ul-about-tab-img">
                            <img src="{{ asset('assets/img/contact-img.jpg') }}" alt="Notre histoire">
                        </div>

                        <div class="ul-about-tab-txt">
                            <h3 class="ul-about-tab-title">Notre Histoire</h3>
                            <p class="ul-about-tab-descr">Espoir Vie ASBL a été fondée avec la conviction profonde que chaque personne mérite une chance de vivre dans la dignité. Depuis nos débuts, nous avons œuvré sans relâche pour améliorer les conditions de vie des personnes en situation de précarité, en particulier les enfants et les familles.</p>

                            <p class="ul-about-tab-descr">Notre parcours a été marqué par des projets significatifs qui ont transformé la vie de nombreuses personnes. Nous avons développé des programmes d'éducation, organisé des campagnes de sensibilisation, et créé des réseaux de solidarité qui continuent de grandir et d'évoluer.</p>

                            <p class="ul-about-tab-descr">Aujourd'hui, fort de notre expérience et de la confiance de nos donateurs et bénévoles, nous continuons à étendre notre impact et à répondre aux nouveaux défis qui se présentent. Notre histoire est celle de milliers de vies transformées, de projets réalisés, et d'espoir redonné.</p>
                        </div>
                    </div>
                </div>


                <div class="tab-navs ul-about-tabs-nav">
                    <button class="tab-nav active" data-tab="tab-mission">Notre Mission</button>
                    <button class="tab-nav" data-tab="tab-vision">Notre Vision</button>
                    <button class="tab-nav" data-tab="tab-history">Notre Histoire</button>
                </div>
            </div>

            <!-- vectors -->
            <div class="ul-events-vectors">
                <img src="{{ asset('assets/img/events-vector-2.svg') }}" alt="Image des événements" class="vector-2">
            </div>
        </div>
    </section>
    <!-- MISSION, VISION, HISTORY SECTION END -->


    <!-- TEAM SECTION START -->
    <section class="ul-team ul-section-spacing">
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
                            <h3 class="ul-team-member-name"><a href="{{ route('contact') }}">Membre de l'équipe</a></h3>
                            <p class="ul-team-member-designation">Bénévole</p>
                        </div>
                    </div>
                </div>

                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-2.jpg') }}" alt="Photo du membre de l'équipe">
                            <div class="ul-team-member-socials">
                                <a href="#"><i class="flaticon-facebook"></i></a>
                                <a href="#"><i class="flaticon-twitter"></i></a>
                                <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                                <a href="#"><i class="flaticon-instagram"></i></a>
                            </div>
                        </div>
                        <div class="ul-team-member-info">
                            <h3 class="ul-team-member-name"><a href="{{ route('contact') }}">Membre de l'équipe</a></h3>
                            <p class="ul-team-member-designation">Bénévole</p>
                        </div>
                    </div>
                </div>

                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-3.jpg') }}" alt="Photo du membre de l'équipe">
                            <div class="ul-team-member-socials">
                                <a href="#"><i class="flaticon-facebook"></i></a>
                                <a href="#"><i class="flaticon-twitter"></i></a>
                                <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                                <a href="#"><i class="flaticon-instagram"></i></a>
                            </div>
                        </div>
                        <div class="ul-team-member-info">
                            <h3 class="ul-team-member-name"><a href="{{ route('contact') }}">Membre de l'équipe</a></h3>
                            <p class="ul-team-member-designation">Bénévole</p>
                        </div>
                    </div>
                </div>

                <!-- single member -->
                <div class="col">
                    <div class="ul-team-member">
                        <div class="ul-team-member-img">
                            <img src="{{ asset('assets/img/member-4.jpg') }}" alt="Photo du membre de l'équipe">
                            <div class="ul-team-member-socials">
                                <a href="#"><i class="flaticon-facebook"></i></a>
                                <a href="#"><i class="flaticon-twitter"></i></a>
                                <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                                <a href="#"><i class="flaticon-instagram"></i></a>
                            </div>
                        </div>
                        <div class="ul-team-member-info">
                            <h3 class="ul-team-member-name"><a href="{{ route('contact') }}">Membre de l'équipe</a></h3>
                            <p class="ul-team-member-designation">Bénévole</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- TEAM SECTION END -->


    <!-- CTA(CALL TO ACTION) SECTION START -->
    <section class="ul-cta">
        <div class="ul-container">
            <span class="ul-section-sub-title">Commencez à aider dès maintenant</span>
            <h2 class="ul-cta-title">Les enfants ont besoin de votre aide, faites un don aujourd'hui</h2>
            <a href="{{ route('donate') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don</a>
        </div>
        <img src="{{ asset('assets/img/cta-vector.svg') }}" alt="Vecteur" class="ul-cta-vector">
    </section>
    <!-- CTA(CALL TO ACTION) SECTION END -->


    <!-- TESTIMONIAL SECTION START -->
    <section class="ul-testimonial-2 ul-section-spacing">
        <div class="ul-container wow animate__fadeInUp">
            <div class="ul-section-heading">
                <div>
                    <span class="ul-section-sub-title">Commencez à aider les personnes dans le besoin</span>
                    <h2 class="ul-section-title">Ce qu'ils disent d'Espoir Vie</h2>
                </div>
                <a href="{{ route('events') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Tous les témoignages</a>
            </div>

            <div class="row ul-testimonial-2-row gy-4">
                <!-- card -->
                <div class="col-md-4">
                    <div class="ul-testimonial-2-overview">
                        <span class="rating">4.9</span>
                        <div class="ul-testimonial-2-overview-stars">
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star"></i>
                            <i class="flaticon-star-1"></i>
                        </div>
                        <span class="ul-testimonial-2-overview-title">Note de 5 étoiles</span>
                        <p class="ul-testimonial-2-overview-descr">Espoir Vie ASBL a transformé des milliers de vies grâce à son dévouement et sa transparence. Votre engagement fait vraiment la différence dans notre communauté.</p>
                        <div class="ul-testimonial-2-overview-reviewers">
                            <img src="{{ asset('assets/img/reviewer-1.png') }}" alt="Témoin">
                            <img src="{{ asset('assets/img/reviewer-2.png') }}" alt="Témoin">
                            <img src="{{ asset('assets/img/reviewer-3.png') }}" alt="Témoin">
                            <img src="{{ asset('assets/img/reviewer-4.png') }}" alt="Témoin">
                        </div>
                    </div>
                </div>

                <!-- txt -->
                <div class="col-md-8">
                    <div class="ul-testimonial-2-slider swiper">
                        <div class="swiper-wrapper">
                            <!-- single slide -->
                            <div class="swiper-slide">
                                <div class="ul-review ul-review-2">
                                    <span class="icon"><i class="flaticon-quote-1"></i></span>
                                    <p class="ul-review-descr">Espoir Vie ASBL a fait une différence incroyable dans ma vie et celle de ma famille. Leur dévouement et leur compassion sont vraiment remarquables. Grâce à leur aide, nous avons pu retrouver espoir et dignité. Je suis reconnaissant pour tout ce qu'ils font chaque jour pour améliorer la vie des personnes dans le besoin.</p>
                                    <div class="ul-review-bottom">
                                        <div class="ul-review-reviewer">
                                            <div class="reviewer-image"><img src="{{ asset('assets/img/reviewer-1.png') }}" alt="Photo du témoin"></div>
                                            <div>
                                                <h3 class="reviewer-name">Marie Dupont</h3>
                                                <span class="reviewer-role">Bénévole</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- single slide -->
                            <div class="swiper-slide">
                                <div class="ul-review ul-review-2">
                                    <span class="icon"><i class="flaticon-quote-1"></i></span>
                                    <p class="ul-review-descr">Merci à Espoir Vie ASBL pour leur engagement exceptionnel. Votre travail fait vraiment une différence dans notre communauté. Je suis fier de soutenir votre cause et je recommande vivement à tous ceux qui veulent faire la différence de vous rejoindre dans cette belle mission.</p>
                                    <div class="ul-review-bottom">
                                        <div class="ul-review-reviewer">
                                            <div class="reviewer-image"><img src="{{ asset('assets/img/reviewer-2.png') }}" alt="Photo du témoin"></div>
                                            <div>
                                                <h3 class="reviewer-name">Pierre Dubois</h3>
                                                <span class="reviewer-role">Donateur</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ul-testimonial-2-slider-nav">
                            <button class="prev"><i class="flaticon-back"></i></button>
                            <button class="next"><i class="flaticon-next"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- TESTIMONIAL SECTION END -->
@endsection
