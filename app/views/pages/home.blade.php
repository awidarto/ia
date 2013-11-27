@extends('layout.front')

@section('content')
<div id="home">
    <div class="row">
        <div class="col-md-8">
            @if(is_null($content))
                <h2>Page Doesn't Exists</h2>
                <p>Sorry, this page apparently does not exist yet.</p>
            @else
                {{ $content['body'] }}
            @endif
        </div>
        <div class="col-md-4 visible-lg">
            @include('partials.identity')
            @include('partials.location')
        </div>
    </div>
</div>
@stop