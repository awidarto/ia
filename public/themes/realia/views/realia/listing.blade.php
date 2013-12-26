@extends('realia.layout')

@section('content')

<div class="container">
    <div id="main">

        <div class="row" id="listing">
            <div class="span9">

               <h1 class="page-header"></h1>

                    <div class="properties-rows">
                        <div class="filter">
                            <form action="{{ URL::full() }}" method="get" class="form-horizontal">


                                <div class="control-group">
                                    <label class="control-label" for="inputSortBy">
                                        Filter by Type
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>
                                    <div class="controls">
                                        <select id="inputFilterBy" name="filter">

                                                <option id="price" value="all">All</option>
                                            @foreach(Config::get('ia.type') as $key=>$val)
                                                <option id="price" value="{{$val}}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->


                                <div class="control-group">
                                    <label class="control-label" for="inputSortBy">
                                        Sort by
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>
                                    <div class="controls">
                                        <select id="inputSortBy" name="sort">
                                            <option value="listingPrice">Price</option>
                                            <option value="state">State</option>
                                            <option value="type">Type</option>
                                        </select>
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="control-group">
                                    <label class="control-label" for="inputOrder">
                                        Order
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>
                                    <div class="controls">
                                        <select id="inputOrder" name="order">
                                            <option value="desc">DESC</option>
                                            <option value="asc">ASC</option>
                                        </select>
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->

                                {{ Former::submit('Submit')->class('btn btn-primary')->style('margin-left: 15px;height: 28px;padding: 2px 8px;') }}


                            </form>
                        </div><!-- /.filter -->
                    </div><!-- /.properties-rows -->

                    <div class="properties-grid">
                        <div class="row">
                            @foreach($properties as $p)

                                <div class="property">
                                    <div class="image">
                                        <div class="content">
                                            <?php
                                                $class = '';
                                                if(isset($p['propertyStatus'])){
                                                    if($p['propertyStatus'] == 'sold'){
                                                        $class = 'sold';
                                                    }else if($p['propertyStatus'] == 'prelisted'){
                                                        $class = 'prelist';
                                                    }
                                                }

                                            ?>
                                            @if(isset($p['propertyStatus']) && $p['propertyStatus'] != 'available')
                                            <div class="propStatus {{ $class }} ">
                                                {{ isset($p['propertyStatus'])?$p['propertyStatus']:'' }}
                                            </div>
                                            @endif

                                            <a href="{{ URL::to('property/detail/'.$p['_id'] )}}"></a>
                                            <img src="{{ isset($p['defaultpictures']['medium_url'])?$p['defaultpictures']['medium_url']:URL::to('defaults/med.png') }}" alt="">


                                        </div><!-- /.content -->

                                    </div><!-- /.image -->

                                    <div class="propertyId">
                                        {{$p['propertyId'] }}
                                    </div>
                                    <div class="title">
                                        <h2><a href="detail.html">{{ $p['number'].' '.$p['address'] }}</a></h2>
                                    </div><!-- /.title -->

                                    <div class="location">{{ $p['city'] }} {{ $p['state'] }}</div><!-- /.location -->

                                    <div class="price">

                                        $ {{ number_format($p['listingPrice'],2,'.',',')  }}</div><!-- /.price -->
                                    <div class="area">
                                        <?php
                                            $roi = ((12*$p['monthlyRental']) - $p['tax'] - $p['insurance'] - ( (12*$p['monthlyRental']) / 10 )) / $p['listingPrice'];
                                        ?>

                                        <span class="key">ROI:</span><!-- /.key -->
                                        <span class="value">{{ number_format($roi*100,2,'.',',')  }}%</span><!-- /.value -->
                                    </div><!-- /.area -->
                                    <div class="clearfix"></div>
                                    <div class="area">
                                        <span class="key">Rental:</span><!-- /.key -->
                                        <span class="value">$ {{ $p['monthlyRental'] }} /month</span><!-- /.value -->
                                    </div><!-- /.area -->
                                    <div class="clearfix"></div>
                                    <div class="area">
                                        <span class="key">Sq. Ft.:</span><!-- /.key -->
                                        <span class="value">{{ $p['lotSize'] }}</span><!-- /.value -->
                                    </div><!-- /.area -->
                                    <div class="bathrooms"><div class="content">{{ $p['bath'] }}</div></div><!-- /.bathrooms -->
                                    <div class="bedrooms"><div class="content">{{ $p['bed'] }}</div></div><!-- /.bedrooms -->

                                </div><!-- /.property -->

                            @endforeach

                            @if( count($properties)%2)
                                <div class="property" style="display:block;background:transparent;border:none;visibility:hidden;">
                                </div>
                            @endif

                        </div><!-- /.row -->
                    </div><!-- /.properties-grid -->
                    <div class="pagination pagination-centered">
                        <ul>
                            <li><a href="{{ URL::to('property/listing') }}">first</a></li>
                            <li><a href="{{ URL::to('property/listing/'.(($current == 0)?$current:$current - 1) ) }}">previous</a></li>
                            @for($p = 0; $p < $paging; $p++)
                                <li {{ ($p == $current)?'class="active"':'' }} ><a href="{{ URL::to('property/listing/'.$p)}}"  >{{$p + 1}}</a></li>
                            @endfor
                            <li><a href="{{ URL::to('property/listing/'.(($current == ($paging - 1))?$current:$current + 1)) }}">next</a></li>
                            <li><a href="{{ URL::to('property/listing/'.($paging - 1) ) }}">last</a></li>
                        </ul>
                    </div><!-- /.pagination -->

            </div>
            <div class="sidebar span3">
                @include('realia.latest')


            </div>
        </div>

    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>


@stop