@extends('layouts.public')

@section('title', 'À propos - Espoir Vie ASBL')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    À propos de nous
                </h1>
                <p class="text-xl md:text-2xl text-indigo-100">
                    Découvrez notre mission, notre vision et nos valeurs
                </p>
            </div>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Notre Mission</h2>
                <p class="text-lg text-gray-700 mb-4">
                    Espoir Vie ASBL est une organisation à but non lucratif dédiée à l'amélioration des conditions de vie 
                    des personnes dans le besoin. Nous croyons fermement que chaque individu mérite une chance de vivre 
                    dans la dignité et avec espoir en l'avenir.
                </p>
                <p class="text-lg text-gray-700 mb-4">
                    Notre mission est de créer un impact positif durable dans les communautés que nous servons en 
                    mettant en place des programmes et des activités qui répondent aux besoins essentiels tout en 
                    favorisant l'autonomie et le développement.
                </p>
            </div>
            <div class="bg-indigo-50 rounded-lg p-8">
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">Nos Valeurs</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-indigo-600 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h4 class="font-semibold text-gray-900">Transparence</h4>
                            <p class="text-gray-600">Nous nous engageons à être transparents dans toutes nos actions et notre gestion.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-indigo-600 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <div>
                            <h4 class="font-semibold text-gray-900">Solidarité</h4>
                            <p class="text-gray-600">Nous croyons en la force de la communauté et de l'entraide.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-indigo-600 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <div>
                            <h4 class="font-semibold text-gray-900">Impact</h4>
                            <p class="text-gray-600">Chaque action que nous entreprenons vise à créer un impact mesurable et durable.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-indigo-600 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <div>
                            <h4 class="font-semibold text-gray-900">Innovation</h4>
                            <p class="text-gray-600">Nous cherchons constamment des solutions innovantes pour répondre aux défis.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Vision Section -->
    <div class="bg-gray-100">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Vision</h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    Nous aspirons à un monde où chaque personne a accès aux ressources essentielles, 
                    à l'éducation et aux opportunités nécessaires pour réaliser son plein potentiel.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="bg-white rounded-lg p-6 shadow-md text-center">
                    <div class="bg-indigo-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Communauté</h3>
                    <p class="text-gray-600">Construire des communautés fortes et unies qui se soutiennent mutuellement.</p>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-md text-center">
                    <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Éducation</h3>
                    <p class="text-gray-600">Promouvoir l'éducation comme clé du développement et de l'autonomie.</p>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-md text-center">
                    <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Durabilité</h3>
                    <p class="text-gray-600">Créer des solutions durables qui perdurent dans le temps.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- What We Do Section -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Ce que nous faisons</h2>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                Nos activités couvrent plusieurs domaines essentiels pour améliorer la qualité de vie des personnes que nous aidons.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-indigo-600 text-3xl mb-4">🎯</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Projets</h3>
                <p class="text-gray-600">Nous développons et gérons des projets à long terme qui ont un impact significatif.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-purple-600 text-3xl mb-4">📅</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Événements</h3>
                <p class="text-gray-600">Nous organisons régulièrement des événements pour sensibiliser et mobiliser.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-green-600 text-3xl mb-4">📢</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Campagnes</h3>
                <p class="text-gray-600">Nos campagnes visent à collecter des fonds et à sensibiliser le public.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="text-blue-600 text-3xl mb-4">📚</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Programmes</h3>
                <p class="text-gray-600">Nous mettons en place des programmes structurés pour répondre aux besoins spécifiques.</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-indigo-600 text-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Rejoignez notre mission</h2>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
                Ensemble, nous pouvons faire une différence réelle dans la vie de nombreuses personnes. 
                Découvrez nos événements et nos activités pour voir comment vous pouvez nous aider.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('events') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Voir nos événements
                </a>
                <a href="{{ route('home') }}" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition">
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
@endsection
