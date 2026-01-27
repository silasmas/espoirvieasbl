@component('mail::message')
# Bienvenue, {{ $user->name }} !

Merci d'avoir rejoint **Espoir Vie ASBL** en tant que donateur.

Voici les informations de votre compte :

- **Nom complet** : {{ $user->name }}
- **Email** : {{ $user->email }}
@if($user->phone)
- **Téléphone** : {{ $user->phone }}
@endif
@if($user->country)
- **Pays** : {{ $user->country }}
@endif
@if($user->donation_period)
- **Date / période de don** : {{ \Illuminate\Support\Carbon::parse($user->donation_period)->format('d/m/Y') }}
@endif
@if($user->donation_type === 'espece' && $user->donation_amount)
- **Type de don** : En espèces (argent)
- **Montant prévu** : {{ number_format($user->donation_amount, 2, ',', ' ') }} {{ $user->donation_currency ?? 'USD' }}
@elseif($user->donation_type === 'nature')
- **Type de don** : En nature (biens / matériel)
@if($user->donation_description)
- **Détail du don en nature** : {{ $user->donation_description }}
@endif
@endif

Un mot de passe a été généré pour vous :

- **Mot de passe provisoire** : `{{ $plainPassword }}`

Nous vous recommandons de vous connecter dès que possible et de modifier ce mot de passe depuis votre tableau de bord.

@component('mail::button', ['url' => route('login')])
Se connecter
@endcomponent

Merci encore pour votre confiance et votre générosité.

L'équipe **Espoir Vie ASBL**
@endcomponent

