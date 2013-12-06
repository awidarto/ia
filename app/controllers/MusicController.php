<?php

class MusicController extends AdminController {

    public function __construct()
    {
        parent::__construct();

        $this->controller_name = str_replace('Controller', '', get_class());

        //$this->crumb = new Breadcrumb();
        $this->crumb->append('Home','left',true);
        $this->crumb->append(strtolower($this->controller_name));

        $this->model = new Music();

    }


    public function getIndex()
    {

        $this->heads = array(
            array('Song Title',array('search'=>true,'sort'=>true)),
            array('Artist',array('search'=>true,'sort'=>true)),
            array('Albums',array('search'=>true,'sort'=>true)),
            array('Genre',array('search'=>true,'sort'=>true)),
            array('Tags',array('search'=>true,'sort'=>true)),
            array('Last Update',array('search'=>true,'sort'=>true,'date'=>true)),
        );

        $this->title = 'Music';

        return parent::getIndex();

    }

    public function postIndex()
    {

        $this->fields = array(
            array('songTitle',array('kind'=>'text','query'=>'like','pos'=>'both','callback'=>'pics','show'=>true)),
            array('artist',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('album',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'attr'=>array('class'=>'expander'))),
            array('genre',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('tags',array('kind'=>'text','query'=>'like','pos'=>'both','callback'=>'splitTag','show'=>true)),
            array('lastUpdate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
        );

        $this->query = array('ownerId'=>Auth::user()->_id);
        return parent::postIndex();
    }

    public function postAdd($data = null)
    {

        $this->validator = array(
            'songTitle' => 'required',
            'slug'=> 'required'
        );

        return parent::postAdd($data);
    }

    public function postEdit($id,$data = null)
    {
        $this->validator = array(
            'songTitle' => 'required',
            'slug'=> 'required'
        );

        return parent::postEdit($id,$data);
    }

    public function beforeSave($data){
        $data['ownerId'] = Auth::user()->_id;
        $data['ownerName'] = Auth::user()->firstname.' '.Auth::user()->lastname;
        return $data;
    }

    public function beforeUpdate($id,$data){
        $data['ownerId'] = Auth::user()->_id;
        $data['ownerName'] = Auth::user()->firstname.' '.Auth::user()->lastname;
        return $data;
    }

    public function afterSave($data){

        $artist = Artist::where('artistName','=',$data['artist'])
            ->where('ownerId','=',$data['ownerId'])
            ->first();

        if($artist == null){
            $artist = new Artist();
        }

        $artist->artistName = $data['artist'];
        $artist->ownerId = Auth::user()->_id;
        $artist->ownerName = Auth::user()->firstname.' '.Auth::user()->lastname;

        $artist->save();

        //save album

        $album = Album::where('albumName','=',$data['album'])
            ->where('ownerId','=',$data['ownerId'])
            ->first();

        if($album == null){
            $album = new Album();
        }

        $album->albumName = $data['album'];
        $album->artistName = $data['artist'];
        $album->ownerId = Auth::user()->_id;
        $album->ownerName = Auth::user()->firstname.' '.Auth::user()->lastname;

        $album->save();


        return $data;
    }

    public function afterUpdate($id,$data = null){

        $artist = Artist::where('artistName','=',$data['artist'])->where('ownerId','=',Auth::user()->_id)->first();

        if($artist == null){
            $artist = new Artist();
        }

        $artist->artistName = $data['artist'];
        $artist->ownerId = Auth::user()->_id;
        $artist->ownerName = Auth::user()->firstname.' '.Auth::user()->lastname;

        $artist->save();

        //save album

        $album = Album::where('albumName','=',$data['album'])
            ->where('ownerId','=',$data['ownerId'])
            ->first();

        if($album == null){
            $album = new Album();
        }

        $album->albumName = $data['album'];
        $album->artistName = $data['artist'];
        $album->ownerId = Auth::user()->_id;
        $album->ownerName = Auth::user()->firstname.' '.Auth::user()->lastname;

        $album->save();



        return $id;
    }

    public function makeActions($data)
    {
        $delete = '<span class="del" id="'.$data['_id'].'" ><i class="icon-trash"></i>Delete</span>';
        $edit = '<a href="'.URL::to('music/edit/'.$data['_id']).'"><i class="icon-edit"></i>Update</a>';

        $actions = $edit.'<br />'.$delete;
        return $actions;
    }

    public function namePic($data)
    {
        $name = HTML::link('products/view/'.$data['_id'],$data['productName']);
        if(isset($data['thumbnail_url']) && count($data['thumbnail_url'])){
            $display = HTML::image($data['thumbnail_url'][0].'?'.time(), $data['filename'][0], array('id' => $data['_id']));
            return $display.'<br />'.$name;
        }else{
            return $name;
        }
    }

    public function pics($data)
    {
        $name = HTML::link('products/view/'.$data['_id'],$data['productName']);
        if(isset($data['thumbnail_url']) && count($data['thumbnail_url'])){
            $display = HTML::image($data['thumbnail_url'][0].'?'.time(), $data['filename'][0], array('style'=>'min-width:100px;','id' => $data['_id']));
            return $data['songTitle'].'<br />'.$display;
        }else{
            return $name;
        }
    }

    public function splitTag($data){
        $tags = explode(',',$data['tags']);
        if(is_array($tags) && count($tags) > 0 && $data['tags'] != ''){
            $ts = array();
            foreach($tags as $t){
                $ts[] = '<span class="tag">'.$t.'</span>';
            }

            return implode('', $ts);
        }else{
            return $data['tags'];
        }
    }

    public function getViewpics($id)
    {

    }


}
