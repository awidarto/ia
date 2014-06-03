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

        {{ HTML::style('bootstrap/css/bootstrap.css') }}
        {{-- HTML::style('bootstrap/css/bootstrap-responsive.min.css') --}}
        {{ HTML::style('font-awesome/css/font-awesome.min.css') }}

        {{-- HTML::style('bootstrap/css/bootswatch.css') --}}
        {{ HTML::style('bootstrap/css/app.css') }}

        {{ HTML::script('js/jquery-1.9.1.js') }}


        {{-- HTML::style('bootstrap/css/app.css') --}}
        {{-- HTML::style('bootstrap/css/bootstrap-wide.css') --}}

        {{ HTML::style('font-awesome/css/font-awesome.min.css') }}

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
            }

            #main-content{
                padding-top: 10px;
                padding:0px 0px;
                max-height: 460px;
                margin-bottom: 0px;
                border-left: thin solid #eee;
                border-right: thin solid #eee;
                background:url({{ URL::to('/');}}/images/skyline-bg.jpg) top center no-repeat;
            }

            #main-content h1{
                margin-top: 20px;
                margin-bottom: 20px;
                padding-left: 10px;
            }

            #content-block{
                width: 1070px;
                height: 460px;
                padding: 0px;
                max-height: 460px;
                overflow: hidden;
                margin-right: auto;
                margin-left: auto;
                display: block;
            }

            #content-container{
                position:relative;
                width: auto;
                height: auto;
                margin: 22px;
                min-height: 400px;
                background-color: white;
                display: block;
            }

            #footer .container{
                width:1070px;
                border-left: thin solid #eee;
                border-right: thin solid #eee;
            }

            .white-text{
                color: white;
                display: inline-block;
            }

            .sel-label{
                padding-bottom: 10px;
            }

            p.credit{
                margin-bottom: 0px;
            }

            p.disclaimer{
                line-height: 16px;
            }

            @media (max-height: 768px){
                .page-view{
                    overflow-y:scroll;
                    height: 400px;
                }

                #main-content{
                    overflow-y:auto;
                    overflow-x:hidden;
                    /*min-height: 570px;*/
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

<body class="preview" style="margin-top: 0px;" onload="window.print()" >

<div id="wrap">

    <!-- Masthead
    ================================================== -->
    <div class="container" id="top-container">
        <header class="jumbotron subhead" id="overview">
            <div class="row">
                <div class="span4">
                    <a style="margin-left:66px;" href="{{ URL::to('/')}}" >{{ HTML::image('images/ialogo-med.png','Investors Alliance',array('class'=>'img-responsive' ) ) }}</a>
                </div>
                <div class="span8 pull-right">
                </div>
            </div>
        </header>
    </div>


    <div class="container">
        @yield('content')
    </div><!-- /container -->

</div>


</body>
</html>