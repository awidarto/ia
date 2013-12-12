@extends('realia.layout')

@section('content')

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">
                <h1 class="page-header">{{ $prop['number'].' '.$prop['address'].', '.$prop['state'] }}</h1>

                {{--
                <div class="carousel property">
                    <div class="preview">
                        <img src="{{ $prop['defaultpictures']['large_url'] }}" alt="">
                    </div><!-- /.preview -->

                    <div class="content">

                        <a class="carousel-prev" href="#">Previous</a>
                        <a class="carousel-next" href="#">Next</a>
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.carousel -->

                --}}

                <div class="thumb-grid">
                        <ul class="thumbnails_grid">
                            @foreach($prop['files'] as $f )
                                <li>
                                    <a href="{{ $f['large_url'] }}" title="{{$f['caption']}}" data-gallery >
                                        <img src="{{ $f['medium_url'] }}" alt="{{$f['caption']}}">
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                </div>

                <div class="clearfix"></div>
                <div class="property-detail">
                    <div class="pull-left overview">
                        <div class="row">
                            <div class="span3">
                                <h2>Overview</h2>

                                <table>
                                    <tr>
                                        <th>Price:</th>
                                        <td>US$ {{ $prop['listingPrice']}}</td>
                                    </tr>
                                    <tr>
                                        <th>FMV:</th>
                                        <td>US$ {{ $prop['FMV']}}</td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>{{ $prop['type']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Construction</th>
                                        <td>{{ $prop['typeOfConstruction']}}</td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <th>Location:</th>
                                        <td>{{ $prop['city'].','.$prop['state']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Bathrooms:</th>
                                        <td>{{ $prop['bath']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Bedrooms:</th>
                                        <td>{{$prop['bed']}}</td>
                                    </tr>
                                    <tr>
                                        <th>House Area:</th>
                                        <td>{{$prop['houseSize']}} ft<sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <th>Lot Size:</th>
                                        <td>{{$prop['lotSize']}} ft<sup>2</sup></td>
                                    </tr>
                                </table>
                                    <br />
                                    <a href="{{ URL::to('property/buy/'.$prop['_id']) }}" class="btn btn-primary pull-right">
                                        Buy Now
                                    </a>
                            </div>
                            <!-- /.span2 -->
                        </div>
                        <!-- /.row -->
                    </div>

                    {{ (isset($prop['description']))?$prop['description']:'<p>No description</p>'}}

                    <div class="clearfix"></div>

                    <div id="finance-calculator" class="overview span3 pull-left">
                        <h2>Finance Calculator</h2>

                        <h3>Simple Interest Calculator </h3>

                        {{ Former::open_vertical() }}
                            {{ Former::text('balance','Amount')->append('$')->value($prop['listingPrice'])->id('balance')}}
                            {{ Former::text('rate','Rate')->append('%')->value(5)->id('rate')}}
                            {{ Former::text('term','Term')->append('Years')->value(30)->id('term')}}
                            {{ Former::button('Calculate')->class('btn btn-primary pull-right')}}
                        {{ Former::close() }}

                    </div>

                    <div class="clearfix"></div>
                    <h2>Map</h2>

                    {{ Former::hidden('ia-latitude')->value(isset($prop['latitude'])?$prop['latitude']:0)->id('ia-latitude') }}
                    {{ Former::hidden('ia-longitude')->value(isset($prop['longitude'])?$prop['longitude']:0)->id('ia-longitude') }}
                    {{ Former::hidden('ia-zoom')->value(isset($prop['zoom'])?$prop['zoom']:11)->id('ia-zoom') }}

                    <div id="property-map"></div><!-- /#property-map -->
                </div>

            </div>
            <div class="sidebar span3">

                @include('realia.latest')


            </div>
        </div>

        <div id="blueimp-gallery" class="blueimp-gallery  blueimp-gallery-controls">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>

        <script type="text/javascript">

        </script>

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>


@stop
