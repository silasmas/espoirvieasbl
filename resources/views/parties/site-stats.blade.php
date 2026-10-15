@if(site_visible('global.stats'))
    @php
        $statIcons = ['flaticon-costumer', 'flaticon-team', 'flaticon-package', 'flaticon-relationship'];
        $stats = site_items('global.stats');
    @endphp
    <div class="ul-stats ul-section-spacing">
        <div class="ul-container">
            <div class="ul-stats-wrapper wow animate__fadeInUp">
                <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 row-cols-xxs-1 ul-bs-row justify-content-center">
                    @foreach($stats as $index => $stat)
                        <div class="col">
                            <div class="ul-stats-item">
                                <i class="{{ $statIcons[$index % count($statIcons)] }}"></i>
                                <span class="number">{{ $stat['number'] ?? '' }}</span>
                                <span class="txt">{{ $stat['text'] ?? '' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
