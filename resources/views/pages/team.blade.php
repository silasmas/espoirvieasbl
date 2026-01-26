@extends('layouts.public')

@section('title', 'Notre équipe - Espoir Vie ASBL')

@section('content')
    <x-breadcrumb
        title="Notre équipe"
        :items="[
            ['route' => 'home', 'label' => 'Accueil'],
            ['label' => 'Notre équipe']
        ]"
    />

    <!-- TEAM SECTION START -->
    <section class="ul-team ul-section-spacing">
        <div class="ul-container">
            <!-- Heading -->
            <div class="ul-section-heading justify-content-center text-center" style="margin-bottom: 50px;">
                <div class="left">
                    <span class="ul-section-sub-title">Notre équipe</span>
                    <h2 class="ul-section-title">Des professionnels dévoués à votre service</h2>
                    <p class="ul-section-descr" style="max-width: 700px; margin: 0 auto;">
                        Notre équipe est composée de personnes passionnées et dévouées qui travaillent chaque jour pour améliorer la vie de ceux qui en ont le plus besoin.
                    </p>
                </div>
            </div>

            @if($teamMembers->count() > 0)
                <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-team-row justify-content-center g-4">
                    @foreach($teamMembers as $index => $member)
                        <div class="col wow animate__fadeInUp" data-wow-delay="{{ $index * 0.1 }}s">
                            <div class="ul-team-member">
                                <div class="ul-team-member-img">
                                    @if($member->photo)
                                        @if(Str::startsWith($member->photo, ['http://', 'https://']))
                                            <img src="{{ $member->photo }}" alt="{{ $member->name }}">
                                        @else
                                            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/img/member-' . (($index % 4) + 1) . '.jpg') }}" alt="{{ $member->name }}">
                                    @endif
                                    @if($member->hasSocialLinks())
                                        <div class="ul-team-member-socials">
                                            @if($member->facebook_url)
                                                <a href="{{ $member->facebook_url }}" target="_blank" rel="noopener"><i class="flaticon-facebook"></i></a>
                                            @endif
                                            @if($member->twitter_url)
                                                <a href="{{ $member->twitter_url }}" target="_blank" rel="noopener"><i class="flaticon-twitter"></i></a>
                                            @endif
                                            @if($member->linkedin_url)
                                                <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener"><i class="flaticon-linkedin-big-logo"></i></a>
                                            @endif
                                            @if($member->instagram_url)
                                                <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener"><i class="flaticon-instagram"></i></a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="ul-team-member-info">
                                    <h3 class="ul-team-member-name"><a href="javascript:void(0);" onclick="showMemberDetails({{ $member->id }})">{{ $member->name }}</a></h3>
                                    <p class="ul-team-member-designation">{{ $member->position ?? 'Membre de l\'équipe' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Section avec les détails des membres (bios) -->
                <div class="ul-team-details" style="margin-top: 80px;">
                    <div class="ul-section-heading justify-content-center text-center" style="margin-bottom: 40px;">
                        <div class="left">
                            <span class="ul-section-sub-title">En savoir plus</span>
                            <h2 class="ul-section-title">À propos de nos membres</h2>
                        </div>
                    </div>

                    <div class="row g-4">
                        @foreach($teamMembers as $index => $member)
                            @if($member->bio)
                                <div class="col-lg-6 wow animate__fadeInUp" id="member-detail-{{ $member->id }}">
                                    <div class="ul-team-detail-card" style="display: flex; gap: 20px; padding: 25px; background: #fff; border-radius: 15px; box-shadow: 0 5px 30px rgba(0,0,0,0.08); height: 100%;">
                                        <div style="flex-shrink: 0;">
                                            @if($member->photo)
                                                @if(Str::startsWith($member->photo, ['http://', 'https://']))
                                                    <img src="{{ $member->photo }}" alt="{{ $member->name }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/img/member-' . (($index % 4) + 1) . '.jpg') }}" alt="{{ $member->name }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                                            @endif
                                        </div>
                                        <div>
                                            <h4 style="font-size: 20px; font-weight: 600; color: #333; margin-bottom: 5px;">{{ $member->name }}</h4>
                                            <p style="font-size: 14px; color: #0172b8; margin-bottom: 15px; font-weight: 500;">{{ $member->position ?? 'Membre de l\'équipe' }}</p>
                                            <p style="font-size: 15px; color: #666; line-height: 1.7; margin: 0;">{{ $member->bio }}</p>
                                            @if($member->hasSocialLinks())
                                                <div style="margin-top: 15px; display: flex; gap: 10px;">
                                                    @if($member->facebook_url)
                                                        <a href="{{ $member->facebook_url }}" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; justify-content: center; width: 35px; height: 35px; background: #f0f9ff; color: #0172b8; border-radius: 50%; text-decoration: none; transition: all 0.3s;">
                                                            <i class="flaticon-facebook"></i>
                                                        </a>
                                                    @endif
                                                    @if($member->twitter_url)
                                                        <a href="{{ $member->twitter_url }}" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; justify-content: center; width: 35px; height: 35px; background: #f0f9ff; color: #0172b8; border-radius: 50%; text-decoration: none; transition: all 0.3s;">
                                                            <i class="flaticon-twitter"></i>
                                                        </a>
                                                    @endif
                                                    @if($member->linkedin_url)
                                                        <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; justify-content: center; width: 35px; height: 35px; background: #f0f9ff; color: #0172b8; border-radius: 50%; text-decoration: none; transition: all 0.3s;">
                                                            <i class="flaticon-linkedin-big-logo"></i>
                                                        </a>
                                                    @endif
                                                    @if($member->instagram_url)
                                                        <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; justify-content: center; width: 35px; height: 35px; background: #f0f9ff; color: #0172b8; border-radius: 50%; text-decoration: none; transition: all 0.3s;">
                                                            <i class="flaticon-instagram"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center" style="padding: 60px 20px;">
                    <p style="font-size: 18px; color: #666;">Aucun membre d'équipe disponible pour le moment.</p>
                    <a href="{{ route('home') }}" class="ul-btn" style="margin-top: 20px;">
                        <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Retour à l'accueil
                    </a>
                </div>
            @endif

            <!-- Call to Action : Rejoindre l'équipe -->
            <div class="ul-team-cta" style="margin-top: 80px; padding: 50px; background: linear-gradient(135deg, #0172b8 0%, #005a8c 100%); border-radius: 20px; text-align: center; color: white;">
                <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 15px;">Vous souhaitez rejoindre notre équipe ?</h3>
                <p style="font-size: 16px; margin-bottom: 25px; max-width: 600px; margin-left: auto; margin-right: auto; opacity: 0.9;">
                    Nous sommes toujours à la recherche de personnes motivées et passionnées pour nous aider dans notre mission. Bénévoles, partenaires, tous sont les bienvenus !
                </p>
                <a href="{{ route('contact') }}" class="ul-btn" style="background: white; color: #0172b8;">
                    <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Nous contacter
                </a>
            </div>
        </div>
    </section>
    <!-- TEAM SECTION END -->

    <script>
        function showMemberDetails(memberId) {
            const element = document.getElementById('member-detail-' + memberId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                // Ajouter une animation de surbrillance
                element.style.transition = 'box-shadow 0.3s, transform 0.3s';
                element.querySelector('.ul-team-detail-card').style.boxShadow = '0 10px 40px rgba(1, 114, 184, 0.3)';
                element.querySelector('.ul-team-detail-card').style.transform = 'scale(1.02)';
                setTimeout(() => {
                    element.querySelector('.ul-team-detail-card').style.boxShadow = '';
                    element.querySelector('.ul-team-detail-card').style.transform = '';
                }, 2000);
            }
        }
    </script>
@endsection
