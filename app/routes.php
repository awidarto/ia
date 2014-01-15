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

Route::get('/','PropertyController@getListing');

Route::get('page/cat/{slug}','PageController@getCat');
Route::get('page/view/{slug}','PageController@getView');
Route::get('page','PageController@getIndex');

Route::get('contact','ContactController@getAdd');

Route::get('brochure/dl/{id}',function($id){

    $prop = Property::find($id)->toArray();

    //return View::make('print.brochure')->with('prop',$prop)->render();

    $content = View::make('print.brochure')->with('prop',$prop)->render();

    //return $content;

    return PDF::loadView('print.brochure',array('prop'=>$prop))
        ->stream('download.pdf');
});

Route::post('brochure/mail/{id}',function($id){

    $prop = Property::find($id)->toArray();

    //$content = View::make('print.brochure')->with('prop',$prop)->render();

    $brochurepdf =  PDF::loadView('print.brochure',array('prop'=>$prop))->output();

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

Route::get('pr/print/{id}',function($id){

    $trx = Transaction::find($id)->toArray();

    $prop = Property::find($trx['propObjectId'])->toArray();

    $agent = Agent::find($trx['agentId'])->toArray();

    return View::make('print.pr')->with('prop',$prop)->with('trx',$trx)->with('agent',$agent);

    //$content = View::make('print.brochure')->with('prop',$prop)->render();

    //return $content;

    //return PDF::loadView('print.pr',array('prop'=>$prop, 'trx'=>$trx, 'agent'=>$agent))
        //->stream('download.pdf');
});


Route::get('pr/dl/{id}',function($id){

    $trx = Transaction::find($id)->toArray();

    $prop = Property::find($trx['propObjectId'])->toArray();

    $agent = Agent::find($trx['agentId'])->toArray();

    //return View::make('print.brochure')->with('prop',$prop)->render();

    //$content = View::make('print.brochure')->with('prop',$prop)->render();

    //return $content;

    return PDF::loadView('print.pr',array('prop'=>$prop, 'trx'=>$trx, 'agent'=>$agent))
        ->stream('download.pdf');
});

Route::post('pr/mail/{id}',function($id){

    $prop = Property::find($id)->toArray();

    //$content = View::make('print.brochure')->with('prop',$prop)->render();

    $brochurepdf =  PDF::loadView('print.brochure',array('prop'=>$prop))->output();

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


Route::get('pdf',function(){
    $content = "
    <page>
        <h1>Exemple d'utilisation</h1>
        <br>
        Ceci est un <b>exemple d'utilisation</b>
        de <a href='http://html2pdf.fr/'>HTML2PDF</a>.<br>
    </page>";

    $html2pdf = new HTML2PDF();
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf','D');
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

    return View::make('pages.faq')->with('faqs',$faqarray)->with('faqcats',$faqcats);
});

Route::get('glossary',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );

    $faqs = Faq::get()->toArray();

    $faqcats = Faqcat::get()->toArray();

    $faqarray = array();

    foreach($faqs as $f){
        $faqarray[$f['category']][] = $f;
    }

    return View::make('pages.glossary')->with('faqs',$faqarray)->with('faqcats',$faqcats);
});


Route::get('dashboard',function(){
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
});


Route::get('changepass',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    Former::framework('TwitterBootstrap');

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


            Event::fire('log.a',array('create account','createaccount',Input::get('email'),'validation fail'));
            //Event::fire('product.createformadmin',array($obj['_id'],$passwordRandom,$obj['conventionPaymentStatus']));
            return Redirect::to('changepass')->with('notify_success', 'Password Changed');
        }else{
            Session::flash('loginError', 'Failed to change password');
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

Route::get('account/create',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    Former::framework('TwitterBootstrap');

    $agents = Agent::get()->toArray();

    $agent_select = array();
    foreach($agents as $agent){
        $agent_select[$agent['_id']] = $agent['firstname'].' '.$agent['lastname'];
    }

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
            Event::fire('log.a',array('create account','createaccount',Input::get('email'),'validation fail'));
            //Event::fire('product.createformadmin',array($obj['_id'],$passwordRandom,$obj['conventionPaymentStatus']));
            return Redirect::to('account/success');
        }else{
            return Redirect::to($this->backlink)->with('notify_success',ucfirst(Str::singular($controller_name)).' saving failed');
        }




    }


    return View::make('pages.createaccount');
});

Route::get('account/success',function(){
    return View::make('pages.createaccountsuccess');
});

Route::get('login',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    Former::framework('TwitterBootstrap');

    $featured = Property::where('tags','like','%featured%')->get()->toArray();

    return View::make('login')->with('featured',$featured);
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

        return Redirect::to('login')->withErrors($validator);
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

                return Redirect::to('login')
                    ->withErrors($validator)
                    ->withInput(Input::except('password'));
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

    Event::fire('log.a',array('logout','logout',Auth::user()->email,'logout'));
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
