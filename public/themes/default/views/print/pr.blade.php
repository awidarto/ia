@extends('layout.brochure')

@section('content')
<html>
<body>
{{ HTML::style('bootstrap/css/bootstrap.min.css') }}
{{ HTML::style('bootstrap/css/bootstrap-responsive.min.css') }}
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

    i.icon-download , i.icon-map-marker, i.icon-envelope, i.icon-print{
        font-size: 18px;
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

</style>

            <?php
                $address = $prop['number'].' '.$prop['address'].' '.$prop['city'].', '.$prop['state'].' '.$prop['zipCode'];
            ?>

    <div class="container">
        <h1 style="padding-left:0px;">Purchase Receipt</h1>
        <div class="row-fluid" style="padding-left:0px;">
            <div class="span4" style="padding-left:0px;">
                <h3>Purchased From</h3>
                <h4>{{ $trx['agentName']}}</h4>
                <h5>
                    {{ $agent['address_1'] }}<br />
                    {{ $agent['address_2'] }}<br />
                    {{ $agent['city']}}, {{ $agent['state']}} {{ (isset($agent['zipCode']))?$agent['zipCode']:''}}<br />
                    {{ $agent['countryOfOrigin']}}
                </h5>
            </div>
            <div class="span1"></div>
            <div class="span4" style="padding-left:0px;">
                <h3>Purchased By</h3>
                <h4>{{ $trx['firstname'].' '.$trx['lastname']}}</h4>
                <h5>
                    {{ $trx['address'] }}<br />
                    {{ $trx['city']}}, {{ $trx['state']}} {{ (isset($trx['zipCode']))?$trx['zipCode']:''}}<br />
                    {{ $trx['countryOfOrigin']}}
                </h5>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="4">Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Property ID</th>
                    <td>{{ $prop['propertyId']}}</td>
                    <th>Address</th>
                    <td>{{ $address}}</td>
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
                    <td class="curr">${{ number_format($prop['listingPrice'],0,'.',',')}}</td>
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
                    <td class="curr">${{ number_format($prop['tax'],0,'.',',')}}</td>
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
                <tr>
                    <td colspan="2"><h4>Due On</h4></td>
                    <td colspan="2"><h4>
                            {{ Carbon::parse($trx['createdDate'])->addDays(14)->format('d M Y')}}
                        </h4>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>


</body>
</html>
@stop