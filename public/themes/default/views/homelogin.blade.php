@extends('layout.front')

@section('content')
<div id="content-block">
    <div id="content-container" class="shadows" style="margin-bottom: 6px;" >


        <div class="row">
            <div style="padding-left: 0px;">
                <div class="row" style="font-style:italic;">
                    <div class="span6" >

                        <h4><img src="{{ URL::to('/')}}/images/ic-login.png"> Please login to continue</h4>

                        {{Former::open_horizontal('login','POST',array('class'=>'span4'))}}
                            @if (Session::get('loginError'))
                                <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                                     <button type="button" class="close" data-dismiss="alert"></button>
                            @endif
                            {{ Former::text('email','Email')->class('span3') }}

                            {{ Former::password('password','Password')->class('span3') }}

                            {{-- Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') --}}

                            {{ Former::submit('Login')->class('btn btn-primary pull-right') }}

                        {{ Former::close() }}

                        <!--insert grid-->
                    </div>
                    <div class="span6 pull-right" >
                        <h4><img src="{{ URL::to('/')}}/images/ic-affiliate.png"> Affiliate Request Form</h4>

                        @if(Session::get('enquiryMessage'))
                                <div class="alert alert-info">{{ Session::get('enquiryMessage') }}</div>
                                     <button type="button" class="close" data-dismiss="alert"></button>
                                <?php Session::forget('enquiryMessage'); ?>
                        @else
                            {{Former::open_horizontal('affiliate','POST',array('class'=>'span5'))}}
                                {{ Former::text('fullname','Full Name')->class('span4') }}

                                {{ Former::text('email','Email')->class('span4') }}

                                {{ Former::text('phone','Phone Number')->class('span4') }}

                                {{ Former::textarea('message','Message')->class('span4')->style('height:80px;') }}

                                {{-- Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') --}}

                                {{ Former::submit('Submit')->class('btn btn-primary pull-right') }}

                            {{ Former::close() }}

                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>



@stop