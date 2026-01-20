@extends('layouts.public')

@section('title', $activity->title . ' - Espoir Vie ASBL')

@section('content')
    <!-- Hero Section with Event Image -->
    @if($activity->image)
        <div class="relative h-96 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $activity->image) }}');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                <div class="text-white">
                    <div class="mb-4">
                        @if($activity->status === 'ongoing')
                            <span class="inline-block bg-green-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                                En cours
                            </span>
                        @elseif($activity->status === 'completed')
                            <span class="inline-block bg-gray-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                                Terminé
                            </span>
                        @elseif($activity->status === 'planned')
                            <span class="inline-block bg-blue-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                                À venir
                            </span>
                        @endif
                        @if($activity->is_featured)
                            <span class="inline-block bg-yellow-500 text-white text-sm font-semibold px-4 py-2 rounded-full ml-3">
                                À l'affiche
                            </span>
                        @endif
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $activity->title }}</h1>
                    @if($activity->short_description)
                        <p class="text-xl text-gray-100 max-w-3xl">{{ $activity->short_description }}</p>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="mb-4">
                    @if($activity->status === 'ongoing')
                        <span class="inline-block bg-green-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                            En cours
                        </span>
                    @elseif($activity->status === 'completed')
                        <span class="inline-block bg-gray-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                            Terminé
                        </span>
                    @elseif($activity->status === 'planned')
                        <span class="inline-block bg-blue-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                            À venir
                        </span>
                    @endif
                    @if($activity->is_featured)
                        <span class="inline-block bg-yellow-500 text-white text-sm font-semibold px-4 py-2 rounded-full ml-3">
                            À l'affiche
                        </span>
                    @endif
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ $activity->title }}</h1>
                @if($activity->short_description)
                    <p class="text-xl text-indigo-100 max-w-3xl">{{ $activity->short_description }}</p>
                @endif
            </div>
        </div>
    @endif

    <!-- Event Details -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Description -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Description</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($activity->description)) !!}
                    </div>
                </div>

                <!-- Results -->
                @if($activity->results)
                    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Résultats</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($activity->results)) !!}
                        </div>
                    </div>
                @endif

                <!-- Impact -->
                @if($activity->impact)
                    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Impact</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($activity->impact)) !!}
                        </div>
                        @if($activity->beneficiaries_count)
                            <div class="mt-6 p-4 bg-indigo-50 rounded-lg">
                                <p class="text-lg font-semibold text-indigo-900">
                                    Nombre de bénéficiaires : <span class="text-indigo-600">{{ number_format($activity->beneficiaries_count, 0, ',', ' ') }}</span>
                                </p>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Gallery -->
                @if($activity->images && count($activity->images) > 0)
                    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Galerie</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($activity->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" 
                                     alt="{{ $activity->title }}" 
                                     class="w-full h-64 object-cover rounded-lg hover:opacity-90 transition cursor-pointer">
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Video -->
                @if($activity->video_url)
                    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Vidéo</h2>
                        <div class="aspect-video w-full">
                            <iframe 
                                src="{{ $activity->video_url }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="w-full h-full rounded-lg">
                            </iframe>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Event Info Card -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6 sticky top-4">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Informations de l'événement</h3>
                    
                    <div class="space-y-4">
                        <!-- Date -->
                        <div class="flex items-start">
                            <svg class="h-5 w-5 mr-3 text-indigo-600 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Date</p>
                                <p class="text-gray-600">
                                    @if($activity->end_date)
                                        Du {{ \Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') }}<br>
                                        au {{ \Carbon\Carbon::parse($activity->end_date)->format('d/m/Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($activity->start_date)->format('d/m/Y') }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Location -->
                        @if($activity->location)
                            <div class="flex items-start">
                                <svg class="h-5 w-5 mr-3 text-indigo-600 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Lieu</p>
                                    <p class="text-gray-600">{{ $activity->location }}</p>
                                    @if($activity->country)
                                        <p class="text-gray-600">{{ $activity->country }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Category -->
                        @if($activity->category)
                            <div class="flex items-start">
                                <svg class="h-5 w-5 mr-3 text-indigo-600 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Catégorie</p>
                                    <p class="text-gray-600">{{ $activity->category }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Type -->
                        <div class="flex items-start">
                            <svg class="h-5 w-5 mr-3 text-indigo-600 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Type</p>
                                <p class="text-gray-600 capitalize">
                                    @if($activity->type === 'event')
                                        Événement
                                    @elseif($activity->type === 'project')
                                        Projet
                                    @elseif($activity->type === 'campaign')
                                        Campagne
                                    @elseif($activity->type === 'program')
                                        Programme
                                    @else
                                        Autre
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Budget Info -->
                    @if($activity->budget || $activity->amount_raised)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-900 mb-3">Financement</h4>
                            @if($activity->budget)
                                <div class="mb-2">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Budget prévu</span>
                                        <span class="font-semibold text-gray-900">{{ number_format($activity->budget, 2, ',', ' ') }} €</span>
                                    </div>
                                </div>
                            @endif
                            @if($activity->amount_raised)
                                <div class="mb-2">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Montant collecté</span>
                                        <span class="font-semibold text-green-600">{{ number_format($activity->amount_raised, 2, ',', ' ') }} €</span>
                                    </div>
                                </div>
                            @endif
                            @if($activity->budget && $activity->amount_raised)
                                <div class="mt-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ min(100, ($activity->amount_raised / $activity->budget) * 100) }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 text-center">
                                        {{ number_format(($activity->amount_raised / $activity->budget) * 100, 1) }}% du budget collecté
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Stats -->
                    <div class="mt-6 pt-6 border-t border-gray-200 grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-2xl font-bold text-indigo-600">{{ number_format($activity->views_count, 0, ',', ' ') }}</p>
                            <p class="text-xs text-gray-600">Vues</p>
                        </div>
                        @if($activity->likes_count > 0)
                            <div>
                                <p class="text-2xl font-bold text-indigo-600">{{ number_format($activity->likes_count, 0, ',', ' ') }}</p>
                                <p class="text-xs text-gray-600">Likes</p>
                            </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('events') }}" 
                           class="block w-full text-center bg-gray-100 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 transition">
                            ← Retour aux événements
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tags -->
    @if($activity->tags && count($activity->tags) > 0)
        <div class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($activity->tags as $tag)
                        <span class="bg-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium shadow-sm">
                            #{{ $tag }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
