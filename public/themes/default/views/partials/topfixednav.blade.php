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
    <!-- Navbar
        ================================================== -->
<div class="navbar" style="margin-left: -100px;">
    <div class="navbar-inner">
     <div class="container">
         <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
         </a>
         <div class="nav-collapse collapse" id="main-menu">
            <ul class="nav" id="main-menu-left" style="margin-top: 4px;">
                <li {{ sa('/') }} {{ sa('dashboard') }} ><a href="{{ URL::to('/') }}" >Home</a></li>
                <li {{ sa('property/listing') }} >
                    @if(Auth::check())
                        <a href="{{ URL::to('property/listing') }}" >Property</a>
                    @else
                        <a href="#loginModal" data-toggle="modal" data-target="#loginModal"  >Property</a>
                    @endif
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Investor Info <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li {{ sa('page/view/buying-process') }} ><a href="{{ URL::to('page/view/buying-process') }}" >Buying Process</a></li>
                        <li {{ sa('page/view/markets') }} ><a href="{{ URL::to('page/view/markets') }}" >Markets</a></li>
                        <li {{ sa('page/view/how-to-invest') }} ><a href="{{ URL::to('page/view/how-to-invest') }}" >How To Invest</a></li>
                        <li {{ sa('page/view/preferred-customer') }} ><a href="{{ URL::to('page/view/preferred-customer') }}" >Preferred Customer</a></li>
                        <li {{ sa('page/view/research') }} ><a href="{{ URL::to('page/view/research') }}" >Research</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">News <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li {{ sa('faq') }} ><a href="{{ URL::to('faq') }}" >FAQ</a></li>
                        <li {{ sa('glossary') }} ><a href="{{ URL::to('glossary') }}" >Glossary</a></li>
                    </ul>
                </li>
                <li {{ sa('page/view/contact') }} ><a href="{{ URL::to('page/view/contact') }}" >Contact</a></li>
            </ul>
         </div>
     </div>
    </div>
</div>
