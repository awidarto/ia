<!DOCTYPE html>
<html lang="en"><script type="text/javascript" async="" src="index_files/ga.js"></script>
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

		{{-- HTML::style('bootstrap/css/bootswatch.css') --}}
		{{ HTML::style('bootstrap/css/app.css') }}

        {{ HTML::script('bootstrap/js/jquery.min.js') }}

</head>

<body class="preview" id="top" data-spy="scroll" data-target=".subnav" data-offset="80" cz-shortcut-listen="true" style="margin-top: 0px;">
	<!--  <script src="../js/bsa.js"></script> -->

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


<br><br><br><br>

		 <!-- Footer
			================================================== -->
			<hr>

			<footer id="footer">
				<p class="pull-right"><a href="http://bootswatch.com/2/united/#top">Back to top</a></p>
				<div class="links">
                    <p>&copy; 2013 - Investors Alliance</p>
				</div>
			</footer>

		</div><!-- /container -->



		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		{{ HTML::script('bootstrap/js/bootstrap.min.js')}}


		{{ HTML::script('bootstrap/js/jquery.smooth-scroll.min.js') }}
		{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
		{{ HTML::script('bootstrap/js/bootswatch.js') }}




</body></html>