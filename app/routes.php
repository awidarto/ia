<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::controller('home', 'HomeController');
Route::controller('shop', 'ShopController');
Route::controller('news', 'NewsController');
Route::controller('page', 'PageController');
Route::controller('products', 'ProductsController');
Route::controller('property', 'PropertyController');
Route::controller('artist', 'ArtistController');
Route::controller('music', 'MusicController');
Route::controller('album', 'AlbumController');
Route::controller('contact', 'ContactController');
Route::controller('transaction', 'TransactionController');

Route::controller('upload', 'UploadController');
Route::controller('ajax', 'AjaxController');

//Route::get('/','PropertyController@getListing');

Route::get('/',function(){

    if(Auth::check()){
        //return Redirect::to('dashboard');
        $slides = Homeslider::where('publishing','published')->orderby('sequence','asc')->get();

        return View::make('pages.home')->with('slides',$slides);
    }else{
        return Redirect::to('login');
    }

});

Route::get('testmenu',function(){

});

Route::get('page/cat/{slug}','PageController@getCat');
Route::get('page/view/{slug}','PageController@getView');
Route::get('page','PageController@getIndex');

Route::get('contact','ContactController@getAdd');

Route::get('brochure/dl/{id}/{d?}',function($id, $type = null){

    $prop = Property::find($id)->toArray();

    $type = (is_null($type))?'pdf':$type;

    $tmpl = Template::where('type','brochure')->where('status','active')->first();

    $template = $tmpl->template;

    $nophotolrg = URL::to('images/no-photo-lrg.jpg');
    $nophoto = URL::to('images/no-photo.jpg');
    $nophotomd = URL::to('images/no-photo-md.jpg');

        if(isset($prop['defaultpictures'])){
            $d = $prop['defaultpictures'];
            $d['brchead'] = (isset($d['brchead']) && $d['brchead'] != '')?$d['brchead']:$nophotolrg;
            $d['brc1'] = ( isset($d['brc1']) && $d['brc1'] != '')?$d['brc1']:$nophotomd;
            $d['brc2'] = ( isset($d['brc2']) && $d['brc2'] != '')?$d['brc2']:$nophotomd;
            $d['brc3'] = ( isset($d['brc3']) && $d['brc3'] != '')?$d['brc3']:$nophotomd;
        }else{
            $d = array();
            $d['brchead'] = $nophoto;
            $d['brc1'] = $nophotomd;
            $d['brc2'] = $nophotomd;
            $d['brc3'] = $nophotomd;
        }

    $prop['defaultpictures'] = $d;

    $contact = array();

    if(Auth::check()){
        $contact['fullname'] = Auth::user()->firstname.' '.Auth::user()->lastname;
        $contact['email'] = Auth::user()->email;
        $contact['mobile'] = Auth::user()->mobile;
    }else{
        $contact['fullname'] = Options::get('brochure_default_name');
        $contact['email'] = Options::get('brochure_default_email');
        $contact['mobile'] = Options::get('brochure_default_mobile');
    }

        $rental = (double)$prop['monthlyRental'] * 12;
        $price = (double)$prop['listingPrice'];
        $year = 3;

        $roi = 0;
        $initprice = $price;
        $counter = $year;
        $result = 0;
        $pct = 3;

        $projected = px($price, $pct, $year,$initprice,$rental ,$roi, $counter, $result);

        $roi3 = $result;
        //print 'projected ROI : '.$result;

        $pct = 5;

        $roi = 0;
        $initprice = $price;
        $counter = $year;
        $result = 0;
        $projected = px($price, $pct, $year,$initprice,$rental ,$roi, $counter, $result);

        $roi5 = $result;


    //return View::make('print.brochure')->with('prop',$prop)->render();

    if(!is_null($type) && $type != 'pdf'){
        $content = View::make('brochuretmpl.'.$template)->with('prop',$prop)
                ->with('roi3',$roi3)
                ->with('roi5',$roi5)
                ->with('contact',$contact)->render();

        return $content;
    }else{
        //return PDF::loadView('print.brochure',array('prop'=>$prop))
        //    ->stream('download.pdf');
        $p = json_encode(array(
            'propertyId'=>$prop['propertyId'],
            'number'=>$prop['number'],
            'address'=>$prop['address'],
            'city'=>$prop['city'],
            'state'=>$prop['state']
         ));
        Event::fire('log.a',array('brochure','download',Auth::user()->email,$p));

        $tmpl = $tmpl->toArray();

        return PDF::loadView('brochuretmpl.'.$template, array('prop'=>$prop, 'contact'=>$contact,'roi3'=>$roi3,'roi5'=>$roi5))
                    ->setOption('margin-top', $tmpl['margin-top'])
                    ->setOption('margin-left', $tmpl['margin-left'])
                    ->setOption('margin-right', $tmpl['margin-right'])
                    ->setOption('margin-bottom', $tmpl['margin-bottom'])
                    ->setOption('dpi',$tmpl['dpi'])
                    ->setPaper($tmpl['paper-size'])
                    ->stream($prop['propertyId'].'.pdf');

        //return PDF::html('print.brochure',array('prop' => $prop), 'download.pdf');
    }

});

function px($price, $pct, $year, $initprice,$rental ,$roi, $counter, &$result){
    if($counter == 0){
        return $roi;
    }else{
        $price = $price + ($price * ( $pct / 100));
        $counter--;
        $rental = $rental + $rental;
        $roi = (($price - $initprice) + $rental )/ $initprice;
        $result = $roi;
        px($price, $pct, $year, $initprice, $rental, $roi ,$counter, $result);
    }
}


Route::post('brochure/mail/{id}',function($id){

    $prop = Property::find($id)->toArray();

    $tmpl = Template::where('type','brochure')->where('status','active')->first();

    $template = $tmpl->template;

    $nophotolrg = URL::to('images/no-photo-lrg.jpg');
    $nophoto = URL::to('images/no-photo.jpg');
    $nophotomd = URL::to('images/no-photo-md.jpg');

        if(isset($prop['defaultpictures'])){
            $d = $prop['defaultpictures'];
            $d['brchead'] = (isset($d['brchead']) && $d['brchead'] != '')?$d['brchead']:$nophotolrg;
            $d['brc1'] = ( isset($d['brc1']) && $d['brc1'] != '')?$d['brc1']:$nophotomd;
            $d['brc2'] = ( isset($d['brc2']) && $d['brc2'] != '')?$d['brc2']:$nophotomd;
            $d['brc3'] = ( isset($d['brc3']) && $d['brc3'] != '')?$d['brc3']:$nophotomd;
        }else{
            $d = array();
            $d['brchead'] = $nophoto;
            $d['brc1'] = $nophotomd;
            $d['brc2'] = $nophotomd;
            $d['brc3'] = $nophotomd;
        }

    $prop['defaultpictures'] = $d;

    $tmpl = $tmpl->toArray();

    $brochurepdf = PDF::loadView('brochuretmpl.'.$template, array('prop'=>$prop))
                    ->setOption('margin-top', $tmpl['margin-top'])
                    ->setOption('margin-left', $tmpl['margin-left'])
                    ->setOption('margin-right', $tmpl['margin-right'])
                    ->setOption('margin-bottom', $tmpl['margin-bottom'])
                    ->setOption('dpi',$tmpl['dpi'])
                    ->setPaper($tmpl['paper-size'])
                    ->output();


    file_put_contents(public_path().'/storage/pdf/'.$prop['propertyId'].'.pdf', $brochurepdf);

    //$mailcontent = View::make('emails.brochure')->with('prop',$prop)->render();

    Mail::send('emails.brochure',$prop, function($message) use ($prop, &$prop){
        $to = Input::get('to');
        $tos = explode(',', $to);
        if(is_array($tos) && count($tos) > 1){
            foreach($tos as $to){
                $message->to($to, $to);
            }
        }else{
                $message->to($to, $to);
        }

        $message->subject('Investors Alliance - '.$prop['propertyId']);

        $message->cc('support@propinvestorsalliance.com');

        $message->attach(public_path().'/storage/pdf/'.$prop['propertyId'].'.pdf');
    });

    $p = json_encode(array(
        'propertyId'=>$prop['propertyId'],
        'number'=>$prop['number'],
        'address'=>$prop['address'],
        'city'=>$prop['city'],
        'state'=>$prop['state']
     ));
    Event::fire('log.a',array('brochure','email',Auth::user()->email,$p));

    print json_encode(array('result'=>'OK'));

});

Route::get('pr/print/{id}',function($id){

    $trx = Transaction::find($id)->toArray();

    $prop = Property::find($trx['propObjectId'])->toArray();

    $agent = Agent::find($trx['agentId'])->toArray();

    return View::make('print.pr')->with('prop',$prop)->with('trx',$trx)->with('agent',$agent);

    //$content = View::make('print.brochure')->with('prop',$prop)->render();

    //return $content;

    //return PDF::loadView('print.pr',array('prop'=>$prop, 'trx'=>$trx, 'agent'=>$agent))
    //    ->stream('download.pdf');
});


Route::get('pr/dl/{id}',function($id){

    $trx = Transaction::find($id)->toArray();

    $prop = Property::find($trx['propObjectId'])->toArray();

    $agent = Agent::find($trx['agentId'])->toArray();

    //return View::make('print.brochure')->with('prop',$prop)->render();

    //$content = View::make('print.brochure')->with('prop',$prop)->render();

    //return $content;

    //return PDF::loadView('print.pr',array('prop'=>$prop, 'trx'=>$trx, 'agent'=>$agent))
    //    ->stream('download.pdf');
    return PDF::loadView('print.pr', array('prop'=>$prop, 'trx'=>$trx, 'agent'=>$agent))
            ->setOption('margin-top', '0mm')
            ->setOption('margin-left', '0mm')
            ->setOption('margin-right', '0mm')
            ->setOption('margin-bottom', '0mm')
            ->setOption('dpi',200)
            ->setPaper('A4')
            ->stream($prop['propertyId'].'_pr.pdf');

});

Route::post('pr/mail/{id}',function($id){

    $prop = Property::find($id)->toArray();

    //$content = View::make('print.brochure')->with('prop',$prop)->render();

    //$brochurepdf =  PDF::loadView('print.brochure',array('prop'=>$prop))->output();

    $brochurepdf = PDF::loadView('print.pr', array('prop'=>$prop, 'trx'=>$trx, 'agent'=>$agent))
                    ->setOption('margin-top', '0mm')
                    ->setOption('margin-left', '0mm')
                    ->setOption('margin-right', '0mm')
                    ->setOption('margin-bottom', '0mm')
                    ->setOption('dpi',200)
                    ->setPaper('A4')
                    ->output();

    file_put_contents(public_path().'/storage/pdf/'.$prop['propertyId'].'.pdf', $brochurepdf);

    //$mailcontent = View::make('emails.brochure')->with('prop',$prop)->render();

    Mail::send('emails.brochure',$prop, function($message) use ($prop, &$prop){
        $to = Input::get('to');
        $tos = explode(',', $to);
        if(is_array($tos) && count($tos) > 1){
            foreach($tos as $to){
                $message->to($to, $to);
            }
        }else{
                $message->to($to, $to);
        }

        $message->subject('Investors Alliance - '.$prop['propertyId']);

        $message->cc('support@propinvestorsalliance.com');

        $message->attach(public_path().'/storage/pdf/'.$prop['propertyId'].'.pdf');
    });

    print json_encode(array('result'=>'OK'));

});


Route::post('affiliate',function(){
    $enquiry = Input::get();
    $enpost = new Enquiry();

    foreach ($enquiry as $key => $value) {
        $enpost->{$key} = $value;
    }

    $enpost->type = 'affiliate';
    $enpost->save();

    $enquiry['type'] = 'Affiliate';
    $enquiry['en_message'] = $enquiry['message'];
    unset($enquiry['message']);

    Mail::send('emails.enquirynotification',$enquiry, function($message) use ($enquiry, &$enquiry){

        $recipient = Options::get('enquiry_receiver_email');

        $recipients = explode(',',$recipient);

        $message->to($recipients);

        $message->subject('Investors Alliance - Enquiry');

        $message->cc('support@propinvestorsalliance.com');

    });


    Session::set('enquiryMessage',  'Thank you for your interest, we will contact you soon.');

    return Redirect::to('/');

});

Route::get('tdate',function(){
    print Carbon::now()->subDays(10);
});

Route::get('hashme/{mypass}',function($mypass){

    print Hash::make($mypass);
});

Route::get('types',function(){
    $types = Property::distinct('type')->get();
    print_r($types->toArray());
});

Route::get('st',function(){
    Property::where('type','SINGLE FAMILY')->update(array('type'=>'SFH'),array('multi'=>true));
});

Route::get('media',function(){
    $media = Product::all();

    print $media->toJson();

});

Route::get('ref',function(){

    return View::make('pages.ref');
});

Route::get('about',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    return View::make('pages.about');
});

Route::get('faq',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );

    $faqs = Faq::get()->toArray();

    $faqcats = Faqcat::get()->toArray();

    $faqarray = array();

    foreach($faqs as $f){
        $faqarray[$f['category']][] = $f;
    }

        $p = json_encode(array(
            'title'=>'FAQ',
        ));
        $actor = (isset(Auth::user()->email))?Auth::user()->email:'guest';

        Event::fire('log.a',array('faq','view',$actor,$p));

    return View::make('pages.faq')->with('faqs',$faqarray)->with('faqcats',$faqcats);
});

Route::get('glossary',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );

        $faqs = Glossary::orderBy('category','asc')->get()->toArray();

        if(count($faqs) == 0){
            $faqs = null;
        }

        $p = json_encode(array(
            'title'=>'Glossary',
         ));

        $actor = (isset(Auth::user()->email))?Auth::user()->email:'guest';

        Event::fire('log.a',array('glossary','view',$actor,$p));

    return View::make('pages.glossary')->with('faqs',$faqs)->with('faqcats',Config::get('site.alphanumeric'));
});


Route::get('dashboard', array('before'=>'auth', function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    Former::framework('TwitterBootstrap');

    if(Auth::user()->role == 'customer'){
        $contact = Buyer::find(Auth::user()->_id)->toArray();

        $buyers = Buyer::find(Auth::user()->_id)->orderby('createdDate')->get()->toArray();

        $trx = Transaction::where('buyerId', '=', Auth::user()->_id)->orderby('createdDate')->get()->toArray();

    }else{
        $contact = Agent::find(Auth::user()->_id)->toArray();

        $buyers = Buyer::where('agentId', '=', Auth::user()->_id)->orderby('createdDate')->get()->toArray();

        $trx = Transaction::where('agentId', '=', Auth::user()->_id)->orderby('createdDate')->get()->toArray();

    }


    return View::make('pages.dashboard')
        ->with('contact',$contact)
        ->with('buyers',$buyers)
        ->with('trx',$trx);
} ) );


Route::get('changepass',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    Former::framework('TwitterBootstrap');

        $p = json_encode(array(
            'title'=>'Change Password',
         ));

        Event::fire('log.a',array('pass','change',Auth::user()->email,$p));

    return View::make('pages.changepass');
});

Route::post('changepass',function(){
    // validate the info, create rules for the inputs
    $rules = array(
        'newpass' => 'required|alphaNum|min:3|same:repass'
    );

    // run the validation rules on the inputs from the form
    $validator = Validator::make(Input::all(), $rules);

    // if the validator fails, redirect back to the form
    if ($validator->fails()) {

        Event::fire('log.a',array('change password','changepass',Auth::user()->email,'validation fail'));

        return Redirect::to('changepass')->withErrors($validator);
    } else {

        $data = Input::get();

        unset($data['csrf_token']);

        unset($data['repass']);

        $user = Agent::find(Auth::user()->_id);

        $user->pass = Hash::make($data['newpass']);

        if($user->save()){
            Session::flash('loginError', 'Password successfuly changed');

            Mail::send('emails.changepass',$data, function($message) use ($user, &$user){
                $to = Input::get('to');
                $tos = explode(',', $to);

                $message->to($user->email);

                $message->subject('Investors Alliance - Password Changes');

                $message->cc('support@propinvestorsalliance.com');

            });


            Event::fire('log.a',array('change password','changepass',Input::get('email'),'password changed'));
            //Event::fire('product.createformadmin',array($obj['_id'],$passwordRandom,$obj['conventionPaymentStatus']));
            return Redirect::to('changepass')->with('notify_success', 'Password Changed');
        }else{
            Session::flash('loginError', 'Failed to change password');

            Event::fire('log.a',array('change password','changepass',Input::get('email'),'fail to change password'));

            return Redirect::to('dashboard')->with('notify_success',ucfirst(Str::singular($controller_name)).' saving failed');
        }

    }


    return View::make('pages.changepass');

});

Route::get('register',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    Former::framework('TwitterBootstrap');

    $featured = Property::where('tags','like','%featured%')->get()->toArray();

    return View::make('realia/registration')->with('featured',$featured);
});

Route::get('signup',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    Former::framework('TwitterBootstrap');

    $agents = Agent::get()->toArray();

    $agent_select = array();
    foreach($agents as $agent){
        $agent_select[$agent['_id']] = $agent['firstname'].' '.$agent['lastname'];
    }

    Event::fire('log.a',array('signup','createaccount','guest','initiate signup'));

    return View::make('pages.createaccount')->with('agents',$agent_select);
});

Route::post('account/create',function(){
    // validate the info, create rules for the inputs
    $rules = array(
        'email'    => 'required|email',
        'pass' => 'required|alphaNum|min:3|same:repass'
    );

    // run the validation rules on the inputs from the form
    $validator = Validator::make(Input::all(), $rules);

    // if the validator fails, redirect back to the form
    if ($validator->fails()) {

        Event::fire('log.a',array('create account','createaccount',Input::get('email'),'validation fail'));

        return Redirect::to('account/create')->withErrors($validator);
    } else {

        $data = Input::get();

        unset($data['csrf_token']);


        $model = new Buyer();

        $data['createdDate'] = new MongoDate();
        $data['lastUpdate'] = new MongoDate();

        unset($data['repass']);
        $data['pass'] = Hash::make($data['pass']);

        $data['fullname'] = $data['firstname'].' '.$data['lastname'];


        if($obj = $model->insert($data)){
            Event::fire('log.a',array('create account','createaccount',Input::get('email'),'account created'));
            //Event::fire('product.createformadmin',array($obj['_id'],$passwordRandom,$obj['conventionPaymentStatus']));
            return Redirect::to('account/success');
        }else{

            Event::fire('log.a',array('create account','createaccount',Input::get('email'),'fail to create account'));

            return Redirect::to($this->backlink)->with('notify_success',ucfirst(Str::singular($controller_name)).' saving failed');
        }

    }


    return View::make('pages.createaccount');
});

Route::get('account/success',function(){
    Event::fire('log.a',array('create account','createaccount','landingpage','account created'));
    return View::make('pages.createaccountsuccess');
});

Route::get('login',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    Former::framework('TwitterBootstrap');

    $featured = Property::where('tags','like','%featured%')->get()->toArray();

    return View::make('homelogin')->with('featured',$featured);
});

Route::post('login',function(){

    // validate the info, create rules for the inputs
    $rules = array(
        'email'    => 'required|email',
        'password' => 'required|alphaNum|min:3'
    );

    // run the validation rules on the inputs from the form
    $validator = Validator::make(Input::all(), $rules);

    // if the validator fails, redirect back to the form
    if ($validator->fails()) {

        Event::fire('log.a',array('login','login',Input::get('email'),'validation fail'));

        Session::flash('failAuth', true);
        return Redirect::to('/')->withErrors($validator);
    } else {

        $userfield = Config::get('kickstart.user_field');
        $passwordfield = Config::get('kickstart.password_field');

        // find the user
        $user = User::where($userfield, '=', Input::get('email'))->first();


        // check if user exists
        if ($user) {

            // check if password is correct
            if (Hash::check(Input::get('password'), $user->{$passwordfield} )) {

                // login the user

                $user->role = 'agent';

                Auth::login($user);

                //print_r(Auth::user());

                //exit();

                Event::fire('log.a',array('login','login',Auth::user()->email,'login success'));

                if(Session::get('redirect') != ''){
                    return Redirect::to(Session::get('redirect'));
                }else{
                    return Redirect::to('/');
                }


            } else {
                // validation not successful
                // send back to form with errors
                // send back to form with old input, but not the password
                Session::flash('loginError', 'Incorrect email or password.');

                Event::fire('log.a',array('login','login',Input::get('email'),'auth fail'));

                Session::flash('failAuth', true);
                return Redirect::to('/')->withErrors($validator);
                /*
                return Redirect::to('login')
                    ->withErrors($validator)
                    ->withInput(Input::except('password'));
                */
            }

        } else {
            // user does not exist in database
            // return them to login with message
            Session::flash('loginError', 'This user does not exist.');

            Event::fire('log.a',array('login','login',Input::get('email'),'unregistered'));

            return Redirect::to('login');
        }

    }

});

Route::post('clogin',function(){

    // validate the info, create rules for the inputs
    $rules = array(
        'cemail'    => 'required|email',
        'cpassword' => 'required|alphaNum|min:3'
    );

    // run the validation rules on the inputs from the form
    $validator = Validator::make(Input::all(), $rules);

    // if the validator fails, redirect back to the form
    if ($validator->fails()) {

        Event::fire('log.a',array('clogin','clogin',Input::get('email'),'validation fail'));

        return Redirect::to('login')->withErrors($validator);
    } else {

        $userfield = Config::get('kickstart.user_field');
        $passwordfield = Config::get('kickstart.password_field');

        // find the user
        $usermodel = new User('buyers');

        $user = $usermodel->where($userfield, '=', Input::get('cemail'))->first();

        // check if user exists
        if ($user) {

            // check if password is correct
            if (Hash::check(Input::get('cpassword'), $user->{$passwordfield} )) {

                $user->role = 'customer';

                // login the user
                Auth::login($user);

                //print_r(Auth::user());

                //print Auth::user()->email;

                Event::fire('log.a',array('clogin','clogin',Auth::user()->email,'login success'));

                /*
                if(Session::get('redirect') != ''){
                    return Redirect::to(Session::get('redirect'));
                }else{
                }
                */

                    return Redirect::to('dashboard');

            } else {
                // validation not successful
                // send back to form with errors
                // send back to form with old input, but not the password
                Session::flash('cloginError', 'Incorrect email or password.');

                Event::fire('log.a',array('clogin','clogin',Input::get('cemail'),'auth fail'));

                return Redirect::to('login')
                    ->withErrors($validator)
                    ->withInput(Input::except('cpassword'));
            }

        } else {
            // user does not exist in database
            // return them to login with message
            Session::flash('cloginError', 'This user does not exist.');

            Event::fire('log.a',array('login','login',Input::get('email'),'unregistered'));

            return Redirect::to('login');
        }

    }

});


Route::get('logout',function(){
    if(isset(Auth::user()->email)){
        $useremail = Auth::user()->email;
    }else{
        $useremail = 'session expired';
    }

    Event::fire('log.a',array('logout','logout',$useremail,'logout'));

    Auth::logout();
    return Redirect::to('/');
});

/* Filters */

Route::filter('auth', function()
{

    if (Auth::guest()){
        Session::put('redirect',URL::full());
        return Redirect::to('login');
    }

    if($redirect = Session::get('redirect')){
        Session::forget('redirect');
        return Redirect::to($redirect);
    }

    //if (Auth::guest()) return Redirect::to('login');
});
