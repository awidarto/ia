@extends('realia.layout')

@section('content')

<style type="text/css">

.properties-grid .property .price{
    position: initial;
}

.propertyId{
    padding: 8px 15px 0px 15px;
    font-weight: bold;
}

.properties-grid .property h2{
    margin-top: 0px;
}

.properties-grid .property .propStatus{
    font-size: 18px;
    padding: 5px 16px;
    position: absolute;
    right: 0px;
    bottom: 15px;
}

.prelist {
    background-color: orange;
}

.sold {
    background-color: red;
    text-transform: uppercase;
    font-weight: bold;
    color: #fff;
}

</style>

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">

               <h1 class="page-header">Properties</h1>

                    <div class="properties-rows">
                        <div class="filter">
                            <form action="http://html.realia.byaviators.com/listing-grid-filter.html?" method="get" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label" for="inputSortBy">
                                        Sort by
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>
                                    <div class="controls">
                                        <select id="inputSortBy">
                                            <option id="price">Price</option>
                                            <option id="published">Published</option>
                                        </select>
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="control-group">
                                    <label class="control-label" for="inputOrder">
                                        Order
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>
                                    <div class="controls">
                                        <select id="inputOrder">
                                            <option id="asc">ASC</option>
                                            <option id="desc">DESC</option>
                                        </select>
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->
                            </form>
                        </div><!-- /.filter -->
                    </div><!-- /.properties-rows -->

                    <div class="properties-grid">
                        <div class="row">
                            @foreach($properties as $p)

                                <div class="property span3">
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
                                            <img src="{{ $p['defaultpictures']['medium_url'] }}" alt="">


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
                                        <span class="key">Price:</span><!-- /.key -->

                                        $ {{ $p['listingPrice'] }}</div><!-- /.price -->
                                    <div class="area">
                                        <?php
                                            $roi = ((12*$p['monthlyRental']) - $p['tax'] - $p['insurance'] - ( (12*$p['monthlyRental']) / 10 )) / $p['listingPrice'];
                                        ?>

                                        <span class="key">ROI:</span><!-- /.key -->
                                        <span class="value">{{ $roi*100 }}%</span><!-- /.value -->
                                    </div><!-- /.area -->
                                    <div class="clearfix"></div>
                                    <div class="area">
                                        <span class="key">Sq. Ft.:</span><!-- /.key -->
                                        <span class="value">{{ $p['lotSize'] }}</span><!-- /.value -->
                                    </div><!-- /.area -->
                                    <div class="bathrooms"><div class="content">{{ $p['bath'] }}</div></div><!-- /.bathrooms -->
                                    <div class="bedrooms"><div class="content">{{ $p['bed'] }}</div></div><!-- /.bedrooms -->
                                    <div class="area">
                                        <span class="key">Monthly Rental:</span><!-- /.key -->
                                        <span class="value">$ {{ $p['monthlyRental'] }} /month</span><!-- /.value -->
                                    </div><!-- /.area -->

                                </div><!-- /.property -->

                            @endforeach

                            @if( count($properties)%2)
                                <div class="property span3" style="display:block;background:transparent;border:none;visibility:hidden;">
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