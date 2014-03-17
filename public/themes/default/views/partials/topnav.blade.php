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
<section id="navbar">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="width: auto;">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li {{ sa('/') }} ><a href="{{ URL::to('property/listing') }}" >Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Investors <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li {{ sa('/') }} ><a href="{{ URL::to('page/view/buying-process') }}" >Buying Process</a></li>
                                <li {{ sa('/') }} ><a href="{{ URL::to('page/view/markets') }}" >Markets</a></li>
                                <li {{ sa('/') }} ><a href="{{ URL::to('page/view/how-to-invest') }}" >How To Invest</a></li>
                                <li {{ sa('/') }} ><a href="{{ URL::to('page/view/preferred-customer') }}" >Preferred Customer</a></li>
                                <li {{ sa('/') }} ><a href="{{ URL::to('page/view/research') }}" >Research</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">News <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li {{ sa('/') }} ><a href="{{ URL::to('faq') }}" >FAQ</a></li>
                                <li {{ sa('/') }} ><a href="{{ URL::to('glossary') }}" >Glossary</a></li>
                            </ul>
                        </li>

                    </ul>
                    <form class="navbar-search pull-right" action="">
                        <input type="text" class="search-query span2" placeholder="Search">
                    </form>
                    <ul class="nav pull-right">
                        <li><a href="http://bootswatch.com/2/united/#">Login</a></li>
                        <li><a href="http://bootswatch.com/2/united/#">Register</a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->
</section>