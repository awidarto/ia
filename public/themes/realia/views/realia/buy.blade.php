@extends('realia.layout')

@section('content')

{{ HTML::style('css/wizard-custom.css') }}

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">
                {{--
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
                --}}

                <h1 class="page-header">{{ $prop['propertyId'].' : '.$prop['number'].' '.$prop['address'] }}</h1>
                <div id="session-counter-bar">
                    You have <span id="session-counter"></span> to finish this transaction.
                </div>
                <div id="rootwizard">
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
                                    {{ Former::hidden('agentId')->value( Auth::user()->_id ) }}
                                    {{ Former::text('agentName','Agent Name')->value(Auth::user()->firstname.' '.Auth::user()->lastname )->readonly(true)->class('uneditable-input') }}
                                    {{ Former::text('customerId','Customer/Badge ID')->value( str_random(5) ) }}
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
                                    {{ Former::select('countryOfOrigin')->options(Config::get('country.countries'))->label('Country') }}
                                    {{ Former::select('state')->options(Config::get('country.aus_states'))->label('State') }}
                                    {{ Former::text('zipCode','ZIP / Postal Code') }}
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab2">
                                {{ Former::select('fundingMethod')->options(Config::get('ia.funding_method'))->label('Funding Method') }}
                                <h5>Primary Purchaser Information</h5>
                                {{ Former::text('legalName','Legal Name for Title') }}
                                {{ Former::select('entityType')->options(Config::get('ia.entity_type'))->label('Entity Type') }}
                        </div>
                        <div class="tab-pane" id="tab3">
                            <table class="table" id="finance" >
                                <thead>
                                    <tr>
                                        <th class="span5"></th>
                                        <th class="span4"></th>
                                        <th class="span2" style="text-align:center;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sale Price</td>
                                        <td></td>
                                        <td>{{ $prop['listingPrice'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ Former::text('code1','Code') }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>{{ Former::text('code2','Code') }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Annual Insurance Premium</td>
                                        <td></td>
                                        <td>{{ $prop['insurance'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tax Adjustment</td>
                                        <td></td>
                                        <td>{{ $prop['tax'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Closing Cost</td>
                                        <td></td>
                                        <td>{{ $prop['HOA']}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Purchase Price</b></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Earnest Money 1</td>
                                        <td>
                                            {{ Former::select('earnestMoneyType1')->options(Config::get('ia.funding_method'))->label('')->class('span2') }}
                                        </td>
                                        <td>{{ Former::text('earnestMoney1','')->label('') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Earnest Money 2</td>
                                        <td>
                                            {{ Former::select('earnestMoneyType2')->options(Config::get('ia.funding_method'))->label('')->class('span2') }}
                                        </td>
                                        <td>{{ Former::text('earnestMoney2','')->label('') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Remaining Balance (Cash)</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Payment</b></td>
                                        <td></td>
                                        <td></td>
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

        <style type="text/css">

            input.uneditable-input{
                border:none;
            }

            .form-horizontal table#finance td .control-label{
                width: auto;
                text-align: left;
                padding-right: 10px;
            }

            .form-horizontal table#finance td .controls {
                margin-left: auto;
            }

            .form-horizontal table#finance td .controls input[type=text]{
                width:auto;
            }

            .table thead th{
                background-color: #eee;
            }

            .table tr td:last-child, .table tr td:last-child input[type=text]{
                text-align: right;
            }

            #session-counter-bar{
                line-height: 24px;
                text-align: right;
                padding: 2px 0px;
            }

            #session-counter{
                font-weight: bold;
            }
        </style>

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

                var myCounter = new Countdown({
                    seconds:300,  // number of seconds to count down
                    onUpdateStatus: function(sec){
                            console.log(sec);

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

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>


@stop
