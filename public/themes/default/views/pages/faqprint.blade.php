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
            </div>
@stop