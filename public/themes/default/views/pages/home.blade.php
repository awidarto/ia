@extends('layout.front')

@section('content')

<style type="text/css">

</style>
<div id="content-block">
    <div id="content-container" style="margin-bottom: 6px;background-color:transparent;" >
                <ul class="bxslider">
                  @foreach($slides as $slide)
                    @if($slide->slidetype == 'imageonly')
                      <li><img src="{{ URL::to( $slide->defaultpictures['full_url'] )}}" /></li>
                    @elseif($slide->slidetype == 'videoonly' )

                      <li>
                        <div style="width:979px;height:373px;min-width:979px;min-height:373px;">
                          <object width="970" height="370"><param value="http://www.youtube.com/v/{{$slide->youtubeUrl}}&showsearch=0&rel=0&fs=1&autoplay=0&amp;ap=%2526fmt%3D18" name="movie" /><param value="window" name="wmode" /><param value="true" name="allowFullScreen" /><embed width="970" height="370" wmode="window" allowfullscreen="true" type="application/x-shockwave-flash" src="http://www.youtube.com/v/{{$slide->youtubeUrl}}&showsearch=0&fs=1&rel=0&autoplay=0&amp;ap=%2526fmt%3D18"></embed></object>
                        </div>
                      </li>

                    @elseif($slide->slidetype == 'imagecontent' )
                        <div style="width:979px;height:373px;min-width:979px;min-height:373px;">
                          <div style="width:45%;height:370px;float:left;margin-right:30px;overflow:hidden;">
                            <img src="{{ URL::to( $slide->defaultpictures['full_url'] )}}" />
                          </div>
                          <div style="width:45%;height:370px;float:left;">
                            {{ $slide->content }}
                          </div>
                        </div>
                    @elseif($slide->slidetype == 'videocontent' )
                        <div style="width:979px;height:373px;min-width:979px;min-height:373px;">
                          <div style="width:45%;height:370px;float:left;margin-right:30px;">
                            <object width="480" height="370"><param value="http://www.youtube.com/v/{{$slide->youtubeUrl}}&showsearch=0&rel=0&fs=1&autoplay=0&amp;ap=%2526fmt%3D18" name="movie" /><param value="window" name="wmode" /><param value="true" name="allowFullScreen" /><embed width="480" height="370" wmode="window" allowfullscreen="true" type="application/x-shockwave-flash" src="http://www.youtube.com/v/{{$slide->youtubeUrl}}&showsearch=0&fs=1&rel=0&autoplay=0&amp;ap=%2526fmt%3D18"></embed></object>
                          </div>
                          <div style="width:45%;height:370px;float:left;">
                            {{ $slide->content }}
                          </div>
                        </div>
                    @elseif($slide->slidetype == 'contentonly' )
                      <li>
                        <div style="width:979px;height:373px;min-width:979px;min-height:373px;">
                          {{ $slide->content }}
                        </div>
                      </li>
                    @endif
                  @endforeach
                </ul>
    </div>
</div>



            <!-- if there are login errors, show them here -->

{{ HTML::style('css/jquery.bxslider.css')}}

<style type="text/css">
.bx-wrapper .bx-viewport{
    -webkit-box-shadow: 3px 4px 15px 4px rgba(0,0,0,0.75);
    -moz-box-shadow: 3px 4px 15px 4px rgba(0,0,0,0.75);
    box-shadow: 3px 4px 15px 4px rgba(0,0,0,0.75);
}

</style>

{{ HTML::script('js/jquery.easing.1.3.js') }}
{{ HTML::script('js/jquery.touchSwipe.min.js') }}
{{ HTML::script('js/jquery.bxslider.min.js') }}

<script type="text/javascript">
    $(document).ready(function(){
        $('.bxslider').bxSlider();
    });

</script>



@stop