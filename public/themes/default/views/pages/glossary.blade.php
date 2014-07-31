@extends('layout.front')

@section('content')

<?php
    function ap($segment){
        return str_replace( $segment , $segment.'/print', URL::full() );
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

            var nexturl = '{{ URL::to( 'glossary' )}}?' + creq;

            window.location = nexturl;
        }

    });
</script>
<style type="text/css">
    ul#alpha-nav li a{
        color: #000;
    }

    #main-content h1 {
        margin-top: 8px;
        margin-bottom: 0px;
        padding-left: 10px;
        border: none;
    }
</style>
<div id="content-block">
    <div id="content-container" class="shadow" style="margin-bottom: 6px;" >

        <div class="row">
            <div class="">
                <div class="row" style="margin:0px;padding:0px;border-bottom:thin solid #eee">
                    <div class="span5" >
                        @if(is_null($faqs))
                            <h1 class="page-header">No Glossary Entry</h1>
                        @else
                            <h1 class="page-header">Glossary</h1>
                        @endif
                    </div>
                    <div class="span4 form-inline pull-right" >
                        <input type="hidden" name="sfull" id="sfull" value="{{ URL::full() }}" />
                        <input type="hidden" name="scurr" id="scurr" value="{{ URL::current() }}" />
                        <input type="hidden" name="sreq" id="sreq" value="{{ str_replace(array(URL::current(),'?'), '', URL::full()) }}" />
                        <input name="s" id="search" placeholder="search" value="{{ Input::get('s')}}" style="width:175px" />
                        <button type="submit" class="btn" id="do-search"><i class="icon-search"></i></button>
                    </div>

                    <div class="span1 pull-right">
                        <a href="{{ ap('glossary') }}" class="receipt" target="new" style="position:absolute;top:3px;right:10px;" ><img src="{{ URL::to('/')}}/images/print.png" /></a>
                    </div>

                </div>

                <div class="row" style="margin:0px;padding:0px;padding-left:8px;">

                    <div class="subnav row" id="filter-bar" style="background-color: transparent;padding:0px;padding-left:0px;margin:0px;">

                        <div class="pagination pagination-centered" style="text-align:left">
                            <ul id="alpha-nav">
                                <li class="class="{{ ms('c','all' , 0) }}"" >
                                    <a href="{{  mg(array('c'=>'all')) }}" class="prev">
                                        All
                                    </a>
                                </li>
                                @foreach( range('A','Z') as $alpha)
                                <li class="class="{{ ms('c',$alpha , 0) }}"" >
                                    <a href="{{  mg(array('c'=>$alpha)) }}" class="prev">
                                        {{ $alpha }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>


                    <div class="span12 lionbars" name="g_container" style="overflow-y:auto;height:340px;width:100%;margin:0px;margin-right:4px;" data-spy="scroll" data-target=".pagination" >
                                @if(is_null($faqs))

                                @else
                                    <?php $lastcat = ''; $cat_count = 0; ?>

                                        @foreach($faqs as $fc)
                                            @if( isset($fc['category']) && $lastcat != $fc['category'])
                                                @if($cat_count > 0 )
                                                    </div>
                                                @endif
                                                <?php $cat_count++; ?>
                                                <div class="section" id="section-{{ $fc['category']}}">
                                                <h3>{{ $fc['category']}}</h3>
                                            @endif
                                                <h4>{{ $fc['title']}}</h4>
                                                <div>
                                                    {{ $fc['body']}}
                                                </div>

                                            <?php $lastcat = (isset($fc['category']))?$fc['category']:$lastcat;?>
                                        @endforeach
                                            </div>

                                @endif
                    </div>
                </div>

            </div>
        </div>

    </div> <!-- end content-container -->

</div>

@stop