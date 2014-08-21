@extends('layout.print')

@section('content')
    <style type="text/css">
        h4{
            color:#FF0000;
        }

        .faq-body{
            margin-bottom: 30px;
            margin-top: 10px;
            text-align: left;
        }

        .faq-body h4{
            margin-bottom: 20px;
        }

        .faq-body p{
            font-size: 14px;
            line-height: 20px;
            font-family: Arial,sans-serif;
        }

        .footer{
            margin-top:25px;
        }

    </style>
            <div class="row-fluid" style="margin:0px;margin-top:20px;padding:0px;">
                @if(is_null($title))
                    <h1 class="page-header">Untitled</h1>
                @else
                    <h1 class="page-header">{{ $title }}</h1>
                @endif
            </div>
            <div class="row-fluid" style="padding:0px;">

                    @if(is_null($faqs))

                    @else
                        {{--@foreach($faqs as $fc=>$fi)

                            <h3 id="{{ $fc }}">{{ ucwords($fc) }}</h3>
                            --}}
                                <ul style="margin-left:10px;margin:bottom:20px;">
                                    @foreach($faqs as $faq)
                                        <div class="faq-body">
                                            <h4>Q. {{ $faq['title']}}</h4>
                                            <p>
                                                {{ $faq['body']}}
                                            </p>
                                        </div>
                                    @endforeach
                                </ul>
                        {{--@endforeach--}}
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