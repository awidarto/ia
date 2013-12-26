@extends('layout.front')

@section('content')
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
                        <th>Order Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
            <h3>Account Info</h3>

            <h3></h3>
        </div>
    </div>
@stop