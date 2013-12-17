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
    @if(Auth::check())
        {{--
            <li {{ sa('/') }} ><a href="{{ URL::to('property/listing') }}" >Properties</a></li>
        --}}
        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/buying-process') }}" >Buying Process</a></li>
        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/markets') }}" >Markets</a></li>
        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/how-to-invest') }}" >How To Invest</a></li>
        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/preferred-customer') }}" >Preferred Customer</a></li>
        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/research') }}" >Research</a></li>
        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/faq') }}" >FAQ</a></li>
    @endif

</ul>