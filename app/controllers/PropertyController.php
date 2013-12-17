<?php

class PropertyController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function __construct()
    {
        Former::framework('TwitterBootstrap');

        $this->beforeFilter('auth', array('on'=>'get' ));
    }

    public function getIndex()
    {
        $pages = Property::get();
        return View::make('realia.listing')->with('pages',$pages);
    }

    public function getCat($slug = null)
    {

        if(is_null($slug)){

            $pages = Page::get()->toArray();

        }else{

            $slug = ucfirst($slug);

            $pages = Page::where('category','=',$slug)->get()->toArray();
        }

        return View::make('pages.pagelist')->with('pages',$pages);
    }

    public function getListing($page = null, $orderby = 'createdDate',$order = 'desc')
    {

        $page = (is_null($page))?0:$page;
        $perpage = 15;
        $skip = $page * $perpage;

        $total = Property::count();

        $paging = ceil($total / $perpage);

        $properties = Property::where('propertyStatus','!=','offline')->skip($skip)->take($perpage)->get();

        return View::make('realia.listing')
            ->with('properties',$properties)
            ->with('current',$page)
            ->with('paging',$paging);
    }

    public function getDetail($id = null){

        $page = Property::find($id);

        if($page){
            $page = $page->toArray();
        }else{
            $page = null;
        }

        return View::make('realia.detail')->with('prop',$page);
    }

    public function getBuy($id = null){

        $page = Property::find($id);

        if($page){
            $page = $page->toArray();
        }else{
            $page = null;
        }

        return View::make('realia.buy')->with('prop',$page);
    }

    public function postProcess(){

        $validator = array(

            );

        $data = Input::get();

        $validation = Validator::make($input = $data, $validator);

        if($validation->fails()){

            return Redirect::to('property/buy')->withErrors($validation)->withInput(Input::all());

        }else{

            unset($data['csrf_token']);

            $data['createdDate'] = new MongoDate();
            $data['lastUpdate'] = new MongoDate();


            $model = new Transaction();

            if($obj = $model->insert($data)){
                return Redirect::to('transaction/listing')->with('notify_success','Order saved successfully');
            }else{
                return Redirect::to('transaction/listing')->with('notify_success','Order saving failed');
            }


        }

    }

    public function getView($slug = null){

        $page = Page::where('slug','=',$slug)->first();

        if($page){
            $page = $page->toArray();
        }else{
            $page = null;
        }

        return View::make('pages.pagereader')->with('content',$page);
    }

    public function getTransactions(){

    }

    public function missingMethod($parameter){

    }

}