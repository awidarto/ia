@extends('layout.print')

@section('content')
    <div class="row">
        <div >
            <div class="row" style="margin:0px;padding:0px;">
                @if(is_null($title))
                    <h1 class="page-header">Untitled</h1>
                @else
                    <h1 class="page-header">{{ $title }}</h1>
                @endif
            </div>
            <div class="row" >

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
                                    <h4>{{ $fc['title']}}</h4>
                                    <div>
                                        {{ $fc['body']}}
                                    </div>

                                <?php $lastcat = (isset($fc['category']))?$fc['category']:$lastcat;?>
                            @endforeach
                                </div>

                    @endif

                </div>
            </div>

        </div>
    </div>
@stop