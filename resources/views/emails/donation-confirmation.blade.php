@extends('emails.layout')

@section('content')
    <h2 style="color: #2563EB; margin-bottom: 20px;">Merci pour votre générosité !</h2>
    
    <p>Bonjour {{ $donation['donor_name'] ?? 'Cher donateur' }},</p>
    
    <p>Nous souhaitons vous exprimer notre profonde gratitude pour votre généreux don en faveur d'<strong>Espoir Vie ASBL</strong>.</p>
    
    <div class="highlight">
        <p style="margin: 0;"><strong>Montant du don :</strong> {{ number_format($donation['amount'] ?? 0, 2, ',', ' ') }} {{ $donation['currency'] ?? 'EUR' }}</p>
        <p style="margin: 10px 0 0 0;"><strong>Date du don :</strong> {{ now()->format('d/m/Y à H:i') }}</p>
        @if(isset($donation['reference']))
        <p style="margin: 10px 0 0 0;"><strong>Référence :</strong> {{ $donation['reference'] }}</p>
        @endif
    </div>
    
    <p>Votre contribution nous permet de continuer à mener nos actions en faveur des personnes dans le besoin. Grâce à votre soutien, nous pouvons :</p>
    <ul>
        <li>Aider davantage de familles et d'enfants</li>
        <li>Développer nos projets humanitaires</li>
        <li>Créer un impact durable dans nos communautés</li>
    </ul>
    
    @if(isset($donation['recurring']) && $donation['recurring'])
    <p><strong>Note :</strong> Ce don fait partie d'un engagement récurrent. Nous vous remercions pour votre soutien continu.</p>
    @endif
    
    <p>Vous recevrez un reçu fiscal par email dans les prochains jours si applicable.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('home') }}" class="button">Découvrir nos actions</a>
    </div>
    
    <p style="margin-top: 30px;">Si vous avez des questions concernant votre don, n'hésitez pas à <a href="{{ $contactUrl ?? route('contact') }}" style="color: #2563EB; text-decoration: underline;">nous contacter</a>.</p>
    
    <p style="margin-top: 30px;">Avec toute notre reconnaissance,<br>
    <strong>L'équipe Espoir Vie ASBL</strong></p>
@endsection
