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
        width: 210px;
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
{{ HTML::style('css/imagestyle.css')}}
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

    function ms($key, $val, $default){
        $pstring = str_replace(URL::current(), '', URL::full());
        $pstring = str_replace('?', '', $pstring);
        parse_str($pstring,$reqs);

        if(Input::get($key) == $val ){
            return 'active';
        }else if(Input::get($key) == '' && $val == $default){
            return 'active';
        }else{
            return '';
        }
    }

    function ps($page){

        if(Input::get('page') == $page ){
            return 'active';
        }else if(Input::get('page') == '' && $page == 0){
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
        var current_session = '{{ Session::get('reservedId')}}';

        console.log('id ' + current_session);

        $('#perpage').on('change',function(){
            console.log($('#perpage').val());
            window.location = $('#perpage').val();
        });

        /*
        $('.thumb').on('click',function(e){
            console.log(this.id);
            if(current_session == this.id){

            }else{
                var calert = 'You currently have another property under process, would you like to cancel that previous process ?';
                if(confirm(calert)){
                    $.post('{{ URL::to('ajax/translock')}}',
                    {
                        lockstatus:'open',
                        propObjectId: this.id
                    },
                    function(data){
                    },
                    'json');

                }else{

                }

                alert();
            }
        });
        */

    });
</script>

<div class="row" style="padding-bottom:0px;margin-top:10px;padding-top:35px;">
    <div class="span12 shadows" style="margin:auto;background-color:#fff;height:460px;">

        {{-- top pagination

        <div class="row" >
            <div class="span4" style="margin-left:0px;" >
                Items {{ ($current * $perpage) + 1 }} to {{ ( $current * $perpage ) + $currentcount }} of {{$total}}{{ total (Filtered from {{$alltotal}} entries) }}
            </div>


            <div class="pagination pagination-centered span6">
                <ul style="margin-left:-5px;">
                    @for($p = 0;$p < $paging;$p++)
                        <li class="{{ ms('page',$p , 0) }}" ><a href="{{ mg(array('page'=>$p))}}" >{{$p + 1}}</a></li>
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
            --}}

        <div class="subnav row" id="filter-bar" style="background-color: #fff;padding:0px;margin:5px;">

            <ul class="nav nav-pills span5" style="padding-left:0px;margin-bottom:2px;" >
                @foreach(array_merge(array('all'=>'All'),Config::get('ia.type')) as $k=>$t)
                    <li class="{{ ms('type',$k , 'all') }}" ><a href="{{ mg(array('type'=>$k,'page'=>0))}}">{{$t}}</a></li>
                @endforeach
            </ul>
            <div class="span2" style="margin-left:0px;padding-top:4px;" >
                Items {{ ($current * $perpage) + 1 }} to {{ ( $current * $perpage ) + $currentcount }} of {{$total}}{{-- total (Filtered from {{$alltotal}} entries) --}}
            </div>
            <ul class="nav nav-pills pull-right">
                <li class="pill-label">Order :</li>
                <li class="{{ ms('order','asc','desc') }}" ><a href="{{ mg(array('order'=>'asc'))}}">asc</a></li>
                <li class="{{ ms('order','desc','desc') }}" ><a href="{{ mg(array('order'=>'desc'))}}">desc</a></li>
            </ul>
            <ul class="nav nav-pills pull-right" id="sorter">
                <li class="pill-label">Sort By :</li>
                @foreach(Config::get('ia.sort') as $k=>$t)
                    <li class="{{ ms('sort',$k,'listingPrice') }}" ><a href="{{ mg(array('sort'=>$k))}}">{{$t}}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="row" style="margin:0px;padding:0px;padding-left:8px;">
            <div class="span12 lionbars" style="overflow-y:auto;height:410px;width:100%;margin:0px;">
                <ul id="listing">
                @foreach($properties as $p)
                    <li>
                        <div class="thumb span4" id="{{$p['_id']}}">
                            <a href="{{ URL::to('property/detail/'.$p['_id']) }}" class="thumblink">
                                <h5>ID : {{$p['propertyId']}}</h5>
                                <div class="img-container">
                                    <img src="{{ (isset($p['defaultpictures']['medium_url']))?$p['defaultpictures']['medium_url']:'' }}" alt="{{$p['propertyId']}}" >
                                    <span class="prop-status {{$p['propertyStatus']}}">{{ $p['propertyStatus']}}</span>
                                </div>
                                <h5>{{ $p['city'].','.$p['state'] }}</h5>
                                <h4>${{ number_format($p['listingPrice'],0,'.',',') }}</h4>
                                <h6>Monthly Rent : ${{ number_format($p['monthlyRental'],0,'.',',') }}</h6>
                            </a>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>

    </div>
    <div class="row" style="margin-top:10px;padding-left:0px;padding-top:8px;" >
        <div class="pagination pagination-centered span12" style="color:#fff;padding-top:15px;">
            <ul>
                @for($p = 0;$p < $paging;$p++)
                    <li class="{{ ms('page',$p , 0) }}" ><a href="{{ mg(array('page'=>$p))}}" >{{$p + 1}}</a></li>
                @endfor
            </ul>
        </div>
    </div>

</div>

<div id="blueimp-gallery" class="blueimp-gallery  blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

@stop