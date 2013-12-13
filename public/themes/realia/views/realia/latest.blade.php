<div class="hidden-tablet">
    <div class="widget properties last">
        <div class="title">
            <h2>New Additions</h2>
        </div><!-- /.title -->

        <?php
            $lasttendays = Carbon::now()->subDays(10);
            $properties = Property::where('publishDate', '>', $lasttendays )->where('publishStatus','published')->orderBy('publishDate','desc')
                //->take(5)
                ->get()->toArray();

        ?>

        <div class="content">
            @foreach($properties as $p)
                <div class="property">
                    <div class="image">
                        <a href="{{ URL::to('property/detail/'.$p['_id'] )}}"></a>
                        <img src="{{ $p['defaultpictures']['thumbnail_url'] }}" alt="">
                    </div><!-- /.image -->

                    <div class="wrapper">
                        <div class="title">
                            <h3>
                                <a href="detail.html">{{ $p['number'].' '.$p['address'] }}</a>
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
