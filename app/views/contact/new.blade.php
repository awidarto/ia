@extends('layout.front')


@section('content')

<h2>{{$title}}</h2>

{{Former::open_vertical_for_files($submit,'POST',array('class'=>''))}}

<?php
/*
'accountnumber' => '3461783111',
'activeCart' => '5260f68b8dfa19da49000000',
'address_1' => 'jl cibaduyut lama komplek sauyunan mas 1 no 19',
'address_2' => '',
'agreetnc' => 'Yes',
'bankname' => 'bca',
'branch' => 'bandung',
'city' => 'bandung',
'country' => 'Indonesia',
'createdDate' => new MongoDate(1382086083, 795000),
'email' => 'emptyshalu@gmail.com',
'firstname' => 'shalu',
'fullname' => 'shalu hz',
'lastUpdate' => new MongoDate(1382086083, 795000),
'lastname' => 'shalu',
'mobile' => '0818229096',
'pass' => '$2a$08$9XwvZZVLsHSzu4MIX1ro3.X3cdhK0btglG7qqLGPgOA6/yYz5a51C',
'role' => 'shopper',
'salutation' => 'Ms',
'saveinfo' => 'No',
'shippingphone' => '02285447649',
'shopperseq' => '0000000019',
'zip' => '40235',
*/

?>

<div class="row-fluid">
    <div class="col-lg-6">

        {{ Former::text('firstname','First Name') }}
        {{ Former::text('lastname','Last Name') }}

        {{ Former::text('email','Email')}}

        {{ Former::select('countryOfOrigin')->options(Config::get('country.countries'))->label('Country of Origin') }}


        {{ Former::textarea('message','Your Message')->class('editor') }}
        <p style="text-align:right">
            {{ Form::submit('Send',array('class'=>'btn primary'))}}&nbsp;&nbsp;
            {{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
        </p>
    </div>
</div>

{{Former::close()}}


<style type="text/css">
#lyric{
    min-height: 350px;
    height: 400px;
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


    $('#songTitle').keyup(function(){
        var title = $('#songTitle').val();
        var slug = string_to_slug(title);
        $('#permalink').val(slug);
    });

    //$('#color_input').colorPicker();

});

</script>

@stop