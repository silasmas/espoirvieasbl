@extends('emails.layout')

@section('content')
    <h2 style="color: #0172b8; margin-bottom: 20px;">Merci pour votre intérêt !</h2>
    
    <p>Bonjour {{ $partner['name'] ?? 'Cher partenaire' }},</p>
    
    <p>Nous avons bien reçu votre demande de partenariat avec <strong>Espoir Vie ASBL</strong> et nous vous en remercions sincèrement.</p>
    
    <div class="highlight">
        <p style="margin: 0;"><strong>Organisation/Entreprise :</strong> {{ $partner['organization'] ?? 'Non spécifié' }}</p>
        <p style="margin: 10px 0 0 0;"><strong>Email de contact :</strong> {{ $partner['email'] ?? 'Non spécifié' }}</p>
        @if(isset($partner['phone']))
        <p style="margin: 10px 0 0 0;"><strong>Téléphone :</strong> {{ $partner['phone'] }}</p>
        @endif
        <p style="margin: 10px 0 0 0;"><strong>Date de la demande :</strong> {{ now()->format('d/m/Y à H:i') }}</p>
    </div>
    
    @if(isset($partner['message']))
    <p style="margin-top: 20px;"><strong>Votre message :</strong></p>
    <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin: 15px 0;">
        <p style="margin: 0; white-space: pre-wrap;">{{ $partner['message'] }}</p>
    </div>
    @endif
    
    <p>Notre équipe va étudier votre demande avec attention et vous contactera dans les plus brefs délais pour discuter des possibilités de collaboration.</p>
    
    <p>Nous sommes toujours à la recherche de partenaires engagés qui partagent nos valeurs et notre vision d'un monde meilleur. Votre intérêt est précieux pour nous.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('about') }}" class="button">En savoir plus sur nous</a>
    </div>
    
    <p style="margin-top: 30px;">Pour toute question supplémentaire, n'hésitez pas à <a href="{{ $contactUrl ?? route('contact') }}" style="color: #0172b8; text-decoration: underline;">nous contacter</a>.</p>
    
    <p style="margin-top: 30px;">Dans l'attente d'une collaboration fructueuse,<br>
    <strong>L'équipe Espoir Vie ASBL</strong></p>
@endsection
