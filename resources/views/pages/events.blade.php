@extends('layouts.public')

@section('title', 'Événements - Espoir Vie ASBL')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Nos Événements
                </h1>
                <p class="text-xl md:text-2xl text-indigo-100">
                    Découvrez tous nos événements et activités à venir
                </p>
            </div>
        </div>
    </div>

    <!-- Events Grid -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        @if($events->count() > 0)
            <!-- Filters -->
            <div class="mb-8 flex flex-wrap gap-4 items-center justify-between">
                <div class="text-gray-700">
                    <span class="font-semibold">{{ $events->total() }}</span> 
                    événement{{ $events->total() > 1 ? 's' : '' }} trouvé{{ $events->total() > 1 ? 's' : '' }}
                </div>
            </div>

            <!-- Events List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                @foreach($events as $event)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300 flex flex-col">
                        <!-- Event Image -->
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 alt="{{ $event->title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-r from-indigo-400 to-purple-400 flex items-center justify-center">
                                <span class="text-white text-4xl font-bold">{{ substr($event->title, 0, 1) }}</span>
                            </div>
                        @endif

                        <!-- Event Content -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Status Badge -->
                            <div class="mb-3">
                                @if($event->status === 'ongoing')
                                    <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        En cours
                                    </span>
                                @elseif($event->status === 'completed')
                                    <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        Terminé
                                    </span>
                                @elseif($event->status === 'planned')
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        À venir
                                    </span>
                                @endif
                                @if($event->is_featured)
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full ml-2">
                                        À l'affiche
                                    </span>
                                @endif
                            </div>

                            <!-- Event Title -->
                            <h3 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">
                                {{ $event->title }}
                            </h3>

                            <!-- Event Description -->
                            <p class="text-gray-600 mb-4 flex-1 line-clamp-3">
                                {{ Str::limit($event->short_description ?? $event->description, 120) }}
                            </p>

                            <!-- Event Meta -->
                            <div class="space-y-2 mb-4 text-sm text-gray-500">
                                <!-- Date -->
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>
                                        @if($event->end_date)
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}
                                        @endif
                                    </span>
                                </div>

                                <!-- Location -->
                                @if($event->location)
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="truncate">{{ $event->location }}</span>
                                        @if($event->country)
                                            <span>, {{ $event->country }}</span>
                                        @endif
                                    </div>
                                @endif

                                <!-- Category -->
                                @if($event->category)
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        <span>{{ $event->category }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- View Details Button -->
                            <a href="{{ route('events.show', $event) }}" 
                               class="block w-full text-center bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                                Voir les détails
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $events->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Aucun événement pour le moment</h3>
                <p class="text-gray-600 mb-8">
                    Nous n'avons pas d'événements disponibles actuellement. Revenez bientôt pour découvrir nos prochains événements !
                </p>
                <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Retour à l'accueil
                </a>
            </div>
        @endif
    </div>

    <!-- Call to Action -->
    @if($events->count() > 0)
        <div class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Restez informé</h2>
                <p class="text-xl text-gray-700 mb-8 max-w-2xl mx-auto">
                    Ne manquez aucun de nos événements. Suivez-nous pour être informé en premier.
                </p>
                <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Retour à l'accueil
                </a>
            </div>
        </div>
    @endif
@endsection
