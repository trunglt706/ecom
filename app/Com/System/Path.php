<?php

namespace App\Com\System;

class Path {

    /*
    |--------------------------------------------------------------------------
    | Get path
    |--------------------------------------------------------------------------
    |
    */
    public static function url($path){
        return url($path);
    }
    public static function urlCom($path){
        return self::url('com/'.$path);
    }
    public static function urlTemplate($path){
        return self::url('templates/'.$path);
    }
    public static function urlCurrentTemplate($lang, $path){
        $template = \Template::current($lang);
        if(is_null($template)) \App::abort(404);
        return self::url('templates/'.  strtolower($template->extension_name).'/'.$path);
    }
    
    // path site
    public static function urlSite($path){
        return url(config('data.ROUTE_PREFIX_SITE').'/'.$path);
    }
    
    // views
    public static function viewAdmin($path){
        return 'admin.'.$path;
    }
    public static function viewAdminCom($path){
        return 'admin.com.'.$path;
    }
    public static function viewCom($path){
        return 'com.'.$path;
    }
    public static function viewTemplate($path){
        return 'templates.'.$path;
    }
    public static function viewCurrentTemplate($lang, $path){
        $template = \Template::current($lang);
        if(is_null($template)) \App::abort(404);
        return 'templates.'.  strtolower($template->extension_name).'.'.$path;
    }
}
