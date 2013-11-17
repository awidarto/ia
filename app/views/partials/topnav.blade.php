<?php
    function sa($item){
        if((URL::to($item) == URL::full()) || strripos(URL::full(), $item) > 0 ){
            return  'class="active"';
        }else{
            return '';
        }
    }
?>

<ul class="nav navbar-nav">
    @if(Auth::check())
        <li {{ sa('music') }}  ><a href="{{ URL::to('music') }}" >Music</a></li>
        <li {{ sa('artist') }} ><a href="{{ URL::to('artist') }}" >Artist</a></li>
        <li {{ sa('album') }} ><a href="{{ URL::to('album') }}" >Album</a></li>
        <li {{ sa('about') }} ><a href="{{ URL::to('profile') }}" >Profile</a></li>
    @endif
    <li {{ sa('contact') }} ><a href="{{ URL::to('contact') }}"  >Contact Us</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('/') }}" >Home</a></li>

</ul>