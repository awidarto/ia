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
        padding-right: 5px;
    }

    ul#sorter{
        margin-right: 30px;
    }

</style>
<?php

    function mg($newparam){

        $pstring = str_replace(URL::current(), '', URL::full());
        $pstring = str_replace('?', '', $pstring);

        parse_str($pstring,$reqs);

        $nreqs = array_merge($reqs,$newparam);
        $str = array();
        foreach ($nreqs as $k=>$v) {
            $str[]= $k.'='.$v;
        }
        $str = implode('&', $str);

        return URL::current().'?'.$str;
    }

    function ms($key, $val){
        $pstring = str_replace(URL::current(), '', URL::full());
        $pstring = str_replace('?', '', $pstring);
        parse_str($pstring,$reqs);

        if(isset($reqs[$key]) && $reqs[$key] == $val ){
            return 'active';
        }else{
            return '';
        }
    }

    if(Input::get('order') == 'asc'){
        $ord = 'desc';
    }else{
        $ord = 'asc';
    }
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#perpage').on('change',function(){
            console.log($('#perpage').val());
            window.location = $('#perpage').val();
        })
    });
</script>

<h1>Property</h1>
<div class="row" style="margin-left:-15px;padding-bottom:0px;">
    <div class="span4" >
        Items {{ $current * $perpage }} to {{ ( $current * $perpage ) + $currentcount }} of {{$total}} total (Filtered from {{$alltotal}} entries)
    </div>
    <div class="pagination pagination-centered span6">
        <ul>
            @for($p = 0;$p < $paging;$p++)
                <li class="{{ ms('page',$p) }}" ><a href="{{ mg(array('page'=>$p))}}" >{{$p + 1}}</a></li>
            @endfor
        </ul>
    </div>
    <div class="span2 pull-right form-inline">
        <?php
            $perpage = array();
            for($p = 1;$p < 5;$p++){
                $url = mg(array('count'=>$p*10));
                $perpage[ $url ] = $p*10;
            }
        ?>
        <label for="perpage">Show </label>
        <select class="span1" id="perpage" name="perpage">
            <?php
                $perpage = array();
            ?>
            @for($p = 2;$p < 6;$p++)
                <?php
                    $url = mg(array('count'=>$p*10));
                    $perpage = $p*10;
                    $selected = (Input::get('count') == $perpage)?'selected':'';
                ?>
                <option value="{{$url}}" {{ $selected }} >{{$perpage}}</option>
            @endfor
        </select> per page
    </div>
</div>
<div class="subnav row" id="filter-bar" style="margin-left:5px;background-color: aquamarine;padding-bottom:0px;">
    <ul class="nav nav-pills span11" style="padding-left:10px;margin-bottom:0px;" >
        @foreach(array_merge(array('all'=>'All'),Config::get('ia.type')) as $k=>$t)
            <li class="{{ ms('type',$k) }}" ><a href="{{ mg(array('type'=>$k))}}">{{$t}}</a></li>
        @endforeach
    </ul>
</div>
<div id="sort-bar row" >
    <ul class="nav nav-pills pull-right">
        <li class="pill-label">Order :</li>
        <li class="{{ ms('order','asc') }}" ><a href="{{ mg(array('order'=>'asc'))}}">asc</a></li>
        <li class="{{ ms('order','desc') }}" ><a href="{{ mg(array('order'=>'desc'))}}">desc</a></li>
    </ul>
    <ul class="nav nav-pills pull-right" id="sorter">
        <li class="pill-label">Sort By :</li>
        @foreach(Config::get('ia.sort') as $k=>$t)
            <li class="{{ ms('sort',$k) }}" ><a href="{{ mg(array('sort'=>$k))}}">{{$t}}</a></li>
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
                    <h5>{{ $p['city'].','.$p['state'] }}</h5>
                    <h4>{{ number_format($p['listingPrice'],2,'.',',') }}</h4>
                    <h6>ROI : {{ number_format(Prefs::roi($p),1,',','.') }}%</h6>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@stop