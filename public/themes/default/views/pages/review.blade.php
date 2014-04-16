@extends('layout.front')

@section('content')

{{ HTML::script('js/jquery.bootstrap.wizard.min.js')}}

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

    h4{
        margin-top: 2px;
        margin-bottom: 2px;
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

    .btn-buy{
        font-size: 36px;
    }

    i.icon-download , i.icon-map-marker, i.icon-envelope{
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

    table#finance tr td:last-child,
    table#finance tr td:last-child input[type=text]
    {
        text-align: right;
        font-size: 13px;
    }

    span.more{
        cursor: pointer;
        text-decoration: underline;
    }

    a.back-btn{
        font-size: 11px;
        text-transform: uppercase;
        color: #aaa;
        line-height: 14px;
    }

</style>
    <?php
        $address = $prop['number'].' '.$prop['address'].' '.$prop['city'].' '.$prop['state'].' '.$prop['zipCode'];
    ?>

<div id="content-block">
    <div id="content-container" class="shadows" style="margin-bottom: 6px;" >
        <div class="row">

            <div class="span4" style="overflow-y:hidden;height:400px;max-height:400px;">
                    <div class="subnav row" id="filter-bar" style="background-color: #fff;padding:0px;margin:5px;position:relative;">
                        <a href="{{ URL::to('property/listing') }}" class="back-btn">
                            <i class="icon-chevron-left"></i> Back to Listing
                        </a>

                        <span style="display:inline-block;position:absolute;right:0;text-transform:uppercase;font-size:12px;font-weight:bold;">PURCHASE DETAIL</span>

                    </div>

                    <div>
                        <a href="#myModal" role="button" data-toggle="modal"><img src="{{ URL::to('/')}}/images/email.png" /></a>
                        &nbsp;&nbsp;
                        <a href="{{ URL::to('brochure/dl/'.$prop['_id'])}}"  target="blank" ><img src="{{ URL::to('/')}}/images/download.png" /></a>
                        &nbsp;&nbsp;
                        <a  href="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q={{$address}}&ie=UTF8&hq=&hnear={{$address}}" target="blank"><img src="{{ URL::to('/')}}/images/marker.png" /></a>

                    </div>

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

            <div class="span8 lionbars" style="margin:auto;background-color:#fff;height:380px;width:670px;overflow-y:auto;overflow-x:hidden;padding-right:14px;margin-left:20px;">
                <h2>Property ID : {{ $prop['propertyId']}}</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Purchaser Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{$trx['firstname'].' '.$trx['lastname']}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $trx['address'].' '.(( isset($trx['address_1']) && $trx['address_1'] != '')?$trx['address_1'].' ':'' ).$trx['state'].' '.$trx['zipCode'].' '.$trx['countryOfOrigin'] }}</td>
                        </tr>
                        <tr>
                            <th>Company</th>
                            <td>{{ $trx['company']}}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4">Property Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Property Address</th>
                            <td colspan="3">{{ $address}}</td>
                        </tr>
                        <tr>
                            <th>Lease Start Date</th>
                            <td>{{ $prop['leaseStartDate']}}</td>
                            <th>Lease Terms</th>
                            <td>{{ $prop['leaseTerms']}}</td>
                        </tr>
                        <tr>
                            <th>Monthly Rent Amount</th>
                            <td>${{ number_format($prop['monthlyRental'],0)}}</td>
                            <th>Section 8 Lease</th>
                            <td>{{ $prop['section8']}}</td>
                        </tr>
                        <tr>
                            <th>Purchased with</th>
                            <td class="h4">{{ $trx['fundingMethod']}}</td>
                            <th>Property Manager</th>
                            <td>{{$prop['propertyManager']}}</td>
                        </tr>
                    </tbody>
                </table>

                <?php
                    $prop['tax'] = str_replace(array(',','.'), '', $prop['tax']);
                    $prop['tax'] = (double) $prop['tax'];
                ?>
                <table class="table table-bordered table-striped" id="finance" >
                    <thead>
                        <tr>
                            <th>Price</th>
                            <th style="text-align:center;" class="span2">Amount</th>
                            <th style="text-align:center;" class="span2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sale Price</td>
                            <td>${{ number_format($prop['listingPrice'],0,'.',',')}}</td>
                            <td>${{ number_format($prop['listingPrice'],0,'.',',')}}</td>
                        </tr>
                        <tr>
                            <td>{{ $trx['adjustmentType1'] }}</td>
                            <td class="curr">${{ number_format($trx['adjustment1'],0,'.',',')}}</td>
                            <td>${{ number_format($prop['listingPrice'] + $trx['adjustment1'],0,'.',',')}}</td>
                        </tr>
                        <tr>
                            <td>{{ $trx['adjustmentType1'] }}</td>
                            <td class="curr">${{ number_format($trx['adjustment2'],0,'.',',')}}</td>
                            <td>${{ number_format($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'],0,'.',',')}}</td>
                        </tr>
                        <tr>
                            <td>Annual Insurance Premium</td>
                            <td class="curr">${{ number_format($prop['insurance'],0,'.',',')}}</td>
                            <td>${{ number_format($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'],0,'.',',')}}</td>

                        </tr>
                        <tr>
                            <td>Tax Adjustment</td>
                            <td class="curr">${{ number_format((int)$prop['tax'],0,'.',',')}}</td>
                            <td>${{ number_format($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'] + $prop['tax'],0,'.',',')}}</td>
                        </tr>
                        <tr>
                            <td>Closing Cost</td>
                            <td class="curr">${{ number_format($trx['closingCost'],0,'.',',')}}</td>
                            <td>${{ number_format($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'] + $prop['tax'] + $trx['closingCost'],0,'.',',')}}</td>
                        </tr>
                        <tr>
                            <td><h4>Total Purchase Price</h4></td>
                            <td></td>
                            <td><h4 id="total_purchase">
                                ${{ number_format($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'] + $prop['tax'] + $trx['closingCost'],0,'.',',')}}
                                </h4>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-striped" id="finance" >
                    <thead>
                        <tr>
                            <th colspan="2">Cash and Earnest Money</th>
                            <th style="text-align:center;" class="span2">Amount</th>
                            <th style="text-align:center;" class="span2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">Cash Proceeds</td>
                            <td class="curr">${{ number_format( ($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'] + $prop['tax'] + $trx['closingCost']),0,'.',',')}}</td>
                            <td>${{ number_format( ($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'] + $prop['tax'] + $trx['closingCost']) ,0,'.',',')}}</td>
                        </tr>
                        <tr>
                            <td>Earnest Money Deposit 1</td>
                            <td class="curr">{{ $trx['earnestMoneyType1']}}</td>
                            <td class="curr">${{ number_format($trx['earnestMoney1'],0,'.',',')}}</td>
                            <td>${{ number_format( ($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'] + $prop['tax'] + $trx['closingCost']) - $trx['earnestMoney1'] ,0,'.',',')}}</td>
                        </tr>
                        <tr>
                            <td>Earnest Money Deposit 2</td>
                            <td class="curr">{{ $trx['earnestMoneyType2']}}</td>
                            <td class="curr">${{ number_format($trx['earnestMoney2'],0,'.',',')}}</td>
                            <td>${{ number_format( ($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'] + $prop['tax'] + $trx['closingCost']) - ($trx['earnestMoney1'] + $trx['earnestMoney2']) ,0,'.',',')}}</td>
                        </tr>
                        <tr>
                            <td>Loan</td>
                            <td class="curr">{{ ($trx['loanProceedPct'] == 0)?'':$trx['loanProceedPct'].'%' }}</td>
                            <td class="curr">${{ number_format($trx['loanProceed'],0,'.',',')}}</td>
                            <td>${{ number_format(($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'] + $prop['tax'] + $trx['closingCost']) - ($trx['earnestMoney1'] + $trx['earnestMoney2'] + $trx['loanProceed']),0,'.',',') }}</td>
                        </tr>

                        <tr>
                            <td colspan="3"><h4>Remaining Balance Due</h4></td>
                            <td><h4>
                                ${{ number_format(($prop['listingPrice'] + $trx['adjustment1'] + $trx['adjustment2'] + $prop['insurance'] + $prop['tax'] + $trx['closingCost']) - ($trx['earnestMoney1'] + $trx['earnestMoney2'] + $trx['loanProceed']),0,'.',',') }}
                                </h4>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <div class="row">
                    <div class="span8">
                        {{ Former::framework('TwitterBootstrap')}}
                        <h4>Review and Submit</h4>
                        {{ Former::open_horizontal('property/commit')}}

                        {{ Former::hidden('trx_id',$trx['_id'])}}

                        <p>
                            Please review the summary above. By Entering your name below you are electronically signing and agreeing to the purchase agreement found here.
                            Click "Edit" to revise your current transaction or click "Proceed" to process your order.
                        </p>
                        {{ Former::hidden('legalName')->value($trx['legalName']) }}
                        {{-- Former::text('signature','Signature') --}}

                        {{ HTML::link('property/update/'.$trx['_id'],'&laquo; Edit',array('class'=>'btn btn-success  btn-large'))}}
                        {{ Former::submit('Proceed &raquo;')->class('btn btn-primary btn-large pull-right')}}
                        {{ Former::close()}}

                    </div>
                </div>

            </div>

        </div>


    </div><!-- end span -->
</div><!-- end row -->



        <script type="text/javascript">

            function Countdown(options) {
                var timer,
                instance = this,
                seconds = options.seconds || 10,
                updateStatus = options.onUpdateStatus || function () {},
                counterEnd = options.onCounterEnd || function () {};

                function decrementCounter() {
                    updateStatus(seconds);

                    if (seconds === 0) {
                        counterEnd();
                        instance.stop();
                    }

                    seconds--;
                }

                this.start = function () {
                    clearInterval(timer);
                    timer = 0;
                    seconds = options.seconds;
                    timer = setInterval(decrementCounter, 1000);
                };

                this.stop = function () {
                    clearInterval(timer);
                };
            }

            $(document).ready(function(){

                function notNan(v){
                    if(v == '' || v == null || typeof v === "undefined" || isNaN(v) ){
                        v = 0;
                    }

                    return parseFloat(v);
                }

                function calculateCost(){
                    var salePrice = $('#listingPrice').val();
                    var adjustment1 = $('#adjustment1').val();
                    var adjustment2 = $('#adjustment2').val();
                    var insurance = $('#insurance').val();
                    var tax = $('#tax').val();
                    var closingCost = $('#closingCost').val();



                    var total_purchase = notNan(salePrice) + notNan(adjustment1) + notNan(adjustment2) + notNan(insurance) + notNan(tax) + notNan(closingCost);

                    console.log(total_purchase);

                    return total_purchase;
                }

                function calculateAdvance(total_purchase){
                    var earnestMoney1 = $('#earnestMoney1').val();
                    var earnestMoney2 = $('#earnestMoney2').val();
                    var loanPercent = $('#loanProceedPct').val();

                    var total_earnest = notNan(earnestMoney1) + notNan(earnestMoney2);
                    var client_balance = total_purchase - total_earnest;

                    $('#remaining_balance').val(client_balance);
                    $('#txt_remaining_balance').html(client_balance);

                    var loan = (notNan(loanPercent) / 100 ) * total_purchase;

                    loan = Math.round(loan);

                    $('#loanProceed').val(loan);

                    var total_payment = (total_purchase - total_earnest) - loan;

                    return total_payment;

                }

                var myCounter = new Countdown({
                    seconds:60*15,  // number of seconds to count down
                    onUpdateStatus: function(sec){
                            //console.log(sec);

                            //hours = totalSeconds / 3600;
                            //totalSeconds %= 3600;
                            totalSeconds = sec;
                            minutes = parseInt(totalSeconds / 60);
                            seconds = totalSeconds % 60;

                            $('#session-counter').html(minutes + ' mins ' + seconds + ' secs ');
                        }, // callback for each second
                    onCounterEnd: function(){ alert('Your session has expired!');} // final action
                });

                //myCounter.start();


                $('.tp').on('keyup',function(){
                    var total_purchase = calculateCost();
                    $('#total_purchase').html(total_purchase);

                    var total_payment = calculateAdvance(total_purchase);
                    $('#total_payment').val(total_payment);
                    $('#txt_total_payment').html(total_payment);

                });

                $('#country').on('change',function(){
                    var country = $('#country').val();

                    if(country == 'Australia'){
                        $('.au').show();
                        $('.us').hide();
                        $('.outside').hide();
                    }else if(country == 'United States of America'){
                        $('.au').hide();
                        $('.us').show();
                        $('.outside').hide();
                    }else{
                        $('.au').hide();
                        $('.us').hide();
                        $('.outside').show();
                    }


                });

                $('#entity_type').on('change',function(){

                    var etype = $('#entity_type').val();

                    var legalName = '';

                    if(etype == 'Business'){
                        $('#entity_source').show();
                        $('#loan_proceed').show();
                        legalName = $('#company').val();
                    }else{
                        $('#entity_source').hide();
                        $('#loan_proceed').hide();
                        legalName = $('#firstname').val() + ' ' + $('#lastname').val();
                    }

                    $('#legalName').val(legalName);

                });

                $('#more_code').on('click',function(){

                    $('#code_2').show();
                    $('#more_code').hide();

                });

                $('#more_earnest').on('click',function(){

                    $('#earnest_2').show();
                    $('#more_earnest').hide();

                });

                $('#rootwizard').bootstrapWizard({
                    'tabClass': 'bwizard-steps',
                    onNext: function(tab, navigation, index) {

                            var ret = true;

                            if(index==1) {

                                $('input').removeClass('error');

                                // Make sure we entered the name
                                if(!$('#firstname').val()) {
                                    $('#firstname').focus();
                                    $('#firstname').addClass('error');
                                    ret = false;
                                }
                                if(!$('#lastname').val()) {
                                    $('#lastname').focus();
                                    $('#lastname').addClass('error');
                                    ret = false;
                                }
                                if(!$('#company').val()) {
                                    $('#company').focus();
                                    $('#company').addClass('error');
                                    ret = false;
                                }
                                if(!$('#phone').val()) {
                                    $('#phone').focus();
                                    $('#phone').addClass('error');
                                    ret = false;
                                }
                                if(!$('#email').val()) {
                                    $('#email').focus();
                                    $('#email').addClass('error');
                                    ret = false;
                                }
                                if(!$('#address').val()) {
                                    $('#address').focus();
                                    $('#address').addClass('error');
                                    ret = false;
                                }

                                if(!$('#city').val()) {
                                    $('#city').focus();
                                    $('#city').addClass('error');
                                    ret = false;
                                }

                                if($('#country').val() == '-') {
                                    $('#country').focus();
                                    $('#country').addClass('error');
                                    ret = false;
                                }

                                $('.error').attr('placeholder','required field');

                                return ret;
                            }

                        },
                    onTabClick:function(tab, navigation, index){
                        return false;
                    },
                    onTabShow: function(tab, navigation, index) {

                            console.log(index);

                            var $total = navigation.find('li').length;
                            var $current = index+1;
                            var $percent = ($current/$total) * 100;
                            $('#rootwizard').find('.bar').css({width:$percent+'%'});

                            // If it's the last tab then hide the last button and show the finish instead
                            if($current >= $total) {
                                $('#rootwizard').find('.pager .next').hide();
                                $('#rootwizard').find('.pager .finish').show();
                                $('#rootwizard').find('.pager .finish').removeClass('disabled');
                            } else {
                                $('#rootwizard').find('.pager .next').show();
                                $('#rootwizard').find('.pager .finish').hide();
                            }

                        }

                });


                $('#process').on('click',function(){

                    var ret = true;

                    console.log($('#adjustment1').val());
                    console.log($('#code1').val());

                    $('input').removeClass('error');

                    if($('#adjustment1').val() && !$('#code1').val()) {
                        $('#code1').focus();
                        $('#code1').addClass('error');
                        ret = false;
                    }

                    if($('#adjustment2').val() && !$('#code2').val()) {
                        $('#code2').focus();
                        $('#code2').addClass('error');
                        ret = false;
                    }

                    if(ret){
                        $('#orderform').submit();
                        return false;
                    }else{
                        return false;
                    }


                });


            });

        </script>
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