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

    $faqarray = array();

    foreach($faqs as $f){
        $faqarray[$f['category']]['content'][] = $f;
    }

    return View::make('pages.faq')->with('faqs',$faqarray);
});

Route::get('register',function(){
    Theme::setCurrentTheme(Prefs::getActiveTheme() );
    Former::framework('TwitterBootstrap');

    $featured = Property::where('tags','like','%featured%')->get()->toArray();

    return View::make('realia/registration')->with('featured',$featured);
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
                Auth::login($user);

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
