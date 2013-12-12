@if(Auth::check())
        <li><a href="{{ URL::to('transaction/listing') }}">Welcome {{ Auth::user()->firstname.' '.Auth::user()->lastname }}</a></li>
        <li><a href="{{ URL::to('logout') }}">Logout</a></li>
@else
        <li><a href="{{ URL::to('/') }}/login">Login</a></li>
        <li><a href="{{ URL::to('/') }}/register">Registration</a></li>

    {{--
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
