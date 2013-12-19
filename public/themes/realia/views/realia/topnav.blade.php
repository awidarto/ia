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
            <!-- NAVIGATION -->
            <div id="navigation">
                <div class="container">
                    <div class="navigation-wrapper">
                        <div class="navigation clearfix-normal">

                            <ul class="nav">

                                {{--
                                    <li {{ sa('/') }} ><a href="{{ URL::to('/') }}" >Home</a></li>
                                --}}

                            @if(Auth::check())

                                <li class="menuparent">
                                    <span class="menuparent nolink">Investment Info</span>
                                    <ul>
                                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/buying-process') }}" >Buying Process</a></li>
                                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/how-to-invest') }}" >How To Invest</a></li>
                                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/research') }}" >Research</a></li>
                                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/preferred-customer') }}" >Preferred Customer</a></li>
                                        <li {{ sa('/') }} ><a href="{{ URL::to('page/view/markets') }}" >Markets</a></li>

                                    </ul>
                                </li>
                                <li {{ sa('/') }} ><a href="{{ URL::to('faq') }}" >FAQ</a></li>

                            @endif


                            {{--
                                <li {{ sa('/') }} ><a href="{{ URL::to('page/view/about-investors-alliance') }}" >About Us</a></li>
                                <li {{ sa('contact') }} ><a href="{{ URL::to('contact') }}"  >Contact Us</a></li>

                            --}}

                            </ul><!-- /.nav -->

{{--


                            <div class="language-switcher">
                                <div class="current en"><a href="index.html" lang="en">English</a></div><!-- /.current -->
                                <div class="options">
                                    <ul>
                                        <li class="fr"><a href="#">Français</a></li>
                                        <li class="de"><a href="#">Deutsch</a></li>
                                    </ul>
                                </div><!-- /.options -->
                            </div><!-- /.language-switcher -->

                            <form method="get" class="site-search" action="http://html.realia.byaviators.com/index-slider.html?">
                                <div class="input-append">
                                    <input title="Enter the terms you wish to search for." class="search-query span2 form-text" placeholder="Search" type="text" name="">
                                    <button type="submit" class="btn"><i class="icon-search"></i></button>
                                </div><!-- /.input-append -->
                            </form><!-- /.site-search -->
    --}}

                        </div><!-- /.navigation -->
                    </div><!-- /.navigation-wrapper -->
                </div><!-- /.container -->
            </div><!-- /.navigation -->
