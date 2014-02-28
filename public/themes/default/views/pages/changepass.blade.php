@extends('layout.front')

@section('content')

    <style type="text/css">
        i {
            font-size: 14px;
        }
    </style>

<div class="row" style="padding-bottom:0px;margin-top:10px;padding-top:15px;">
    <div class="span12 shadows" style="margin:auto;background-color:#fff;height:480px;">

        <div class="row" style="margin:0px;padding:0px;">
                <h1>Dashboard</h1>
        </div>


        <div class="row" style="margin:0px;padding:5px;">

            <div class="span3 lionbars" style="margin:auto;background-color:#fff;height:430px;overflow-y:auto;overflow-x:hidden;">
                <ul class="nav nav-list bs-docs-sidenav" style="width: 200px;top: 140px;">
                  <li><a href="#recent-orders"><i class="icon-chevron-right"></i> Recent Orders</a></li>
                  <li><a href="#buyer-list"><i class="icon-chevron-right"></i> Buyer List</a></li>
                  <li><a href="#account-info"><i class="icon-chevron-right"></i> Account Info</a></li>
                </ul>
            </div>
            <div class="span5 lionbars" style="margin:auto;background-color:#fff;height:430px;overflow-y:auto;overflow-x:hidden;">
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


    </div>
</div>

@stop