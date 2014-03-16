@extends('layout.front')

@section('content')

<div id="content-block">
    <div id="content-container" class="shadow" style="margin-bottom: 6px;" >

<div class="row">
    <div class="">
        <div class="row" style="margin:0px;padding:0px;">
            <h1 class="page-header">Glossary</h1>
        </div>

        <div class="row" style="margin:0px;padding:0px;padding-left:8px;">
            <div class="span12 lionbars" style="overflow-y:auto;height:340px;width:100%;margin:0px;margin-right:4px;">
                @foreach($faqcats as $fc)
                    <h3 id="{{ $fc['slug']}}">{{ $fc['title']}}</h3>
                        <ul style="margin-left:10px;">
                            @foreach($faqs[$fc['title']] as $faq)
                                <h4>{{ $faq['title']}}</h4>
                                <div>
                                    {{ $faq['body']}}
                                </div>
                            @endforeach
                        </ul>
                @endforeach
            </div>
        </div>

    </div>
</div>

    </div>
</div>

@stop