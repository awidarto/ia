@extends('layout.front')

@section('content')
    <div class="row">
      <div class="span3 bs-docs-sidebar">
        <h1 style="margin-top:6px;" class="affix">FAQ</h1>
        <ul class="nav nav-list bs-docs-sidenav affix" style="width: 200px;top: 140px;">
            @foreach($faqcats as $fc)
                <li><a href="#{{ $fc['slug']}}"><i class="icon-chevron-right"></i> {{ $fc['title']}}</a></li>
            @endforeach
        </ul>
      </div>
        <div class="span8" style="padding-left: 15px;overflow-y:auto;" >
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
@stop