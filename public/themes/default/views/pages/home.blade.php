@extends('layout.front')

@section('content')

<style type="text/css">
    #main-content {
        padding-top: 10px;
        background-color: #bd1022;
        padding: 0px 0px;
        min-height: 460px;
        height: 100%;
        margin-bottom: 0px;
        width: 100%;
    }
</style>
            <!-- if there are login errors, show them here -->
<div class="row" style="margin-left:8px;padding-bottom:0px;margin-top:10px;">
        <div class="row">
            <div class="liquid-slider span7" id="home-slider">

                @foreach($featured as $f)
                 <div>
                      <h4 class="title">{{ $f['number'].' '.$f['address'].','.$f['city'].' '.$f['state'] }}</h4>
                      <div class="row">
                        <div class="span2" >
                            <img src="{{ $f['defaultpictures']['thumbnail_url']}}" alt="{{ $f['propertyId'] }}" />
                        </div>
                        <div class="span3" >
                            {{ $f['description']}}
                        </div>
                      </div>
                 </div>
                @endforeach
            </div>

        </div>

    {{ HTML::style('css/liquid-slider.css') }}

</div>

{{ HTML::script('js/jquery.easing.1.3.js') }}
{{ HTML::script('js/jquery.touchSwipe.min.js') }}
{{ HTML::script('js/jquery.liquid-slider.min.js') }}

<script type="text/javascript">
    $(document).ready(function(){
        $('#home-slider').liquidSlider({
            'autoSlide':true
        });
    });

</script>


<div class="container">
    <div id="main">

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>



@stop