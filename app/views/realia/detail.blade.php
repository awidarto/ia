@extends('realia.layout')

@section('content')

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">
                <h1 class="page-header">{{ $prop['number'].' '.$prop['address'] }}</h1>

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
                                    <button class="btn btn-primary pull-right">
                                        Buy Now
                                    </button>
                            </div>
                            <!-- /.span2 -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ullamcorper libero sed
                        ante auctor vel gravida nunc placerat. Suspendisse molestie posuere sem, in viverra dolor
                        venenatis sit amet. Aliquam gravida nibh quis justo pulvinar luctus. Phasellus a malesuada
                        massa. Mauris elementum tempus nisi, vitae ullamcorper sem ultricies vitae. Nullam consectetur
                        lacinia nisi, quis laoreet magna pulvinar in. Class aptent taciti sociosqu ad litora torquent
                        per conubia nostra, per inceptos himenaeos. In hac habitasse platea dictumst. Cum sociis natoque
                        penatibus et magnis dis parturient montes, nascetur ridiculus mus.</strong> Morbi eu sapien ac
                        diam facilisis vehicula nec sit amet odio. Vivamus quis dui ac nulla molestie blandit eu in
                        nunc. In justo erat, lacinia in vulputate non, tristique eu mi. Aliquam tristique dapibus
                        tempor. Vivamus malesuada tempor urna, in convallis massa lacinia sed. Phasellus gravida auctor
                        vestibulum. Suspendisse potenti. In tincidunt felis bibendum nunc tempus sagittis. Praesent elit
                        dolor, ultricies interdum porta sit amet, iaculis in neque. Nullam urna ante, tempus vel iaculis
                        nec, rutrum sit amet nulla. Morbi vestibulum ante in turpis ultricies in tincidunt sapien
                        iaculis. Aenean feugiat rhoncus arcu, at luctus libero blandit tempus. Vivamus rutrum tellus
                        quis leo placerat eu adipiscing purus vehicula.</p>

                    <!--

                    <h2>General amenities</h2>

                    <div class="row">
                        <ul class="span2">
                            <li class="checked">
                                Air conditioning
                            </li>
                            <li class="checked">
                                Balcony
                            </li>
                            <li class="checked">
                                Bedding
                            </li>
                            <li class="checked">
                                Cable TV
                            </li>
                            <li class="plain">
                                Cleaning after exit
                            </li>
                            <li class="plain">
                                Cofee pot
                            </li>
                            <li class="plain">
                                Computer
                            </li>
                            <li class="checked">
                                Cot
                            </li>
                        </ul>
                        <ul class="span2">
                            <li class="checked">
                                Dishwasher
                            </li>
                            <li class="checked">
                                DVD
                            </li>
                            <li class="checked">
                                Fan
                            </li>
                            <li class="checked">
                                Fridge
                            </li>
                            <li class="checked">
                                Grill
                            </li>
                            <li class="checked">
                                Hairdryer
                            </li>
                            <li class="plain">
                                Heating
                            </li>
                            <li class="checked">
                                Hi-fi
                            </li>
                        </ul>
                        <ul class="span2">
                            <li class="plain">
                                Internet
                            </li>
                            <li class="checked">
                                Iron
                            </li>
                            <li class="checked">
                                Juicer
                            </li>
                            <li class="checked">
                                Lift
                            </li>
                            <li class="plain">
                                Microwave
                            </li>
                            <li class="plain">
                                Oven
                            </li>
                            <li class="checked">
                                Parking
                            </li>
                            <li class="plain">
                                Parquet
                            </li>
                        </ul>
                        <ul class="span2">
                            <li class="plain">
                                Radio
                            </li>
                            <li class="checked">
                                Roof terrace
                            </li>
                            <li class="plain">
                                Smoking allowed
                            </li>
                            <li class="checked">
                                Terrace
                            </li>
                            <li class="plain">
                                Toaster
                            </li>
                            <li class="plain">
                                Towelwes
                            </li>
                            <li class="plain">
                                Use of pool
                            </li>
                            <li class="plain">
                                Video
                            </li>
                        </ul>
                    </div>
                    -->

                    <h2>Map</h2>

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



                g.each(function(){
                    links.push({
                        href:$(this).val(),
                        title:$(this).data('caption')
                    });
                })
                var options = {
                    carousel: false
                };
                blueimp.Gallery(links, options);



        </script>

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>


@stop
