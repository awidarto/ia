@extends('layout.front')

@section('content')

<style type="text/css">

</style>
<div id="content-block">
    <div id="content-container" style="margin-bottom: 6px;background-color:transparent;" >
                <ul class="bxslider">
                  <li><img src="{{ URL::to('/')}}/images/dummy/banner1.png" /></li>
                  <li><img src="{{ URL::to('/')}}/images/dummy/banner2.png" /></li>
                  <li><img src="{{ URL::to('/')}}/images/dummy/banner1.png" /></li>
                  <li><img src="{{ URL::to('/')}}/images/dummy/banner2.png" /></li>
                </ul>
    </div>
</div>



            <!-- if there are login errors, show them here -->

{{ HTML::style('css/jquery.bxslider.css')}}

<style type="text/css">
.bx-wrapper .bx-viewport{
    -webkit-box-shadow: 3px 4px 15px 4px rgba(0,0,0,0.75);
    -moz-box-shadow: 3px 4px 15px 4px rgba(0,0,0,0.75);
    box-shadow: 3px 4px 15px 4px rgba(0,0,0,0.75);
}

</style>

{{ HTML::script('js/jquery.easing.1.3.js') }}
{{ HTML::script('js/jquery.touchSwipe.min.js') }}
{{ HTML::script('js/jquery.bxslider.min.js') }}

<script type="text/javascript">
    $(document).ready(function(){
        $('.bxslider').bxSlider();
    });

</script>



@stop