@extends('layout.front')

@section('content')
<div id="content-block">
    <div id="content-container" class="shadows" style="margin-bottom: 6px;" >


        <div class="row">
            <div >
                <div class="row" style="margin:0px;padding:0px;">
                    <h1 class="page-header">Login</h1>
                </div>
                <div class="row" style="margin:0px;padding:0px;padding-left:8px;">
                    <div class="span12" style="overflow-y:auto;height:340px;width:100%;margin:0px;margin-right:4px;">
                            <div class="offset4" style="margin-top:35px;border:thin solid #eee;padding:15px;width:300px;text-align:center;" >
                                {{Former::open_horizontal('login','POST',array('class'=>''))}}
                                    @if (Session::get('loginError'))
                                        <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
                                             <button type="button" class="close" data-dismiss="alert"></button>
                                    @endif
                                    {{ Former::text('email','Email')->class('span2') }}

                                    {{ Former::password('password','Password')->class('span2') }}

                                    {{-- Former::checkbox('remember-me')->label('')->text('Remember Me')->value('remember-me') --}}

                                    {{ Former::submit('Login')->class('btn btn-primary offset1') }}

                                {{ Former::close() }}

                            </div>

                        <div style="padding-top:50px;">
                            <p class="" style="font-size:10px;color:#ccc;text-align:justify;">
                                <strong>DISCLAIMER:</strong> All properties are sold as is, no warranties are offered by Investors Alliance (you may choose to purchase a home warranty from a 3rd party). Each property is different, and buyers may conduct their own due diligence before finalizing a purchase. Investors Alliance offers no guarantee of any kind regarding a specific property's performance, return on investment, or capitalization rate. Prior to undertaking any real estate transaction, you may consult your own accounting, legal and tax advisors to evaluate the risks, consequences and suitability of that transaction.
                            </p>
                        </div>

                        <!--insert grid-->
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>



@stop