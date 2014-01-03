@extends('layout.front')

@section('content')
            <!-- if there are login errors, show them here -->
<div class="row" style="margin-left:8px;padding-bottom:0px;margin-top:10px;">
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
    <div class="span1"></div>
    <div class="span3">
        <h4>Customer Login</h4>
            {{Former::open_horizontal('clogin','POST',array('class'=>''))}}
                @if (Session::get('cloginError'))
                    <div class="alert alert-danger">{{ Session::get('cloginError') }}</div>
                         <button type="button" class="close" data-dismiss="alert"></button>
                @endif
                {{ Former::text('email','Email')->class('span2') }}

                {{ Former::password('password','Password')->class('span2') }}

                {{-- Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') --}}

                {{ Former::submit('Login')->class('btn btn-primary pull-right') }}

                <div class="" style="display:block;padding-top:20px;text-align:right;clear:both;width:100%;">
                    <a href="{{ URL::to('account/create') }}" class="" >Create account</a> here
                </div>

            {{ Former::close() }}
    </div>
    <div class="span1"></div>
    <div class="span4" style="padding-top:15px auto;text-align:right;">
        @include('partials.youtube')
    </div>

    {{ HTML::style('css/liquid-slider.css') }}

    <div class="row">
        <div class="liquid-slider" id="home-slider">

            @foreach($featured as $f)
             <div>
                  <h4 class="title">{{ $f['number'].' '.$f['address'].','.$f['city'].' '.$f['state'] }}</h4>
                  <div class="row">
                    <div class="span2" >
                        <img src="{{ $f['defaultpictures']['thumbnail_url']}}" alt="{{ $f['propertyId'] }}" />
                    </div>
                    <div class="span10" >
                        {{ $f['description']}}
                    </div>
                  </div>
             </div>
            @endforeach
        </div>

    </div>
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