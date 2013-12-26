@extends('layout.front')

@section('content')
<style type="text/css">
    ul#listing{
        list-style: none;
        margin: 0px;
    }

    ul#listing li .thumb{
        display: block;
        margin: 4px;
        padding: 5px;
        border: thin solid #ccc;
        width: 166px;
        text-align: center;
    }

    ul#listing li .thumb h4,
    ul#listing li .thumb h5,
    ul#listing li .thumb h6
    {
        margin: 4px 0px;
    }

    #filter-bar .nav-pills{
        margin-bottom: 4px;
    }

    #sort-bar{
        display: block;
    }

    li.pill-label{
        line-height: 20px;
        padding-top: 3px;
    }
</style>
<h1>Property</h1>
<div class="row" style="margin-left:-15px;padding-bottom:0px;">
    <div class="span2" >
        Items 1 to 20 of 40 total
    </div>
    <div class="pagination pagination-centered span8">
        <ul>
            <li class="active"><a href="http://bootswatch.com/2/united/#">1</a></li>
            <li><a href="http://bootswatch.com/2/united/#">2</a></li>
            <li><a href="http://bootswatch.com/2/united/#">3</a></li>
            <li><a href="http://bootswatch.com/2/united/#">4</a></li>
            <li><a href="http://bootswatch.com/2/united/#">5</a></li>
        </ul>
    </div>
    <div class="span2 pull-right form-inline">
        {{ Former::select('perpage','Show ')->label('Show')->options(Config::get('ia.type'))->class('span1') }} per page
    </div>
</div>
<div class="subnav row" id="filter-bar" style="margin-left:5px;background-color: aquamarine;padding-bottom:0px;">
    <ul class="nav nav-pills span11" style="padding-left:10px;margin-bottom:0px;" >
        @foreach(array_merge(array('all'=>'All'),Config::get('ia.type')) as $k=>$t)
            <li><a href="{{$k}}">{{$t}}</a></li>
        @endforeach
    </ul>
</div>
<div id="sort-bar row" >
    <ul class="nav nav-pills pull-right">
        <li class="pill-label">Sort By :</li>
        @foreach(Config::get('ia.sort') as $k=>$t)
            <li><a href="{{$k}}">{{$t}}</a></li>
        @endforeach
    </ul>
</div>
<div class="row">
    <div class="span12" >
        <ul id="listing">
        @foreach($properties as $p)
            <li>
                <div class="thumb span3">
                    <h5>ID : {{$p['propertyId']}}</h5>
                    <img src="{{ (isset($p['defaultpictures']['medium_url']))?$p['defaultpictures']['medium_url']:'' }}" alt="{{$p['propertyId']}}" >
                    <h4>{{ number_format($p['listingPrice'],2,'.',',') }}</h4>
                    <h6>ROI : {{ number_format($p['listingPrice'],2,',','.') }}</h6>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@stop