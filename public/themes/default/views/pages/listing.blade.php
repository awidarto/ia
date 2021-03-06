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

    #advanced-link{
        cursor: pointer;
        color: white;
        margin-left: 5px;
    }

.form-horizontal .no-label  .controls {
        margin-left: 0px;
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

        $('#do-search').on('click',function(){
            do_search();
        });

        $('#do_advanced_search').on('click',function(){
            do_advanced_search();
        });

        $('#search').on('keyup',function(ev){
            console.log(ev.keyCode);
            if(ev.keyCode == '13'){
                do_search();
            }
        });

        $('#advanced-link').on('click',function(){
            $('#searchModal').modal();
        });


        function do_search(){
            var current = $('#sfull').val();
            var req = $('#sreq').val();
            var term = $('#search').val();

            if(req != ''){
                var curr = req.split('&');

                curr = replace_param('s', term, curr);
                curr = replace_param('md','sim', curr);

                var creq = curr.join('&');

                var nexturl = '{{ URL::to( $pageurl )}}?' + creq;
                window.location = nexturl;

            }else if( req == '' ){
                if(term != ''){
                    nreq = [];

                    nreq.push('s=' + term);
                    nreq.push('md=sim');

                    var creq = nreq.join('&');
                    var nexturl = '{{ URL::to( $pageurl )}}?' + creq;
                }else{
                    var nexturl = '{{ URL::to( $pageurl )}}';
                }
                window.location = nexturl;

            }

        }

        function do_advanced_search(){
            var current = $('#sfull').val();
            var req = $('#sreq').val();
            var term = $('#searchword').val();

            var scope = $('#searchscope').val();

            var price = $('#filter_price').val();
            var price_sign = $('#price_sign').val();
            var price_rel = $('#price_rel').val();

            var price1 = $('#filter_price2').val();
            var price_sign1 = $('#price_sign2').val();


            if(req != ''){
                var curr = req.split('&');

                curr = replace_param('s', term, curr);
                curr = replace_param('md','adv', curr);
                curr = replace_param('sc' , scope, curr);
                curr = replace_param('p1' , price, curr);
                curr = replace_param('ps1' , price_sign, curr);
                curr = replace_param('pr' , price_rel, curr);
                curr = replace_param('p2' , price1, curr);
                curr = replace_param('ps2' , price_sign1, curr);


                var creq = curr.join('&');

                var nexturl = '{{ URL::to( $pageurl )}}?' + creq;
                window.location = nexturl;

            }else if(req == ''){
                if(term != '' || price != ''){
                    nreq = [];
                    nreq.push('s=' + term);
                    nreq.push('md=adv');
                    nreq.push('sc='+scope);
                    nreq.push('p1='+price);
                    nreq.push('ps1='+price_sign);
                    nreq.push('pr='+price_rel);
                    nreq.push('p2='+price1);
                    nreq.push('ps2='+price_sign1);

                    var creq = nreq.join('&');
                    var nexturl = '{{ URL::to( $pageurl )}}?' + creq;
                }else{
                    var nexturl = '{{ URL::to( $pageurl )}}';
                }
                window.location = nexturl;

            }

        }

        function replace_param(par, term, curr){
            var nreq = [];
            var curel = [];

            for(i = 0; i < curr.length; i++){
                t = curr[i];
                vt = t.split('=');
                if(vt[0] == par){
                    nreq.push(par + '=' + term);
                }else{
                    nreq.push(t);
                }
                curel.push(vt[0]);
            }

            if(curel.indexOf(par) < 0){
                nreq.push(par + '=' + term);
            }

            return nreq;
        }

        function add_param(par,term, req, nreq, curr){

            if(req != '' && req.indexOf(par) >= 0 && curr.length > 0){
                for(i = 0; i < curr.length; i++){
                    t = curr[i];
                    vt = t.split('=');
                    if(vt[0] == par){
                        nreq.push(par + term);
                    }else{
                        nreq.push(t);
                    }
                }
            }else{
                nreq.push(par + term);
            }

            return nreq;
        }

    });
</script>

<div id="content-block">
    <div id="content-container" class="shadows" style="margin-bottom: 6px;" >


        <div class="row" >
            <div class="span12" >

                <div class="row" style="margin:0px;padding:0px;width:1000px;">
                    <div class="span12" style="overflow-y:auto;width:100%;margin:0px;">
                        <ul id="listing">
                        @foreach($properties as $p)
                            <li>
                                <div class="thumb span3" id="{{$p['_id']}}">
                                    <a href="{{ URL::to('property/detail/'.$p['_id']) }}" class="thumblink">
                                        <div class="img-container">
                                            <img src="{{ (isset($p['defaultpictures']['medium_url']))?$p['defaultpictures']['medium_url']:URL::to('images').'/no-photo.jpg' }}" alt="{{$p['propertyId']}}" >
                                            <span class="prop-status {{$p['propertyStatus']}}">{{ $p['propertyStatus']}}</span>
                                        </div>
                                        <h5>ID : {{$p['propertyId']}}</h5>
                                        <h5>{{ ucwords( $p['city']  ) .' '. strtoupper($p['state']) }}</h5>
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
        <span class="span3" style="width:230px;">
            <span class="white-text sel-label">See</span>
            <select class="span1" id="typeselect" name="type" style="width:75px;">
                @foreach(array_merge(array('all'=>'All'),Config::get('ia.type')) as $k=>$t)
                    <?php
                        $url = mg(array('type'=>$k,'page'=>0));
                        $selected = (Input::get('type') == $k)?'selected':'';
                    ?>
                    <option value="{{ $url }}" {{ $selected }} >{{$t}}</option>
                @endforeach

            </select>

            <span class="white-text sel-label">Sort by</span>
            <select class="span1" id="sorter" name="type" style="width:75px;">
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

        <div class="span3 form-inline" style="width:205px">
            <input type="hidden" name="sfull" id="sfull" value="{{ URL::full() }}" />
            <input type="hidden" name="scurr" id="scurr" value="{{ URL::current() }}" />
            <input type="hidden" name="sreq" id="sreq" value="{{ $current_request }}" />
            <input name="s" id="search" placeholder="search" value="{{ Input::get('s')}}" style="width:105px" />
            <button type="submit" class="btn" id="do-search"><i class="icon-search"></i></button>
            <span id="advanced-link" >advanced</span>
        </div>

        <div class="pagination pagination-centered span4" style="color:#fff;width:320px;text-align:center">
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


        <div class="span2 pull-right white-text" style="width:75px;" >
            {{ ($current * $perpage) + 1 }} to {{ ( $current * $perpage ) + $currentcount }} of {{$total}}
            {{-- total (Filtered from {{$alltotal}} entries) --}}
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
            Items {{ ($current * $perpage) + 1 }} to {{ ( $current * $perpage ) + $currentcount }} of {{$total}}
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

<div id="searchModal" class="modal hide fade" style="width:500px;margin-left:-125px;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Advanced Search</h3>
  </div>
  <div class="modal-body">
        <?php Former::framework('TwitterBootstrap')?>
        {{Former::open_horizontal('login','POST',array('class'=>''))}}
            {{ Former::text('searchword','Keyword')->value(Input::get('s')) }}

            <?php
                $price_sign = array(
                        ''=>'All',
                        '$eq'=>'=',
                        '$gt'=>'>',
                        '$gte'=>'>=',
                        '$lt'=>'<',
                        '$lte'=>'<=',
                        );
                $bool = array(
                        ''=>'none',
                        'OR'=>'OR',
                        'AND'=>'AND'
                    );
                $scope = array(
                        ''=>'All Field',
                        'city'=>'City',
                        'state'=>'State',
                        'propertyId'=>'Property ID'
                    );
            ?>
            <div class="row-fluid form-horizontal">
                {{ Former::select('searchscope', 'Scope')->options($scope)->class('span6') }}
            </div>
            <div class="row-fluid form-horizontal">
                <div class="span4">
                    {{ Former::select('price_sign', 'Filter by Price')->options($price_sign, Input::get('ps1'))->class('span12') }}
                </div>
                <div class="span8 no-label">
                    {{ Former::text('filter_price','')->class('span6')->value(Input::get('p1')) }}
                </div>
            </div>

            {{ Former::select('price_rel', '')->options($bool, Input::get('pr'))->class('span2')->help('relationship between two price conditions (optional)') }}

            <div class="row-fluid form-horizontal">
                <div class="span4">
                    {{ Former::select('price_sign2', '')->options($price_sign, Input::get('ps2'))->class('span12') }}
                </div>
                <div class="span8 no-label">
                    {{ Former::text('filter_price2','')->value(Input::get('p2'))->class('span6')->help('second price condition (optional)') }}
                </div>
            </div>

            {{ Former::button('Search')->id('do_advanced_search')->class('btn btn-primary pull-right') }}

        {{ Former::close() }}
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