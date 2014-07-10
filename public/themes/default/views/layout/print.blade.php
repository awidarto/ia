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

        {{-- HTML::style('bootstrap/css/bootswatch.css') --}}
        {{-- HTML::style('bootstrap/css/app.css') --}}

        {{-- HTML::script('js/jquery-1.9.1.js') --}}


        {{-- HTML::style('bootstrap/css/app.css') --}}
        {{-- HTML::style('bootstrap/css/bootstrap-wide.css') --}}

        {{-- HTML::style('font-awesome/css/font-awesome.min.css') --}}

        <style type="text/css">
            /*
                html,
                body {
                    height: 100%;
                }
            #top-container{
                width:960px;
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

            .white-text{
                color: white;
                display: inline-block;
            }

            .sel-label{
                padding-bottom: 10px;
            }


        */
            body{
                font-family: arial,helvetica,sans-serif;
                font-size: 12px;
            }

            p.credit{
                margin-bottom: 0px;
            }

            p.disclaimer{
                line-height: 16px;
                font-size:10px;
                color:#ccc;
                text-align:justify;
            }

            h1.page-header{
                color: red;
                font-size: 30px;
            }

            .container{
                padding:0px 30px;
            }

            @media print{
                #footer {
                     display: block;
                     position: relative;
                     bottom: 0;
                }

                tbody{
                    display: block;
                }

                thead{
                    display: table-header-group;
                }

                tfoot{
                    display: table-footer-group;
                }
            }

            @media screen{
                thead{
                    display: block;
                }

                tfoot{
                    display: block;
                }

            }

    </style>
</head>

<body class="preview" style="margin-top: 0px;"  onload="window.print()" >

    <table border="0" width="100%">
        <thead>
            <tr>
                <th style="width:100%">
                    <div class="container" id="top-container">
                        <header class="jumbotron subhead" id="overview">
                            <div class="row-fluid">
                                <div class="span4 pull-right" style="display:block;">
                                    {{ HTML::image('images/ialogo-med.png','Investors Alliance',array('class'=>'img-responsive' ) ) }}
                                </div>
                                <div class="span8 pull-right">
                                </div>
                            </div>
                        </header>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="container">
                        @yield('content')
                    </div><!-- /container -->
                    <div style="height:100%;">

                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot id="footer">
            <tr>
                <td>
                    <div class="container">
                        <p class="muted credit">Copyright &copy; 2013 - Investors Alliance USA Property | Terms & Conditions | Privacy Policy</p>
                        <p class="disclaimer" >
                            <strong>DISCLAIMER:</strong> While every effort is made to ensure that this information is accurate and conforms with all applicable legal requirements it is supplied in good faith as an aid to users. Investors Alliance do not warrant that it is complete, comprehensive or accurate, or commit to its being updated. In no event shall Investors Alliance be liable for any incidental, indirect, consequential or special damages of any kind, or any damages whatsoever, including, without limitation, those resulting from loss of profit, loss of contracts, goodwill, data, information, income, expected savings or business relationships, whether or not advised of the possibility of such damage, arising out of or in connection with the use of this information.
                        </p>
                        <p class="disclaimer">
                            Copyright - All materials contained herein are, unless otherwise stated, the property of Investors Alliance. Reproduction or retransmission of the materials, in whole or in part, in any manner, without the prior written consent of the copyright holder, is a violation of copyright law.
                        </p>
                        <img src="{{ URL::to('images/ia_print_footer.png')}}" alt="footer image" />
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>

    {{--

    <table id="footer" width="100%">
        <tr>
            <td>
                <div class="container">
                    <p class="muted credit">Copyright &copy; 2013 - Investors Alliance USA Property | Terms & Conditions | Privacy Policy</p>
                    <p class="disclaimer" >
                        <strong>DISCLAIMER:</strong> While every effort is made to ensure that this information is accurate and conforms with all applicable legal requirements it is supplied in good faith as an aid to users. Investors Alliance do not warrant that it is complete, comprehensive or accurate, or commit to its being updated. In no event shall Investors Alliance be liable for any incidental, indirect, consequential or special damages of any kind, or any damages whatsoever, including, without limitation, those resulting from loss of profit, loss of contracts, goodwill, data, information, income, expected savings or business relationships, whether or not advised of the possibility of such damage, arising out of or in connection with the use of this information.
                    </p>
                    <p class="disclaimer">
                        Copyright - All materials contained herein are, unless otherwise stated, the property of Investors Alliance. Reproduction or retransmission of the materials, in whole or in part, in any manner, without the prior written consent of the copyright holder, is a violation of copyright law.
                    </p>
                    <img src="{{ URL::to('images/ia_print_footer.png')}}" alt="footer image" />
                </div>
            </td>
        </tr>
    </table>
    --}}

</body>
</html>