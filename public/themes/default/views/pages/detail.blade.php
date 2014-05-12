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
        border-top: 1px solid #FFF;
        vertical-align: top;*/
        border-top: thin solid white;
        padding: 2px 4px;
        line-height: 13px;
        font-size: 11px;
    }

    .table th{
        min-width: 120px;
        border-right: thin solid white;
    }

    .table tr{
        border: none;
    }

    table.table{
        border: thin solid black;
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
        background-color: #eee;
        border-color: transparent;
        border-top: thin solid #fff;
    }

    table th{
        font-weight: bold;
        background-color: #eee;
        border-color: transparent;
    }

    table th.h4{
        background-color: transparent;
    }


    ul.thumbnails_grid{
        list-style: none;
        margin-left: 0px;
    }

    ul.thumbnails_grid li{
        float:left;
    }

    ul.thumbnails_grid li a{
        display: block;
        margin-right:4px;
        margin-bottom:4px;
    }

    ul.thumbnails_grid li a img{
        width:75px;
        height:auto;
    }

    #main-img {
        display: block;
        padding: 0px;
        margin:0px;
        max-height: 260px;
        overflow: hidden;
    }

    #main-img img{
        width: 100%;
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

    #main-content{
        display: block;
    }

    .button-row{
        text-align:right;
        line-height:28px;
        font-size:20px;
    }

    .button-row a{
        font-size:26px;
        display: inline-block;
        padding: 2px;
        margin-right: 10px;
    }

    .btn-buy,
    i.icon-download , i.icon-map-marker, i.icon-envelope
    {
        font-size: 22px;
        color:#F00;
    }

    a.back-btn{
        font-size: 11px;
        text-transform: uppercase;
        color: #aaa;
    }

    p.note{
        font-size: 9px;
        line-height: 12px;
        margin-bottom: 0px;
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

<div id="content-block">
    <div id="content-container" class="shadows" style="margin-bottom: 6px;" >
        <div class="row">
            <div class="span5">
                <div class="subnav row" id="filter-bar" style="background-color: #fff;padding:0px;margin:5px;position:relative;">
                    <a href="{{ $backlink }}" class="back-btn">
                        <i class="icon-chevron-left"></i> Back to Listing
                    </a>

                    <?php

                        if( isset($prop['locked']) && $prop['locked'] == 1 && $prop['reservedBy'] == Auth::user()->_id){
                            $urlbuy = URL::to('property/buy/'.$prop['_id']);
                        }elseif( isset($prop['locked']) && $prop['locked'] == 1 && $prop['reservedBy'] != Auth::user()->_id){
                            $urlbuy = '';
                        }else{
                            $urlbuy = URL::to('property/buy/'.$prop['_id']);
                        }
                    ?>
                    <span style="display:inline-block;position:absolute;right:0;text-transform:uppercase;font-size:12px;">Property ID : {{$prop['propertyId']}}</span>

                </div>

                <div id="main-img" class="img-container">
                    <img src="{{ (isset($prop['defaultpictures']['full_url']))?$prop['defaultpictures']['full_url']:URL::to('images/no-photo-md.jpg') }}" alt="{{$prop['propertyId']}}" >
                    <span class="prop-status-small {{$prop['propertyStatus']}}">{{ $prop['propertyStatus']}}</span>
                    @if( isset($prop['locked']) && $prop['locked'] == 1)
                        <span style="position:absolute;font-size:12px;padding:2px 4px;display:block;background-color:yellow;bottom:0px;">This property is currently under buying process.</span>
                    @endif

                </div>
                <style type="text/css">
                .gal-container{
                    padding-top: 10px;
                }

                .gal-scroll{
                    overflow-x: scroll;
                    overflow-y: hidden;
                    min-height: 70px;
                    height: 70px;
                    white-space: nowrap!important;
                }

                .gal-scroll a{
                    display: inline-block;
                }

                .gal-scroll a img{
                    width: 70px;
                    height:auto;
                }

                </style>

                <div class="gal-container">
                    <div class="gal-scroll lionbars">
                        @foreach($prop['files'] as $f )
                            <a href="{{ $f['fileurl'] }}" title="{{$f['caption']}}" data-gallery >
                                <img src="{{ $f['medium_url'] }}" alt="{{$f['caption']}}">
                            </a>
                        @endforeach
                    </div>
                </div>


            </div>
            <div class="span4" style="padding: 30px 8px 0px 8px;">
                <div style="border:thin solid black;margin-bottom:0px;display:block;">
                    <table class="table" style="border:thin solid transparent;margin-bottom:0px;">
                        <tr>
                            <th colspan="2" style="text-align:left;font-style:italic;font-size:14px;font-weight:bold;">
                                Property Info
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Address
                            </th>
                            <td>
                                {{ $prop['number'].' '.$prop['address'] }}<br />
                                {{ $prop['city'].' '.$prop['state'].' '.$prop['zipCode'] }}
                            </td>
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
                                {{ Ks::us($prop['lotSize'] * 43560) }} sqft
                                @else
                                {{ Ks::us($prop['lotSize']) }} sqft
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
                                @if($prop['leaseTerms'] == '-' || $prop['leaseTerms'] == '')
                                    -
                                @else
                                    {{ $prop['leaseTerms'] }} month(s)
                                @endif
                            </td>

                        </tr>
                        <tr>

                            <th>Lease Start Date</th>
                            <td>
                                {{ ($prop['leaseStartDate'] == false)?'-':date('M, jS Y', strtotime($prop['leaseStartDate']))  }}
                            </td>

                        </tr>
                        <tr>

                            <th>Annual Tax</th>
                            <td>
                                {{ Ks::usd( $prop['tax']) }}
                            </td>
                        </tr>

                    </table>

                </div>

                    <div>
                        <a href="#myModal" role="button" data-toggle="modal"><img src="{{ URL::to('/')}}/images/email.png" /></a>
                        &nbsp;&nbsp;
                        <a href="{{ URL::to('brochure/dl/'.$prop['_id'])}}"  target="blank" ><img src="{{ URL::to('/')}}/images/download.png" /></a>
                        &nbsp;&nbsp;
                        <a  href="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q={{$address}}&ie=UTF8&hq=&hnear={{$address}}" target="blank"><img src="{{ URL::to('/')}}/images/marker.png" /></a>
                        &nbsp;&nbsp;
                        <a href="{{ $urlbuy }}" class="btn-buy" style="bottom:0px;"><img src="{{ URL::to('/')}}/images/cart.png" /></a>

                    </div>

            </div>
            <div class="span4" style="padding: 8px 0px;">
                <style type="text/css">
                    table#fin{
                        border: thin solid black;
                        background: url({{ URL::to('/')}}/images/fin-grad.png) repeat-x;
                        background-size: 100% 100%;
                        color:white;
                    }

                    table#fin th{
                        width:150px;
                        text-align: right;
                        background: transparent;
                        line-height:18px;
                    }

                    table#fin td{
                        background: transparent;
                        line-height:14px;
                        border: none;
                    }

                    table#fin th.header{
                        text-align: left;
                        font-size: 14px;
                        border: none;
                    }

                    table#fin input[type="text"]{
                        width:95%;
                        text-align: right;
                        margin: 0px;
                        padding: 2px;
                    }

                    table#fin th+td{
                        text-align: right;
                    }

                    table#fin tr.yield th, table#fin tr.yield td{
                        color:white;
                        font-size: 14px;
                        font-weight: normal;
                        border: none;
                    }

                    table#fin th{
                        font-weight: normal;
                        border: none;
                    }

                </style>

                <table class="table" id="fin" style="width:100%;margin-bottom:0px;">
                    <thead>
                        <tr>
                            <th colspan="2" class="header" style="text-align:left;font-style:italic;font-size:16px;font-weight:normal;">
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
                            <th>Purchase Price</th><td>${{ Ks::us( $prop['listingPrice'])}}</td>
                            <input type="hidden" value="{{ $prop['listingPrice'] }}" id="purchasePrice" >
                        </tr>
                        <tr>
                            <th>Monthly Rent</th><td><input class="calc" type="text" value="{{$prop['monthlyRental']}}" data-symbol="$ " data-thousands="," data-decimal="." id="monthlyRental"></td>
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
                            <th>Taxes*</th><td><input class="calc"  type="text" value="{{str_replace(array(',','.'),'',$prop['tax']) }}" id="tax"></td>
                        </tr>
                        <tr>
                            <th>Insurance**</th><td><input  class="calc" type="text" value="{{$prop['insurance']}}" id="insurance"></td>
                        </tr>
                        <tr>
                            <th>Property Management</th><td><span class="pull-left" ><input  class="calc" style="width:20px" type="text" value="10" id="propFeePct">%</span> <span id="propManagementFee">{{ Ks::usd($propManagementFee)}}</span></td>
                        </tr>
                        <tr>
                            <th>HOA</th><td><span class="pull-left" ><input  class="calc" style="width:40px" type="text" value="{{ number_format( ($prop['HOA'] / 12) , 1, '.', '') }}" id="HOAmonthly"></span> <span><input  class="calc" style="width:40px" type="text" value="{{ $prop['HOA'] }}" id="HOAannual"></span></td>
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
                <p class="note">*&nbsp;&nbsp; Approximately to latest current year available<br />** Approximately</p>

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

                    /*
                    $('.calc').on('focus',function(){
                        if($('#HOAmonthly').is(':focus')){
                            var HOAmonthly = notNan( $('#HOAmonthly').val() );
                            $('#HOAannual').val( parseInt(HOAmonthly) * 12  );
                        }else if($('#HOAannual').is(':focus')){
                            var HOAannual = notNan( $('#HOAannual').val() );
                            $('#HOAmonthly').val( parseFloat(HOAannual) / 12 );
                        }else{
                            $('#HOAmonthly').val( parseInt($('#HOAannual').val()) / 12 );
                        }

                    });
                    */

                    $('.calc').on('keyup',function(){
                        var purchasePrice = {{ $prop['listingPrice']}};
                        var monthlyRental = notNan($('#monthlyRental').val());
                        /*
                        if($('#HOA').is(':focus')){
                            var HOAmonthly = notNan( $('#HOAmonthly').val() );
                            $('#HOAannual').val( parseFloat(HOAmonthly * 12).toFixed(2)  );
                        }else if($('#HOAannual').is(':focus')){
                            var HOAannual = notNan( $('#HOAannual').val() );
                            $('#HOAmonthly').val( parseFloat(HOAannual  / 12 ).toFixed(2) );
                        }else{
                            $('#HOAmonthly').val( parseFloat($('#HOAannual').val()  / 12).toFixed(2) );
                        }
                        */

                        var HOAannual = notNan( $('#HOAannual').val() );
                        var HOAmonthly = notNan( $('#HOAmonthly').val() );

                        if($('#HOA').is(':focus')){
                            $('#HOAannual').val( parseFloat(HOAmonthly * 12).toFixed(2)  );
                        }else if($('#HOAannual').is(':focus')){
                            $('#HOAmonthly').val( parseFloat(HOAannual  / 12 ).toFixed(2) );
                        }else{
                            $('#HOAmonthly').val( parseFloat($('#HOAannual').val()  / 12).toFixed(2) );
                        }

                        var tax = notNan($('#tax').val());
                        var insurance = notNan($('#insurance').val());

                        var annualRental = 12 * monthlyRental;
                        var propManagementFee = annualRental * ( notNan($('#propFeePct').val()) / 100 );
                        var maintenanceAllowance = annualRental *  ( notNan($('#maintenanceAllowancePct').val()) / 100 );
                        var vacancyAllowance = annualRental *  ( notNan($('#vacancyAllowancePct').val()) / 100 );

                        var totalExpense = notNan(propManagementFee) + notNan(maintenanceAllowance) + notNan(vacancyAllowance) + tax + insurance + HOAannual;

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

                    $(document).ready(function(){
                        //$('input.calc').mask('000,000,000,000,000', {reverse: true});
                    });
                </script>

            </div>

        </div><!-- end row -->

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