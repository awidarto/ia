<div class="content" style="margin-top:10px;">

<?php
    $videos = Video::where('tags','like','%featured%')->take(3)->get()->toArray();
?>

@foreach($videos as $v)

<?php
    $y_id = explode('/',$v['url']);

    $y_id = array_pop($y_id);
?>

<object width="250" height="212"><param value="http://www.youtube.com/v/{{$y_id}}&showsearch=0&rel=0&fs=1&autoplay=0&amp;ap=%2526fmt%3D18" name="movie" /><param value="window" name="wmode" /><param value="true" name="allowFullScreen" /><embed width="250" height="212" wmode="window" allowfullscreen="true" type="application/x-shockwave-flash" src="http://www.youtube.com/v/{{$y_id}}&showsearch=0&fs=1&rel=0&autoplay=0&amp;ap=%2526fmt%3D18"></embed></object><br />

@endforeach
</div>
