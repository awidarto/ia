@extends('realia.layout')

@section('content')

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
                                            <a href="{{ URL::to('property/detail/'.$p['_id'] )}}"></a>
                                            <img src="{{ $p['defaultpictures']['medium_url'] }}" alt="">
                                        </div><!-- /.content -->

                                        <div class="price">$ {{ $p['listingPrice'] }}</div><!-- /.price -->
                                    </div><!-- /.image -->

                                    <div class="title">
                                        <h2><a href="detail.html">{{ $p['number'].' '.$p['address'] }}</a></h2>
                                    </div><!-- /.title -->

                                    <div class="location">{{ $p['city'] }} {{ $p['state'] }}</div><!-- /.location -->
                                    <div class="area">
                                        <span class="key">Lot Size:</span><!-- /.key -->
                                        <span class="value">{{ $p['lotSize'] }}</span><!-- /.value -->
                                    </div><!-- /.area -->
                                    <div class="bedrooms"><div class="content">{{ $p['bed'] }}</div></div><!-- /.bedrooms -->
                                    <div class="bathrooms"><div class="content">{{ $p['bath'] }}</div></div><!-- /.bathrooms -->
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
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li class="active"><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">next</a></li>
                            <li><a href="#">last</a></li>
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