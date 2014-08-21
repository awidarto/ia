@extends('layout.front')

@section('content')

<?php
    function ap($segment){
        return str_replace( $segment , $segment.'/pdf', URL::full() );
    }

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
    $(document).ready( function(){

        $('#do-search').on('click',function(){
            do_search();
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

            var curr = req.split('&');
            var nreq = [];

            if(req != '' && req.indexOf('s=') >= 0 && curr.length > 0){
                for(i = 0; i < curr.length; i++){
                    t = curr[i];
                    if(t.indexOf('s=') >= 0 ){
                        nreq.push('s=' + term);
                    }else{
                        nreq.push(t);
                    }
                }
            }else{
                nreq.push('s=' + term);
            }

            var creq = nreq.join('&');

            var nexturl = '{{ URL::to( 'faq' )}}?' + creq;

            window.location = nexturl;
        }

    });
</script>
    <style type="text/css">
        h4{
            color:#FF0000;
        }

        .faq-body{
            margin-bottom: 20px;
        }
    </style>


<div id="content-block">
    <div id="content-container" class="shadows" style="margin-bottom: 6px;" >


        <div class="row">
            <div >
                <div class="row" style="margin:0px;padding:0px;">
                    <h1 class="page-header">Frequently Asked Questions</h1>
                </div>
                <a href="{{ ap('faq') }}" class="receipt pull-right" target="new" style="position:absolute;top:3px;right:10px;" ><img src="{{ URL::to('/')}}/images/print.png" /></a>

                <div class="row" style="margin:0px;padding:0px;margin-left:8px;margin-right:10px;">
                    <div class="span12 lionbars" style="overflow-y:auto;height:340px;width:100%;margin:0px;margin-right:4px;">

                        {{-- print_r($faqs); die();--}}
                        {{-- @foreach($faqs as $f)--}}
                            {{--
                            <h3 id="{{ $fc }}">{{ ucwords($fc) }}</h3>
                            --}}
                                <ul style="margin-right:0px;margin-right:20px;">
                                    @foreach($faqs as $faq)
                                        <h4>Q. {{ $faq['title']}}</h4>
                                        <div class="faq-body" >
                                            {{ $faq['body']}}
                                        </div>
                                    @endforeach
                                </ul>
                        {{--@endforeach--}}
                    </div>
                </div>

            </div>
        </div>



    </div> <!-- end container -->

<!-- bottom filter -->

    <div class="subnav row" id="filter-bar" style="background-color: transparent;padding:0px;padding-left:22px;margin:0px;">

        <div class="span3 form-inline" style="width:205px">
            <input type="hidden" name="sfull" id="sfull" value="{{ URL::full() }}" />
            <input type="hidden" name="scurr" id="scurr" value="{{ URL::current() }}" />
            <input type="hidden" name="sreq" id="sreq" value="{{ str_replace(array(URL::current(),'?'), '', URL::full()) }}" />
            <input name="s" id="search" placeholder="search" value="{{ Input::get('s')}}" style="width:105px" />
            <button type="submit" class="btn" id="do-search"><i class="icon-search"></i></button>
        </div>


    </div>

<!-- end bottom filter -->


</div>

@stop