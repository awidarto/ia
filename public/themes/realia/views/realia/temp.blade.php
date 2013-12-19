
                    <div class="overview thumb-grid span5 pull-right">
                            <ul class="thumbnails_grid">
                                @foreach($prop['files'] as $f )
                                    <li>
                                        <a href="{{ $f['large_url'] }}" title="{{$f['caption']}}" data-gallery >
                                            <img src="{{ $f['medium_url'] }}" alt="{{$f['caption']}}">
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                    </div>

                </div>
                {{--
                <div class="property-detail">
                    <h2>Map</h2>

                    {{ Former::hidden('ia-latitude')->value(isset($prop['latitude'])?$prop['latitude']:0)->id('ia-latitude') }}
                    {{ Former::hidden('ia-longitude')->value(isset($prop['longitude'])?$prop['longitude']:0)->id('ia-longitude') }}
                    {{ Former::hidden('ia-zoom')->value(isset($prop['zoom'])?$prop['zoom']:11)->id('ia-zoom') }}

                    <div id="property-map"></div><!-- /#property-map -->
                </div>

                --}}


                <div id="finance-calculator" class="overview span3 pull-left">
                    <h2>Finance Calculator</h2>

                    <h3>Simple Interest Calculator </h3>

                    {{ Former::open_vertical() }}
                        {{ Former::text('balance','Amount')->append('$')->value($prop['listingPrice'])->id('balance')}}
                        {{ Former::text('rate','Rate')->append('%')->value(5)->id('rate')}}
                        {{ Former::text('term','Term')->append('Years')->value(30)->id('term')}}
                        {{ Former::button('Calculate')->class('btn btn-primary pull-right')}}
                    {{ Former::close() }}

                </div>
