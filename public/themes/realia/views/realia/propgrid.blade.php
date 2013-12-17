<div class="properties-grid">
    <div class="row">

<?php
    $properties = Property::orderBy('createdDate','desc')->take(9)->get()->toArray();
?>


        @foreach($properties as $p)

            <div class="property span3">
                <div class="image">
                    <div class="content">
                        <a href="{{ URL::to('property/detail/'.$p['_id'] )}}"></a>
                        <img src="{{ $p['defaultpictures']['medium_url'] }}" alt="">
                    </div><!-- /.content -->

                </div><!-- /.image -->

                <div class="title">
                    <h2><a href="detail.html">{{ $p['number'].' '.$p['address'] }}</a></h2>
                </div><!-- /.title -->

                <div class="location">{{ $p['city'] }} {{ $p['state'] }}</div><!-- /.location -->

                <div class="price">$ {{ $p['listingPrice'] }}</div><!-- /.price -->

                <div class="area">
                    <span class="key">Lot Size:</span><!-- /.key -->
                    <span class="value">{{ $p['lotSize'] }}</span><!-- /.value -->
                </div><!-- /.area -->
                <div class="area">
                    <span class="key">Monthly Rent:</span><!-- /.key -->
                    <span class="value">$ {{ $p['monthlyRental'] }}</span><!-- /.value -->
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
