<?php

class PropertyController extends TableController {

    public function __construct()
    {
        parent::__construct();

        $this->controller_name = str_replace('Controller', '', get_class());

        //$this->crumb = new Breadcrumb();
        $this->crumb->append('Home','left',true);
        $this->crumb->append(strtolower($this->controller_name));

        $this->model = new Property();
        //$this->model = DB::collection('documents');

    }

    public function getTest()
    {
        $raw = $this->model->where('docFormat','like','picture')->get();

        print $raw->toJSON();
    }


    public function getIndex()
    {

        $this->heads = array(
            array('Photos',array('search'=>false,'sort'=>false)),
            array('Address',array('search'=>true,'sort'=>true)),
            array('Number',array('search'=>true,'sort'=>true)),
            array('City',array('search'=>true,'sort'=>true)),
            array('ZIP',array('search'=>true,'sort'=>true)),
            array('State',array('search'=>true,'sort'=>true)),
            /*
            array('Bed',array('search'=>true,'sort'=>false)),
            array('Bath',array('search'=>true,'sort'=>true)),
            array('Pool',array('search'=>true,'sort'=>true)),
            array('Garage',array('search'=>true,'sort'=>true)),
            array('Basement',array('search'=>true,'sort'=>true)),
            array('Category',array('search'=>true,'sort'=>true)),
            array('Created',array('search'=>true,'sort'=>true,'date'=>true)),
            array('Last Update',array('search'=>true,'sort'=>true,'date'=>true)),
            */
        );

        //print $this->model->where('docFormat','picture')->get()->toJSON();

        $this->title = 'Properties';

        return parent::getIndex();

    }

    public function postIndex()
    {

        $this->fields = array(
            array('number',array('kind'=>'text','query'=>'like','pos'=>'both','callback'=>'namePic','show'=>true)),
            array('address',array('kind'=>'text','query'=>'like','pos'=>'both','callback'=>'fullInfo','attr'=>array('class'=>'expander'),'show'=>true)),
            array('number',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('city',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('zipCode',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('state',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            /*
            array('bed',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('bath',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('pool',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('garage',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('basement',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('category',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
            array('createdDate',array('kind'=>'datetime','query'=>'like','pos'=>'both','show'=>true)),
            array('lastUpdate',array('kind'=>'datetime','query'=>'like','pos'=>'both','show'=>true)),
            */
        );

        return parent::postIndex();
    }

    public function postAdd($data = null)
    {

        $this->validator = array(
            'number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zipCode' => 'required',
            'type' => 'required',
            'yearBuilt' => 'required',
            'FMV' => 'required',
            'listingPrice' => 'required'
        );

        return parent::postAdd($data);
    }

    public function postEdit($id,$data = null)
    {
        $this->validator = array(
            'number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zipCode' => 'required',
            'type' => 'required',
            'yearBuilt' => 'required',
            'FMV' => 'required',
            'listingPrice' => 'required'
        );

        return parent::postEdit($id,$data);
    }

    public function makeActions($data)
    {
        $delete = '<span class="del" id="'.$data['_id'].'" ><i class="icon-trash"></i>Delete</span>';
        $edit = '<a href="'.URL::to('property/edit/'.$data['_id']).'"><i class="icon-edit"></i>Update</a>';

        $actions = $edit.'<br />'.$delete;
        return $actions;
    }

    public function fullInfo($data){
        $info = $data['number'].' '.$data['address'].'<br />'.$data['city'].','.$data['zipCode'].'<br />'.$data['state'];
        return $info;
    }

    public function splitTag($data){
        $tags = explode(',',$data['docTag']);
        if(is_array($tags) && count($tags) > 0 && $data['docTag'] != ''){
            $ts = array();
            foreach($tags as $t){
                $ts[] = '<span class="tag">'.$t.'</span>';
            }

            return implode('', $ts);
        }else{
            return $data['docTag'];
        }
    }

    public function splitShare($data){
        $tags = explode(',',$data['docShare']);
        if(is_array($tags) && count($tags) > 0 && $data['docShare'] != ''){
            $ts = array();
            foreach($tags as $t){
                $ts[] = '<span class="tag">'.$t.'</span>';
            }

            return implode('', $ts);
        }else{
            return $data['docShare'];
        }
    }

    public function namePic($data)
    {
        $name = HTML::link('property/view/'.$data['_id'],$data['address']);

        $thumbnail_url = '';

        if(isset($data['thumbnail_url']) && count($data['thumbnail_url'])){
            $glinks = '';
            for($i = 0 ; $i < count($data['thumbnail_url']);$i++ ){
                if($data['defaultpic'] == $data['file_id'][$i]){
                    $thumbnail_url = $data['thumbnail_url'][$i];
                }
                $glinks .= '<input type="hidden" class="g_'.$data['_id'].'" data-caption="'.$data['caption'][$i].'" value="'.$data['fileurl'][$i].'" >';
            }

            $display = HTML::image($thumbnail_url.'?'.time(), $thumbnail_url, array('class'=>'thumbnail img-polaroid','id' => $data['_id'])).$glinks;
            return $display;
        }else{
            return $name;
        }
    }

    public function pics($data)
    {
        $name = HTML::link('products/view/'.$data['_id'],$data['productName']);
        if(isset($data['thumbnail_url']) && count($data['thumbnail_url'])){
            $display = HTML::image($data['thumbnail_url'][0].'?'.time(), $data['filename'][0], array('style'=>'min-width:100px;','id' => $data['_id']));
            return $display.'<br /><span class="img-more" id="'.$data['_id'].'">more images</span>';
        }else{
            return $name;
        }
    }

    public function getViewpics($id)
    {

    }


}
