<?php
    function sa($item){
        $patt = '/'.addslashes($item).'$/';

        if((URL::to($item) == URL::full())){
            return  'class="active"';
        }else{
            return '';
        }
    }
?>
<ul class="nav navbar-nav">
    <li {{ sa('/') }} ><a href="{{ URL::to('/') }}" >Home</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('property') }}" >Property</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/process') }}" >Buying Process</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/preferred') }}" >Preferred Customer</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/investor-info') }}" >Investor Info</a></li>
    @if(Auth::check())
        <li {{ sa('music') }}  ><a href="{{ URL::to('music') }}" >Music</a></li>
        <li {{ sa('artist') }} ><a href="{{ URL::to('artist') }}" >Artist</a></li>
        <li {{ sa('album') }} ><a href="{{ URL::to('album') }}" >Album</a></li>
        <li {{ sa('about') }} ><a href="{{ URL::to('profile') }}" >Profile</a></li>
    @endif
    <li {{ sa('contact') }} ><a href="{{ URL::to('contact') }}"  >Contact Us</a></li>

</ul>