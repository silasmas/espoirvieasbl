@extends('layouts.public')

@section('title', 'Faire un don - Espoir Vie ASBL')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')

    <x-breadcrumb
        title="Nos projets"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Faire un don']
        ]"
    />


<!-- DONTATIONS SECTION START -->
<section class="ul-section-spacing overflow-hidden">
    <!-- DONTATIONS Grid -->
    <div class="ul-container wow animate__fadeInUp">
        @if($activities->count() > 0)
        <div class="row ul-bs-row row-cols-xl-4 row-cols-md-3 row-cols-2 row-cols-xxs-1">
            @foreach($activities as $activity)
            <!-- single item -->
            <div class="col">
                <div class="ul-donation ul-donation--inner">
                    <div class="ul-donation-img">
                        @if($activity->image)
                            <img src="{{ activity_image_url($activity->image) }}" alt="{{ $activity->title }}" style="width: 282px; height: 188px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/img/donation-1.jpg') }}" alt="{{ $activity->title }}" style="width: 282px; height: 188px; object-fit: cover;">
                        @endif
                        @if($activity->category)
                        <span class="tag">{{ $activity->category }}</span>
                        @endif
                    </div>
                    <div class="ul-donation-txt">
                        @if($activity->budget > 0)
                        @php
                            $progressPercentage = min(100, (($activity->amount_raised ?? 0) / $activity->budget) * 100);
                        @endphp
                        <div class="ul-donation-progress">
                            <div class="donation-progress-container ul-progress-container">
                                <div class="donation-progressbar ul-progressbar" data-ul-progress-value="{{ round($progressPercentage) }}">
                                    <div class="donation-progress-label ul-progress-label"></div>
                                </div>
                            </div>
                            <div class="ul-donation-progress-labels">
                                <span class="ul-donation-progress-label">Collecté : {{ number_format($activity->amount_raised ?? 0, 0, ',', ' ') }} €</span>
                                <span class="ul-donation-progress-label">Objectif : {{ number_format($activity->budget, 0, ',', ' ') }} €</span>
                            </div>
                        </div>
                        @endif
                        <a href="{{ route('donate.detail', $activity) }}" class="ul-donation-title">{{ $activity->title }}</a>
                        <p class="ul-donation-descr">{{ Str::limit($activity->short_description ?? $activity->description ?? 'Aidez-nous à réaliser ce projet', 100) }}</p>
                        <a href="{{ route('donate.detail', $activity) }}" class="ul-donation-btn">Faire un don <i class="flaticon-up-right-arrow"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center" style="padding: 60px 20px;">
            <p style="font-size: 18px; color: #666;">Aucun projet disponible pour le moment.</p>
            <a href="{{ route('home') }}" class="ul-btn" style="margin-top: 20px;">
                <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Retour à l'accueil
            </a>
        </div>
        @endif
    </div>


    <!-- pagination -->
    @if($activities->hasPages())
        {{ $activities->links('pagination.custom') }}
    @endif
</section>
<!-- DONTATIONS SECTION END -->
@endsection

