@extends('layouts.public')

@section('title', 'Désabonnement de la newsletter - Espoir Vie ASBL')

@section('content')
    <x-breadcrumb 
        title="Désabonnement de la newsletter"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Désabonnement']
        ]"
    />

<!-- UNSUBSCRIBE SECTION START -->
<section class="ul-section-spacing">
    <div class="ul-container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="ul-contact-card" style="background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center;">
                    @if($success ?? false)
                        <div style="margin-bottom: 30px;">
                            <div style="width: 80px; height: 80px; background-color: #d4edda; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                <i class="flaticon-tick" style="font-size: 40px; color: #155724;"></i>
                            </div>
                            <h2 style="color: #0172b8; margin-bottom: 15px;">Désabonnement confirmé</h2>
                        </div>
                        <div style="background-color: #EFF6FF; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                            <p style="margin: 0; font-size: 16px; color: #333;">{{ $message ?? 'Vous avez été désabonné avec succès.' }}</p>
                            @if(isset($email))
                            <p style="margin: 10px 0 0 0; color: #666; font-size: 14px;">Email : <strong>{{ $email }}</strong></p>
                            @endif
                        </div>
                        <p style="color: #666; margin-bottom: 25px;">Vous ne recevrez plus nos emails. Nous sommes désolés de vous voir partir, mais vous pouvez vous réabonner à tout moment si vous changez d'avis.</p>
                        <div style="margin-top: 30px;">
                            <a href="{{ route('home') }}" class="ul-btn" style="margin-right: 10px;">
                                <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Retour à l'accueil
                            </a>
                            <a href="{{ route('contact') }}" class="ul-btn" style="background: transparent; color: #0172b8; border: 2px solid #0172b8;">
                                Nous contacter
                            </a>
                        </div>
                    @else
                        <div style="margin-bottom: 30px;">
                            <div style="width: 80px; height: 80px; background-color: #f8d7da; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                <i class="flaticon-close" style="font-size: 40px; color: #721c24;"></i>
                            </div>
                            <h2 style="color: #721c24; margin-bottom: 15px;">Erreur de désabonnement</h2>
                        </div>
                        <div style="background-color: #f8d7da; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                            <p style="margin: 0; font-size: 16px; color: #721c24;">{{ $message ?? 'Une erreur est survenue.' }}</p>
                        </div>
                        <p style="color: #666; margin-bottom: 25px;">Si vous souhaitez vous désabonner, veuillez utiliser le lien présent dans nos emails ou nous contacter directement.</p>
                        <div style="margin-top: 30px;">
                            <a href="{{ route('contact') }}" class="ul-btn">
                                <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous contacter
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- UNSUBSCRIBE SECTION END -->
@endsection
