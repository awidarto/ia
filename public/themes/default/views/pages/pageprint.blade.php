@extends('layout.print')

@section('content')
    <div class="row">
        <div >
            <div class="row" style="margin:0px;padding:0px;">
                @if(is_null($content))
                    <h1 class="page-header">Page Doesn't Exists</h1>
                @else
                    <h1 class="page-header">{{ $content['title'] }}</h1>
                @endif
            </div>
            <div class="row" >

                    @if(is_null($content))
                        <p>Sorry, this page apparently does not exist yet.</p>
                    @else
                        {{ $content['body'] }}
                    @endif

                    <!--insert grid-->
                </div>
            </div>

        </div>
    </div>
@stop