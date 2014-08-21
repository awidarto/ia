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
    </style>
            <div class="row" style="margin:0px;margin-top:20px;padding:0px;">
                @if(is_null($title))
                    <h1 class="page-header">Untitled</h1>
                @else
                    <h1 class="page-header">{{ $title }}</h1>
                @endif
            </div>
            <div class="row" style="padding:8px;">

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
@stop