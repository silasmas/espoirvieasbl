@extends('layouts.public')

@section('title', $article->title . ' - Espoir Vie ASBL')

@section('content')
    <x-breadcrumb
        title="{{ $article->title }}"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['route' => 'articles', 'label' => 'Articles'],
            ['label' => Str::limit($article->title, 30)]
        ]"
    />

    <!-- ARTICLE DETAIL SECTION START -->
    <section class="ul-section-spacing">
        <div class="ul-container">
            <div class="row">
                <!-- Article principal -->
                <div class="col-lg-8">
                    <article class="ul-blog-detail">
                        <!-- Image de l'article -->
                        <div class="ul-blog-detail-img" style="margin-bottom: 30px;">
                            @if($article->image)
                                @if(Str::startsWith($article->image, ['http://', 'https://']))
                                    <img src="{{ $article->image }}" alt="{{ $article->title }}" style="width: 100%; height: auto; border-radius: 10px;">
                                @else
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" style="width: 100%; height: auto; border-radius: 10px;">
                                @endif
                            @else
                                <img src="{{ asset('assets/img/blog-b-1.jpg') }}" alt="{{ $article->title }}" style="width: 100%; height: auto; border-radius: 10px;">
                            @endif
                        </div>

                        <!-- Meta informations -->
                        <div class="ul-blog-detail-meta" style="display: flex; gap: 20px; margin-bottom: 20px; flex-wrap: wrap;">
                            <div style="display: flex; align-items: center; gap: 8px; color: #666;">
                                <i class="flaticon-account" style="color: #0172b8;"></i>
                                <span>Par {{ $article->author_display_name }}</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px; color: #666;">
                                <i class="flaticon-calendar" style="color: #0172b8;"></i>
                                <span>{{ $article->published_at ? $article->published_at->translatedFormat('d F Y') : $article->created_at->translatedFormat('d F Y') }}</span>
                            </div>
                            @if($article->category)
                                <div style="display: flex; align-items: center; gap: 8px; color: #666;">
                                    <i class="flaticon-price-tag" style="color: #0172b8;"></i>
                                    <span>{{ $article->category }}</span>
                                </div>
                            @endif
                            <div style="display: flex; align-items: center; gap: 8px; color: #666;">
                                <i class="flaticon-view" style="color: #0172b8;"></i>
                                <span>{{ number_format($article->views_count) }} vues</span>
                            </div>
                        </div>

                        <!-- Titre -->
                        <h1 style="font-size: 32px; font-weight: 700; color: #333; margin-bottom: 20px; line-height: 1.3;">{{ $article->title }}</h1>

                        <!-- Extrait -->
                        @if($article->excerpt)
                            <p style="font-size: 18px; color: #555; font-style: italic; margin-bottom: 30px; padding: 20px; background: #f8f9fa; border-left: 4px solid #0172b8; border-radius: 0 8px 8px 0;">
                                {{ $article->excerpt }}
                            </p>
                        @endif

                        <!-- Contenu -->
                        <div class="ul-blog-detail-content" style="font-size: 16px; line-height: 1.8; color: #444;">
                            {!! $article->content !!}
                        </div>

                        <!-- Tags -->
                        @if($article->tags && count($article->tags) > 0)
                            <div class="ul-blog-detail-tags" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                                <strong style="color: #333;">Tags :</strong>
                                <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                                    @foreach($article->tags as $tag)
                                        <span style="display: inline-block; padding: 5px 15px; background: #f0f9ff; color: #0172b8; border-radius: 20px; font-size: 14px;">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Partage -->
                        <div class="ul-blog-detail-share" style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                            <strong style="color: #333; margin-right: 15px;">Partager cet article :</strong>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('article.show', $article->slug)) }}" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #3b5998; color: white; border-radius: 50%; margin-right: 10px; text-decoration: none;">
                                <i class="flaticon-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('article.show', $article->slug)) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #1da1f2; color: white; border-radius: 50%; margin-right: 10px; text-decoration: none;">
                                <i class="flaticon-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('article.show', $article->slug)) }}&title={{ urlencode($article->title) }}" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #0077b5; color: white; border-radius: 50%; text-decoration: none;">
                                <i class="flaticon-linkedin-big-logo"></i>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <aside style="padding-left: 30px;">
                        <!-- Articles récents -->
                        @if($recentArticles->count() > 0)
                            <div class="ul-sidebar-widget" style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); margin-bottom: 30px;">
                                <h3 style="font-size: 20px; font-weight: 600; color: #333; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #0172b8;">Articles récents</h3>
                                @foreach($recentArticles as $index => $recentArticle)
                                    <div style="display: flex; gap: 15px; {{ !$loop->last ? 'margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eee;' : '' }}">
                                        <div style="flex-shrink: 0; width: 80px; height: 80px; border-radius: 8px; overflow: hidden;">
                                            @if($recentArticle->image)
                                                @if(Str::startsWith($recentArticle->image, ['http://', 'https://']))
                                                    <img src="{{ $recentArticle->image }}" alt="{{ $recentArticle->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('storage/' . $recentArticle->image) }}" alt="{{ $recentArticle->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/img/blog-' . (($index % 3) + 1) . '.jpg') }}" alt="{{ $recentArticle->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('article.show', $recentArticle->slug) }}" style="display: block; font-size: 15px; font-weight: 500; color: #333; text-decoration: none; line-height: 1.4; margin-bottom: 5px;">
                                                {{ Str::limit($recentArticle->title, 50) }}
                                            </a>
                                            <span style="font-size: 13px; color: #888;">{{ $recentArticle->published_at ? $recentArticle->published_at->translatedFormat('d M Y') : $recentArticle->created_at->translatedFormat('d M Y') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Call to action -->
                        <div class="ul-sidebar-widget" style="background: linear-gradient(135deg, #0172b8 0%, #005a8c 100%); padding: 30px; border-radius: 10px; text-align: center; color: white;">
                            <h3 style="font-size: 22px; font-weight: 600; margin-bottom: 15px;">Soutenez nos actions</h3>
                            <p style="font-size: 15px; margin-bottom: 20px; opacity: 0.9;">Votre don peut changer des vies. Rejoignez-nous dans notre mission.</p>
                            <a href="{{ route('donate') }}" class="ul-btn" style="background: white; color: #0172b8; display: inline-flex; align-items: center; gap: 8px;">
                                <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don
                            </a>
                        </div>
                    </aside>
                </div>
            </div>

            <!-- Retour à la liste -->
            <div style="margin-top: 40px; text-align: center;">
                <a href="{{ route('articles') }}" class="ul-btn" style="background: #f8f9fa; color: #333;">
                    <i class="flaticon-back"></i> Retour aux articles
                </a>
            </div>
        </div>
    </section>
    <!-- ARTICLE DETAIL SECTION END -->
@endsection
