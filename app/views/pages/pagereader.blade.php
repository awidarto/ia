@extends('layout.front')

@section('content')
            @if(is_null($content))
                <h2>Page Doesn't Exists</h2>
                <p>Sorry, this page apparently does not exist yet.</p>
            @else
                <h2>{{ $content['title'] }}</h2>
                {{ $content['body'] }}
            @endif
@stop