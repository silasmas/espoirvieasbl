@foreach(site_menu() as $item)
    <a href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
@endforeach
