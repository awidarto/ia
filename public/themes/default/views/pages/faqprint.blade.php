@extends('layout.print')

@section('content')
    <style type="text/css">
        h4{
            color:#FF0000;
        }

        .faq-body{
            margin-bottom: 20px;
        }
    </style>
    <div class="row">
        <div >
            <div class="row" style="margin:-8px;padding:0px;">
                @if(is_null($title))
                    <h1 class="page-header">Untitled</h1>
                @else
                    <h1 class="page-header">{{ $title }}</h1>
                @endif
            </div>
            <div class="row" >

                    @if(is_null($faqs))

                    @else
                        @foreach($faqs as $fc=>$fi)
                            {{--
                            <h3 id="{{ $fc }}">{{ ucwords($fc) }}</h3>
                            --}}
                                <ul style="margin-left:10px;margin:bottom:20px;">
                                    @foreach($fi as $faq)
                                        <h4>Q. {{ $faq['title']}}</h4>
                                        <div class="faq-body">
                                            {{ $faq['body']}}
                                        </div>
                                    @endforeach
                                </ul>
                        @endforeach
                    @endif

                </div>
            </div>

        </div>
    </div>
@stop