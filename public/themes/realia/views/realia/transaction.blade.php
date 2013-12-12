@extends('realia.layout')

@section('content')

<style type="text/css">
.table thead th{
    vertical-align: top;
    text-align: center;
}

</style>

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">

               <h1 class="page-header">Transactions</h1>

                    <div class="properties-rows">
                        <div class="filter">
                            <form action="http://html.realia.byaviators.com/listing-grid-filter.html?" method="get" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label" for="inputSortBy">
                                        Sort by
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>
                                    <div class="controls">
                                        <select id="inputSortBy">
                                            <option id="price">Price</option>
                                            <option id="published">Published</option>
                                        </select>
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="control-group">
                                    <label class="control-label" for="inputOrder">
                                        Order
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>
                                    <div class="controls">
                                        <select id="inputOrder">
                                            <option id="asc">ASC</option>
                                            <option id="desc">DESC</option>
                                        </select>
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->
                            </form>
                        </div><!-- /.filter -->
                    </div><!-- /.properties-rows -->

{{--

    [_id] => 52a9844dccae5b3507000000
    [propObjectId] => 52a94f58ccae5b7a04000000
    [propertyId] => IA10018
    [agentId] => 51e621588dfa198e18000000
    [agentName] => Oddie Octaviadi
    [customerId] => tb1234
    [firstName] => Phillip
    [lastName] => Coulson
    [company] => SHIELD
    [phone] => 65909012389
    [email] => coulson@shield.org
    [address] => The BUS
    [City] => Perth
    [countryOfOrigin] => Australia
    [state] => WA
    [zipCode] => 898082
    [fundingMethod] => Cash
    [legalName] => Phillip Coulson
    [entityType] => Personal
    [code1] => 1233
    [code2] => 1234
    [earnestMoneyType1] => Check
    [earnestMoney1] => 10000
    [earnestMoneyType2] => Cash
    [earnestMoney2] => 5000
    [_token] => m9BtDvXzlybNWKvMxxmJhUlfh4EHiz6VppAif9ce
    [createdDate] => 2013-12-12 09:39:25
    [lastUpdate] => 2013-12-12 09:39:25

--}}

                            <table class="table" id="finance" >
                                <thead>
                                    <tr>
                                        <th rowspan="2">Property ID</th>
                                        <th colspan="2">Buyer</th>
                                        <th rowspan="2">Amount</th>
                                        <th rowspan="2">Status</th>
                                        <th rowspan="2">Date</th>
                                        <th rowspan="2">Documents</th>
                                    </tr>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $t)
                                        <tr>
                                            <td>{{ $t['propertyId']}}</td>
                                            <td>{{ $t['firstName']}}</td>
                                            <td>{{ $t['lastName']}}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $t['createdDate']}}</td>
                                            <td>
                                                Download
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                    <div class="pagination pagination-centered">
                        <ul>
                            <li><a href="{{ URL::to('transaction/listing') }}">first</a></li>
                            <li><a href="{{ URL::to('transaction/listing/'.(($current == 0)?$current:$current - 1) ) }}">previous</a></li>
                            @for($p = 0; $p < $paging; $p++)
                                <li {{ ($p == $current)?'class="active"':'' }} ><a href="{{ URL::to('transaction/listing/'.$p)}}"  >{{$p + 1}}</a></li>
                            @endfor
                            <li><a href="{{ URL::to('transaction/listing/'.(($current == ($paging - 1))?$current:$current + 1)) }}">next</a></li>
                            <li><a href="{{ URL::to('transaction/listing/'.($paging - 1) ) }}">last</a></li>
                        </ul>
                    </div><!-- /.pagination -->

            </div>
            <div class="sidebar span3">
                @include('realia.latest')


            </div>
        </div>

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>


@stop