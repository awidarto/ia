@extends('layout.print')

@section('content')
    <style type="text/css">
        h4{
            color:#FF0000;
        }

        .page-body{
            margin-bottom: 15px;
            margin-top: 10px;
            text-align: left;
        }

        .page-body h4{
            margin-bottom: 10px;
        }

        .footer{
            margin-top:25px;
        }
    </style>
            <div class="row-fluid page-body" style="margin:0px;margin-top:20px;padding:0px;">
                @if(is_null($content))
                    <h1 class="page-header">Page Doesn't Exists</h1>
                @else
                    <h1 class="page-header">{{ $content['title'] }}</h1>
                @endif
            </div>
            <div class="row-fluid page-body" style="padding:0px;">
                @if(is_null($content))
                    <p>Sorry, this page apparently does not exist yet.</p>
                @else
                    {{ $content['body'] }}
                @endif
            </div>

            <div class="footer">
                <p class="muted credit">Copyright &copy; 2013 - Investors Alliance USA Property | Terms & Conditions | Privacy Policy</p>
                <p class="disclaimer" >
                    <strong>DISCLAIMER:</strong> While every effort is made to ensure that this information is accurate and conforms with all applicable legal requirements it is supplied in good faith as an aid to users. Investors Alliance do not warrant that it is complete, comprehensive or accurate, or commit to its being updated. In no event shall Investors Alliance be liable for any incidental, indirect, consequential or special damages of any kind, or any damages whatsoever, including, without limitation, those resulting from loss of profit, loss of contracts, goodwill, data, information, income, expected savings or business relationships, whether or not advised of the possibility of such damage, arising out of or in connection with the use of this information.
                </p>
                <p class="disclaimer">
                    Copyright - All materials contained herein are, unless otherwise stated, the property of Investors Alliance. Reproduction or retransmission of the materials, in whole or in part, in any manner, without the prior written consent of the copyright holder, is a violation of copyright law.
                </p>
            </div>

@stop