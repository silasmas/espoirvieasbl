<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Espoir Vie ASBL') }} - Connexion</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <x-vite-assets />
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-sky-50">
            <div class="flex flex-col items-center">
                <a href="/">
                    <img src="{{ asset('assets/img/lg.png') }}" alt="Espoir Vie ASBL" class="w-20 h-20 rounded-full shadow-md">
                </a>
                <p class="mt-3 text-sm text-sky-800 font-medium uppercase tracking-wide">
                    Espoir Vie ASBL
                </p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-sky-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
