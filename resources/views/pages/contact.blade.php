@extends('layouts.public')

@section('title', 'Nous contacter - Espoir Vie ASBL')

@section('content')

    <x-breadcrumb
        title="Nous contacter"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Nous contacter']
        ]"
    />


<!-- CONTACT INFOS SECTION START -->
<div class="ul-contact-infos">
    <div class="ul-section-spacing ul-container">
        <div class="row row-cols-md-3 row-cols-2 row-cols-xxs-1 ul-bs-row">
            <!-- single info -->
            @if(site_phone() !== '')
            <div class="col">
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-phone-call"></i></div>
                    <div class="txt">
                        <span class="title">Numéro de téléphone</span>
                        <a href="tel:{{ preg_replace('/\s+/', '', site_phone()) }}">{{ site_phone() }}</a>
                    </div>
                </div>
            </div>
            @endif
            <div class="col">
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-comment"></i></div>
                    <div class="txt">
                        <span class="title">Adresse email</span>
                        <a href="mailto:{{ site_email() }}">{{ site_email() }}</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="ul-contact-info">
                    <div class="icon"><i class="flaticon-location"></i></div>
                    <div class="txt">
                        <span class="title">Adresse</span>
                        <span class="descr">{{ site_address() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT INFOS SECTION END -->


<!-- MAPS SECTION START -->
@if(site_visible('contact.map'))
<div class="ul-contact-map">
    <iframe src="{{ site_map_embed() }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
@endif
<!-- MAPS SECTION END -->


<!-- CONTACT SECTION START -->
<section class="ul-inner-contact ul-section-spacing">
    @include('parties.page-intro', ['key' => 'contact.intro'])

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

@endsection
