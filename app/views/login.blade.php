@extends('layout.front')

@section('content')
            <!-- if there are login errors, show them here -->
@if(Auth::check())
    <p class="navbar-text pull-right">
        Hello {{ Auth::user()->fullname }}
        <a href="{{ URL::to('logout')}}" >Logout</a>
    </p>
@endif

<div class="row">
    <div class="col-lg-6">
        <h3>Sign Up</h3>


        {{Former::open_vertical('signup','POST',array('class'=>''))}}
            <h2 class="form-signin-heading">Sign up, upload and make $$$</h2>
            @if (Session::has('login_errors'))
                @if (Session::get('loginError'))
                <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                     <button type="button" class="close" data-dismiss="alert"></button>
                     Email or password incorrect.
                @endif
            @endif
            {{ Former::text('email','Email') }}
            {{ Former::text('firstname','First Name') }}
            {{ Former::text('lastname','Last Name') }}

            {{ Former::password('pass','Password') }}
            {{ Former::password('repass','Repeat Password') }}

            <p>{{ Form::submit('Sign Up',array('class'=>'btn btn-primary')) }}</p>

        {{Former::close()}}

    </div>
    <div class="col-lg-6">
        <h3>Sign In</h3>

        {{Former::open_vertical('login','POST',array('class'=>''))}}
            <h2 class="form-signin-heading">Already a member ? Sign in</h2>
            @if (Session::has('login_errors'))
                @if (Session::get('loginError'))
                <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                     <button type="button" class="close" data-dismiss="alert"></button>
                     Email or password incorrect.
                @endif
            @endif
            {{ Former::text('email','Email') }}

            {{ Former::password('password','Password') }}

            <label class="checkbox">
              <input type="checkbox" value="remember-me"> Remember me
            </label>
            <p>{{ Form::submit('Submit!',array('class'=>'btn btn-primary')) }}</p>
        {{ Former::close() }}
    </div>
</div>




@stop