<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="realia/img/favicon.png" type="image/png">

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

                <div class="widget span3">
                    <div class="title">
                        <h2>Contact us</h2>
                    </div><!-- /.title -->

                    <div class="content">
                        <table class="contact">
                            <tbody>
                            <tr>
                                <th class="address">Address:</th>
                                <td>1900 Pico Blvd<br>Santa Monica, CA 90405<br>United States<br></td>
                            </tr>
                            <tr>
                                <th class="phone">Phone:</th>
                                <td>+48 123 456 789</td>
                            </tr>
                            <tr>
                                <th class="email">E-mail:</th>
                                <td><a href="mailto:info@yourcompany.com">info@example.com</a></td>
                            </tr>
                            <tr>
                                <th class="skype">Skype:</th>
                                <td>your.company</td>
                            </tr>
                            <tr>
                                <th class="gps">GPS:</th>
                                <td>34.016811<br>-118.469009</td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /.content -->
                </div><!-- /.widget -->

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
            </div><!-- /.row -->
        </div><!-- /#footer-top-inner -->
    </div><!-- /#footer-top -->

    @include('realia/footer')

</div><!-- /#footer-wrapper -->
</div><!-- /#wrapper -->
</div><!-- /#wrapper-outer -->

{{--
<div class="palette">
    <div class="toggle">
        <a href="#">Toggle</a>
    </div><!-- /.toggle -->

    <div class="inner">
        <div class="headers">
            <h2>Header styles</h2>
            <ul>
                <li><a class="header-light">Light</a></li>
                <li><a class="header-normal">Normal</a></li>
                <li><a class="header-dark">Dark</a></li>
            </ul>
        </div><!-- /.headers -->

        <div class="patterns">
            <h2>Background patterns</h2>
            <ul>
                <li><a class="pattern-cloth-alike">cloth-alike</a></li>
                <li><a class="pattern-corrugation">corrugation</a></li>
                <li><a class="pattern-diagonal-noise">diagonal-noise</a></li>
                <li><a class="pattern-dust">dust</a></li>
                <li><a class="pattern-fabric-plaid">fabric-plaid</a></li>
                <li><a class="pattern-farmer">farmer</a></li>
                <li><a class="pattern-grid-noise">grid-noise</a></li>
                <li><a class="pattern-lghtmesh">lghtmesh</a></li>
                <li><a class="pattern-pw-maze-white">pw-maze-white</a></li>
                <li><a class="pattern-none">none</a></li>
            </ul>
        </div>

        <div class="colors">
            <h2>Color variants</h2>
            <ul>
                <li><a href="assets/css/realia-red.css" class="red">Red</a></li>
                <li><a href="assets/css/realia-magenta.css" class="magenta">Magenta</a></li>
                <li><a href="assets/css/realia-brown.css" class="brown">Brown</a></li>
                <li><a href="assets/css/realia-orange.css" class="orange">Orange</a></li>
                <li><a href="assets/css/realia-brown-dark.css" class="brown-dark">Brown dark</a></li>

                <li><a href="assets/css/realia-gray-red.css" class="gray-red">Gray Red</a></li>
                <li><a href="assets/css/realia-gray-magenta.css" class="gray-magenta">Gray Magenta</a></li>
                <li><a href="assets/css/realia-gray-brown.css" class="gray-brown">Gray Brown</a></li>
                <li><a href="assets/css/realia-gray-orange.css" class="gray-orange">Gray Orange</a></li>
                <li><a href="assets/css/realia-gray-brown-dark.css" class="gray-brown-dark">Gray Brown dark</a></li>

                <li><a href="assets/css/realia-green-light.css" class="green-light">Green light</a></li>
                <li><a href="assets/css/realia-green.css" class="green">Green</a></li>
                <li><a href="assets/css/realia-turquiose.css" class="turquiose">Turquiose</a></li>
                <li><a href="assets/css/realia-blue.css" class="blue">Blue</a></li>
                <li><a href="assets/css/realia-violet.css" class="violet">Violet</a></li>

                <li><a href="assets/css/realia-gray-green-light.css" class="gray-green-light">Gray Green light</a></li>
                <li><a href="assets/css/realia-gray-green.css" class="gray-green">Gray Green</a></li>
                <li><a href="assets/css/realia-gray-turquiose.css" class="gray-turquiose">Gray Turquiose</a></li>
                <li><a href="assets/css/realia-gray-blue.css" class="gray-blue">Gray Blue</a></li>
                <li><a href="assets/css/realia-gray-violet.css" class="gray-violet">Gray Violet</a></li>
            </ul>
        </div><!-- /.colors -->

        <a href="#" class="btn btn-primary reset">Reset default</a>
    </div><!-- /.inner -->
</div><!-- /.palette -->
--}}

{{ HTML::script('http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true') }}
{{ HTML::script('realia/js/jquery.ezmark.js') }}
{{ HTML::script('realia/js/jquery.currency.js') }}
{{ HTML::script('realia/js/jquery.cookie.js') }}
{{ HTML::script('realia/js/retina.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('realia/js/carousel.js') }}
{{ HTML::script('realia/js/gmap3.min.js') }}
{{ HTML::script('realia/js/gmap3.infobox.min.js') }}
{{ HTML::script('realia/libraries/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js') }}
{{ HTML::script('realia/libraries/chosen/chosen.jquery.min.js') }}
{{ HTML::script('realia/libraries/iosslider/_src/jquery.iosslider.min.js') }}
{{ HTML::script('realia/libraries/bootstrap-fileupload/bootstrap-fileupload.js') }}
{{ HTML::script('realia/js/realia.js') }}


{{ HTML::script('js/blueimp-gallery.min.js') }}
{{ HTML::script('js/jquery.blueimp-gallery.min.js') }}

{{ HTML::script('js/jquery.bootstrap.wizard.min.js') }}

</body>
</html>
