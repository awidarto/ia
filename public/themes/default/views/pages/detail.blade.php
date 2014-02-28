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
        font-size: 24px;
    }

    i.icon-download , i.icon-map-marker, i.icon-envelope{
        font-size: 20px;
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
    }

    #map-box{
        margin-top: 15px;
        border-top: thin solid #eef;
        padding: 10px 4px;
    }

</style>
{{ HTML::style('css/imagestyle.css')}}

<?php

    $address = $prop['number'].' '.$prop['address'].' '.$prop['city'].' '.$prop['state'].' '.$prop['zipCode'];
    if($prop['type'] == 'LAND'){
        $color = 'green';
        $label = 'L';
    }else{
        $color = 'blue';
        $label = 'H';
    }

?>

<div class="row" style="padding-bottom:0px;margin-top:10px;padding-top:35px;">
    <div class="span12  shadows" style="margin:auto;background-color:#fff;height:460px;">

        <div class="subnav row" id="filter-bar" style="background-color: #fff;padding:0px;margin:5px;">
            <ul class="nav nav-pills span5" style="padding-left:0px;margin-bottom:2px;" >
                <li>
                    <a href="{{ URL::previous() }}" class="btn btn-primary">&laquo; Back</a>
                </li>
            </ul>
            @if( isset($prop['locked']) && $prop['locked'] == 1)
                <span style="font-size:12px;margin-left:4px;padding:2px 4px;display:inline-block;background-color:yellow;">This property is currently under buying process.</span>
            @endif

        <?php

            if( isset($prop['locked']) && $prop['locked'] == 1 && $prop['reservedBy'] == Auth::user()->_id){
                $urlbuy = URL::to('property/buy/'.$prop['_id']);
            }elseif( isset($prop['locked']) && $prop['locked'] == 1 && $prop['reservedBy'] != Auth::user()->_id){
                $urlbuy = '';
            }else{
                $urlbuy = URL::to('property/buy/'.$prop['_id']);
            }
        ?>
            <div class="span4 pull-right" style="text-align:right;">
                <a class="btn"  href="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q={{$address}}&ie=UTF8&hq=&hnear={{$address}}" target="blank"><i class="icon-map-marker"></i></a>
                &nbsp;&nbsp;&nbsp;
                <a href="{{ URL::to('brochure/dl/'.$prop['_id'])}}" class="btn"  target="blank" ><i class="icon-download"></i></a>
                &nbsp;&nbsp;&nbsp;
                <a href="#myModal" role="button" class="btn" data-toggle="modal"><i class="icon-envelope"></i></a>

                &nbsp;&nbsp;

                <a href="{{ $urlbuy }}" class="btn btn-primary btn-buy" style="bottom:0px;"><i class="icon-shopping-cart"></i></a>
            </div>

        </div>


    <div class="row" style="margin:0px;padding:5px;">
        <div class="span4 lionbars" style="margin:auto;background-color:#fff;height:405px;overflow-y:auto;overflow-x:hidden;padding-right:4px;">
            <div id="main-img" class="img-container">
                <img src="{{ (isset($prop['defaultpictures']['medium_url']))?$prop['defaultpictures']['medium_url']:'' }}" alt="{{$prop['propertyId']}}" >
                <span class="prop-status-small {{$prop['propertyStatus']}}">{{ $prop['propertyStatus']}}</span>
            </div>
            <h5 style="text-align:center;">ID : {{$prop['propertyId']}}</h5>

            <table class="table">
                <tr>
                    <th colspan="2" class="h4">
                        {{ $prop['number'].' '.$prop['address'] }}<br />
                        {{ $prop['city'].' '.$prop['state'].' '.$prop['zipCode'] }}
                    </th>
                </tr>
                {{--
                <tr>
                    <td colspan="2" style="text-align:justify;">
                        <a class="btn"  href="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q={{$address}}&ie=UTF8&hq=&hnear={{$address}}" target="blank"><i class="icon-map-marker"></i></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="{{ URL::to('brochure/dl/'.$prop['_id'])}}" class="btn"  target="blank" ><i class="icon-download"></i></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="#myModal" role="button" class="btn" data-toggle="modal"><i class="icon-envelope"></i></a>

                    </td>
                </tr>
                --}}
                <tr>
                    <th>Price</th>
                    <td>
                        ${{ number_format($prop['listingPrice'],0,'.',',') }}
                    </td>
                </tr>
                <tr>
                    <th>FMV</th>
                    <td>
                        ${{ number_format($prop['FMV'],0,'.',',') }}
                    </td>
                </tr>
                <tr>
                    <th>Monthly Rent</th>
                    <td>
                        ${{ number_format($prop['monthlyRental'],0,'.',',') }}
                    </td>
                </tr>
                <tr>

                    <th>Type</th>
                    <td>
                        {{ $prop['type'] }}
                    </td>
                </tr>
                <tr>

                    <th>Bed</th>
                    <td>
                        {{ $prop['bed'] }}
                    </td>
                </tr>
                <tr>

                    <th>Bath</th>
                    <td>
                        {{ $prop['bath'] }}
                    </td>
                </tr>
                <tr>

                    <th>Size</th>
                    <td>
                        {{ number_format($prop['houseSize'],0) }} sqft
                    </td>

                </tr>
                <tr>

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

                    <th>Year Built</th>
                    <td>
                        {{ $prop['yearBuilt'] }}
                    </td>

                </tr>
                <tr>

                    @if($prop['typeOfConstruction'] == '')
                        <th>Property Manager</th>
                        <td>
                            {{ $prop['propertyManager'] }}
                        </td>
                    @else
                        <th>Construction</th>
                        <td>
                            {{ $prop['typeOfConstruction'] }}
                        </td>
                    @endif

                </tr>

                <tr>

                    <th>Parcel #</th>
                    <td>
                        {{ $prop['parcelNumber'] }}
                    </td>

                </tr>

                <tr>

                    <th>Category</th>
                    <td>
                        {{ ucfirst(strtolower($prop['category'])) }}
                    </td>
                </tr>
                <tr>

                    <th>Lease Term</th>
                    <td>
                        {{ $prop['leaseTerms'] }} month(s)
                    </td>

                </tr>
                <tr>

                    <th>Lease Start Date</th>
                    <td>
                        {{ $prop['leaseStartDate'] }}
                    </td>

                </tr>
                <tr>

                    <th>Annual Tax</th>
                    <td>
                        ${{ $prop['tax'] }}
                    </td>
                </tr>

            </table>

        </div>
            <div class="span8 lionbars" style="margin:auto;background-color:#fff;height:405px;overflow-y:auto;overflow-x:hidden;padding-right:4px;">
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

                <style type="text/css">
                    table#fin th{
                        width:200px;
                        text-align: right;
                    }

                    table#fin th.header{
                        text-align: left;
                    }

                    table#fin input[type="text"]{
                        width:80%;
                        text-align: right;
                        margin: 0px;
                        padding: 2px;
                    }

                    table#fin th+td{
                        text-align: right;
                    }

                    table#fin tr.yield th, table#fin tr.yield td{
                        background-color: maroon;
                        color:white;
                        font-size: 14px;
                        font-weight: bold;
                    }

                </style>

                <div id="map-box">
                    <div id="map-container">
                        <a class="btn"  href="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q={{$address}}&ie=UTF8&hq=&hnear={{$address}}" target="blank">
                            <img src="http://maps.googleapis.com/maps/api/staticmap?center={{ $address }}&zoom=13&size=260x370&maptype=roadmap&markers=color:{{ $color }}%7Clabel:{{ $label }}%7C{{ $address }}&sensor=false" style="float:left"/>
                        </a>
                    </div>
                    <table class="table table-bordered" id="fin" style="width:300px;float:right;">
                        <thead>
                            <tr>
                                <th colspan="2" class="header">
                                    Financial Calculator
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $annualRental = 12*$prop['monthlyRental'];
                                $propManagementFee = $annualRental * 0.1;
                                $maintenanceAllowance = $annualRental * 0;
                                $vacancyAllowance = $annualRental * 0;

                                $totalExpense = $propManagementFee + $maintenanceAllowance + $vacancyAllowance + $prop['tax'] + $prop['insurance'];

                                $netAnnualCashFlow = $annualRental - $totalExpense;
                                $netMonthlyCashFlow = round($netAnnualCashFlow / 12, 0, PHP_ROUND_HALF_UP);

                                $roi = ($netAnnualCashFlow / $prop['listingPrice']) * 100;
                                $roi = round($roi, 1, PHP_ROUND_HALF_UP);

                            ?>
                            <tr>
                                <th class="h5">Purchase Price</th><td class="h5">${{ Ks::us( $prop['listingPrice'])}}</td>
                                <input type="hidden" value="{{ $prop['listingPrice'] }}" id="purchasePrice" >
                            </tr>
                            <tr>
                                <th>Monthly Rent</th><td><input class="calc" type="text" value="{{$prop['monthlyRental']}}" id="monthlyRental"></td>
                            </tr>
                            <tr>
                                <th>Annual Rent</th><td id="txt_annualRental">${{ Ks::us($annualRental) }}</td>
                                <input type="hidden" value="{{ $annualRental }}" id="annualRental">
                            </tr>
                            <tr>
                                <th colspan="2" class="header">Annual Expenses</th>
                                <input type="hidden" value="{{ $annualRental }}" id="annualRental">
                            </tr>
                            <tr>
                                <th>Taxes</th><td><input class="calc"  type="text" value="{{str_replace(array(',','.'),'',$prop['tax']) }}" id="tax"></td>
                            </tr>
                            <tr>
                                <th>Insurance</th><td><input  class="calc" type="text" value="{{$prop['insurance']}}" id="insurance"></td>
                            </tr>
                            <tr>
                                <th>Property Management</th><td><span class="pull-left" ><input  class="calc" style="width:20px" type="text" value="10" id="propFeePct">%</span> <span id="propManagementFee">${{ $propManagementFee}}</span></td>
                            </tr>
                            <tr>
                                <th>Maintenance Allowance</th><td><span class="pull-left" ><input  class="calc" style="width:20px" type="text" value="0" id="maintenanceAllowancePct">%</span> <span id="maintenanceAllowance">${{ Ks::us($maintenanceAllowance) }}</span></td>
                            </tr>
                            <tr>
                                <th>Vacancy Allowance</th><td><span class="pull-left" ><input  class="calc" style="width:20px" type="text" value="0" id="vacancyAllowancePct">%</span> <span id="vacancyAllowance">${{ Ks::us($vacancyAllowance)}}</span></td>
                            </tr>
                            <tr>
                                <th class="h6">Total Expenses</th><td id="totalExpense">${{ Ks::us($totalExpense) }}</td>
                            </tr>
                            <tr>
                                <th>Net Annual Cash Flow</th><td id="netAnnualCashFlow">${{ Ks::us($netAnnualCashFlow) }}</td>
                            </tr>
                            <tr>
                                <th class="h6"><b>Net Monthly Cash Flow</b></th><td id="netMonthlyCashFlow">${{ Ks::us($netMonthlyCashFlow) }}</td>
                            </tr>
                            <tr class="yield">
                                <th>ROI</th><td id="calcROI">{{ $roi }}%</td>
                            </tr>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        function notNan(v){
                            if(v == '' || v == null || typeof v === "undefined" || isNaN(v) ){
                                v = 0;
                            }

                            return parseFloat(v);
                        }

                        function cf(input) {
                            var output = input
                            if (parseFloat(input)) {
                                input = new String(input); // so you can perform string operations
                                var parts = input.split("."); // remove the decimal part
                                parts[0] = parts[0].split("").reverse().join("").replace(/(\d{3})(?!$)/g, "$1,").split("").reverse().join("");
                                output = parts.join(".");
                            }

                            return output;
                        }

                        $('.calc').on('keyup',function(){
                            var purchasePrice = {{ $prop['listingPrice']}};
                            var monthlyRental = notNan($('#monthlyRental').val());

                            var tax = notNan($('#tax').val());
                            var insurance = notNan($('#insurance').val());

                            var annualRental = 12 * monthlyRental;
                            var propManagementFee = annualRental * ( notNan($('#propFeePct').val()) / 100 );
                            var maintenanceAllowance = annualRental *  ( notNan($('#maintenanceAllowancePct').val()) / 100 );
                            var vacancyAllowance = annualRental *  ( notNan($('#vacancyAllowancePct').val()) / 100 );

                            var totalExpense = notNan(propManagementFee) + notNan(maintenanceAllowance) + notNan(vacancyAllowance) + tax + insurance;

                            var netAnnualCashFlow = annualRental - totalExpense;
                            var netMonthlyCashFlow = netAnnualCashFlow / 12;
                                netMonthlyCashFlow = netMonthlyCashFlow.toFixed(0);

                            var roi = ( netAnnualCashFlow / purchasePrice ) * 100;
                            roi = roi.toFixed(1);

                            $('#propManagementFee').html('$' + cf(propManagementFee));
                            $('#maintenanceAllowance').html('$' + cf(maintenanceAllowance));
                            $('#vacancyAllowance').html('$' + cf(vacancyAllowance));

                            $('#totalExpense').html('$' + cf(totalExpense));
                            $('#netAnnualCashFlow').html('$' + cf(netAnnualCashFlow));
                            $('#netMonthlyCashFlow').html('$' + cf(netMonthlyCashFlow));

                            $('#calcROI').html(roi + '%');

                        });

                    </script>
                </div>
            </div>
    </div>


    </div><!-- end span -->
</div><!-- end row -->


<div id="blueimp-gallery" class="blueimp-gallery  blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Send Property Brochure</h3>
  </div>
  <div class="modal-body">
    {{ Former::open_horizontal('sendEmailForm')->id('sendEmailForm')}}
    {{ Former::text('to', 'Send To')->id('sendTo')->help('use comma to separate multiple email addresses')}}
    {{ Former::close() }}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sendEmail').on('click',function(){
                $.post('{{ URL::to('brochure/mail/'.$prop['_id'])}}',
                    { to: $('#sendTo').val() },
                    function(data){
                        if(data.result == 'OK'){
                            $('#sendTo').val('');
                            $('#myModal').modal('hide');
                        }
                    },'json'
                );
            });
        });
    </script>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-primary" id="sendEmail">Send</button>
  </div>
</div>

@stop