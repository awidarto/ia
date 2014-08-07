<?php

class Prefs {

    public static $category;

    public function __construct()
    {

    }

    public static function getChildPage($parent){
        return Page::where('menu',$parent)
            ->where('status','inactive')
            ->orderBy('menuSeq','asc')->get();
    }

    public static function getCategory(){
        $c = Category::get();
        self::$category = $c;
        return new self;
    }

    public function catToSelection($value, $label, $all = true)
    {
        if($all){
            $ret = array(''=>'All');
        }else{
            $ret = array();
        }

        foreach (self::$category as $c) {
            $ret[$c->{$value}] = $c->{$label};
        }


        return $ret;
    }

    public function catToArray()
    {
        return self::$category;
    }

    public static function themeAssetsUrl()
    {
        return URL::to('/').'/'.Theme::getCurrentTheme();
    }

    public static function themeAssetsPath()
    {
        return 'themes/'.Theme::getCurrentTheme().'/assets/';
    }

    public static function getActiveTheme()
    {
        return Config::get('kickstart.default_theme');
    }

    public static function roi($p,$pct = true){
        $roi = ((12*$p['monthlyRental']) - $p['tax'] - $p['insurance'] - ( (12*$p['monthlyRental']) / 10 )) / $p['listingPrice'];
        if($pct){
            return $roi*100;
        }else{
            return $roi;
        }
    }

}
