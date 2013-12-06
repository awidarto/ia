@extends('layout.front')

@section('content')
<h3>Contact Us</h3>
{{Former::open_vertical_for_files($submit,'POST',array('class'=>''))}}

<div class="row-fluid">
    <div class="col-lg-6">

        {{ Former::text('firstName','First Name') }}
        {{ Former::text('artist','Artist') }}
        {{ Former::text('album','Album') }}
        {{ Former::select('countryOfOrigin')->options(Config::get('country.countries'))->label('Country of Origin') }}
        {{ Former::text('slug','Permalink')->id('permalink') }}

        {{ Former::text('price','Price (IDR)') }}
        {{ Former::text('tags','Tags')->class('tag_keyword') }}

        <div class="control-group">
            <label class="control-label" for="userfile">Upload Images</label>
            <div class="controls">
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload" type="file" name="files[]" multiple>
                </span>
                <br />
                <br />
                <div id="progress" class="progress progress-success progress-striped">
                    <div class="bar"></div>
                </div>
                <br />
                <div id="files" class="files">
                    <ul>
                        <?php
                            $allin = Input::old();
                            $showold = false;

                            if( count($allin) > 0){
                                $showold = true;
                            }

                            if($showold && isset( $allin['thumbnail_url'])){

                                $filename = $allin['filename'];
                                $thumbnail_url = $allin['thumbnail_url'];

                                $thumb = '<li><img src="%s"><br /><input type="radio" name="defaultpic" value="%s" %s > Default<br />';
                                $thumb .= '<span class="img-title">%s</span>';
                                $thumb .= '<label for="colour">Colour</label><input type="text" name="colour[]" value="%s"  />';
                                $thumb .= '<label for="material">Material & Finish</label><input type="text" name="material[]" value="%s"  />';
                                $thumb .= '<label for="tags">Tags</label><input type="text" name="tag[]" value="%s"  /></li>';

                                for($t = 0; $t < count($filename);$t++){
                                    if($allin['defaultpic'] == $filename[$t]){
                                        $isdef = 'checked="checked"';
                                    }else{
                                        $isdef = ' ';
                                    }

                                    printf($thumb,$thumbnail_url[$t],
                                        $filename[$t],
                                        $isdef,
                                        $filename[$t],
                                        $allin['colour'][$t],$allin['material'][$t],$allin['tag'][$t]);
                                }

                            }
                        ?>
                    </ul>
                </div>
                <div id="uploadedform">
                    <?php

                        if($showold && isset( $allin['filename'] )){

                            $count = 0;
                            $upcount = count($allin['filename']);

                            $upl = '';
                            for($u = 0; $u < $upcount; $u++){
                                $upl .= '<input type="hidden" name="delete_type[]" value="' . $allin['delete_type'][$u] . '">';
                                $upl .= '<input type="hidden" name="delete_url[]" value="' . $allin['delete_url'][$u] . '">';
                                $upl .= '<input type="hidden" name="filename[]" value="' . $allin['filename'][$u]  . '">';
                                $upl .= '<input type="hidden" name="filesize[]" value="' . $allin['filesize'][$u]  . '">';
                                $upl .= '<input type="hidden" name="temp_dir[]" value="' . $allin['temp_dir'][$u]  . '">';
                                $upl .= '<input type="hidden" name="thumbnail_url[]" value="' . $allin['thumbnail_url'][$u] . '">';
                                $upl .= '<input type="hidden" name="filetype[]" value="' . $allin['filetype'][$u] . '">';
                                $upl .= '<input type="hidden" name="fileurl[]" value="' . $allin['fileurl'][$u] . '">';
                            }

                            print $upl;
                        }

                    ?>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6">
        @include('partials.editortoolbar')
        {{ Former::textarea('lyric','Lyric') }}
        <p style="text-align:right">
            {{ Form::submit('Save',array('class'=>'btn primary'))}}&nbsp;&nbsp;
            {{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
        </p>
    </div>
</div>

{{Former::close()}}

@stop