@extends('emails.layout')

@section('content')
    <h2 style="color: #0172b8; margin-bottom: 20px;">Bienvenue dans notre newsletter !</h2>
    
    <p>Bonjour,</p>
    
    <p>Nous sommes ravis de vous accueillir dans notre communauté de soutien ! Votre inscription à la newsletter d'<strong>Espoir Vie ASBL</strong> a été confirmée avec succès.</p>
    
    <div class="highlight">
        <p style="margin: 0;"><strong>Votre adresse email :</strong> {{ $subscription->email }}</p>
        <p style="margin: 10px 0 0 0;"><strong>Date d'inscription :</strong> {{ $subscription->subscribed_at->format('d/m/Y à H:i') }}</p>
    </div>
    
    <p>Vous recevrez désormais :</p>
    <ul>
        <li>Nos dernières actualités et événements</li>
        <li>Des informations sur nos projets en cours</li>
        <li>Des témoignages de ceux que nous aidons</li>
        <li>Des opportunités de participer à nos actions</li>
    </ul>
    
    <p>Merci de nous faire confiance et de soutenir notre mission de créer un avenir meilleur pour tous.</p>
    
    <p style="margin-top: 30px;">Cordialement,<br>
    <strong>L'équipe Espoir Vie ASBL</strong></p>
    
    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0; text-align: center;">
        <p style="font-size: 12px; color: #666;">Vous pouvez vous désabonner à tout moment en cliquant sur le lien en bas de cet email.</p>
    </div>
@endsection
