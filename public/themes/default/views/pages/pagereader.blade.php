@extends('layout.front')

@section('content')

<div class="row" style="padding-bottom:0px;margin-top:10px;padding-top:35px;">
    <div class="span12  shadows" style="margin:auto;background-color:#fff;height:460px;">
        <div class="row" style="margin:0px;padding:0px;">
            @if(is_null($content))
                <h1 class="page-header">Page Doesn't Exists</h1>
            @else
                <h1 class="page-header">{{ $content['title'] }}</h1>
            @endif
        </div>
        <div class="row" style="margin:0px;padding:0px;padding-left:8px;">
            <div class="span12 lionbars" style="overflow-y:auto;height:410px;width:100%;margin:0px;margin-right:4px;">

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