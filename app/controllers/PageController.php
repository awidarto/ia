<?php

class PageController extends BaseController {

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

    public function getIndex()
    {
        $pages = Page::get();
        return View::make('pages.pagelist')->with('pages',$pages);
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

    public function getView($slug = null){

        $page = Page::where('slug','=',$slug)->first();

        if($page){
            $page = $page->toArray();

            $p = json_encode(array(
                'id'=>$page['_id'],
                'title'=>$page['title'],
                'slug'=>$page['slug'],
                'category'=>$page['category'],
                'tags'=>$page['tags']
             ));

        }else{
            $page = null;

            $p = json_encode(array(
                'slug'=>$slug,
                'result'=>'page not exist'
             ));
        }

        $actor = (isset(Auth::user()->email))?Auth::user()->email:'guest';

        Event::fire('log.a',array('page','view',$actor,$p));

        return View::make('pages.pagereader')->with('content',$page);
    }

    public function getPrint($slug = null){

        $page = Page::where('slug','=',$slug)->first();

        if($page){
            $page = $page->toArray();

            $p = json_encode(array(
                'id'=>$page['_id'],
                'title'=>$page['title'],
                'slug'=>$page['slug'],
                'category'=>$page['category'],
                'tags'=>$page['tags']
             ));

        }else{
            $page = null;

            $p = json_encode(array(
                'slug'=>$slug,
                'result'=>'page not exist'
             ));
        }

        $actor = (isset(Auth::user()->email))?Auth::user()->email:'guest';

        Event::fire('log.a',array('page','view',$actor,$p));

        return View::make('pages.pageprint')->with('content',$page);
    }

    public function getPdf($slug = null){

        $page = Page::where('slug','=',$slug)->first();

        if($page){
            $page = $page->toArray();

            $p = json_encode(array(
                'id'=>$page['_id'],
                'title'=>$page['title'],
                'slug'=>$page['slug'],
                'category'=>$page['category'],
                'tags'=>$page['tags']
             ));

        }else{
            $page = null;

            $p = json_encode(array(
                'slug'=>$slug,
                'result'=>'page not exist'
             ));
        }

        $actor = (isset(Auth::user()->email))?Auth::user()->email:'guest';

        Event::fire('log.a',array('page','pdf',$actor,$p));

        //return View::make('pages.pageprint')->with('content',$page);

        return PDF::loadView('pages.pageprint', array('content'=>$page))
                ->setOption('margin-top', '25mm')
                ->setOption('margin-left', '10mm')
                ->setOption('margin-right', '10mm')
                ->setOption('margin-bottom', '57mm')
                ->setOption('header-html', public_path().'/printpart/header.html')
                ->setOption('footer-html', public_path().'/printpart/footer.html')
                ->setOption('dpi',200)
                ->setPaper('A4')
                ->stream($slug.'.pdf');

    }

    public function missingMethod($param = array()){

    }

}