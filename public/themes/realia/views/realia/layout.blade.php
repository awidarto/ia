<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">

    <link rel="shortcut icon" href="realia/img/favicon.png" type="image/png">

    {{ HTML::style('css/typography.css') }}
    {{ HTML::style('realia/css/bootstrap.css') }}
    {{ HTML::style('realia/css/bootstrap-responsive.css') }}
    {{ HTML::style('realia/libraries/chosen/chosen.css') }}
    {{ HTML::style('realia/libraries/bootstrap-fileupload/bootstrap-fileupload.css') }}
    {{ HTML::style('realia/libraries/jquery-ui-1.10.2.custom/css/ui-lightness/jquery-ui-1.10.2.custom.min.css') }}
    {{ HTML::style('realia/css/realia-red.css') }}

    {{ HTML::style('css/blueimp-gallery.min.css') }}

    {{ HTML::style('css/app.css') }}

    {{ HTML::script('realia/js/jquery.js') }}


    <title>{{ Config::get('site.name') }}</title>
</head>
<body>
<div id="wrapper-outer" >
    <div id="wrapper">
        <div id="wrapper-inner">
            <!-- BREADCRUMB -->
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <ul class="breadcrumb pull-left">
                                <li><a href="index-2.html">Home</a></li>
                            </ul><!-- /.breadcrumb -->

                            <div class="account pull-right">
                                <ul class="nav nav-pills">
                                    @include('partials.identity')
                                </ul>
                            </div>
                        </div><!-- /.span12 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.breadcrumb-wrapper -->

            <!-- HEADER -->
            <div id="header-wrapper">
                <div id="header">
                    <div id="header-inner">
                        <div class="container">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <div class="row">
                                        <div class="logo-wrapper span4">
                                            <a href="#nav" class="hidden-desktop" id="btn-nav">Toggle navigation</a>

                                            <div class="logo">
                                                <a href="{{ URL::to('/') }}"><img class="img-responsive" src="{{ URL::to('images/').'/ialogo.png' }}"></a>
                                            </div><!-- /.logo -->

                                            {{--
                                                <div class="site-name">
                                                    <a href="index.html" title="Home" class="brand">Realia</a>
                                                </div><!-- /.site-name -->

                                                <div class="site-slogan">
                                                    <span>Real estate &amp; Rental<br>made easy</span>
                                                </div><!-- /.site-slogan -->

                                            --}}
                                        </div><!-- /.logo-wrapper -->

                                        {{--

                                        <div class="info">
                                            <div class="site-email">
                                                <a href="mailto:info@investorsalliance.com">info@investorsalliance.com</a>
                                            </div><!-- /.site-email -->

                                            <div class="site-phone">
                                                <span>333-666-777</span>
                                            </div><!-- /.site-phone -->
                                        </div><!-- /.info -->
                                        <!--
                                        <a class="btn btn-primary btn-large list-your-property arrow-right" href="list-your-property.html">List your property</a>
                                        -->
                                        --}}
                                    </div><!-- /.row -->
                                </div><!-- /.navbar-inner -->
                            </div><!-- /.navbar -->
                        </div><!-- /.container -->
                    </div><!-- /#header-inner -->
                </div><!-- /#header -->
            </div><!-- /#header-wrapper -->

            @include('realia.topnav')

            <!-- CONTENT -->
            <div id="content">

                @yield('content')

            </div><!-- /#content -->

    </div><!-- /#wrapper-inner -->

<div id="footer-wrapper">
    <div id="footer-top">
        <div id="footer-top-inner" class="container">
            <div class="row">
                {{--
                    <div class="widget properties span3">
                        <div class="title">
                            <h2>Most Recent</h2>
                        </div><!-- /.title -->

                        <div class="content">
                            <div class="property">
                                <div class="image">
                                    <a href="detail.html"></a>
                                    <img src="{{ URL::to('/') }}/realia/img/tmp/property-small-1.png" alt="">
                                </div><!-- /.image -->
                                <div class="wrapper">
                                    <div class="title">
                                        <h3>
                                            <a href="detail.html">27523 Pacific Coast</a>
                                        </h3>
                                    </div><!-- /.title -->
                                    <div class="location">Palo Alto CA</div><!-- /.location -->
                                    <div class="price">€2 300 000</div><!-- /.price -->
                                </div><!-- /.wrapper -->
                            </div><!-- /.property -->

                            <div class="property">
                                <div class="image">
                                    <a href="detail.html"></a>
                                    <img src="{{ URL::to('/') }}/realia/img/tmp/property-small-2.png" alt="">
                                </div><!-- /.image -->
                                <div class="wrapper">
                                    <div class="title">
                                        <h3>
                                            <a href="detail.html">27523 Pacific Coast</a>
                                        </h3>
                                    </div><!-- /.title -->
                                    <div class="location">Palo Alto CA</div><!-- /.location -->
                                    <div class="price">€2 300 000</div><!-- /.price -->
                                </div><!-- /.wrapper -->
                            </div><!-- /.property -->

                            <div class="property">
                                <div class="image">
                                    <a href="detail.html"></a>
                                    <img src="{{ URL::to('/') }}/realia/img/tmp/property-small-3.png" alt="">
                                </div><!-- /.image -->
                                <div class="wrapper">
                                    <div class="title">
                                        <h3>
                                            <a href="detail.html">27523 Pacific Coast</a>
                                        </h3>
                                    </div><!-- /.title -->
                                    <div class="location">Palo Alto CA</div><!-- /.location -->
                                    <div class="price">€2 300 000</div><!-- /.price -->
                                </div><!-- /.wrapper -->
                            </div><!-- /.property -->
                        </div><!-- /.content -->
                    </div><!-- /.properties-small -->

                --}}

                <div class="widget span4">
                    <div class="content">
                        <table class="contact">
                            <tbody>
                            <tr>
                                <th class="address">USA:</th>
                                <td>125 East Main Street #350<br>American Fork, UT 84003<br>USA

                                </td>
                            </tr>
                            <tr>
                                <th class="phone">Phone:</th>
                                <td>+1 614 432 8875</td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /.content -->
                </div><!-- /.widget -->

                <div class="widget span4">
                    <div class="content">
                        <table class="contact">
                            <tbody>
                            <tr>
                                <th class="address">Australia:</th>
                                <td>PO BOX 6175<br>Linden Park, SA 5065<br>Australia
                                </td>
                            </tr>
                            <tr>
                                <th class="phone">Phone:</th>
                                <td>+1 614 432 8875</td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /.content -->
                </div><!-- /.widget -->

                {{--

                <div class="widget span3">
                    <div class="title">
                        <h2 class="block-title">Useful links</h2>
                    </div><!-- /.title -->

                    <div class="content">
                        <ul class="menu nav">
                            <li class="first leaf"><a href="404.html">404 page</a></li>
                            <li class="leaf"><a href="about-us.html">About us</a></li>
                            <li class="leaf"><a href="contact-us.html">Contact us</a></li>
                            <li class="leaf"><a href="faq.html">FAQ</a></li>
                            <li class="leaf"><a href="grid-system.html">Grid system</a></li>
                            <li class="leaf"><a href="our-agents.html">Our agents</a></li>
                            <li class="last leaf"><a href="typography.html">Typography</a></li>
                        </ul>
                    </div><!-- /.content -->
                </div><!-- /.widget -->

                <div class="widget span3">
                    <div class="title">
                        <h2 class="block-title">Say hello!</h2>
                    </div><!-- /.title -->

                    <div class="content">
                        <form method="post">
                            <div class="control-group">
                                <label class="control-label" for="inputName">
                                    Name
                                    <span class="form-required" title="This field is required.">*</span>
                                </label>
                                <div class="controls">
                                    <input type="text" id="inputName">
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="inputEmail">
                                    Email
                                    <span class="form-required" title="This field is required.">*</span>
                                </label>
                                <div class="controls">
                                    <input type="text" id="inputEmail">
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="inputMessage">
                                    Message
                                    <span class="form-required" title="This field is required.">*</span>
                                </label>

                                <div class="controls">
                                    <textarea id="inputMessage"></textarea>
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="form-actions">
                                <input type="submit" class="btn btn-primary arrow-right" value="Send">
                            </div><!-- /.form-actions -->
                        </form>
                    </div><!-- /.content -->
                </div><!-- /.widget -->

                --}}
            </div><!-- /.row -->
        </div><!-- /#footer-top-inner -->
    </div><!-- /#footer-top -->

    @include('realia/footer')

</div><!-- /#footer-wrapper -->
</div><!-- /#wrapper -->
</div><!-- /#wrapper-outer -->

{{ HTML::script('realia/js/jquery.ezmark.js') }}
{{ HTML::script('realia/js/jquery.currency.js') }}
{{ HTML::script('realia/js/jquery.cookie.js') }}
{{ HTML::script('realia/js/retina.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('realia/js/carousel.js') }}
{{ HTML::script('realia/libraries/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js') }}
{{ HTML::script('realia/libraries/chosen/chosen.jquery.min.js') }}
{{ HTML::script('realia/libraries/iosslider/_src/jquery.iosslider.min.js') }}
{{ HTML::script('realia/libraries/bootstrap-fileupload/bootstrap-fileupload.js') }}

{{ HTML::script('http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true') }}
{{ HTML::script('realia/js/gmap3.min.js') }}
{{ HTML::script('realia/js/gmap3.infobox.min.js') }}

{{ HTML::script('realia/js/realia.js') }}


{{ HTML::script('js/blueimp-gallery.min.js') }}
{{ HTML::script('js/jquery.blueimp-gallery.min.js') }}

{{ HTML::script('js/jquery.bootstrap.wizard.min.js') }}


</body>
</html>
