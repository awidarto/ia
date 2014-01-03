@extends('layout.front')

@section('content')
<style type="text/css">
.form-horizontal .control-label {
    width: 85px;
}
</style>

<h1>Create an Account</h1>


{{ Former::open_horizontal('account/create')->id('createaccount')}}
    <div class="row">
        <div class="span5">
            <h3>Personal Information</h3>
            {{ Former::hidden('customerId')->value( str_random(5) )->class('span1') }}
            {{ Former::text('email','Email Address')->class('span3 auto-email') }}
            {{ Former::select('salutation')->options(Config::get('kickstart.salutation'))->label('Salutation')->class('span1') }}
            {{ Former::text('firstname','First Name')->class('span3') }}
            {{ Former::text('lastname','Last Name')->class('span3') }}
            {{ Former::text('company','Company / Entity')->class('span3') }}
            {{ Former::text('phone','Telephone')->class('span3') }}

        </div>
        <div class="span6">
            <h3>Address Information</h3>
            {{ Former::text('address','Street Address') }}
            {{ Former::text('city','City') }}
            {{ Former::select('countryOfOrigin')->options(Config::get('country.countries'))->label('Country')->id('country') }}
            <div class="us" style="display:none;">
                {{ Former::select('state')->class('us')->options(Config::get('country.us_states'))->label('State')->style('display:none;') }}
            </div>
            <div class="au" style="display:none;">
                {{ Former::select('state')->class('au')->options(Config::get('country.aus_states'))->label('State')->style('display:none;') }}
            </div>
            <div class="outside">
                {{ Former::text('state','State / Province')->class('outside') }}
            </div>

            {{ Former::text('zipCode','ZIP / Postal Code') }}

            {{ Former::hidden('agentId')->value('') }}
            {{ Former::hidden('agentName')->value('') }}
        </div>
    </div>
    <div class="row">
        <div class="span5">
            <h3>Prefered Agent</h3>
            {{ Former::select('agentId')->class('au')->options($agents)->label('Agent') }}
        </div>
        <div class="span6">
            <h3>Login Information</h3>
            {{ Former::password('pass','Password') }}
            {{ Former::password('repass','Repeat Password') }}
        </div>
    </div>
    <div class="row">
        <div class="span9">
            {{ Former::submit('submit','Submit')->class('btn btn-primary pull-right')}}
        </div>
    </div>
{{ Former::close() }}
    <script type="text/javascript">
        $(document).ready(function(){
                $('#country').on('change',function(){
                    var country = $('#country').val();

                    if(country == 'Australia'){
                        $('.au').show();
                        $('.us').hide();
                        $('.outside').hide();
                    }else if(country == 'United States of America'){
                        $('.au').hide();
                        $('.us').show();
                        $('.outside').hide();
                    }else{
                        $('.au').hide();
                        $('.us').hide();
                        $('.outside').show();
                    }
                });
        });
    </script>
@stop