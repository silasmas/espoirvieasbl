@extends('emails.layout')

@section('content')
    <h2 style="color: #0172b8; margin-bottom: 20px;">Votre message a bien été reçu</h2>
    
    <p>Bonjour {{ $contactMessage->name }},</p>
    
    <p>Nous avons bien reçu votre message et nous vous en remercions. Notre équipe vous répondra dans les plus brefs délais.</p>
    
    <div class="highlight">
        <p style="margin: 0;"><strong>Sujet :</strong> {{ $contactMessage->subject }}</p>
        <p style="margin: 10px 0 0 0;"><strong>Date d'envoi :</strong> {{ $contactMessage->created_at->format('d/m/Y à H:i') }}</p>
    </div>
    
    <p style="margin-top: 20px;"><strong>Récapitulatif de votre message :</strong></p>
    <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin: 15px 0;">
        <p style="margin: 0; white-space: pre-wrap;">{{ $contactMessage->message }}</p>
    </div>
    
    <p>En attendant notre réponse, n'hésitez pas à consulter nos <a href="{{ route('events') }}" style="color: #0172b8; text-decoration: underline;">événements à venir</a> ou nos <a href="{{ route('about') }}" style="color: #0172b8; text-decoration: underline;">activités en cours</a>.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $contactUrl ?? route('contact') }}" class="button">Visiter notre site</a>
    </div>
    
    <p style="margin-top: 30px;">Merci de votre confiance,<br>
    <strong>L'équipe Espoir Vie ASBL</strong></p>
@endsection
