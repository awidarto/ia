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

    public function numberSearch($search = '')
    {

        $sval = new MongoRegex('/'.$search.'/i');

        $sign = null;
        $str = $search;

        $qstr = trim(str_replace(array('<','>','='), '', $str));

        $qval = (double)$qstr;

        if($search == ''){
            return 0;
        }

        if(strpos($str, "<=") !== false){
            $sign = '$lte';
        }elseif(strpos($str, ">=") !== false){
            $sign = '$gte';
        }elseif(strpos($str, ">") !== false){
            $sign = '$gt';
        }elseif(stripos($str, "<") !== false){
            $sign = '$lt';
        }

        //print $sign;
        if(is_null($sign)){
            $qval = $qval;
        }else{
            $qval = array($sign=>$qval);
        }

        return $qval;

    }

    public function prepareNumberSearch($search)
    {
        if(is_array($this->numberSearch($search))){
            $qp = $this->numberSearch($search);
            $qs = key($qp);
            $qv = $qp[key($qp)];

            $fs = Auth::user()->price_sign;
            $fv = Auth::user()->filter_price;

            if(($fs == '&lt' && $qs == '$lt') || ($fs == '$lte' && $qs == '$lte')){
                if($fv < $qv){
                    return $this->numberSearch($search);
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function getListing($prefilter = null)
    {
        //print_r(Auth::user());
        //count=40&order=asc&page=3&sort=State&type=TRIPLEX


        Session::put('backlink',URL::full());

        $page = (Input::get('page') == '')?'0':Input::get('page');
        $perpage = (Input::get('count') == '')?'8':Input::get('count');
        $order = (Input::get('order') == '')?'desc':Input::get('order');
        //$sort = (Input::get('sort') == '')?'listingPrice':Input::get('sort');
        $sort = (Input::get('sort') == '')?'propertyId':Input::get('sort');
        $filter = (Input::get('type') == '')?'all':Input::get('type');

        $search = (Input::get('s') == '')?'':Input::get('s');
        $searchscope = (Input::get('sc') == '')?'':Input::get('sc');
        $searchmode = (Input::get('md') == '')?'':Input::get('md');

        $searchprice = (Input::get('p1') == '')?'':Input::get('p1');
        $searchpricesign = (Input::get('ps1') == '')?'':Input::get('ps1');
        $searchpricerel = (Input::get('pr') == '')?'':Input::get('pr');
        $searchprice2 = (Input::get('p2') == '')?'':Input::get('p2');
        $searchpricesign2 = (Input::get('ps2') == '')?'':Input::get('ps2');


        $page = (is_null($page))?0:$page;
        $skip = $page * $perpage;

        $total_all = Property::count();

        $query = array();

        $is_search = false;

        if($filter == 'all'){

            $q = array();
            $q['propertyStatus'] = array('$ne'=>'offline');

            $or = array();
            $and = array();

            if(!is_null($prefilter)){
                $prefilter = str_replace('-', ' ', $prefilter);
                $and[] = array('propertyStatus'=>$prefilter);
            }

            if($search != '' && $searchmode == 'sim'){
                $sval = new MongoRegex('/'.$search.'/i');
                if($is_search == false){
                    $or_search[] = array('state'=>$sval);
                    $or_search[] = array('propertyId'=>$sval);
                    $or_search[] = array('city'=>$sval);
                }

                $and[] = array('$or'=>$or_search);

            }else if( $search != '' && $searchmode == 'adv'){
                $sval = new MongoRegex('/'.$search.'/i');
                if($is_search == false){
                    if($searchscope == ''){
                        $or_search[] = array('state'=>$sval);
                        $or_search[] = array('propertyId'=>$sval);
                        $or_search[] = array('city'=>$sval);
                    }else{
                        $or_search[] = array($searchscope=>$sval);
                    }
                }

                $and[] = array('$or'=>$or_search);

            }


            if(Auth::user()->prop_access == 'filtered'){
                if(isset(Auth::user()->filter_principal) && Auth::user()->filter_principal != ''){
                    $q['principal'] = Auth::user()->filter_principal;
                }

                if(isset(Auth::user()->filter_state) && Auth::user()->filter_state != ''){
                    $states = explode(',',Auth::user()->filter_state);

                    if(is_array($states) && count($states) > 1){
                        $or_state = array();
                        foreach($states as $state){
                            $or_state[] = array('state'=>$state);
                        }
                        $and[] = array('$or'=>$or_state);
                    }else{
                        $q['state'] = Auth::user()->filter_state;
                    }
                }

                if( isset(Auth::user()->filter_propmanager) &&  Auth::user()->filter_propmanager != ''){
                    $states = explode(';',Auth::user()->filter_propmanager);

                    if(is_array($states) && count($states) > 1){
                        $or_propmanager = array();
                        foreach($states as $manager){
                            $or_propmanager[] = array('propertyManager'=>$manager);
                        }
                        $and[] = array('$or'=>$or_propmanager);
                    }else{
                        $q['propertyManager'] = Auth::user()->filter_propmanager;
                    }
                }

                if( isset(Auth::user()->filter_status) && Auth::user()->filter_status != ''){
                    if(isset(Auth::user()->filter_status) && Auth::user()->filter_status == 'both'){
                        $or_status[] = array('propertyStatus'=>'sold');
                        $or_status[] = array('propertyStatus'=>'available');
                        $and[] = array('$or'=>$or_status);
                    }else{
                        $q['propertyStatus'] = Auth::user()->filter_status;
                    }
                }

                if( isset(Auth::user()->price_sign) && Auth::user()->price_sign != ''){

                    $price_line = array('listingPrice'=>array(Auth::user()->price_sign => Auth::user()->filter_price));

                    if( Auth::user()->price_sign2 != '' &&  Auth::user()->price_sign2 != '' && Auth::user()->price_rel != '' &&  Auth::user()->price_rel != '-'){
                        $price_line2 = array('listingPrice'=>array(Auth::user()->price_sign2 => Auth::user()->filter_price2));
                        if( Auth::user()->price_rel == 'OR'){
                            $or_price[] = $price_line;
                            $or_price[] = $price_line2;
                            $and[] = array('$or'=>$or_price);
                        }else{
                            $and[] = $price_line;
                            $and[] = $price_line2;
                        }
                    }else{
                        $and[] = $price_line;
                    }

                }

                if( isset(Auth::user()->price_sign) && Auth::user()->price_sign == ''){

                    if($searchpricesign != '' && $searchpricesign != '-'){
                        $price_line = array('listingPrice'=>array($searchpricesign => (double)$searchprice));

                        if( $searchpricesign2 != '' && $searchpricerel != '' &&  $searchpricerel != '-'){
                            $price_line2 = array('listingPrice'=>array($searchpricesign2 => (double)$searchprice2));
                            if( $searchpricerel == 'OR'){
                                $or_price[] = $price_line;
                                $or_price[] = $price_line2;
                                $and[] = array('$or'=>$or_price);
                            }else{
                                $and[] = $price_line;
                                $and[] = $price_line2;
                            }
                        }else{
                            $and[] = $price_line;
                        }

                    }


                }


                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;

            }else if(Auth::user()->prop_access == 'filtered_and_individual'){

                $q['assigned_user'] = Auth::user()->id;

                if(isset(Auth::user()->filter_principal) && Auth::user()->filter_principal != ''){
                    $q['principal'] = Auth::user()->filter_principal;
                }

                if(isset(Auth::user()->filter_state) && Auth::user()->filter_state != ''){
                    $states = explode(',',Auth::user()->filter_state);

                    if(is_array($states) && count($states) > 1){
                        $or_state = array();
                        foreach($states as $state){
                            $or_state[] = array('state'=>$state);
                        }
                        $and[] = array('$or'=>$or_state);
                    }else{
                        $q['state'] = Auth::user()->filter_state;
                    }
                }

                if(isset(Auth::user()->filter_propmanager) && Auth::user()->filter_propmanager != ''){
                    $states = explode(';',Auth::user()->filter_propmanager);

                    if(is_array($states) && count($states) > 1){
                        $or_propmanager = array();
                        foreach($states as $manager){
                            $or_propmanager[] = array('propertyManager'=>$manager);
                        }
                        $and[] = array('$or'=>$or_propmanager);
                    }else{
                        $q['propertyManager'] = Auth::user()->filter_propmanager;
                    }
                }

                if(isset(Auth::user()->filter_status) && Auth::user()->filter_status != ''){
                    if(isset(Auth::user()->filter_status) && Auth::user()->filter_status == 'both'){
                        $or_status[] = array('propertyStatus'=>'sold');
                        $or_status[] = array('propertyStatus'=>'available');
                        $and[] = array('$or'=>$or_status);
                    }else{
                        $q['propertyStatus'] = Auth::user()->filter_status;
                    }
                }

                if( isset(Auth::user()->price_sign) && Auth::user()->price_sign != ''){
                    $price_line = array('listingPrice'=>array(Auth::user()->price_sign => Auth::user()->filter_price));
                    if( Auth::user()->price_sign2 != '' &&  Auth::user()->price_sign2 != '' && Auth::user()->price_rel != '' &&  Auth::user()->price_rel != '-'){
                        $price_line2 = array('listingPrice'=>array(Auth::user()->price_sign2 => Auth::user()->filter_price2));
                        if( Auth::user()->price_rel == 'OR'){
                            $or_price[] = $price_line;
                            $or_price[] = $price_line2;
                            $and[] = array('$or'=>$or_price);
                        }else{
                            $and[] = $price_line;
                            $and[] = $price_line2;
                        }
                    }else{
                        $and[] = $price_line;
                    }

                }

                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;

            }else if(Auth::user()->prop_access == 'filtered_or_individual'){

                $or[] = array('assigned_user'=>Auth::user()->id);

                if(isset(Auth::user()->filter_principal) && Auth::user()->filter_principal != ''){
                    $and['principal'] = Auth::user()->filter_principal;
                }

                if(isset(Auth::user()->filter_state) && Auth::user()->filter_state != ''){
                    $states = explode(',',Auth::user()->filter_state);

                    if(is_array($states) && count($states) > 1){
                        $or_state = array();
                        foreach($states as $state){
                            $or_state[] = array('state'=>$state);
                        }
                        $and[] = array('$or'=>$or_state);
                    }else{
                        $q['state'] = Auth::user()->filter_state;
                    }
                }

                if(isset(Auth::user()->filter_propmanager) && Auth::user()->filter_propmanager != ''){
                    $states = explode(';',Auth::user()->filter_propmanager);

                    if(is_array($states) && count($states) > 1){
                        $or_propmanager = array();
                        foreach($states as $manager){
                            $or_propmanager[] = array('propertyManager'=>$manager);
                        }
                        $and[] = array('$or'=>$or_propmanager);
                    }else{
                        $q['propertyManager'] = Auth::user()->filter_propmanager;
                    }
                }

                if(isset(Auth::user()->filter_status) && Auth::user()->filter_status != ''){
                    if(isset(Auth::user()->filter_status) && Auth::user()->filter_status == 'both'){
                        $or_status[] = array('propertyStatus'=>'sold');
                        $or_status[] = array('propertyStatus'=>'available');
                        $and[] = array('$or'=>$or_status);
                    }else{
                        $q['propertyStatus'] = Auth::user()->filter_status;
                    }
                }

                if( isset(Auth::user()->price_sign) && Auth::user()->price_sign != ''){
                    $price_line = array('listingPrice'=>array(Auth::user()->price_sign => Auth::user()->filter_price));
                    if( Auth::user()->price_sign2 != '' &&  Auth::user()->price_sign2 != '' && Auth::user()->price_rel != '' &&  Auth::user()->price_rel != '-'){
                        $price_line2 = array('listingPrice'=>array(Auth::user()->price_sign2 => Auth::user()->filter_price2));
                        if( Auth::user()->price_rel == 'OR'){
                            $or_price[] = $price_line;
                            $or_price[] = $price_line2;
                            $and[] = array('$or'=>$or_price);
                        }else{
                            $and[] = $price_line;
                            $and[] = $price_line2;
                        }
                    }else{
                        $and[] = $price_line;
                    }

                }

                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;

            }else if(Auth::user()->prop_access == 'individual'){

                $q= array(
                            'propertyStatus'=>array('$ne'=>'offline'),
                            'assigned_user'=>Auth::user()->id
                        );

                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;


            }else{

                $q = array(
                            'propertyStatus'=>array('$ne'=>'offline')
                        );

                if($searchpricesign != '' && $searchpricesign != '-'){
                    if($searchpricesign == '$eq'){
                        $price_line = array('listingPrice' => (double)$searchprice);
                    }else{
                        $price_line = array('listingPrice'=>array($searchpricesign => (double)$searchprice));
                    }

                    if( $searchpricesign2 != '' && $searchpricerel != '' &&  $searchpricerel != '-'){
                        if($searchpricesign == '$eq'){
                            $price_line2 = array('listingPrice'=> (double)$searchprice2);
                        }else{
                            $price_line2 = array('listingPrice'=>array($searchpricesign2 => (double)$searchprice2));
                        }

                        if( $searchpricerel == 'OR'){
                            $or_price[] = $price_line;
                            $or_price[] = $price_line2;
                            $and[] = array('$or'=>$or_price);
                        }else{
                            $and[] = $price_line;
                            $and[] = $price_line2;
                        }
                    }else{
                        $and[] = $price_line;
                    }

                }

                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;

            }

            //print_r(json_encode($query) );

        }else{

            $q = array();
            $q['propertyStatus'] = array('$ne'=>'offline');
            $q['type'] = $filter;

            $or = array();
            $and = array();

            if(!is_null($prefilter)){
                $and[] = array('propertyStatus'=>$prefilter);
            }

            if($search != ''){
                $sval = new MongoRegex('/'.$search.'/i');
                $or_search[] = array('state'=>$sval);
                $or_search[] = array('propertyId'=>$sval);
                $or_search[] = array('city'=>$sval);
                $or_search[] = array('listingPrice'=>$sval);
                $and[] = array('$or'=>$or_search);
            }

            if(Auth::user()->prop_access == 'filtered'){

                if(isset(Auth::user()->filter_principal) && Auth::user()->filter_principal != ''){
                    $q['principal'] = Auth::user()->filter_principal;
                }

                if(isset(Auth::user()->filter_state) && Auth::user()->filter_state != ''){
                    $states = explode(',',Auth::user()->filter_state);

                    if(is_array($states) && count($states) > 1){
                        $or_state = array();
                        foreach($states as $state){
                            $or_state[] = array('state'=>$state);
                        }
                        $and[] = array('$or'=>$or_state);
                    }else{
                        $q['state'] = Auth::user()->filter_state;
                    }
                }

                if(isset(Auth::user()->filter_propmanager) && Auth::user()->filter_propmanager != ''){
                    $states = explode(';',Auth::user()->filter_propmanager);

                    if(is_array($states) && count($states) > 1){
                        $or_propmanager = array();
                        foreach($states as $manager){
                            $or_propmanager[] = array('propertyManager'=>$manager);
                        }
                        $and[] = array('$or'=>$or_propmanager);
                    }else{
                        $q['propertyManager'] = Auth::user()->filter_propmanager;
                    }
                }


                if(isset(Auth::user()->filter_status) && Auth::user()->filter_status != ''){
                    if(isset(Auth::user()->filter_status) && Auth::user()->filter_status == 'both'){
                        $or_status[] = array('propertyStatus'=>'sold');
                        $or_status[] = array('propertyStatus'=>'available');
                        $and[] = array('$or'=>$or_status);
                    }else{
                        $q['propertyStatus'] = Auth::user()->filter_status;
                    }
                }

                if( isset(Auth::user()->price_sign) && Auth::user()->price_sign != ''){
                    $price_line = array('listingPrice'=>array(Auth::user()->price_sign => Auth::user()->filter_price));
                    if( Auth::user()->price_sign2 != '' &&  Auth::user()->price_sign2 != '' && Auth::user()->price_rel != '' &&  Auth::user()->price_rel != '-'){
                        $price_line2 = array('listingPrice'=>array(Auth::user()->price_sign2 => Auth::user()->filter_price2));
                        if( Auth::user()->price_rel == 'OR'){
                            $or_price[] = $price_line;
                            $or_price[] = $price_line2;
                            $and[] = array('$or'=>$or_price);
                        }else{
                            $and[] = $price_line;
                            $and[] = $price_line2;
                        }
                    }else{
                        $and[] = $price_line;
                    }

                }

                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;

            }else if(Auth::user()->prop_access == 'filtered_and_individual'){

                $q['assigned_user'] = Auth::user()->id;

                if(isset(Auth::user()->filter_principal) && Auth::user()->filter_principal != ''){
                    $q['principal'] = Auth::user()->filter_principal;
                }

                if(isset(Auth::user()->filter_state) && Auth::user()->filter_state != ''){
                    $states = explode(',',Auth::user()->filter_state);

                    if(is_array($states) && count($states) > 1){
                        $or_state = array();
                        foreach($states as $state){
                            $or_state[] = array('state'=>$state);
                        }
                        $and[] = array('$or'=>$or_state);
                    }else{
                        $q['state'] = Auth::user()->filter_state;
                    }
                }

                if(isset(Auth::user()->filter_propmanager) && Auth::user()->filter_propmanager != ''){
                    $states = explode(';',Auth::user()->filter_propmanager);

                    if(is_array($states) && count($states) > 1){
                        $or_propmanager = array();
                        foreach($states as $manager){
                            $or_propmanager[] = array('propertyManager'=>$manager);
                        }
                        $and[] = array('$or'=>$or_propmanager);
                    }else{
                        $q['propertyManager'] = Auth::user()->filter_propmanager;
                    }
                }


                if(isset(Auth::user()->filter_status) && Auth::user()->filter_status != ''){
                    if(isset(Auth::user()->filter_status) && Auth::user()->filter_status == 'both'){
                        $or[] = array('propertyStatus'=>'sold');
                        $or[] = array('propertyStatus'=>'available');
                        $and[] = array('$or'=>$or);
                    }else{
                        $q['propertyStatus'] = Auth::user()->filter_status;
                    }
                }

                if( isset(Auth::user()->price_sign) && Auth::user()->price_sign != ''){
                    $price_line = array('listingPrice'=>array(Auth::user()->price_sign => Auth::user()->filter_price));
                    if( Auth::user()->price_sign2 != '' &&  Auth::user()->price_sign2 != '' && Auth::user()->price_rel != '' &&  Auth::user()->price_rel != '-'){
                        $price_line2 = array('listingPrice'=>array(Auth::user()->price_sign2 => Auth::user()->filter_price2));
                        if( Auth::user()->price_rel == 'OR'){
                            $or_price[] = $price_line;
                            $or_price[] = $price_line2;
                            $and[] = array('$or'=>$or_price);
                        }else{
                            $and[] = $price_line;
                            $and[] = $price_line2;
                        }
                    }else{
                        $and[] = $price_line;
                    }

                }

                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;

            }else if(Auth::user()->prop_access == 'filtered_or_individual'){

                $or[] = array('assigned_user'=>Auth::user()->id);

                if(isset(Auth::user()->filter_principal) && Auth::user()->filter_principal != ''){
                    $and['principal'] = Auth::user()->filter_principal;
                }

                if(isset(Auth::user()->filter_state) && Auth::user()->filter_state != ''){
                    $states = explode(',',Auth::user()->filter_state);

                    if(is_array($states) && count($states) > 1){
                        $or_state = array();
                        foreach($states as $state){
                            $or_state[] = array('state'=>$state);
                        }
                        $and[] = array('$or'=>$or_state);
                    }else{
                        $q['state'] = Auth::user()->filter_state;
                    }
                }

                if(isset(Auth::user()->filter_propmanager) && Auth::user()->filter_propmanager != ''){
                    $states = explode(';',Auth::user()->filter_propmanager);

                    if(is_array($states) && count($states) > 1){
                        $or_propmanager = array();
                        foreach($states as $manager){
                            $or_propmanager[] = array('propertyManager'=>$manager);
                        }
                        $and[] = array('$or'=>$or_propmanager);
                    }else{
                        $q['propertyManager'] = Auth::user()->filter_propmanager;
                    }
                }


                if(isset(Auth::user()->filter_status) && Auth::user()->filter_status != ''){
                    if(isset(Auth::user()->filter_status) && Auth::user()->filter_status == 'both'){
                        $or_status[] = array('propertyStatus'=>'sold');
                        $or_status[] = array('propertyStatus'=>'available');
                        $and[] = array('$or'=>$or_status);
                    }else{
                        $q['propertyStatus'] = Auth::user()->filter_status;
                    }
                }

                if( isset(Auth::user()->price_sign) && Auth::user()->price_sign != ''){
                    $price_line = array('listingPrice'=>array(Auth::user()->price_sign => Auth::user()->filter_price));
                    if( Auth::user()->price_sign2 != '' &&  Auth::user()->price_sign2 != '' && Auth::user()->price_rel != '' &&  Auth::user()->price_rel != '-'){
                        $price_line2 = array('listingPrice'=>array(Auth::user()->price_sign2 => Auth::user()->filter_price2));
                        if( Auth::user()->price_rel == 'OR'){
                            $or_price[] = $price_line;
                            $or_price[] = $price_line2;
                            $and[] = array('$or'=>$or_price);
                        }else{
                            $and[] = $price_line;
                            $and[] = $price_line2;
                        }
                    }else{
                        $and[] = $price_line;
                    }

                }

                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;

            }else if(Auth::user()->prop_access == 'individual'){

                $q = array(
                            'propertyStatus'=>array('$ne'=>'offline'),
                            'type'=>$filter,
                            'assigned_user'=>Auth::user()->id
                        );

                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;

            }else{

                $q = array(
                            'propertyStatus'=>array('$ne'=>'offline'),
                            'type'=>$filter,

                        );

                if($searchpricesign != '' && $searchpricesign != '-'){
                    if($searchpricesign == '$eq'){
                        $price_line = array('listingPrice' => (double)$searchprice);
                    }else{
                        $price_line = array('listingPrice'=>array($searchpricesign => (double)$searchprice));
                    }

                    if( $searchpricesign2 != '' && $searchpricerel != '' &&  $searchpricerel != '-'){
                        if($searchpricesign == '$eq'){
                            $price_line2 = array('listingPrice'=> (double)$searchprice2);
                        }else{
                            $price_line2 = array('listingPrice'=>array($searchpricesign2 => (double)$searchprice2));
                        }

                        if( $searchpricerel == 'OR'){
                            $or_price[] = $price_line;
                            $or_price[] = $price_line2;
                            $and[] = array('$or'=>$or_price);
                        }else{
                            $and[] = $price_line;
                            $and[] = $price_line2;
                        }
                    }else{
                        $and[] = $price_line;
                    }

                }

                if(count($and) > 0){
                    $q['$and'] = $and;
                }

                if(count($or) > 0){
                    $q['$or'] = $or;
                }

                $query = $q;

            }

        }

        //print_r($query);

        $properties = Property::whereRaw($query)->orderBy($sort,$order)->skip($skip)->take($perpage)->get();

        $total_found = Property::whereRaw($query)->count();

        $currentcount = count($properties->toArray());

        $paging = floor($total_found / $perpage);

        $q = json_encode($query);

        Event::fire('cleanup');

        if($search == ''){
            Event::fire('log.a',array('property','list',Auth::user()->email,$q));
        }else{
            Event::fire('log.a',array('property','search',Auth::user()->email,$q));
        }

        $current_request = str_replace(array(URL::current(),'?'), '', URL::full());

        return View::make('pages.listing')
            ->with('pageurl',URL::current())
            ->with('properties',$properties)
            ->with('total',$total_found)
            ->with('alltotal',$total_all)
            ->with('current',$page)
            ->with('perpage',$perpage)
            ->with('currentcount',$currentcount)
            ->with('current_request',$current_request)
            ->with('paging',$paging);
    }

    public function getDetail($id = null){

        $page = Property::find($id);

        if($page){
            $page = $page->toArray();

            //print_r($page);

            //
            if( !$this->checkDate($page['leaseStartDate'])
                || $page['leaseStartDate'] == 0
                || $page['leaseStartDate'] == '-'
                || $page['leaseStartDate'] == '' ){

                $page['leaseStartDate'] = false;
            }

            if(strtoupper($page['category']) != 'TENANTED'){
                $page['leaseStartDate'] = false;
            }

            $annualRental = 12*$page['monthlyRental'];
            $propManagementFee = $annualRental * 0.1;
            $maintenanceAllowance = $annualRental * 0;
            $vacancyAllowance = $annualRental * 0;

            $totalExpense = $propManagementFee + $maintenanceAllowance + $vacancyAllowance + $page['tax'] + $page['insurance'];

            $netAnnualCashFlow = $annualRental - $totalExpense;
            $netMonthlyCashFlow = round($netAnnualCashFlow / 12, 0, PHP_ROUND_HALF_UP);

            $netroi = ($netAnnualCashFlow / $page['listingPrice']);


            $rental = (double)$page['monthlyRental'] * 12;
            $price = (double)$page['listingPrice'];
            $year = 3;

            $roi = 0;
            $initprice = $price;
            $counter = $year;
            $result = 0;
            $pct = 5;
            $result = 0;

            fv( $initprice, $pct, $year, $counter ,$result );

            $froi = (($result - $price) + ( $price * $netroi * $year )) / $price;

            $page['projectedROI'] = $froi;

        }else{
            $page = null;
        }

        $backlink = Session::get('backlink',URL::to('property/listing'));

        $p = json_encode(array(
            'propertyId'=>$page['propertyId'],
            'number'=>$page['number'],
            'address'=>$page['address'],
            'city'=>$page['city'],
            'state'=>$page['state']
         ));
        Event::fire('log.a',array('property','detail',Auth::user()->email,$p));

        return View::make('pages.detail')
            ->with('backlink',$backlink)
            ->with('prop',$page);
    }

    public function postProjected()
    {
        $in = Input::get();

        $_id = $in['_id'];

        $prop = Property::find($_id)->toArray();

            $annualRental = 12*$prop['monthlyRental'];
            $propManagementFee = $annualRental * 0.1;
            $maintenanceAllowance = $annualRental * 0;
            $vacancyAllowance = $annualRental * 0;

            $totalExpense = $propManagementFee + $maintenanceAllowance + $vacancyAllowance + $prop['tax'] + $prop['insurance'];

            $netAnnualCashFlow = $annualRental - $totalExpense;
            $netMonthlyCashFlow = round($netAnnualCashFlow / 12, 0, PHP_ROUND_HALF_UP);

            $netroi = ($netAnnualCashFlow / $prop['listingPrice']);


        $rental = (double)$prop['monthlyRental'] * 12;
        $price = (double)$prop['listingPrice'];
        $year = $in['year'];

        $roi = 0;
        $initprice = $price;
        $counter = $year;
        $result = 0;

        $result = 0;

        $initprice = $price;
        $pct = $in['rate'];

        fv( $initprice, $pct, $year, $counter ,$result );

        $froi = (($result - $price) + ( $price * $netroi * $year )) / $price;

        //$projected = px($price, $pct, $year,$initprice,$rental ,$roi, $counter, $netroi ,$result);

        $froi = round($froi * 100, 1, PHP_ROUND_HALF_UP).'%';

        return Response::json( array('result'=>'OK', 'roi'=>$result, 'froi'=>$froi ) );

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

        $p = json_encode(array(
            'propertyId'=>$property['propertyId'],
            'number'=>$property['number'],
            'address'=>$property['address'],
            'city'=>$property['city'],
            'state'=>$property['state']
         ));
        Event::fire('log.a',array('property','buy',Auth::user()->email,$p));


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

                $p = json_encode(array(
                    'trx_id'=>$trx->_id,
                    'buyer_id'=>$buyer['buyerId']
                 ));
                $actor = Auth::user()->email;
                Event::fire('log.a',array('property','processbuy',$actor,$p));

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

    public function checkDate($string){
        $date = date_parse($string);
        if ($date["error_count"] == 0 && checkdate($date["month"], $date["day"], $date["year"])){
            return true;
        }else{
            return false;
        }
    }

    public function missingMethod($parameter = array()){

    }

}