@extends('layouts.public')

@section('title', 'Nous contacter - Espoir Vie ASBL')

@section('content')

 <!-- BREADCRUMBS SECTION START -->
 <section class="ul-breadcrumb ul-section-spacing">
    <div class="ul-container">
        <h2 class="ul-breadcrumb-title">Nous contacter</h2>
        <ul class="ul-breadcrumb-nav">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><span class="separator"><i class="flaticon-right"></i></span></li>
            <li>Nous contacter</li>
        </ul>
    </div>
</section>
<!-- BREADCRUMBS SECTION END -->


<!-- CONTACT INFOS SECTION START -->
<div class="ul-contact-infos">
    <div class="ul-section-spacing ul-container">
        <div class="row row-cols-md-3 row-cols-2 row-cols-xxs-1 ul-bs-row">
            <!-- single info -->
            <div class="col">
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-phone-call"></i></div>
                    <div class="txt">
                        <span class="title">Numéro de téléphone</span>
                        <a href="tel:+442045770077">+44 204 577 0077</a>
                    </div>
                </div>
            </div>
            <!-- single info -->
            <div class="col">
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-comment"></i></div>
                    <div class="txt">
                        <span class="title">Adresse email</span>
                        <a href="mailto:info@espoirvieasbl.org">info@espoirvieasbl.org</a>
                    </div>
                </div>
            </div>
            <!-- single info -->
            <div class="col">
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-location"></i></div>
                    <div class="txt">
                        <span class="title">Adresse du bureau</span>
                        <span class="descr">Bruxelles, Belgique</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT INFOS SECTION END -->


<!-- MAPS SECTION START -->
<div class="ul-contact-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4273.369923927683!2d89.24843545559786!3d25.755317550773302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e32e0754341e5f%3A0xa50209e1e2d5aed5!2sRangpur%20Zoo!5e0!3m2!1sen!2sbd!4v1736854209235!5m2!1sen!2sbd" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- MAPS SECTION END -->


<!-- CONTACT SECTION START -->
<section class="ul-inner-contact ul-section-spacing">
    <div class="ul-section-heading justify-content-center text-center">
        <div>
            <span class="ul-section-sub-title">Nous contacter</span>
            <h2 class="ul-section-title">N'hésitez pas à nous écrire à tout moment</h2>
        </div>
    </div>

    <div class="ul-inner-contact-container">
        <!-- Zone de notification -->
        <div id="contact-notification" class="contact-notification" style="display: none;"></div>

        <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="ul-contact-form ul-form">
            @csrf
            <div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="name" id="ul-contact-name" placeholder="Votre nom" required>
                        <span class="error-message" id="error-name"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="email" name="email" id="ul-contact-email" placeholder="Adresse email" required>
                        <span class="error-message" id="error-email"></span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="subject" id="ul-contact-subject" placeholder="Sujet" required>
                        <span class="error-message" id="error-subject"></span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <textarea name="message" id="ul-contact-msg" placeholder="Tapez votre message" rows="6" required></textarea>
                        <span class="error-message" id="error-message"></span>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" id="contact-submit-btn" class="ul-btn">
                        <i class="flaticon-fast-forward-double-right-arrows-symbol"></i>
                        <span id="btn-text">Envoyer le message</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- CONTACT SECTION END -->

<style>
    .async-notification,
    .contact-notification {
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-weight: 500;
        animation: slideDown 0.3s ease-out;
    }

    .async-notification.success,
    .contact-notification.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .async-notification.error,
    .contact-notification.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .error-message {
        display: block;
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }

    .form-group input.error,
    .form-group textarea.error {
        border-color: #dc3545;
    }

    #contact-submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
