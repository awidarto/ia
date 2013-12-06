<h1 class="page-header">Featured properties</h1>

<?php
    $properties = Property::get()->toArray();
?>


<div class="properties-grid">
    <div class="row">

        @foreach($properties as $p)

            <div class="property span3">
                <div class="image">
                    <div class="content">
                        <a href="{{ URL::to('property/detail/'.$p['id'] )}}"></a>
                        <img src="{{ $p['defaultpictures']['medium_url'] }}" alt="">
                    </div><!-- /.content -->

                    <div class="price">{{ $p['listingPrice'] }}</div><!-- /.price -->
                </div><!-- /.image -->

                <div class="title">
                    <h2><a href="detail.html">{{ $p['address'] }}</a></h2>
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


    </div><!-- /.row -->
</div><!-- /.properties-grid -->
