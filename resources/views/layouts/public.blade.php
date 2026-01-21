<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Espoir Vie ASBL'))</title>

    <!-- Fonts -->
    <!--
            Pour commenter rapidement ce que vous avez sélectionné dans la plupart des éditeurs de code (comme VS Code, Sublime Text, etc) :
            - Windows/Linux : Ctrl + /
            - Mac : Cmd + /
        -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/icon/flaticon_charitics.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/splide/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slim-select/slimselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate-wow/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}">

    <!-- custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Scripts -->
    {{-- <x-vite-assets /> --}}
</head>

<body>
    <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div>

    <!-- SIDEBAR SECTION START -->
    <div class="ul-sidebar">
        <!-- header -->
        <div class="ul-sidebar-header">
            <div class="ul-sidebar-header-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/lg.jpg') }}" alt="Espoir Vie ASBL" class="logo">
                </a>
            </div>
            <!-- sidebar closer -->
            <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
        </div>

        <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>


        <!-- sidebar footer -->
        <div class="ul-sidebar-footer">
            <span class="ul-sidebar-footer-title">Suivez-nous</span>

            <div class="ul-sidebar-footer-social">
                <a href="#"><i class="flaticon-facebook"></i></a>
                <a href="#"><i class="flaticon-twitter"></i></a>
                <a href="#"><i class="flaticon-instagram"></i></a>
                <a href="#"><i class="flaticon-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- SIDEBAR SECTION END -->

    <!-- SEARCH MODAL SECTION START -->
    <div class="ul-search-form-wrapper flex-grow-1 flex-shrink-0">
        <button class="ul-search-closer"><i class="flaticon-close"></i></button>

        <form action="#" class="ul-search-form">
            <div class="ul-search-form-right">
                <input type="search" name="search" id="ul-search" placeholder="Rechercher ici">
                <button type="submit"><span class="icon"><i class="flaticon-search"></i></span></button>
            </div>
        </form>
    </div>
    <!-- SEARCH MODAL SECTION END -->

    <!-- HEADER SECTION START -->
    <header class="ul-header">
        <div class="ul-header-bottom to-be-sticky">
            <div class="ul-header-bottom-wrapper ul-header-container">
                <div class="logo-container">
                    <a href="{{ route('home') }}" class="d-inline-block">
                        <img src="{{ asset('assets/img/lg.png') }}" height="50px" width="50px" alt="Espoir Vie ASBL"
                            class="logo"></a>
                </div>

                <!-- header nav -->
                <div class="ul-header-nav-wrapper">
                    <div class="to-go-to-sidebar-in-mobile">
                        <nav class="ul-header-nav">
                            <a href="{{ route('home') }}">Accueil</a>
                            <a href="{{ route('about') }}">À propos</a>
                            <a href="{{ route('events') }}">Événement</a>
                            <a href="{{ route('donate') }}">Faire un don</a>
                            <a href="{{ route('contact') }}">Nous contacter</a>
                        </nav>
                    </div>
                </div>

                <!-- actions -->
                <div class="ul-header-actions">
                    <button class="ul-header-search-opener"><i class="flaticon-search"></i></button>
                    <a href="{{ route('donate') }}" class="ul-btn d-sm-inline-flex d-none"><i
                            class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don</a>
                    <button class="ul-header-sidebar-opener d-lg-none d-inline-flex"><i
                            class="flaticon-menu"></i></button>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER SECTION END -->


    <!-- Main Content -->
    <main class="overflow-hidden">
        @yield('content')
    </main>

    <!-- FOOTER SECTION START -->
    <footer class="ul-footer">
        <div class="ul-footer-top">
            <div class="ul-footer-container">
                <div class="ul-footer-top-contact-infos">
                    <!-- single info -->
                    <div class="ul-footer-top-contact-info">
                        <!-- icon -->
                        <div class="ul-footer-top-contact-info-icon">
                            <div class="ul-footer-top-contact-info-icon-inner">
                                <i class="flaticon-pin"></i>
                            </div>
                        </div>
                        <!-- txt -->
                        <div class="ul-footer-top-contact-info-txt">
                            <span class="ul-footer-top-contact-info-label">Adresse</span>
                            <h5 class="ul-footer-top-contact-info-address">4648 Rocky Road Philadelphia PA, 1920</h5>
                        </div>
                    </div>

                    <!-- single info -->
                    <div class="ul-footer-top-contact-info">
                        <!-- icon -->
                        <div class="ul-footer-top-contact-info-icon">
                            <div class="ul-footer-top-contact-info-icon-inner">
                                <i class="flaticon-email"></i>
                            </div>
                        </div>
                        <!-- txt -->
                        <div class="ul-footer-top-contact-info-txt">
                            <span class="ul-footer-top-contact-info-label">Envoyer un email</span>
                            <h5 class="ul-footer-top-contact-info-address"><a
                                    href="mailto:info@exmple.com">info@exmple.com</a></h5>
                        </div>
                    </div>

                    <!-- single info -->
                    <div class="ul-footer-top-contact-info">
                        <!-- icon -->
                        <div class="ul-footer-top-contact-info-icon">
                            <div class="ul-footer-top-contact-info-icon-inner">
                                <i class="flaticon-telephone-call-1"></i>
                            </div>
                        </div>
                        <!-- txt -->
                        <div class="ul-footer-top-contact-info-txt">
                            <span class="ul-footer-top-contact-info-label">Appel d'urgence</span>
                            <h5 class="ul-footer-top-contact-info-address"><a href="tel:88012365499">+88 0123 654
                                    99</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ul-footer-middle">
            <div class="ul-footer-container">
                <div class="ul-footer-middle-wrapper wow animate__fadeInUp">
                    <div class="ul-footer-about">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/lg.png') }}"
                            height="80px" width="80px" alt="Espoir Vie ASBL" class="logo"></a>
                        <p class="ul-footer-about-txt">Espoir Vie ASBL est une organisation à but non lucratif dédiée à améliorer la vie des personnes dans le besoin. Ensemble, créons un avenir meilleur pour tous.</p>
                        <div class="ul-footer-socials">
                            <a href="#"><i class="flaticon-facebook"></i></a>
                            <a href="#"><i class="flaticon-twitter"></i></a>
                            <a href="#"><i class="flaticon-linkedin-big-logo"></i></a>
                            <a href="#"><i class="flaticon-youtube"></i></a>
                        </div>
                    </div>

                    <div class="ul-footer-widget">
                        <h3 class="ul-footer-widget-title">Liens rapides</h3>

                        <div class="ul-footer-widget-links">
                            <a href="{{ route('about') }}">À propos</a>
                            <a href="{{ route('events') }}">Événements</a>
                            <a href="{{ route('donate') }}">Faire un don</a>
                            <a href="{{ route('contact') }}">Nous contacter</a>
                        </div>
                    </div>

                    <div class="ul-footer-widget ul-footer-recent-posts">
                        <h3 class="ul-footer-widget-title">Articles récents</h3>

                        <div class="ul-blog-sidebar-posts">
                            <!-- single post -->
                            <div class="ul-blog-sidebar-post ul-footer-post">
                                <div class="img">
                                    <img src="assets/img/blog-2.jpg" alt="Post Image">
                                </div>

                                <div class="txt">
                                    <span class="date">
                                        <span class="icon"><i class="flaticon-calendar"></i></span>
                                        <span>May 12, 2025</span>
                                    </span>

                                    <h4 class="title"><a href="blog-details.html">There are many vario ns of passages
                                            of</a></h4>
                                </div>
                            </div>

                            <!-- single post -->
                            <div class="ul-blog-sidebar-post ul-footer-post">
                                <div class="img">
                                    <img src="assets/img/blog-1.jpg" alt="Post Image">
                                </div>

                                <div class="txt">
                                    <span class="date">
                                        <span class="icon"><i class="flaticon-calendar"></i></span>
                                        <span>May 12, 2025</span>
                                    </span>

                                    <h4 class="title"><a href="blog-details.html">There are many vario ns of passages
                                            of</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ul-footer-widget ul-nwsltr-widget">
                        <h3 class="ul-footer-widget-title">Nous contacter</h3>
                        <div class="ul-footer-widget-links ul-footer-contact-links">
                            <a href="mailto:info@example.com"><i class="flaticon-mail"></i> info@example.com</a>
                            <a href="tel:123-456-7890"><i class="flaticon-telephone-call"></i> 123-456-7890</a>
                        </div>
                        <form action="#" class="ul-nwsltr-form">
                            <div class="top">
                                <input type="email" name="email" id="nwsltr-email"
                                    placeholder="Votre adresse email" class="ul-nwsltr-input">
                                <button type="submit"><i class="flaticon-next"></i></button>
                            </div>

                            <div class="agreement">
                                <label for="nwsltr-agreement" class="ul-checkbox-wrapper">
                                    <input type="checkbox" name="agreement" id="nwsltr-agreement" hidden>
                                    <span class="ul-checkbox"><i class="flaticon-tick"></i></span>
                                    <span class="ul-checkbox-txt">J'accepte la <a href="#">Politique de confidentialité</a></span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer bottom -->
        <div class="ul-footer-bottom">
            <div class="ul-footer-container">
                <div class="ul-footer-bottom-wrapper">
                    <p class="copyright-txt">&copy;
                        <span id="footer-copyright-year"></span> Espoir Vie ASBL. Tous droits réservés.
                    </p>
                    <div class="ul-footer-bottom-nav"><a href="#">Conditions d'utilisation</a> <a
                            href="#">Politique de confidentialité</a></div>
                </div>
            </div>
        </div>

        <!-- vector -->
        <div class="ul-footer-vectors">
            <img src="{{ asset('assets/img/footer-vector-img.png') }}" alt="Image du footer" class="ul-footer-vector-1">
        </div>
    </footer>
    <!-- FOOTER SECTION END -->
    <!-- libraries JS -->
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide-extension-auto-scroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slim-select/slimselect.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/animate-wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splittype/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/mixitup/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fslightbox/fslightbox.js') }}"></script>
    <script src="{{ asset('assets/vendor/flatpickr/flatpickr.js') }}"></script>

    <!-- custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/tab.js') }}"></script>
    <script src="{{ asset('assets/js/accordion.js') }}"></script>
    <script src="{{ asset('assets/js/progressbar.js') }}"></script>
    <script src="{{ asset('assets/js/donate-form.js') }}"></script>
    </div>
</body>

</html>
