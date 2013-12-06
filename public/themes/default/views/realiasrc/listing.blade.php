@extends('realia.layout')

@section('content')

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">

               <h1 class="page-header">Properties</h1>


                <div class="properties-grid">

                    @foreach($properties as $p)

                        <div class="property span3">
                            <div class="image">
                                <div class="content">
                                    <a href="{{ URL::to('property/detail/'.$p['_id'] )}}"></a>
                                    <img src="{{ $p['defaultpictures']['large_url'] }}" alt="">
                                </div><!-- /.content -->

                                <div class="price">$ {{ $p['listingPrice'] }}</div><!-- /.price -->
                            </div><!-- /.image -->

                            <div class="title">
                                <h2><a href="detail.html">{{ $p['number'].' '.$p['address'] }}</a></h2>
                            </div><!-- /.title -->

                            <div class="location">{{ $p['city'] }} {{ $p['state'] }}</div><!-- /.location -->
                            <div class="area">
                                <span class="key">Lot Size:</span><!-- /.key -->
                                <span class="value">{{ $p['lotSize'] }}</span><!-- /.value -->
                            </div><!-- /.area -->
                            <div class="bedrooms"><div class="content">{{ $p['bed'] }}</div></div><!-- /.bedrooms -->
                            <div class="bathrooms"><div class="content">{{ $p['bath'] }}</div></div><!-- /.bathrooms -->
                        </div><!-- /.property -->

                    @endforeach

                </div><!-- /.properties-grid -->
                <div class="pagination pagination-centered">
                    <ul>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li class="active"><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">next</a></li>
                        <li><a href="#">last</a></li>
                    </ul>
                </div><!-- /.pagination -->

            </div>
            <div class="sidebar span3">

                @include('realia.latest')


            </div>
        </div>

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>


@stop