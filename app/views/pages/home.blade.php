@extends('realia.layout')

@section('content')
<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">
                <h1 class="page-header">Featured properties</h1>
                <!--insert grid-->
            </div>
            <div class="sidebar span3">
                <div class="widget our-agents">
                    <div class="title">
                        <h2>Our Agents</h2>
                    </div><!-- /.title -->

                    <div class="content">
                        <div class="agent">
                            <div class="image">
                                <img src="{{ URL::to('/') }}/realia/img/photos/emma-small.png" alt="">
                            </div><!-- /.image -->
                            <div class="name">Victoria Summer</div><!-- /.name -->
                            <div class="phone">333-666-777</div><!-- /.phone -->
                            <div class="email"><a href="mailto:victoria@example.com">victoria@example.com</a></div><!-- /.email -->
                        </div><!-- /.agent -->

                        <div class="agent">
                            <div class="image">
                                <img src="{{ URL::to('/') }}/realia/img/photos/john-small.png" alt="">
                            </div><!-- /.image -->
                            <div class="name">John Doe</div><!-- /.name -->
                            <div class="phone">111-222-333</div><!-- /.phone -->
                            <div class="email"><a href="mailto:john.doe@example.com">victoria@example.com</a></div><!-- /.email -->
                        </div><!-- /.agent -->
                    </div><!-- /.content -->
                </div><!-- /.our-agents -->
                <div class="hidden-tablet">
                    <div class="widget properties last">
                        <div class="title">
                            <h2>Latest Properties</h2>
                        </div><!-- /.title -->

                        <div class="content">
                            <div class="property">
                                <div class="image">
                                    <a href="detail.html"></a>
                                    <img src="{{ URL::to('/') }}/realia/img/tmp/property-small-4.png" alt="">
                                </div><!-- /.image -->

                                <div class="wrapper">
                                    <div class="title">
                                        <h3>
                                            <a href="detail.html">27523 Pacific Coast</a>
                                        </h3>
                                    </div><!-- /.title -->
                                    <div class="location">Palo Alto CA</div><!-- /.location -->
                                    <div class="price">€2 300 000</div><!-- /.price -->
                                </div><!-- /.wrapper -->
                            </div><!-- /.property -->

                            <div class="property">
                                <div class="image">
                                    <a href="detail.html"></a>
                                    <img src="{{ URL::to('/') }}/realia/img/tmp/property-small-5.png" alt="">
                                </div><!-- /.image -->

                                <div class="wrapper">
                                    <div class="title">
                                        <h3>
                                            <a href="detail.html">27523 Pacific Coast</a>
                                        </h3>
                                    </div><!-- /.title -->
                                    <div class="location">Palo Alto CA</div><!-- /.location -->
                                    <div class="price">€2 300 000</div><!-- /.price -->
                                </div><!-- /.wrapper -->
                            </div><!-- /.property -->

                            <div class="property">
                                <div class="image">
                                    <a href="detail.html"></a>
                                    <img src="{{ URL::to('/') }}/realia/img/tmp/property-small-6.png" alt="">
                                </div><!-- /.image -->

                                <div class="wrapper">
                                    <div class="title">
                                        <h3>
                                            <a href="detail.html">27523 Pacific Coast</a>
                                        </h3>
                                    </div><!-- /.title -->
                                    <div class="location">Palo Alto CA</div><!-- /.location -->
                                    <div class="price">€2 300 000</div><!-- /.price -->
                                </div><!-- /.wrapper -->
                            </div><!-- /.property -->

                            <div class="property">
                                <div class="image">
                                    <a href="detail.html"></a>
                                    <img src="{{ URL::to('/') }}/realia/img/tmp/property-small-2.png" alt="">
                                </div><!-- /.image -->

                                <div class="wrapper">
                                    <div class="title">
                                        <h3>
                                            <a href="detail.html">27523 Pacific Coast</a>
                                        </h3>
                                    </div><!-- /.title -->
                                    <div class="location">Palo Alto CA</div><!-- /.location -->
                                    <div class="price">€2 300 000</div><!-- /.price -->
                                </div><!-- /.wrapper -->
                            </div><!-- /.property -->
                        </div><!-- /.content -->
                    </div><!-- /.properties -->
                </div>
            </div>
        </div>

        @include('realia.carousel')
    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>

<!--insert bottom features-->

@stop