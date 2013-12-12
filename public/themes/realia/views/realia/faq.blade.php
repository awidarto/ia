@extends('realia.layout')

@section('content')

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span6">

                <?php $counter = 0 ?>
                <?php $cc = 0 ?>

                @foreach( $faqs as $cat=>$content )

                    @if( $counter%2 == 0 )
                        <h2>{{ $cat }}</h2>
                        <div class="accordion" id="faqLeft{{ $counter }}">
                            @foreach($content['content'] as $c)
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqLeft{{ $counter }}" href="#collapseLeft{{$cc}}">
                                            <span class="sign"></span> {{ $c['title'] }}
                                        </a>
                                    </div><!-- /.accordion-heading -->

                                    <div id="collapseLeft{{$cc}}" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            {{ $c['body'];  }}
                                        </div><!-- /.accordion-inner -->
                                    </div><!-- /.accordion-body -->
                                </div><!-- /.accordion-group -->
                                <?php $cc++; ?>
                            @endforeach
                        </div>

                    @endif

                    <?php $counter++ ?>

                @endforeach

            </div><!-- /.span6 -->

            <div class="span6">

                <?php $counter = 1 ?>
                <?php $cc = 0 ?>

                @foreach( $faqs as $cat=>$content )

                    @if( $counter%2 == 0 )
                        <h2>{{ $cat }}</h2>
                        <div class="accordion" id="faqRight{{ $counter }}">
                            @foreach($content['content'] as $c)
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqRight{{ $counter }}" href="#collapseRight{{$cc}}">
                                            <span class="sign"></span> {{ $c['title'] }}
                                        </a>
                                    </div><!-- /.accordion-heading -->

                                    <div id="collapseRight{{$cc}}" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            {{ $c['body'];  }}
                                        </div><!-- /.accordion-inner -->
                                    </div><!-- /.accordion-body -->
                                </div><!-- /.accordion-group -->
                                <?php $cc++; ?>
                            @endforeach
                        </div>

                    @endif

                    <?php $counter++ ?>

                @endforeach


            </div><!-- /.span6 -->


        </div><!-- /.row -->

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>


@stop