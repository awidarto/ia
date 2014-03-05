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

        Logger::access();

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
        $perpage = (Input::get('count') == '')?'8':Input::get('count');
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

        Event::fire('cleanup');

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


        $property = Property::find($id);

        if($property){
            $prop = $property->toArray();

            $trans = Transaction::where('propertyId', '=', $prop['propertyId'])->where('agentId','=',Auth::user()->_id)->first();

            if(isset($trans['propertyId']) && $trans['propertyId'] == $prop['propertyId']){
                return Redirect::to('property/detail/'.$id);
            }else{
                $bought = false;
            }

        }else{
            $prop = null;
        }

        if($prop['propertyStatus'] == 'reserved'){
            if(isset($prop['reservedBy']) && $prop['reservedBy'] == Auth::user()->_id){
                return View::make('pages.buy')->with('prop',$prop)->with('trx_id','')->with('update',0);
            }else{
                return Redirect::to('property/detail/'.$id);
            }
        }else{
            $property->propertyLastStatus = $property->propertyStatus;
            $property->propertyStatus = 'reserved';
            $property->reservedBy = Auth::user()->_id;
            $property->reservedAt = new MongoDate();
            $property->locked = 1;
            $property->save();

            Session::put('reservedBy', Auth::user()->_id);
            Session::put('reservedAt', time());
            Session::put('reservedLock', 1);
            Session::put('reservedId', $prop['_id']);

            return View::make('pages.buy')->with('prop',$prop)->with('trx_id','')->with('update',0);
        }

    }

    public function getUpdate($id = null){

        $trx = Transaction::find($id)->toArray();

        $prop = Property::find($trx['propObjectId'])->toArray();

        Former::populate($trx);

        return View::make('pages.buy')->with('prop',$prop)->with('trx_id',$id)->with('update',1);
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

            $data['update'] = (is_null($data['update']) || $data['update'] == '')?0:$data['update'];
            $trx_id = (is_null($data['trx_id']) || $data['trx_id'] == '')?0:$data['trx_id'];

            $buyer = array();
            $buyer['buyerId']           =        $data['buyerId'];

            $buyer['agentId']           =        $data['agentId'];
            $buyer['agentName']         =          $data['agentName'];
            $buyer['customerId']        =           $data['customerId'];
            $buyer['salutation']        =           $data['salutation'];
            $buyer['firstname']         =          $data['firstname'];
            $buyer['lastname']          =         $data['lastname'];
            $buyer['email']             =      $data['email'];
            $buyer['number']           =        $data['number'];
            $buyer['address']           =        $data['address'];
            $buyer['address_2']           =        $data['address_2'];
            $buyer['company']           =        $data['company'];
            $buyer['phone']             =      $data['phone'];
            $buyer['city']              =     $data['city'];
            $buyer['countryOfOrigin']   =            $data['countryOfOrigin'];
            $buyer['state']             =      $data['state'];
            $buyer['zipCode']           =        $data['zipCode'];

            $sequence = new Sequence();

            $newbuyer = false;

            if($buyer['buyerId'] == ''){ // new buyer
                $seq = $sequence->getNewId('customer');
                $buyer['sequence'] = $seq;
                $buyer['customerId'] = 'IAB'.$seq;
                $buyer['lastUpdate'] = new MongoDate();
                $buyer['createdDate'] = new MongoDate();

                $buyermodel = new Buyer();
                $buyermodel->insert($buyer);
            }elseif($buyer['buyerId'] != '' && $data['update'] == 1){
                $buyermodel = Buyer::find($buyer['buyerId']);

                foreach($buyer as $k=>$v){
                    $buyermodel->{$k} = $v;
                }

                $buyermodel->save();
            }



            $data['adjustment1'] = ($data['adjustment1'] == '' || is_null($data['adjustment1']))?0:$data['adjustment1'];
            $data['adjustment2'] = ($data['adjustment2'] == '' || is_null($data['adjustment2']))?0:$data['adjustment2'];

            $data['earnestMoney1'] = ($data['earnestMoney1'] == '' || is_null($data['earnestMoney1']))?0:$data['earnestMoney1'];
            $data['earnestMoney2'] = ($data['earnestMoney2'] == '' || is_null($data['earnestMoney2']))?0:$data['earnestMoney2'];

            if($data['update'] == 1){
                $trx = Transaction::find($trx_id);
            }else{
                $trx = Transaction::create($data);
                $seq = $sequence->getNewId('order');
                $data['sequence'] = $seq;
                $data['orderNumber'] = 'IAO'.$seq;
            }

            foreach($data as $k=>$v){
                $trx->{$k} = $v;
            }

            if($trx->save()){
                return Redirect::to('property/review/'.$trx->_id)->with('notify_success','Order saved successfully');
            }else{
                return Redirect::to('property/review')->with('notify_success','Order saving failed');
            }


        }

    }

    public function postCommit(){

        $validator = array(
            'legalName'=>'required'
        );

        $data = Input::get();

        $validation = Validator::make($input = $data, $validator);

        $trx_id = $data['trx_id'];

        if($validation->fails()){

            return Redirect::to('property/review/'.$trx_id)->withErrors($validation)->withInput(Input::all());

        }else{


            unset($data['csrf_token']);

            $data['lastUpdate'] = new MongoDate();

            $trx = Transaction::find($trx_id);

            $prop = Property::find($trx->propObjectId);

            $prop->propertyStatus = 'under contract';

            $prop->locked = 0;

            $trx->propertyStatus = 'under contract';

            $trx->orderStatus = 'pending';

            //$trx->signature = $data['signature'];

            $trx->legalSigned = $data['legalName'];

            $trx->propertyData = $prop->toArray();

            $trx->propertyNumber = $prop->number;
            $trx->propertyAddress = $prop->address;
            $trx->propertyCity = $prop->city;
            $trx->propertyState = $prop->state;
            $trx->propertyZipCode = $prop->zipCode;

            $trx->earnestMoney = $trx->earnestMoney1 + $trx->earnestMoney2;


            if($trx->save()){
                $prop->save();
                return Redirect::to('property/receipt/'.$trx->_id)->with('prop',$prop->toArray())->with('trx',$trx->toArray())->with('notify_success','Order saved successfully');
            }else{
                return Redirect::to('property/review/'.$trx->_id)->with('prop',$prop)->with('trx',$trx->toArray())->with('notify_success','Order Process Failed. Please check your submitted informations.');
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

    public function getReview($id = null){

        $trx = Transaction::find($id)->toArray();

        $prop = Property::find($trx['propObjectId'])->toArray();

        //print_r($trx);

        return View::make('pages.review')->with('trx',$trx)->with('prop',$prop);
    }

    public function getReceipt($id = null){

        $trx = Transaction::find($id)->toArray();

        $prop = Property::find($trx['propObjectId'])->toArray();

        $agent = Agent::find($trx['agentId'])->toArray();

        //print_r($trx);

        return View::make('pages.receipt')->with('trx',$trx)->with('prop',$prop)->with('agent',$agent);
    }

    public function getTransactions(){

    }

    public function missingMethod($parameter){

    }

}