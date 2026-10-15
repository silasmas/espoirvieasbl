@if(site_visible($key))
    <section class="ul-section-spacing">
        <div class="ul-container">
            <div class="ul-section-heading">
                <div class="left">
                    @if(site_text($key, 'subtitle') !== '')
                        <span class="ul-section-sub-title">{{ site_text($key, 'subtitle') }}</span>
                    @endif
                    <h2 class="ul-section-title">{{ site_text($key, 'title') }}</h2>
                    @if(site_text($key, 'body') !== '')
                        <p class="ul-section-descr">{!! nl2br(e(site_text($key, 'body'))) !!}</p>
                    @endif
                </div>
            </div>
            <div class="row row-cols-md-2 row-cols-1 gy-3">
                @foreach(site_items($key) as $item)
                    <div class="col">
                        <div class="ul-about-block">
                            <div class="block-left">
                                @if(($item['title'] ?? '') !== '')
                                    <h3 class="block-title">{{ $item['title'] }}</h3>
                                @endif
                                @if(($item['text'] ?? '') !== '')
                                    <p>{{ $item['text'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
