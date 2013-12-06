@extends('realia.layout')

@section('content')
<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">
                <h1 class="page-header">Featured properties</h1>
                <!--insert grid-->
                @include('realia.propgrid')

            </div>
            <div class="sidebar span3">


                @include('realia.latest')

            </div>
        </div>

        @include('realia.carousel')
    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>

<!--insert bottom features-->

@stop