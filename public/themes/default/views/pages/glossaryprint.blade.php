@extends('layout.print')

@section('content')
    <style type="text/css">
        h4{
            color:#FF0000;
        }

        .faq-body{
            margin-bottom: 15px;
            margin-top: 10px;
            text-align: left;
        }

        .faq-body h4{
            margin-bottom: 10px;
        }

        .faq-body p{
            font-size: 14px;
            line-height: 20px;
            font-family: Arial,sans-serif;
        }

        .footer{
            margin-top:25px;
            padding:10px 0px;
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
                    <?php $lastcat = ''; $cat_count = 0; ?>

                    @foreach($faqs as $fc)
                        @if( isset($fc['category']) && $lastcat != $fc['category'])
                            @if($cat_count > 0 )
                                </div>
                            @endif
                            <?php $cat_count++; ?>
                            <div class="section" id="section-{{ $fc['category']}}">
                            <h3>{{ $fc['category']}}</h3>
                        @endif
                            <div class="faq-body" >
                                <h4>{{ $fc['title']}}</h4>
                                <p>
                                    {{ $fc['body']}}
                                </p>
                            </div>

                        <?php $lastcat = (isset($fc['category']))?$fc['category']:$lastcat;?>
                    @endforeach
                        </div>

            @endif

        </div>

    </div>

    <div class="row-fluid footer">
        <div class="span12">
            <p class="muted credit">Copyright &copy; 2013 - Investors Alliance USA Property | Terms & Conditions | Privacy Policy</p>
            <p class="disclaimer" >
                <strong>DISCLAIMER:</strong> While every effort is made to ensure that this information is accurate and conforms with all applicable legal requirements it is supplied in good faith as an aid to users. Investors Alliance do not warrant that it is complete, comprehensive or accurate, or commit to its being updated. In no event shall Investors Alliance be liable for any incidental, indirect, consequential or special damages of any kind, or any damages whatsoever, including, without limitation, those resulting from loss of profit, loss of contracts, goodwill, data, information, income, expected savings or business relationships, whether or not advised of the possibility of such damage, arising out of or in connection with the use of this information.
            </p>
            <p class="disclaimer">
                Copyright - All materials contained herein are, unless otherwise stated, the property of Investors Alliance. Reproduction or retransmission of the materials, in whole or in part, in any manner, without the prior written consent of the copyright holder, is a violation of copyright law.
            </p>

        </div>
    </div>

@stop