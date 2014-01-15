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
                  <li><a href="{{URL::to('dashboard')}}#recent-orders"><i class="icon-chevron-right"></i> Recent Orders</a></li>
                  <li><a href="{{URL::to('dashboard')}}#buyer-list"><i class="icon-chevron-right"></i> Buyer List</a></li>
                  <li><a href="{{URL::to('dashboard')}}#account-info"><i class="icon-chevron-right"></i> Account Info</a></li>
                </ul>
        </div>
        <div class="span4">
            <h3 style="margin-top:6px;">Change Password</h3>
            @if (Session::get('loginError'))
                <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                     <button type="button" class="close" data-dismiss="alert"></button>
            @endif
            {{ Former::open_horizontal('changepass')}}
                {{ Former::password('newpass','New Password') }}
                {{ Former::password('repass','Repeat New Password') }}
                {{ Former::submit('submit','Submit')->class('btn btn-primary pull-right')}}
            {{ Former::close()}}
        </div>
    </div>
@stop