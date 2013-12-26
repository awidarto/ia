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
    <div class="page-header">
        <h1>Navbars</h1>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="width: auto;">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="http://bootswatch.com/2/united/#">Project name</a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li {{ sa('/') }} ><a href="{{ URL::to('/') }}" >Home</a></li>
                        <li {{ sa('/') }} ><a href="{{ URL::to('property/listing') }}" >Properties</a></li>
                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/buying-process') }}" >Buying Process</a></li>
                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/markets') }}" >Markets</a></li>
                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/how-to-invest') }}" >How To Invest</a></li>
                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/preferred-customer') }}" >Preferred Customer</a></li>
                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/research') }}" >Research</a></li>
                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/faq') }}" >FAQ</a></li>
                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/glossary') }}" >Glossary</a></li>

                    </ul>
                    <form class="navbar-search pull-left" action="">
                        <input type="text" class="search-query span2" placeholder="Search">
                    </form>
                    <ul class="nav pull-right">
                        <li><a href="http://bootswatch.com/2/united/#">Link</a></li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a href="http://bootswatch.com/2/united/#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="http://bootswatch.com/2/united/#">Action</a></li>
                                <li><a href="http://bootswatch.com/2/united/#">Another action</a></li>
                                <li><a href="http://bootswatch.com/2/united/#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="http://bootswatch.com/2/united/#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->
</section>