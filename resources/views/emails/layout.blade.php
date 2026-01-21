<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Espoir Vie ASBL' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .email-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #2563EB;
            margin-bottom: 30px;
        }
        .email-logo {
            max-width: 120px;
            height: auto;
            margin-bottom: 15px;
        }
        .email-title {
            color: #2563EB;
            font-size: 24px;
            margin-top: 20px;
            font-weight: bold;
        }
        .email-content {
            padding: 20px 0;
        }
        .email-footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #2563EB;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #1e40af;
        }
        .highlight {
            background-color: #EFF6FF;
            padding: 15px;
            border-left: 4px solid #2563EB;
            margin: 20px 0;
        }
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            .email-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('assets/img/lg.png') }}" alt="Espoir Vie ASBL" class="email-logo">
            <h1 class="email-title">Espoir Vie ASBL</h1>
        </div>

        <div class="email-content">
            @yield('content')
        </div>

        <div class="email-footer">
            <p><strong>Espoir Vie ASBL</strong></p>
            <p>Créons ensemble un avenir meilleur pour tous</p>
            <p>
                <a href="{{ config('app.url') }}" style="color: #2563EB;">{{ config('app.url') }}</a>
            </p>
            <p style="margin-top: 15px; font-size: 11px;">
                © {{ date('Y') }} Espoir Vie ASBL. Tous droits réservés.
            </p>
            <p style="margin-top: 10px;">
                @if(isset($unsubscribeUrl) && $unsubscribeUrl)
                <a href="{{ $unsubscribeUrl }}" style="color: #666; text-decoration: underline;">Se désabonner</a> |
                @endif
                @if(isset($contactUrl) && $contactUrl)
                <a href="{{ $contactUrl }}" style="color: #666; text-decoration: underline;">Nous contacter</a>
                @else
                <a href="{{ route('contact') }}" style="color: #666; text-decoration: underline;">Nous contacter</a>
                @endif
            </p>
        </div>
    </div>
</body>
</html>
