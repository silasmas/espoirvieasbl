@foreach(site_social_links() as $link)
    <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $link['label'] }}">
        <i class="{{ $link['icon'] }}"></i>
    </a>
@endforeach
