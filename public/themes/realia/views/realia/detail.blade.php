@extends('realia.layout')

@section('content')

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">
                <h1 class="page-header"><a href="{{ URL::to('property/listing')}}" class="btn btn-primary">&laquo; Back</a> {{ $prop['number'].' '.$prop['address'].', '.$prop['state'] }}</h1>
                <div class="property-detail row">
                    <div class="overview span9">
                        <img src={{ $prop['defaultpictures']['thumbnail_url'] }} style="width:140px;float:left;">
                            <?php
                                $roi = ((12*$prop['monthlyRental']) - $prop['tax'] - $prop['insurance'] - ( (12*$prop['monthlyRental']) / 10 )) / $prop['listingPrice'];
                            ?>

                        <ul class="span2 main-info">
                            <li>ID : {{ $prop['propertyId'] }}</li>
                            <li>Price : US$ {{ $prop['listingPrice']}}</li>
                            <li>ROI : {{ $roi*100 }}%</li>
                        </ul>

                        <table class="span4" style="float:left;height:100%;">
                            <tr>
                                <th>Type</th>
                                <td>{{ $prop['type'] }}</td>
                                <th>Bedrooms:</th>
                                <td>{{$prop['bed']}}</td>
                            </tr>
                            <tr>
                                <th>Monthly Rental</th>
                                <td>US$ {{ $prop['monthlyRental'] }}</td>
                                <th>Bathrooms:</th>
                                <td>{{ $prop['bath']}}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $prop['category']}}</td>
                                <th>Construction</th>
                                <td>{{ $prop['typeOfConstruction']}}</td>
                            </tr>
                            </tr>
                            <tr>
                                <th>Square Feet:</th>
                                <td>{{$prop['lotSize']}} ft<sup>2</sup></td>
                                <th>Location:</th>
                                <td>{{ $prop['number'].' '.$prop['address'].'<br />'.$prop['city'].','.$prop['state']}}</td>
                            </tr>

                        </table>
                        <div class="clearfix"></div>
                            <a href="{{ URL::to('property/buy/'.$prop['_id']) }}" class="btn btn-primary pull-right" style="font-size:18px;font-style:bold">
                                Buy Now
                            </a>

                    </div>
                    <div class="span10">

                    </div>
                </div>
                <div class="property-detail row">

                    <div class="overview span3" style="height:100%;min-height:500px;">
                        <h2>Specification</h2>

                        <table class="info">
                            @if(isset($prop['propertyStatus']) && $prop['propertyStatus'] == 'prelisted')
                            <tr>
                                <th class="prelist" colspan="2">Prelisted</th>
                            </tr>

                            @endif
                            <tr>
                                <th>Price:</th>
                                <td>US$ {{ $prop['listingPrice']}}</td>
                            </tr>
                            <?php
                                $roi = ((12*$prop['monthlyRental']) - $prop['tax'] - $prop['insurance'] - ( (12*$prop['monthlyRental']) / 10 )) / $prop['listingPrice'];
                            ?>
                            <tr>
                                <th>ROI</th>
                                <td>{{ $roi*100 }}%</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ $prop['number'].' '.$prop['address'].'<br />'.$prop['city'].','.$prop['state']}}</td>
                            </tr>
                            <tr>
                                <th>Year Built</th>
                                <td>{{ $prop['yearBuilt']}}</td>
                            </tr>
                            <tr>
                                <th>Construction</th>
                                <td>{{ $prop['typeOfConstruction']}}</td>
                            </tr>
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
                                <th>Square Feet:</th>
                                <td>{{$prop['lotSize']}} ft<sup>2</sup></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ (isset($prop['description']))?$prop['description']:'<p>No description</p>'}}</td>
                            </tr>


                        </table>
                    </div>


                    <div>
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
                    <div>
                        <h2 class="page-header">Map</h2>

                        {{ Former::hidden('ia-latitude')->value(isset($prop['latitude'])?$prop['latitude']:0)->id('ia-latitude') }}
                        {{ Former::hidden('ia-longitude')->value(isset($prop['longitude'])?$prop['longitude']:0)->id('ia-longitude') }}
                        {{ Former::hidden('ia-zoom')->value(isset($prop['zoom'])?$prop['zoom']:11)->id('ia-zoom') }}

                        <div id="property-map"></div><!-- /#property-map -->

                    </div>

                </div><!--property detail-->

                <div class="property-detail row">
                </div>


            </div>
            <div class="sidebar span3">

                @include('realia.latest')


            </div>
        </div>


    <!--insert carousel-->
    <!--insert features-->
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



@stop
