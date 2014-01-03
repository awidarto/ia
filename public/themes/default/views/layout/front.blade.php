<!DOCTYPE html>
<html lang="en">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>{{ Config::get('site.name') }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		{{ HTML::style('bootstrap/css/bootstrap.min.css') }}
		{{-- HTML::style('bootstrap/css/bootstrap-responsive.min.css') --}}
		{{ HTML::style('font-awesome/css/font-awesome.min.css') }}

        {{ HTML::style('css/blueimp-gallery.min.css') }}

		{{-- HTML::style('bootstrap/css/bootswatch.css') --}}
		{{ HTML::style('bootstrap/css/app.css') }}

        {{ HTML::script('realia/js/jquery.js') }}

        <style type="text/css">

            html,
            body {
                height: 100%;
                /* The html and body elements cannot have any padding or margin. */
            }

            /* Wrapper for page content to push down footer */
            #wrap {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                /* Negative indent footer by it's height */
                margin: 0 auto -60px;
            }

            /* Set the fixed height of the footer here */
            #push,
            #footer {
                height: 30px;
            }
            #footer {
                background-color: #fff;
                width: 940px;
                padding: 15px 10px;
                margin-left: auto;
                margin-right: auto;
            }

            /* Lastly, apply responsive CSS fixes as necessary */
            @media (max-width: 767px) {
                #footer {
                    margin-left: -20px;
                    margin-right: -20px;
                    padding-left: 20px;
                    padding-right: 20px;
                }
            }

            #main-content{
                padding-top: 10px;
                background-color: #fff;
                padding:0px 0px;
                min-height: 100%;
                height: 100%;
                margin-bottom: 0px;
            }

            #main-content h1{
                margin-top: 20px;
                margin-bottom: 20px;
                padding-left: 10px;
            }

            @media (max-height: 768px){
                .page-view{
                    overflow-y:scroll;
                    height: 400px;
                }

                #main-content{
                    overflow-y:auto;
                    overflow-x:hidden;
                    height: 570px;
                }

                #main-content h1 {
                    margin-top: 8px;
                    margin-bottom: 8px;
                    padding-left: 10px;
                }

                #main-img img{
                    height:75px;
                    width: auto;
                }

                #main-img {
                    display:inline-block;
                    border : none;
                }

                #overview img{
                    height:45px;
                    width: auto;
                }

                [class*="span"] {
                    float: left;
                    min-height: 1px;
                    margin-left: 1px;
                }
            }

    </style>


</head>

<body class="preview" id="top" data-spy="scroll" data-target=".subnav" data-offset="80" cz-shortcut-listen="true" style="margin-top: 0px;">
	<!--  <script src="../js/bsa.js"></script> -->

<div id="wrap">

    <!-- Masthead
    ================================================== -->
    <div class="container">
        <header class="jumbotron subhead" id="overview">
            <div class="row">
                <div class="span6">
                    <a href="{{ URL::to('/')}}" >{{ HTML::image('images/ialogo.png','Investors Alliance',array('class'=>'img-responsive' ) ) }}</a>
                </div>
                <div class="span6">

                </div>
            </div>
        </header>
    </div>

    @include('partials.topfixednav')

    <div class="container" id="main-content">

    @yield('content')

    </div><!-- /container -->
    <div id="push"></div>
</div>
<div id="footer">
    <div class="container" style="border-top: thin solid #eee;">
        <p class="muted credit">&copy; 2013 - Investors Alliance</p>
    </div>
</div>

<!-- Footer
==================================================
<div id="footer" class="container">
    <p>&copy; 2013 - Investors Alliance</p>
</div>
-->


		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		{{ HTML::script('bootstrap/js/bootstrap.min.js')}}


		{{ HTML::script('bootstrap/js/jquery.smooth-scroll.min.js') }}
		{{ HTML::script('bootstrap/js/bootswatch.js') }}

        {{ HTML::script('js/blueimp-gallery.min.js') }}
        {{ HTML::script('js/jquery.blueimp-gallery.min.js') }}

</body>
</html>