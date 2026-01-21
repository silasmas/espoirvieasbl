@extends('emails.layout')

@section('content')
    @if(isset($title))
    <h2 style="color: #0172b8; margin-bottom: 20px;">{{ $title }}</h2>
    @endif
    
    @if(isset($greeting))
    <p>{{ $greeting }}</p>
    @endif
    
    @if(isset($content))
    <div>
        {!! $content !!}
    </div>
    @endif
    
    @if(isset($button_text) && isset($button_url))
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $button_url }}" class="button">{{ $button_text }}</a>
    </div>
    @endif
    
    @if(isset($closing))
    <p style="margin-top: 30px;">{{ $closing }}<br>
    <strong>L'équipe Espoir Vie ASBL</strong></p>
    @else
    <p style="margin-top: 30px;">Cordialement,<br>
    <strong>L'équipe Espoir Vie ASBL</strong></p>
    @endif
@endsection
