<?php
    function sa($item){
        $patt = '/'.addslashes($item).'$/';

        if((URL::to($item) == URL::full())){
            return  'class="active"';
        }else{
            return '';
        }
    }
/*
HOME
RESEARCH
MARKETS
PROPERTIES
FAQ
GLOSSARY
HOW TO INVEST
ABOUT US
CONTACT US
*/

?>

<ul class="nav navbar-nav">
    <li {{ sa('/') }} ><a href="{{ URL::to('/') }}" >Home</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('property/listing') }}" >Properties</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/view/buying-process') }}" >Buying Process</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/view/markets') }}" >Markets</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/view/how-to-invest') }}" >How To Invest</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/view/preferred-customer') }}" >Preferred Customer</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/view/research') }}" >Research</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/view/faq') }}" >FAQ</a></li>
    <li {{ sa('/') }} ><a href="{{ URL::to('page/view/about-investors-alliance') }}" >About Us</a></li>
    <li {{ sa('contact') }} ><a href="{{ URL::to('contact') }}"  >Contact Us</a></li>
    @if(Auth::check())
        <li {{ sa('music') }}  ><a href="{{ URL::to('music') }}" >Music</a></li>
        <li {{ sa('artist') }} ><a href="{{ URL::to('artist') }}" >Artist</a></li>
        <li {{ sa('album') }} ><a href="{{ URL::to('album') }}" >Album</a></li>
        <li {{ sa('about') }} ><a href="{{ URL::to('profile') }}" >Profile</a></li>
    @endif

</ul>