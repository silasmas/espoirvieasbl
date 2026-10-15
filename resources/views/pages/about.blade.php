@extends('layouts.public')

@section('title', 'À propos - Espoir Vie ASBL')

@section('content')
    <x-breadcrumb
        title="À propos de nous"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'À propos']
        ]"
    />

    @if(site_visible('about.intro'))
        <section class="ul-about ul-section-spacing wow animate__fadeInUp">
            <div class="ul-container">
                <div class="row row-cols-md-2 row-cols-1 align-items-center gy-4 ul-about-row">
                    <div class="col">
                        <div class="ul-about-imgs">
                            <div class="img-wrapper">
                                <img src="{{ site_image('about.intro', 'assets/img/about-img.png') }}" alt="{{ site_text('about.intro', 'title', 'À propos') }}">
                            </div>
                            <div class="ul-about-imgs-vectors">
                                <img src="{{ asset('assets/img/about-img-vector-1.svg') }}" alt="Illustration" class="vector-1">
                                <img src="{{ asset('assets/img/about-img-vector-2.svg') }}" alt="Illustration" class="vector-2">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="ul-about-txt">
                            <span class="ul-section-sub-title ul-section-sub-title--2">{{ site_text('about.intro', 'subtitle', 'À propos de nous') }}</span>
                            <h2 class="ul-section-title">{{ site_text('about.intro', 'title') }}</h2>
                            <p class="ul-section-descr">{{ site_text('about.intro', 'body') }}</p>
                            <div class="ul-about-block">
                                <div class="block-left">
                                    <div class="block-heading">
                                        <div class="icon"><i class="flaticon-love"></i></div>
                                        <h3 class="block-title">{{ site_extra('about.intro', 'block_title', 'Notre devise') }}</h3>
                                    </div>
                                    <ul class="block-list">
                                        @foreach(site_items('about.intro') as $item)
                                            @if(($item['text'] ?? '') !== '')
                                                <li>{{ $item['text'] }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="block-right"><img src="{{ asset('assets/img/about-block-img.jpg') }}" alt="Illustration à propos"></div>
                            </div>
                            <div class="ul-about-bottom">
                                <a href="{{ site_link('about.intro', 'donate') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ site_text('about.intro', 'button_label', 'Faire un don') }}</a>
                                @if(site_phone() !== '')
                                    <div class="ul-about-call">
                                        <div class="icon"><i class="flaticon-telephone-call"></i></div>
                                        <div class="txt">
                                            <span class="call-title">Appelez-nous</span>
                                            <a href="tel:{{ preg_replace('/\s+/', '', site_phone()) }}">{{ site_phone() }}</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ul-about-vectors">
                <img src="{{ asset('assets/img/about-vector-1.png') }}" alt="Vecteur" class="vector-1">
            </div>
        </section>
    @endif

    @include('parties.site-stats')

    @if(site_visible('about.mission') || site_visible('about.vision') || site_visible('about.history'))
        <section class="ul-about-tabs ul-events ul-section-spacing pt-0">
            <div class="ul-container">
                <div class="ul-section-heading align-items-center wow animate__fadeInUp">
                    <div class="left">
                        <span class="ul-section-sub-title">Depuis 2000</span>
                        <h2 class="ul-section-title text-white">Mission, vision et histoire</h2>
                    </div>
                    <a href="{{ route('donate') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Faire un don</a>
                </div>
                <div class="tab-group">
                    <div class="ul-about-tabs-wrapper">
                        @if(site_visible('about.mission'))
                            <div id="tab-mission" class="ul-tab ul-about-tab active">
                                <div class="ul-about-tab-img">
                                    <img src="{{ site_image('about.mission', 'assets/img/mission-img.jpg') }}" alt="{{ site_text('about.mission', 'title', 'Notre mission') }}">
                                </div>
                                <div class="ul-about-tab-txt">
                                    <h3 class="ul-about-tab-title">{{ site_text('about.mission', 'title', 'Notre mission') }}</h3>
                                    <p class="ul-about-tab-descr">{!! nl2br(e(site_text('about.mission', 'body'))) !!}</p>
                                    <ul class="ul-about-tab-list">
                                        @foreach(site_items('about.mission') as $item)
                                            @if(($item['text'] ?? '') !== '')
                                                <li>{{ $item['text'] }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if(site_visible('about.vision'))
                            <div id="tab-vision" class="ul-tab ul-about-tab">
                                <div class="ul-about-tab-img">
                                    <img src="{{ site_image('about.vision', 'assets/img/why-join.jpg') }}" alt="{{ site_text('about.vision', 'title', 'Notre vision') }}">
                                </div>
                                <div class="ul-about-tab-txt">
                                    <h3 class="ul-about-tab-title">{{ site_text('about.vision', 'title', 'Notre vision') }}</h3>
                                    <p class="ul-about-tab-descr">{!! nl2br(e(site_text('about.vision', 'body'))) !!}</p>
                                    <ul class="ul-about-tab-list">
                                        @foreach(site_items('about.vision') as $item)
                                            @if(($item['text'] ?? '') !== '')
                                                <li>{{ $item['text'] }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if(site_visible('about.history'))
                            <div id="tab-history" class="ul-tab ul-about-tab">
                                <div class="ul-about-tab-img">
                                    <img src="{{ site_image('about.history', 'assets/img/contact-img.jpg') }}" alt="{{ site_text('about.history', 'title', 'Notre histoire') }}">
                                </div>
                                <div class="ul-about-tab-txt">
                                    <h3 class="ul-about-tab-title">{{ site_text('about.history', 'title', 'Notre histoire') }}</h3>
                                    <p class="ul-about-tab-descr">{!! nl2br(e(site_text('about.history', 'body'))) !!}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="tab-navs ul-about-tabs-nav">
                        @if(site_visible('about.mission'))
                            <button class="tab-nav active" data-tab="tab-mission">{{ site_text('about.mission', 'title', 'Notre mission') }}</button>
                        @endif
                        @if(site_visible('about.vision'))
                            <button class="tab-nav" data-tab="tab-vision">{{ site_text('about.vision', 'title', 'Notre vision') }}</button>
                        @endif
                        @if(site_visible('about.history'))
                            <button class="tab-nav" data-tab="tab-history">{{ site_text('about.history', 'title', 'Notre histoire') }}</button>
                        @endif
                    </div>
                </div>
                <div class="ul-events-vectors">
                    <img src="{{ asset('assets/img/events-vector-2.svg') }}" alt="" class="vector-2">
                </div>
            </div>
        </section>
    @endif

    @include('parties.text-list', ['key' => 'about.objectives'])
    @include('parties.text-list', ['key' => 'about.domains'])
    @include('parties.text-list', ['key' => 'about.actions'])
    @include('parties.text-list', ['key' => 'about.perspectives'])
    @include('parties.text-list', ['key' => 'about.partner'])

    @if(site_visible('about.team'))
        <section class="ul-team ul-section-spacing">
            <div class="ul-container">
                <div class="ul-section-heading justify-content-between">
                    <div class="left">
                        <span class="ul-section-sub-title">{{ site_text('about.team', 'subtitle', 'Notre équipe') }}</span>
                        <h2 class="ul-section-title">{{ site_text('about.team', 'title', 'Les personnes qui portent Espoir Vie') }}</h2>
                    </div>
                    <div>
                        <a href="{{ site_link('about.team', 'contact') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ site_text('about.team', 'button_label', 'Nous rejoindre') }}</a>
                    </div>
                </div>
                <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-team-row justify-content-center">
                    @forelse($teamMembers as $index => $member)
                        <div class="col">
                            <div class="ul-team-member">
                                <div class="ul-team-member-img">
                                    @if($member->photo)
                                        <img src="{{ \Illuminate\Support\Str::startsWith($member->photo, ['http://', 'https://']) ? $member->photo : asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/member-' . (($index % 4) + 1) . '.jpg') }}" alt="{{ $member->name }}">
                                    @endif
                                </div>
                                <div class="ul-team-member-info">
                                    <h3 class="ul-team-member-name"><a href="{{ route('team') }}">{{ $member->name }}</a></h3>
                                    <p class="ul-team-member-designation">{{ $member->position ?? 'Membre' }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="ul-section-descr">Les membres visibles se renseignent dans l'espace d'administration.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif

    @if(site_visible('about.cta'))
        <section class="ul-cta">
            <div class="ul-container">
                <span class="ul-section-sub-title">{{ site_text('about.cta', 'subtitle', 'Commencez à aider dès maintenant') }}</span>
                <h2 class="ul-cta-title">{{ site_text('about.cta', 'title', 'Les enfants vulnérables ont besoin de votre aide') }}</h2>
                <a href="{{ site_link('about.cta', 'donate') }}" class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> {{ site_text('about.cta', 'button_label', 'Faire un don') }}</a>
            </div>
            <img src="{{ asset('assets/img/cta-vector.svg') }}" alt="" class="ul-cta-vector">
        </section>
    @endif

    @if(site_visible('home.testimonials') && isset($testimonials) && $testimonials->count() > 0)
        <section class="ul-testimonial-2 ul-section-spacing">
            <div class="ul-container wow animate__fadeInUp">
                <div class="ul-section-heading">
                    <div>
                        <span class="ul-section-sub-title">{{ site_text('home.testimonials', 'subtitle', 'Témoignages') }}</span>
                        <h2 class="ul-section-title">{{ site_text('home.testimonials', 'title', 'Témoignages') }}</h2>
                    </div>
                </div>
                <div class="row ul-testimonial-2-row gy-4">
                    @foreach($testimonials as $testimonial)
                        <div class="col-md-6">
                            <div class="ul-review ul-review-2">
                                <p class="ul-review-descr">{{ $testimonial->content }}</p>
                                <div class="ul-review-bottom">
                                    <div class="ul-review-reviewer">
                                        <div>
                                            <h3 class="reviewer-name">{{ $testimonial->name }}</h3>
                                            <span class="reviewer-role">{{ $testimonial->role ?? 'Membre' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
