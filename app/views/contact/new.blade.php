@extends('realia.layout')


@section('content')

<div class="container">
    <div id="main">

        <div class="row">
            <div class="span9">

                <h1 class="page-header">{{ $title }}</h1>

                {{Former::open_vertical_for_files($submit,'POST',array('class'=>''))}}

                {{ Former::text('firstname','First Name') }}
                {{ Former::text('lastname','Last Name') }}

                {{ Former::text('email','Email')}}

                {{ Former::select('countryOfOrigin')->options(Config::get('country.countries'))->label('Country of Origin') }}


                {{ Former::textarea('message','Your Message')->class('editor') }}

                <p style="text-align:right">
                    {{ Form::submit('Send',array('class'=>'btn btn-primary arrow-right'))}}&nbsp;&nbsp;
                    {{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
                </p>


                {{Former::close()}}

            </div>
            <div class="sidebar span3">

                @include('realia.latest')


            </div>
        </div>

        @include('realia.carousel')
    <!--insert carousel-->
    <!--insert features-->
    </div>
</div>




<style type="text/css">
#lyric{
    min-height: 350px;
    height: 400px;
}

input, textarea, .uneditable-input {
    width: 350px;
}

textarea{
    height: 300px;
}

#message{
    width: 100%;
    margin-bottom:8px;
}

</style>

<script type="text/javascript">

$(document).ready(function() {
    /*
    $('select').select2({
      width : 'resolve'
    });
    var editor = new wysihtml5.Editor("lyric", { // id of textarea element
      toolbar:      "wysihtml5-toolbar", // id of toolbar element
      parserRules:  wysihtml5ParserRules // defined in parser rules set
    });
    */

    var url = '{{ URL::to('upload') }}';

    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                var thumb = '<li><img src="' + file.thumbnail_url + '" /><br /><input type="radio" name="defaultpic" value="' + file.name + '"> Default<br /><span class="img-title">' + file.name + '</span>' +
                '<label for="colour">Colour</label><input type="text" name="colour[]" />' +
                '<label for="material">Material & Finish</label><input type="text" name="material[]" />' +
                '<label for="tags">Tags</label><input type="text" name="tag[]" />' +
                '</li>';
                $(thumb).appendTo('#files ul');

                var upl = '<input type="hidden" name="delete_type[]" value="' + file.delete_type + '">';
                upl += '<input type="hidden" name="delete_url[]" value="' + file.delete_url + '">';
                upl += '<input type="hidden" name="filename[]" value="' + file.name  + '">';
                upl += '<input type="hidden" name="filesize[]" value="' + file.size  + '">';
                upl += '<input type="hidden" name="temp_dir[]" value="' + file.temp_dir  + '">';
                upl += '<input type="hidden" name="thumbnail_url[]" value="' + file.thumbnail_url + '">';
                upl += '<input type="hidden" name="filetype[]" value="' + file.type + '">';
                upl += '<input type="hidden" name="fileurl[]" value="' + file.url + '">';

                $(upl).appendTo('#uploadedform');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css(
                'width',
                progress + '%'
            );

            /*
            if(progress == 100){
                $('#progress .bar').css('width','0%');
            }
            */
        }
    })
    .prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

});

</script>

@stop