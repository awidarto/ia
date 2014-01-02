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
        border-top: 1px solid #ddd;
        font-size: 11px;
    }

    table th{
        font-weight: bold;
        width: 100px;
        background-color: #ccc;
        border-color: transparent;
    }

    /*
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


    table th.h4{
        background-color: transparent;
    }
    */

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

    table#finance tr td:last-child{
        text-align: right;
        font-size: 13px;
    }

    span.more{
        cursor: pointer;
        text-decoration: underline;
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
    </div>
    <div class="span4">
        <h1 style="margin-top:0px;padding-left:0px;margin-bottom:4px;">ID : {{$prop['propertyId']}}</h1>
        <h2 style="margin-top:0px;margin-bottom:4px;">Purchase Details</h2>
        <a href="{{ URL::to('brochure/dl/'.$prop['_id'])}}" target="blank" style="width:100%;line-height:24px;"><i class="icon-download"></i> Brochure</a>
    </div>
    <div class="span5">
        <div id="session-counter-bar" style="text-align:right;">
            Your shopping cart will expire in <span id="session-counter"></span>.
        </div>
    </div>
    <hr>
</div>
<div class="row">
    <div class="span3">
        <h4>Description</h4>
        {{ $prop['description']}}
    </div>
    <div class="span9">
        {{ HTML::style('css/wizard-custom.css') }}

            <style type="text/css">
                .bwizard-steps li {
                    display: inline-block;
                    position: relative;
                    margin-right: 5px;
                    padding: 12px 17px 10px 30px;
                    background: #cfcfcf;
                    line-height: 18px;
                    list-style: none;
                    zoom: 1;
                    width: 26%;
                }
            </style>

                <div id="rootwizard" style="width: 645px;">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab">Sales & Contact Information</a></li>
                        <li><a href="#tab2" data-toggle="tab">Funding & Title Information</a></li>
                        <li><a href="#tab3" data-toggle="tab">Financial Information</a></li>
                    </ul>
                    {{--

                    <div id="bar" class="progress progress-striped active">
                      <div class="bar"></div>
                    </div>

                    --}}

                    {{ Former::open_horizontal('property/process')->id('orderform')}}

                    {{ Former::hidden('propObjectId')->value($prop['_id']) }}
                    {{ Former::hidden('propertyId')->value($prop['propertyId']) }}

                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <div class="row">
                                <div class="span4">
                                    {{ Former::text('customerId','Customer ID')->value( str_random(5) ) }}
                                    {{ Former::select('salutation')->options(Config::get('kickstart.salutation'))->label('Salutation')->class('span1') }}
                                    {{ Former::text('firstname','First Name') }}
                                    {{ Former::text('lastname','Last Name') }}
                                    {{ Former::text('company','Company / Entity') }}
                                    {{ Former::text('phone','Telephone') }}
                                    {{ Former::text('email','Email Address') }}

                                </div>
                                <div class="span4">
                                    {{ Former::text('address','Street Address') }}
                                    {{ Former::text('city','City') }}
                                    {{ Former::select('countryOfOrigin')->options(Config::get('country.countries'))->label('Country')->id('country') }}
                                    <div class="us" style="display:none;">
                                        {{ Former::select('state')->class('us')->options(Config::get('country.us_states'))->label('State')->style('display:none;') }}
                                    </div>
                                    <div class="au" style="display:none;">
                                        {{ Former::select('state')->class('au')->options(Config::get('country.aus_states'))->label('State')->style('display:none;') }}
                                    </div>
                                    <div class="outside">
                                        {{ Former::text('state','State / Province')->class('outside') }}
                                    </div>

                                    {{ Former::text('zipCode','ZIP / Postal Code') }}

                                    {{ Former::hidden('agentId')->value( Auth::user()->_id ) }}
                                    {{ Former::hidden('agentName')->value( Auth::user()->firstname.' '.Auth::user()->lastname ) }}
                                    {{--
                                    <div class="control-group" style="margin-top:100px;">
                                        <label for="agentName" style="font-weight:bolder;" class="control-label">Agent Name</label>
                                        <div class="controls" style="line-height:27px;font-size:12px;padding-left:5px;">
                                            {{ Auth::user()->firstname.' '.Auth::user()->lastname}}
                                        </div>
                                    </div>

                                    --}}
                                    <table class="table table-bordered table-striped" style="margin-left:85px;width:220px;">
                                        <thead>
                                            <tr>
                                                <th>Agent : </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ Auth::user()->firstname.' '.Auth::user()->lastname}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                                {{ Former::select('fundingMethod')->options(Config::get('ia.funding_method'))->label('Funding Method') }}
                                <h5>Primary Purchaser Information</h5>
                                {{ Former::text('legalName','Legal Name for Title') }}
                                {{ Former::select('entityType')->options(Config::get('ia.entity_type'))->label('Entity Type')->id('entity_type') }}
                                <div id="entity_source" style="display:none;">
                                {{ Former::select('entitySource')->options(Config::get('ia.entity_source'))->label('Entity Type') }}
                                </div>
                        </div>
                        {{ Former::framework('nude')}}
                        <div class="tab-pane" id="tab3">
                            <table class="table table-bordered table-striped" id="finance" >
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="span3"></th>
                                        <th style="text-align:center;" class="span2">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sale Price</td>
                                        <td></td>
                                        <td>{{ $prop['listingPrice'] }}
                                            {{ Former::hidden('listingPrice')->value($prop['listingPrice'] )->id('listingPrice') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form-inline">{{ Former::text('code1','Code')->class('span1') }}</td>
                                        <td>
                                            {{ Former::select('adjustmentType1')->options(Config::get('ia.adjustment_type'))->label('')->class('span2') }} <span id="more_code" class="more">Add More</span>
                                        </td>
                                        <td>
                                            {{ Former::text('adjustment1','')->label('')->class('span2 tp')->id('adjustment1') }}
                                        </td>
                                    </tr>
                                    <tr id="code_2" style="display:none;">
                                        <td class="form-inline">{{ Former::text('code2','Code')->class('span1') }}</td>
                                        <td>
                                            {{ Former::select('adjustmentType2')->options(Config::get('ia.adjustment_type'))->label('')->class('span2') }}
                                        </td>
                                        <td>
                                            {{ Former::text('adjustment2','')->label('')->class('span2 tp')->id('adjustment2') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Annual Insurance Premium</td>
                                        <td></td>
                                        <td>{{ $prop['insurance'] }}
                                            {{ Former::hidden('insurance')->value($prop['insurance'] )->id('listingPrice') }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tax Adjustment</td>
                                        <td></td>
                                        <td>{{ $prop['tax'] }}
                                            {{ Former::hidden('tax')->value($prop['tax'] )->id('listingPrice') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Closing Cost</td>
                                        <td></td>
                                        <td>{{ Former::text('closingCost','')->label('')->class('span2 tp')->id('closingCost') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h4>Total Purchase Price</h4></td>
                                        <td></td>
                                        <td><h4 id="total_purchase"></h4></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Earnest Money 1</td>
                                        <td>
                                            {{ Former::select('earnestMoneyType1')->options(Config::get('ia.funding_method'))->label('')->class('span2') }} <span id="more_earnest" class="more">Add More</span>
                                        </td>
                                        <td>{{ Former::text('earnestMoney1','')->label('')->class('span2') }}</td>
                                    </tr>
                                    <tr id="earnest_2" style="display:none;">
                                        <td>Earnest Money 2</td>
                                        <td>
                                            {{ Former::select('earnestMoneyType2')->options(Config::get('ia.funding_method'))->label('')->class('span2') }}
                                        </td>
                                        <td>{{ Former::text('earnestMoney2','')->label('')->class('span2') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Remaining Balance (Cash)</td>
                                        <td></td>
                                        <td><span id="remaining_balance"></span></td>
                                    </tr>

                                    <tr id="loan_proceed">
                                        <td>Insider's Cash, LLC Loan proceeds<br /><span class="help">*not including origination fee or reserves.</span></td>
                                        <td>
                                            {{ Former::text('loanProceedPct','')->label('')->class('span1') }} %
                                        </td>
                                        <td>
                                            {{ Former::text('loanProceed','')->label('')->class('span2') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h3>Total Payment</h3></td>
                                        <td></td>
                                        <td><span id="total_payment"></span></td>
                                    </tr>

                                </tbody>
                            </table>


                        </div>
                        <ul class="pager wizard">
                            <li class="previous first" style="display:none;"><a href="#">First</a></li>
                            <li class="previous"><a href="#">Previous</a></li>
                            <li class="next" ><a href="#">Next</a></li>
                            <li class="next finish" id="process" style="display:none;"><a href="">Process</a></li>
                        </ul>
                    </div>

                    {{ Former::close() }}

                </div>


    </div>
</div>

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

                function calculateCost(){
                    var salePrice = $('#listingPrice').val();
                    var adjustment1 = $('#adjustment1').val();
                    var adjustment2 = $('#adjustment2').val();
                    var insurance = $('#insurance').val();
                    var tax = $('#tax').val();
                    var closingCost = $('#closingCost').val();

                    var total_purchase = parseInt(salePrice) + parseInt(adjustment1) + parseInt(adjustment2) + parseInt(insurance) + parseInt(tax) + parseInt(closingCost);

                    console.log(total_purchase);

                    return total_purchase;
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

                myCounter.start();


                $('.tp').on('keyup',function(){
                    var tp = calculateCost();
                    $('#total_purchase').html(tp);
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

                    if(etype == 'Business'){
                        $('#entity_source').show();
                        $('#loan_proceed').show();
                    }else{
                        $('#entity_source').hide();
                        $('#loan_proceed').hide();
                    }

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
                            if(index==2) {
                                // Make sure we entered the name
                                if(!$('#name').val()) {
                                    /*
                                    alert('You must enter your name');
                                    $('#name').focus();
                                    return false;
                                    */
                                }
                            }

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

                    $('#orderform').submit();
                    return false;

                });

            });

        </script>

@stop