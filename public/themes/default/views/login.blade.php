@extends('layout.front')

@section('content')
            <!-- if there are login errors, show them here -->
@if(Auth::check())
    <p class="navbar-text pull-right">
        Hello {{ Auth::user()->fullname }}
        <a href="{{ URL::to('logout')}}" >Logout</a>
    </p>
@endif

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">

                <table class="table">
                    <tr>
                        <td>
                           <h2 class="page-header">Agent Login</h2>

                                {{Former::open_horizontal('login','POST',array('class'=>'span4'))}}
                                    @if (Session::has('login_errors'))
                                        @if (Session::get('loginError'))
                                        <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                                             <button type="button" class="close" data-dismiss="alert"></button>
                                             Email or password incorrect.
                                        @endif
                                    @endif
                                    {{ Former::text('email','Email')->class('span2 pull-right') }}

                                    {{ Former::password('password','Password')->class('span2 pull-right') }}

                                    {{-- Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') --}}

                                    <br />

                                    {{ Former::submit('Login')->class('btn btn-primary pull-right') }}

                                {{ Former::close() }}

                        </td>
                        <td>
                               <h2 class="page-header">Customer Login</h2>

                                    {{Former::open_horizontal('login','POST',array('class'=>'span4'))}}
                                        @if (Session::has('login_errors'))
                                            @if (Session::get('loginError'))
                                            <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                                                 <button type="button" class="close" data-dismiss="alert"></button>
                                                 Email or password incorrect.
                                            @endif
                                        @endif
                                        {{ Former::text('email','Email')->class('span2 pull-right') }}

                                        {{ Former::password('password','Password')->class('span2 pull-right') }}

                                        {{-- Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') --}}

                                        <br />

                                        {{ Former::submit('Login')->class('btn btn-primary pull-right') }}
                                        <br />

                                        <div style="font-size:13px;text-align:right;clear:both;padding-top:10px;">
                                            Interested in investing ?
                                            <a href="{{ URL::to('register') }}" class="" >Create login</a> here
                                        </div>
                                    {{ Former::close() }}

                        </td>
                    </tr>
                </table>

            {{ HTML::style('css/liquid-slider.css') }}

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
            <div class="sidebar span3">
                @include('partials.youtube')


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
    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>



@stop