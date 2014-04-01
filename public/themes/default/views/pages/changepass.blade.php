@extends('layout.front')

@section('content')

    <style type="text/css">
        i {
            font-size: 14px;
        }
    </style>

<div id="content-block">
    <div id="content-container" class="shadow" style="margin-bottom: 6px;" >

        <div class="row">
            <div class="">

                <div class="row" style="margin:0px;padding:0px;">
                        <h1>Dashboard</h1>
                </div>

                <div class="row" style="margin:0px;padding:5px;">

                    <div class="lionbars" style="margin:auto;background-color:#fff;height:340px;overflow-y:auto;overflow-x:hidden;padding-left: 5px;">
                        <h3 style="margin-top:6px;">Change Password</h3>
                        @if (Session::get('loginError'))
                            <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                                 <button type="button" class="close" data-dismiss="alert"></button>
                        @endif
                        {{ Former::open_horizontal('changepass')->style('width:300px;')}}
                            {{ Former::password('newpass','New Password') }}
                            {{ Former::password('repass','Repeat New Password') }}
                            <a href="{{ URL::to('dashboard')}}" class="pull-right" style="margin-left:10px;">cancel</a>
                            {{ Former::submit('submit','Submit')->class('btn btn-primary pull-right')}}
                        {{ Former::close()}}

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


@stop