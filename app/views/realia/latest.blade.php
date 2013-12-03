<div class="hidden-tablet">
    <div class="widget properties last">
        <div class="title">
            <h2>Latest Properties</h2>
        </div><!-- /.title -->

        <?php
            $properties = Property::orderBy('createdDate','desc')->take(5)->get()->toArray();

        ?>

        <div class="content">
            @foreach($properties as $p)
                <div class="property">
                    <div class="image">
                        <a href="detail.html"></a>
                        <img src="{{ $p['defaultpictures']['thumbnail_url'] }}" alt="">
                    </div><!-- /.image -->

                    <div class="wrapper">
                        <div class="title">
                            <h3>
                                <a href="detail.html">{{ $p['address'] }}</a>
                            </h3>
                        </div><!-- /.title -->
                        <div class="location">{{ $p['city'] }} {{ $p['state'] }}</div><!-- /.location -->
                        <div class="price">{{ $p['listingPrice'] }}</div><!-- /.price -->
                    </div><!-- /.wrapper -->
                </div><!-- /.property -->

            @endforeach

        </div><!-- /.content -->
    </div><!-- /.properties -->
</div>
