

                </div>
                {{--

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
