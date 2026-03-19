@extends('layouts.public')

@section('title', 'Se connecter - Espoir Vie ASBL')

@section('content')

    <x-breadcrumb
        title="Se connecter"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Se connecter']
        ]"
    />

<section class="ul-section-spacing">
    <div class="ul-section-heading justify-content-center text-center">
        <div>
            <span class="ul-section-sub-title">Connexion</span>
            <h2 class="ul-section-title">Connexion à votre espace donateur</h2>
            <p class="mt-3">Connectez-vous pour suivre vos dons, consulter vos reçus et vos rapports d'activités.</p>
        </div>
    </div>

    <div class="ul-container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="ul-auth-card">
                    @if (session('status'))
                        <div class="async-notification success mb-4">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="ul-donation-details-form">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Adresse email *" required autofocus autocomplete="username" class="form-control">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Mot de passe *" required autocomplete="current-password" class="form-control">
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                            <label class="ul-auth-remember">
                                <input type="checkbox" name="remember">
                                Se souvenir de moi
                            </label>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="ul-auth-forgot">Mot de passe oublié ?</a>
                            @endif
                        </div>
                        <div class="form-group" style="margin-top: 24px;">
                            <button type="submit" class="ul-auth-btn">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
