@extends('layout.front')

@section('content')
<style type="text/css">
    ul#listing{
        list-style: none;
        margin: 0px;
        margin-left: 0px;
    }

    ul#listing li .thumb{
        display: block;
        padding: 4px;
        margin: 0px 4px 4px 0px;
        border: thin solid #ccc;
        width: 235px;
        text-align: center;
    }

    ul#listing li .thumb .img-container{
        margin-right: auto;
        margin-left: auto;
        height: 130px;
        width:auto;
        overflow: hidden;
    }

    ul#listing li .thumb h4,
    ul#listing li .thumb h5,
    ul#listing li .thumb h6
    {
        line-height: 16px;
        margin: 0px 0px;
        font-weight: normal;
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

    ul#ordering{
        list-style-type: none;
        margin-left: 0px;
    }

    ul#ordering li{
        float: left;
    }

    ul#ordering li a{
        display: block;
        color: #999;
        font-size: 14px;
        font-weight: normal;
        padding: 2px 4px;
    }

    ul#ordering li.active a{
        color: #FFF;
    }

    a.prev i, a.next i{
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
    }

    a.prev:hover i, a.next:hover i{
        color:#ccc;
    }

    ul#ordering li a:hover{
        text-decoration: underline;
        background-color: transparent;
    }

    .pagination ul>li>a:hover, .pagination ul>li>a:focus, .pagination ul>.active>a, .pagination ul>.active>span {
        color: #FFF;
        font-weight: normal;
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

        $('#typeselect').on('change',function(){
            console.log($('#perpage').val());
            window.location = $('#typeselect').val();
        });

        $('#sorter').on('change',function(){
            console.log($('#sorter').val());
            window.location = $('#sorter').val();
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

<div id="content-block">
    <div id="content-container" class="shadows" style="margin-bottom: 6px;" >


        <div class="row" >
            <div class="span12" >

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


                <div class="row" style="margin:0px;padding:0px;width:1000px;">
                    <div class="span12" style="overflow-y:auto;width:100%;margin:0px;">
                        <ul id="listing">
                        @foreach($properties as $p)
                            <li>
                                <div class="thumb span3" id="{{$p['_id']}}">
                                    <a href="{{ URL::to('property/detail/'.$p['_id']) }}" class="thumblink">
                                        <div class="img-container">
                                            <img src="{{ (isset($p['defaultpictures']['medium_url']))?$p['defaultpictures']['medium_url']:'' }}" alt="{{$p['propertyId']}}" >
                                            <span class="prop-status {{$p['propertyStatus']}}">{{ $p['propertyStatus']}}</span>
                                        </div>
                                        <h5>ID : {{$p['propertyId']}}</h5>
                                        <h5>{{ ucfirst( strtolower($p['city'])  ) .' '. strtoupper($p['state']) }}</h5>
                                        <h4>${{ number_format($p['listingPrice'],0,'.',',') }}</h4>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>

            </div><!-- span12 -->

        </div>

    </div>

<!-- bottom filter -->

    <div class="subnav row" id="filter-bar" style="background-color: transparent;padding:0px;padding-left:22px;margin:0px;">
        <span class="span3">
            <span class="white-text sel-label">See</span>
            <select class="span1" id="typeselect" name="type">
                @foreach(array_merge(array('all'=>'All'),Config::get('ia.type')) as $k=>$t)
                    <?php
                        $url = mg(array('type'=>$k,'page'=>0));
                        $selected = (Input::get('type') == $k)?'selected':'';
                    ?>
                    <option value="{{ $url }}" {{ $selected }} >{{$t}}</option>
                @endforeach

            </select>

            <span class="white-text sel-label">Sort by</span>
            <select class="span1" id="sorter" name="type">
                @foreach(array_merge(array('all'=>'All'),Config::get('ia.sort')) as $k=>$t)
                    <?php
                        $url = mg(array('sort'=>$k));
                        $selected = (Input::get('sort') == $k)?'selected':'';
                    ?>
                    <option value="{{ $url }}" {{ $selected }} >{{$t}}</option>
                @endforeach

            </select>

        </span>

        <div class="span1">
            <ul class="nav" id="ordering">
                <li style="float:left" class="{{ ms('order','asc','desc') }}" ><a href="{{ mg(array('order'=>'asc'))}}"><i class="fa fa-chevron-up"></i></a></li>
                <li class="{{ ms('order','desc','desc') }}" ><a href="{{ mg(array('order'=>'desc'))}}"><i class="fa fa-chevron-down"></i></a></li>
            </ul>
        </div>

        <div class="pagination pagination-centered span6" style="color:#fff;">
            <ul>
                <?php
                    $prev = ($current - 1 < 0 )?0:($current - 1);
                    $next = ($current + 1 > $paging )?$current:($current + 1);
                ?>
                <li class="" >
                    <a href="{{ mg(array('page'=>$prev))}}" class="prev" >
                        <i class="fa fa-angle-double-left"></i>
                    </a>
                </li>
                <?php
                    $max_count = Config::get('kickstart.pagination_max_count');

                ?>
                @if( $max_count >= $paging )
                    @for($p = 0;$p < $paging + 1;$p++)
                        <li class="{{ ms('page',$p , 0) }}" >
                            <a href="{{ mg(array('page'=>$p))}}" >
                                    {{$p + 1}}
                            </a>
                        </li>
                    @endfor
                @elseif( $max_count < $paging )

                    @if( $current >= ($max_count - 1) )
                        <?php
                            $pstart = $current - ($max_count - 2);
                            $pend = $pstart + $max_count;
                        ?>
                    @else
                        <?php
                            $pstart = 0;
                            $pend = $max_count;
                        ?>
                    @endif

                    @for($p = $pstart;$p < $pend;$p++)
                        <li class="{{ ms('page',$p , 0) }}" >
                            <a href="{{ mg(array('page'=>$p))}}" >
                                    {{$p + 1}}
                            </a>
                        </li>
                    @endfor

                @endif
                <li class="" >
                    <a href="{{ mg(array('page'=>$next))}}" class="next" >
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </li>

            </ul>
        </div>


        <div class="span2 pull-right white-text" >
            Items {{ ($current * $perpage) + 1 }} to {{ ( $current * $perpage ) + $currentcount }} of {{$total}}{{-- total (Filtered from {{$alltotal}} entries) --}}
        </div>

        {{--

        <ul class="nav nav-pills">
            <li class="pill-label">Order :</li>
            <li class="{{ ms('order','asc','desc') }}" ><a href="{{ mg(array('order'=>'asc'))}}">asc</a></li>
            <li class="{{ ms('order','desc','desc') }}" ><a href="{{ mg(array('order'=>'desc'))}}">desc</a></li>
        </ul>

        <ul class="nav nav-pills span5" style="padding-left:0px;margin-bottom:2px;" >
            @foreach(array_merge(array('all'=>'All'),Config::get('ia.type')) as $k=>$t)
                <li class="{{ ms('type',$k , 'all') }}" ><a href="{{ mg(array('type'=>$k,'page'=>0))}}">{{$t}}</a></li>
            @endforeach
        </ul>
        <div class="span2" style="margin-left:0px;padding-top:4px;" >
            Items {{ ($current * $perpage) + 1 }} to {{ ( $current * $perpage ) + $currentcount }} of {{$total}}{{-- total (Filtered from {{$alltotal}} entries)
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


        --}}
    </div>

<!-- end bottom filter -->


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