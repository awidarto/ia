@extends('layout.front')

@section('content')

    <style type="text/css">
        i {
            font-size: 14px;
        }
    </style>

    <div class="row">
      <div class="span3 bs-docs-sidebar">
        <h1 style="margin-top:6px;" class="affix">Dashboard</h1>
        <ul class="nav nav-list bs-docs-sidenav affix" style="width: 200px;top: 140px;">
          <li><a href="#recent-orders"><i class="icon-chevron-right"></i> Recent Orders</a></li>
          <li><a href="#buyer-list"><i class="icon-chevron-right"></i> Buyer List</a></li>
          <li><a href="#account-info"><i class="icon-chevron-right"></i> Account Info</a></li>
        </ul>
      </div>
        <div class="span8">
            <h3 id="recent-order">Recent Orders</h3>
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
                        <td class="curr">{{ Ks::usd($tx['total_purchase'])}}</td>
                        <td class="curr">{{ Ks::usd($tx['total_payment'])}}</td>
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
                        <td class="curr">{{ Ks::usd($total_purchase)}}</td>
                        <td class="curr">{{ Ks::usd($total_payment)}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <h3 id="buyer-list">Buyers List</h3>
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
                            <a href="#myModalReceipt" role="button" class="btn receipt" data-toggle="modal"><i class="icon-eye-open"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h3 id="account-info">Account Info</h3>
            <h5>Contact Detail</h5>
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $contact['salutation'].'. '.$contact['firstname'].' '.$contact['lastname'] }}</td>
                        <th>Email</th>
                        <td>{{ $contact['email'] }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <?php
                            $address_2 = ($contact['address_2'] != '')?$contact['address_2'].'<br />':'';
                        ?>
                        <td>{{ $contact['address_1'].'<br />'.$address_2.$contact['city'].' '.$contact['state'].'<br />'.$contact['countryOfOrigin']}}</td>
                        <th>Phone</th>
                        <td>{{ $contact['mobile']}}</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <a href="{{ URL::to('changepass') }}"><i class="icon-key"></i> Change Password</a>&nbsp;&nbsp;&nbsp;
                            <a href="{{ URL::to('addaddress')}}" ><i class="icon-plus-sign"></i> Add Address</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
@stop