@extends('realia.layout')

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

               <h1 class="page-header">Login</h1>

                    {{Former::open_horizontal('login','POST',array('class'=>''))}}
                        @if (Session::has('login_errors'))
                            @if (Session::get('loginError'))
                            <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                                 <button type="button" class="close" data-dismiss="alert"></button>
                                 Email or password incorrect.
                            @endif
                        @endif
                        {{ Former::text('email','Email') }}

                        {{ Former::password('password','Password') }}

                        {{-- Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') --}}

                        <br />

                        {{ Former::submit('Login')->class('btn btn-primary offset3') }}

                    {{ Former::close() }}


            </div>
            <div class="sidebar span3">
                @include('realia.latest')


            </div>
        </div>

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>



@stop