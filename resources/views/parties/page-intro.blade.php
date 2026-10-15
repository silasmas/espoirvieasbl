@if(site_visible($key))
    <div class="ul-section-heading justify-content-center text-center" style="margin-bottom: 40px;">
        <div class="left">
            @if(site_text($key, 'subtitle') !== '')
                <span class="ul-section-sub-title">{{ site_text($key, 'subtitle') }}</span>
            @endif
            @if(site_text($key, 'title') !== '')
                <h2 class="ul-section-title">{{ site_text($key, 'title') }}</h2>
            @endif
            @if(site_text($key, 'body') !== '')
                <p class="ul-section-descr">{!! nl2br(e(site_text($key, 'body'))) !!}</p>
            @endif
        </div>
    </div>
@endif
