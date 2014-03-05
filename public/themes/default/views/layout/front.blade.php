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

        {{ HTML::style('css/lionbars.css') }}

        {{ HTML::style('css/custom-theme/jquery-ui-1.10.3.custom.css')}}

		{{-- HTML::style('bootstrap/css/bootswatch.css') --}}
		{{ HTML::style('bootstrap/css/app.css') }}

        {{ HTML::script('js/jquery-1.9.1.js') }}

        {{ HTML::script('js/jquery-ui/js/jquery-ui-1.10.3.custom.min.js')}}

        {{ HTML::style('bootstrap/css/app.css') }}
        {{-- HTML::style('bootstrap/css/bootstrap-wide.css') --}}

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

            #top-container{
                width:1070px;
                border-left: thin solid #eee;
                border-right: thin solid #eee;
            }

            #main-content{
                padding-top: 10px;
                padding:0px 0px;
                min-height: 460px;
                height: 450px;
                margin-bottom: 0px;
                width: 1070px;
                border-left: thin solid #eee;
                border-right: thin solid #eee;
            }

            #main-content h1{
                margin-top: 20px;
                margin-bottom: 20px;
                padding-left: 10px;
            }

            #footer .container{
                width:1070px;
                border-left: thin solid #eee;
                border-right: thin solid #eee;
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
                    width: auto;
                }

                #main-img {
                    display:inline-block;
                    border : none;
                }

                #overview img{
                    height:75px;
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
    <div class="container" id="top-container">
        <header class="jumbotron subhead" id="overview">
            <div class="row">
                <div class="span4">
                    <a href="{{ URL::to('/')}}" >{{ HTML::image('images/ialogo-med.png','Investors Alliance',array('class'=>'img-responsive' ) ) }}</a>
                </div>
                <div class="span8 pull-right">
                    <div class="pull-right" id="main-menu-right">
                        @include('partials.identity')
                    </div>
                    <div class="clearfix"></div>
                    @include('partials.topfixednav')
                </div>
            </div>
        </header>
    </div>


    <div class="container" id="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div><!-- /container -->
    <div id="footer">
        <div class="container">
            <p class="muted credit">Copyright &copy; 2013 - Investors Alliance USA Property | Terms & Conditions | Privacy Policy</p>
        </div>
    </div>
</div>

<div id="loginModal" class="modal hide fade" style="width:250px;margin-left:-125px;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Login</h3>
  </div>
  <div class="modal-body">
        {{Former::open_horizontal('login','POST',array('class'=>''))}}
            @if (Session::get('loginError'))
                <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                     <button type="button" class="close" data-dismiss="alert"></button>
            @endif
            {{ Former::text('email','Email')->class('span2') }}

            {{ Former::password('password','Password')->class('span2') }}

            {{-- Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') --}}

            {{ Former::submit('Login')->class('btn btn-primary pull-right') }}

        {{ Former::close() }}
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

        {{ HTML::script('js/jquery.lionbars.0.3.min.js') }}

        <script type="text/javascript">
            var base = '{{ URL::to('/')}}/';
        </script>

        {{ HTML::script('js/ia.js') }}

</body>
</html>