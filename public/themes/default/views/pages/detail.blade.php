@extends('layout.front')

@section('content')
<style type="text/css">
    div.dcol h1,
    div.dcol h2,
    div.dcol h3,
    div.dcol h4,
    div.dcol h5,
    div.dcol h6 {
            margin-top: 0px;
    }

    dl {
        margin-bottom:50px;
        margin-top: 0px;
        font-size: 13px;
    }

    dl dt {
        float:left;
        font-weight:bold;
        margin-right:10px;
        padding:0px 2px;
        width:100px;
        min-width: 60px;
        display: block;
        vertical-align: top;
    }

    dl dt:after{
        content: ':';
    }

    dl dd {
        margin:2px 0;
        padding:0px 2px;
        display: block;
        padding-left: 60px;
    }

    .h4{
        font-size: 16px;
        font-weight: bold;
    }

    .h5{
        font-size: 14px;
        font-weight: bold;
    }

    .h6{
        font-size: 13px;
        font-weight: bold;
    }

    .table th, .table td {
        /*padding: 8px;
        text-align: left;
        vertical-align: top;*/
        line-height: 16px;
        border-top: 1px solid #FFF;
    }

    table{
        width:100%;
        font-size: 12px;
        border:none;
    }

    table tr{
        border:none;
    }

    table td{
        min-width: 80px;
        border-color: transparent;
    }

    table th{
        font-weight: bold;
        width: 100px;
        background-color: #eee;
        border-color: transparent;
    }

    table th.h4{
        background-color: transparent;
    }

    .btn-buy{
        font-size: 36px;
    }

    i.icon-download{
        font-size: 26px;
    }

    ul.thumbnails_grid{
        list-style: none;
        margin-left: 0px;
    }

    ul.thumbnails_grid li{
        float:left;
    }

    ul.thumbnails_grid li a, #main-img {
        display: block;
        padding: 4px;
        margin:4px;
        border:thin solid #eef;
    }

    ul.thumbnails_grid li a img{
        width:120px;
        height:auto;
    }

    #map-container{
        display: inline-block;
        padding: 4px;
        border: solid thin #eef;
    }

    #map-box{
        margin-top: 15px;
        border-top: thin solid #eef;
        padding: 10px 4px;
    }

</style>

<h1>
    <a href="{{ URL::previous() }}" class="btn btn-primary">&laquo; Back</a>
</h1>

<div class="row">
    <div class="span2">
        <div id="main-img">
            <img src="{{ (isset($prop['defaultpictures']['medium_url']))?$prop['defaultpictures']['medium_url']:'' }}" alt="{{$prop['propertyId']}}" >
        </div>
        <h5 style="text-align:center;">ID : {{$prop['propertyId']}}</h5>
    </div>
    <div class="span9">
        <table class="table">
            <tr>
                <th colspan="2" rowspan="2" class="h4">
                    {{ $prop['number'].' '.$prop['address'] }}<br />
                    {{ $prop['city'].', '.$prop['state'].' '.$prop['zipCode'] }}
                </th>

                <th>Type</th>
                <td>
                    {{ $prop['type'] }}
                </td>

                <th>Size</th>
                <td>
                    {{ number_format($prop['houseSize'],0) }} sqft
                </td>

            </tr>
            <tr>

                <th>Bed</th>
                <td>
                    {{ $prop['bed'] }}
                </td>

                <th>Lot Size</th>
                <td>
                    @if( $prop['lotSize'] < 100)
                    {{ number_format($prop['lotSize'] * 43560,0) }} sqft
                    @else
                    {{ $prop['lotSize'] }} sqft
                    @endif
                </td>

            </tr>
            <tr>
                <th>Price</th>
                <td>
                    ${{ number_format($prop['listingPrice'],0,'.',',') }}
                </td>

                <th>Bath</th>
                <td>
                    {{ $prop['bath'] }}
                </td>

                <th>Year Built</th>
                <td>
                    {{ $prop['yearBuilt'] }}
                </td>

            </tr>
            <tr>
                <th>FMV</th>
                <td>
                    ${{ number_format($prop['FMV'],0,'.',',') }}
                </td>

                <th>Garage</th>
                <td>
                    {{ $prop['garage'] }}
                </td>

                <th>Construction</th>
                <td>
                    {{ $prop['typeOfConstruction'] }}
                </td>

            </tr>
            <tr>
                <th>ROI</th>
                <td>
                    {{ number_format(Prefs::roi($prop),1,'.',',') }}%
                </td>

                <th>Pool</th>
                <td>
                    {{ $prop['pool'] }}
                </td>

                <th>Parcel #</th>
                <td>
                    {{ $prop['parcelNumber'] }}
                </td>

            </tr>
        </table>
    </div>
    <div class="span1" style="text-align:center;">
        <a href="{{ URL::to('brochure/dl/'.$prop['_id'])}}" target="blank" style="width:100%">Brochure<br /><i class="icon-download"></i></a>
        <br />
        <br />
        <a href="{{ URL::to('property/buy/'.$prop['_id']) }}" class="btn btn-primary btn-buy"><i class="icon-shopping-cart"></i></a>
    </div>
</div>
<div class="row">
    <div class="span3">
        <h4>Description</h4>
        {{ $prop['description']}}
    </div>
    <div class="span9">
        <ul class="thumbnails_grid">
            @foreach($prop['files'] as $f )
                <li>
                    <a href="{{ $f['fileurl'] }}" title="{{$f['caption']}}" data-gallery >
                        <img src="{{ $f['medium_url'] }}" alt="{{$f['caption']}}">
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="clearfix"></div>
        <div id="map-box">
            <?php

                $address = $prop['number'].' '.$prop['address'].' '.$prop['city'].', '.$prop['state'].' '.$prop['zipCode'];
                if($prop['type'] == 'LAND'){
                    $color = 'green';
                    $label = 'L';
                }else{
                    $color = 'blue';
                    $label = 'H';
                }

            ?>
            <div id="map-container">
                <img src="http://maps.googleapis.com/maps/api/staticmap?center={{ $address }}&zoom=13&size=300x250&maptype=roadmap&markers=color:{{ $color }}%7Clabel:{{ $label }}%7C{{ $address }}&sensor=false" />
            </div>
        </div>
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

@stop