@extends('layout.front')

@section('content')
<div id="content-block">
    <div id="content-container" class="shadows" style="margin-bottom: 6px;" >


        <div class="row">
            <div >
                <div class="row" style="margin:0px;padding:0px;">
                    @if(is_null($content))
                        <h1 class="page-header">Page Doesn't Exists</h1>
                    @else
                        <h1 class="page-header">{{ $content['title'] }}</h1>
                    @endif
                </div>
                <div class="row" style="margin:0px;padding:0px;padding-left:8px;">
                    <div class="span12 lionbars" style="overflow-y:auto;height:340px;width:100%;margin:0px;margin-right:4px;">

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

    </div>
</div>



@stop