@extends('layout.front')

@section('content')

<div id="content-block">
    <div id="content-container" class="shadow" style="margin-bottom: 6px;" >

<div class="row">
    <div class="">
        <div class="row" style="margin:0px;padding:0px;">
            @if(is_null($faqs))
                <h1 class="page-header">No Glossary Entry</h1>
            @else
                <h1 class="page-header">Glossary</h1>
            @endif
        </div>

        <div class="row" style="margin:0px;padding:0px;padding-left:8px;">
            <div class="span12 lionbars" style="overflow-y:auto;height:340px;width:100%;margin:0px;margin-right:4px;">
                        @if(is_null($faqs))

                        @else
                            <?php $lastcat = '';?>

                                @foreach($faqs as $fc)
                                    @if( isset($fc['category']) && $lastcat != $fc['category'])
                                    <h3 id="{{ $fc['category']}}">{{ $fc['category']}}</h3>
                                    @endif
                                    <h4>{{ $fc['title']}}</h4>
                                    <div>
                                        {{ $fc['body']}}
                                    </div>
                                    <?php $lastcat = (isset($fc['category']))?$fc['category']:$lastcat;?>
                                @endforeach

                        @endif
            </div>
        </div>

    </div>
</div>

    </div>
</div>

@stop