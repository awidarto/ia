@extends('layout.front')

@section('content')

    <style type="text/css">
        i {
            font-size: 16px;
        }
    </style>

    <h1>Dashboard</h1>
    <div class="row">
      <div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav">
          <li><a href="#recent-orders"><i class="icon-chevron-right"></i> Recent Orders</a></li>
          <li><a href="#account-info"><i class="icon-chevron-right"></i> Account Info</a></li>
        </ul>
      </div>
        <div class="span8">
            <h3>Recent Orders</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Ship To</th>
                        <th>Purchase Total</th>
                        <th>Payment Due</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total_purchase = 0;
                        $total_payment = 0;
                    ?>
                    @foreach($trx as $tx)
                    <tr>
                        <td>{{ $tx['orderNumber']}}</td>
                        <td>{{ Carbon::createFromFormat('Y-m-d H:i:s',$tx['createdDate'])->format('d/m/Y')}}</td>
                        <td>{{ $tx['firstname'].' '.$tx['lastname']}}</td>
                        <td>{{ Ks::usd($tx['total_purchase'])}}</td>
                        <td>{{ Ks::usd($tx['total_payment'])}}</td>
                        <td>{{ $tx['orderStatus']}}</td>
                        <td>
                            <a href="{{ URL::to('pr/print/'.$tx['_id'])}}" class="btn receipt" target="new" ><i class="icon-print"></i></a>
                            <a href="{{ URL::to('pr/dl/'.$tx['_id'])}}"  class="btn receipt"  target="new" ><i class="icon-download"></i></a>
                            {{--
                            <a href="#myModalReceipt" role="button" class="btn receipt" data-toggle="modal"><i class="icon-envelope"></i></a>
                            --}}
                        </td>
                        <?php
                            $total_purchase += $tx['total_purchase'];
                            $total_payment += $tx['total_payment'];
                        ?>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>{{ Ks::usd($total_purchase)}}</td>
                        <td>{{ Ks::usd($total_payment)}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <h3>Account Info</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Ship To</th>
                        <th>Purchase Total</th>
                        <th>Payment Due</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                        <td></td>
                        <th></th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <h3>Buyers List</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Salutation</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buyers as $by)
                    <tr>
                        <td>{{ $by['customerId']}}</td>
                        <td>{{ $by['salutation']}}</td>
                        <td>{{ $by['firstname']}}</td>
                        <td>{{ $by['lastname']}}</td>
                        <td>{{ $by['email']}}</td>
                        <td>{{ $by['phone']}}</td>
                        <td>
                            <a href="{{ URL::to('pr/print/'.$tx['_id'])}}" class="btn receipt" target="new" ><i class="icon-print"></i></a>
                            <a href="{{ URL::to('pr/dl/'.$tx['_id'])}}"  class="btn receipt"  target="new" ><i class="icon-download"></i></a>
                            {{--
                            <a href="#myModalReceipt" role="button" class="btn receipt" data-toggle="modal"><i class="icon-envelope"></i></a>
                            --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@stop