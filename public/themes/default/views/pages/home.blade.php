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
<div class="row" style="padding-bottom:0px;margin-top:10px;">
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


<div class="container">
    <div id="main">

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>



@stop