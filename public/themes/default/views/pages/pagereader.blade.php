@extends('layout.front')

@section('content')

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span12">

                @if(is_null($content))
                    <h1 class="page-header">Page Doesn't Exists</h1>
                    <p>Sorry, this page apparently does not exist yet.</p>
                @else
                    <h1 class="page-header">{{ $content['title'] }}</h1>
                    {{ $content['body'] }}
                @endif

                <!--insert grid-->
            </div>
        </div>

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>


@stop