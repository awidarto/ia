@extends('layout.front')

@section('content')

<style type="text/css">

</style>
            <!-- if there are login errors, show them here -->
    <div class="row" style="padding-bottom:0px;margin-top:10px;padding-top:65px;">
        <div class="span12" style="margin:auto">
            <ul class="bxslider" style="margin:0px;padding:0px;" >
              <li><img src="{{ URL::to('/')}}/images/dummy/banner1.png" /></li>
              <li><img src="{{ URL::to('/')}}/images/dummy/banner2.png" /></li>
              <li><img src="{{ URL::to('/')}}/images/dummy/banner1.png" /></li>
              <li><img src="{{ URL::to('/')}}/images/dummy/banner2.png" /></li>
            </ul>
        </div>
    </div>

{{ HTML::style('css/jquery.bxslider.css')}}

{{ HTML::script('js/jquery.easing.1.3.js') }}
{{ HTML::script('js/jquery.touchSwipe.min.js') }}
{{ HTML::script('js/jquery.bxslider.min.js') }}

<script type="text/javascript">
    $(document).ready(function(){
        $('.bxslider').bxSlider();
    });

</script>



@stop