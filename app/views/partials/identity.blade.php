@if(Auth::check())
        <p>Welcome {{ Auth::user()->firstname.' '.Auth::user()->lastname }}<br />
        <a href="{{ URL::to('logout') }}">Logout</a></p>
@endif
