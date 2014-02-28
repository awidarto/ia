@extends('layout.front')

@section('content')
            <!-- if there are login errors, show them here -->
<div class="row content-box" style="margin-left:8px;padding-bottom:0px;margin-top:40px;">
    <div class="span8">
        <div class="row">
            <div class="span3">
                <h4>Agent Login</h4>
                    {{Former::open_horizontal('login','POST',array('class'=>''))}}
                        @if (Session::get('loginError'))
                            <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                                 <button type="button" class="close" data-dismiss="alert"></button>
                        @endif
                        {{ Former::text('email','Email')->class('span2') }}

                        {{ Former::password('password','Password')->class('span2') }}

                        {{-- Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') --}}

                        {{ Former::submit('Login')->class('btn btn-primary pull-right') }}

                    {{ Former::close() }}
            </div>
            {{--
            <div class="span1"></div>
            <div class="span3">
                <h4>Customer Login</h4>
                    {{Former::open_horizontal('clogin','POST',array('class'=>''))}}
                        @if (Session::get('cloginError'))
                            <div class="alert alert-danger">{{ Session::get('cloginError') }}</div>
                                 <button type="button" class="close" data-dismiss="alert"></button>
                        @endif
                        {{ Former::text('cemail','Email')->class('span2') }}

                        {{ Former::password('cpassword','Password')->class('span2') }}

                        {{ Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') }}

                        {{ Former::submit('Login')->class('btn btn-primary pull-right') }}

                        <div class="" style="display:block;padding-top:20px;text-align:right;clear:both;width:100%;">
                            <a href="{{ URL::to('account/create') }}" class="" >Create account</a> here
                        </div>

                    {{ Former::close() }}
            </div>
            --}}
        </div>
    </div>
    <div class="span3" style="padding-left:30px;">
        @include('partials.youtube')
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