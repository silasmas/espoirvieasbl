@extends('layouts.public')

@section('title', 'Articles - Espoir Vie ASBL')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <x-breadcrumb
        title="Nos articles"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Articles']
        ]"
    />

    <!-- ARTICLES SECTION START -->
    <section class="ul-blogs ul-section-spacing">
        <div class="ul-container">
            <!-- Heading -->
            <div class="ul-section-heading justify-content-center text-center" style="margin-bottom: 40px;">
                <div class="left">
                    <span class="ul-section-sub-title">Notre blog</span>
                    <h2 class="ul-section-title">Découvrez nos dernières actualités</h2>
                    <p class="ul-section-descr">Restez informé de nos actions, de nos projets en cours et des témoignages de ceux que nous aidons.</p>
                </div>
            </div>

            @if($articles->count() > 0)
                <div class="row row-cols-md-3 row-cols-sm-2 row-cols-1 g-4">
                    @foreach($articles as $index => $article)
                        <div class="col wow animate__fadeInUp">
                            <div class="ul-blog">
                                <div class="ul-blog-img">
                                @if($article->image)
                                    @if(Str::startsWith($article->image, ['http://', 'https://']))
                                        <img src="{{ $article->image }}" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/img/blog-' . (($index % 3) + 1) . '.jpg') }}" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                                @endif
                                    <div class="date">
                                        <span class="number">{{ $article->published_at ? $article->published_at->format('d') : $article->created_at->format('d') }}</span>
                                        <span class="txt">{{ $article->published_at ? $article->published_at->translatedFormat('M') : $article->created_at->translatedFormat('M') }}</span>
                                    </div>
                                </div>
                                <div class="ul-blog-txt">
                                    <div class="ul-blog-infos">
                                        <div class="ul-blog-info">
                                            <span class="icon"><i class="flaticon-account"></i></span>
                                            <span class="text">Par {{ $article->author_display_name }}</span>
                                        </div>
                                        @if($article->category)
                                            <div class="ul-blog-info">
                                                <span class="icon"><i class="flaticon-price-tag"></i></span>
                                                <span class="text">{{ $article->category }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('article.show', $article->slug) }}" class="ul-blog-title">{{ Str::limit($article->title, 60) }}</a>
                                    @if($article->excerpt)
                                        <p class="ul-blog-excerpt" style="font-size: 14px; color: #666; margin: 10px 0;">{{ Str::limit($article->excerpt, 100) }}</p>
                                    @endif
                                    <a href="{{ route('article.show', $article->slug) }}" class="ul-blog-btn">Lire la suite <span class="icon"><i class="flaticon-next"></i></span></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- pagination -->
                @if($articles->hasPages())
                    <div style="margin-top: 40px;">
                        {{ $articles->links('pagination.custom') }}
                    </div>
                @endif
            @else
                <div class="text-center" style="padding: 60px 20px;">
                    <p style="font-size: 18px; color: #666;">Aucun article disponible pour le moment.</p>
                    <a href="{{ route('home') }}" class="ul-btn" style="margin-top: 20px;">
                        <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Retour à l'accueil
                    </a>
                </div>
            @endif
        </div>
    </section>
    <!-- ARTICLES SECTION END -->
@endsection
