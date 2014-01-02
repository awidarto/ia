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

    public function getListing()
    {

        //count=40&order=asc&page=3&sort=State&type=TRIPLEX

        $page = (Input::get('page') == '')?'0':Input::get('page');
        $perpage = (Input::get('count') == '')?'20':Input::get('count');
        $order = (Input::get('order') == '')?'desc':Input::get('order');
        $sort = (Input::get('sort') == '')?'listingPrice':Input::get('sort');
        $filter = (Input::get('type') == '')?'all':Input::get('type');

        $page = (is_null($page))?0:$page;
        $skip = $page * $perpage;

        $total_all = Property::count();

        if($filter == 'all'){
            $properties = Property::where('propertyStatus','!=','offline')->orderBy($sort,$order)->skip($skip)->take($perpage)->get();
            $total_found = Property::where('propertyStatus','!=','offline')->count();

        }else{
            $properties = Property::where('propertyStatus','!=','offline')
                            ->where('type','=',$filter)
                            ->orderBy($sort,$order)->skip($skip)->take($perpage)->get();
            $total_found = Property::where('propertyStatus','!=','offline')
                            ->where('type','=',$filter)
                            ->count();
        }

        $currentcount = count($properties->toArray());

        $paging = ceil($total_found / $perpage);

        return View::make('pages.listing')
            ->with('properties',$properties)
            ->with('total',$total_found)
            ->with('alltotal',$total_all)
            ->with('current',$page)
            ->with('perpage',$perpage)
            ->with('currentcount',$currentcount)
            ->with('paging',$paging);
    }

    public function getDetail($id = null){

        $page = Property::find($id);

        if($page){
            $page = $page->toArray();
        }else{
            $page = null;
        }

        return View::make('pages.detail')->with('prop',$page);
    }

    public function getBuy($id = null){

        $page = Property::find($id);

        if($page){
            $page = $page->toArray();
        }else{
            $page = null;
        }

        return View::make('pages.buy')->with('prop',$page);
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


            $buyer = array();

            $buyer['agentId']           =        $data['agentId'];
            $buyer['agentName']          =          $data['agentName'];
            $buyer['customerId']        =           $data['customerId'];
            $buyer['salutation']        =           $data['salutation'];
            $buyer['firstname']         =          $data['firstname'];
            $buyer['lastname']          =         $data['lastname'];
            $buyer['email']             =      $data['email'];
            $buyer['address']           =        $data['address'];
            $buyer['company']           =        $data['company'];
            $buyer['phone']             =      $data['phone'];
            $buyer['city']              =     $data['city'];
            $buyer['countryOfOrigin']   =            $data['countryOfOrigin'];
            $buyer['state']             =      $data['state'];
            $buyer['zipCode']           =        $data['zipCode'];
            $buyer['createdDate']       =            new MongoDate();
            $buyer['lastUpdate']        =           new MongoDate();

            $buyermodel = new Buyer();

            $buyermodel->insert($buyer);

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