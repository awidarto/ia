@extends('layout.print')

@section('content')
        @if(is_null($content))
            <h1 class="page-header">Page Doesn't Exists</h1>
        @else
            <h1 class="page-header">{{ $content['title'] }}</h1>
        @endif

        @if(is_null($content))
            <p>Sorry, this page apparently does not exist yet.</p>
        @else
            {{ $content['body'] }}
        @endif
@stop