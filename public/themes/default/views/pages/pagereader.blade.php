@extends('layout.front')

@section('content')
<div id="content-block">
    <div id="content-container" class="shadows" style="margin-bottom: 6px;" >


        <div class="row">
            <div >
                <div class="row" style="margin:0px;padding:0px;position:relative;">
                    @if(is_null($content))
                        <h1 class="page-header">Page Doesn't Exists</h1>
                    @else
                        <h1 class="page-header">{{ $content['title'] }}</h1>
                    @endif

                    <a href="{{ URL::to('page/print/'.$content['slug'] )}}" class="receipt pull-right" target="new" style="position:absolute;top:3px;right:10px;" ><img src="{{ URL::to('/')}}/images/print.png" /></a>

                </div>
                <div class="row" style="margin:0px;padding:0px;margin-left:8px;">
                    <div class="span12 lionbars" style="overflow-y:auto;height:340px;width:100%;margin:0px;margin-right:4px;">
                        <div style="display:block;margin-right:20px;">
                            @if(is_null($content))
                                <p>Sorry, this page apparently does not exist yet.</p>
                            @else
                                {{ $content['body'] }}
                            @endif

                        </div>
                        <!--insert grid-->
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>



@stop