@if(Auth::check())
        <a href="{{ URL::to('dashboard') }}">Welcome {{ Auth::user()->firstname.' '.Auth::user()->lastname }}</a> | <a href="{{ URL::to('logout') }}">LOGOUT</a>
@else
        <a href="#loginModal" data-toggle="modal" data-target="#loginModal" >LOGIN</a>

    {{--
 | <a href="{{ URL::to('/') }}/signup">SIGN UP</a>
         <li><a href="{{ URL::to('/') }}/register">Registration</a></li>

    <h2>LOGIN / SIGN UP</h2>
    <div class="span12" style="padding:0px;">
        {{ Former::open_vertical(array('url' => 'login','class'=>'', 'role'=>'form')) }}
                @if (Session::has('loginError'))
                    @if (Session::get('loginError'))
                    <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                         <button type="button" class="close" data-dismiss="alert"></button>
                         Email or password incorrect.
                    @endif
                @endif
                <div class="form-group" >
                    {{ $errors->first('email') }}
                    {{ $errors->first('password') }}
                </div>

                <div class="form-group" >
                    {{ Form::text('email', Input::old('email'), array('placeholder' => 'your email')) }}
                    {{ Form::password('password',array('placeholder' => 'your password')) }}
                    {{ Form::submit('Go',array('class'=>'btn btn-default btn-sm')) }}
                </div>

                <label class="checkbox">
                  <input type="checkbox" value="remember-me"> Remember me
                </label>
        {{ Former::close() }}
    </div>

    --}}
@endif
