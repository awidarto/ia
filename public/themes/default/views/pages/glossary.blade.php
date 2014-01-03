@extends('layout.front')

@section('content')
    <h1>Glossary</h1>
    <div class="row">
      <div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav">
            @foreach($faqcats as $fc)
                <li><a href="#{{ $fc['slug']}}"><i class="icon-chevron-right"></i> {{ $fc['title']}}</a></li>
            @endforeach
        </ul>
      </div>
        <div class="span8" style="padding-left: 15px;" >
            @foreach($faqcats as $fc)
                <h3>{{ $fc['title']}}</h3>
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