@extends('realia.layout')

@section('content')
            <!-- if there are login errors, show them here -->
@if(Auth::check())
    <p class="navbar-text pull-right">
        Hello {{ Auth::user()->fullname }}
        <a href="{{ URL::to('logout')}}" >Logout</a>
    </p>
@endif

<style type="text/css">

form#register .control-label {
    float: left;
    width: 400px;
    padding-top: 0px;
    text-align: right;
    padding-right: 8px;
    font-size: 12px;
}

form#register{
    margin-top: 40px;
}

form#register input[type=text]{
    width: 300px;
}

</style>

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">

            {{Former::open_horizontal('register','POST',array('class'=>'','id'=>'register'))}}
                {{ Former::text('firstname','First Name: *') }}
                {{ Former::text('lastname','Last Name: *') }}
                {{ Former::text('phone','Home Phone: *') }}
                {{ Former::text('mobile','Cell Phone:') }}
                {{ Former::text('address','Address: *') }}
                {{ Former::text('city','City: *') }}
                {{ Former::text('state','State: *') }}
                {{ Former::text('zipCode','Postal Code: *') }}
                {{ Former::text('countryOfOrigin','Country: *') }}
                {{ Former::text('email','Email Address: *') }}
                {{ Former::text('experienceInvesting','Have you had experience investing in real estate? *') }}
                {{ Former::text('yearsInvesting','How many years have you been investing in real estate? *') }}
                {{ Former::text('numberOfPropertiesLastYear','How many properties have you purchased in the last year? *') }}
                {{ Former::text('everRehab','Have you ever rehabbed a property? *') }}
                {{ Former::text('everOwnRentalInvestment','Have you ever owned a rental investment property? *') }}
                {{ Former::text('planToAttendThreeDayTraining','Are you currently planning to attend a 3 day training event? *') }}
                {{ Former::text('howMuchToInvest','How much are you looking to invest? *') }}
                {{ Former::text('typeOfFund','What type of funds do you plan to use? *') }}
                {{ Former::text('IRASelfDirected','If you plan to use IRA funds, is it already self directed?') }}
                {{ Former::text('needFinancing','Do you need financing to complete an investment transaction? *') }}
                {{ Former::text('rateYourCredit','Please rate your credit? *') }}
                {{ Former::text('ownOrRentPrimaryResidence','Do you own or rent your primary residence? *') }}
                {{ Former::text('howQuickToInvest','How quickly are you looking to invest? *') }}
                {{ Former::text('howToContactYou','How would you like us to contact you? *') }}
                {{ Former::submit('Submit')->class('btn btn-primary offset5') }}

            {{ Former::close() }}


            </div>
            <div class="sidebar span3">
                @include('realia.youtube')
            </div>
        </div>
    </div>
</div>

@stop


