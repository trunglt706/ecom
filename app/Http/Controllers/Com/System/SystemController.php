<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public function __construct() {
        // if(!(\Auth::check() && \Auth::user()->login_backend)) abort(404);
    }

    public function pathHandle($paths = null){
        $method = \Request::method();
        $paths = explode("/", $paths);
        foreach ($paths as $path) {
            \_Route::urlencode($path);
        }
        $auth_ctrl = 'App\Http\Controllers\Com\System\AuthController';
        $route = \_Route::get('admin', $paths[0]);
        switch ($method) {
            case 'GET':
                if($paths[0] == "") return redirect(config('data.ROUTE_PREFIX_ADMIN').'/login');
                if(is_null($route)) return \App::make($auth_ctrl)->{'get'.self::get_name($paths[0])}();
                if(!(\Auth::check() && \Auth::user()->login_backend)) return redirect(config('data.ROUTE_PREFIX_ADMIN').'/login');
                $ctrl = 'App\Http\Controllers\Com\\' . $route->extension_name . '\\' . $route->ctrl;
                if(count($paths) == 1) return \App::make($ctrl)->{'getIndex'}();
                return \App::make($ctrl)->{'get'.self::get_name($paths[1])}();
                break;
            case 'POST':
                if(is_null($route)) return \App::make($auth_ctrl)->{'post'.self::get_name($paths[0])}();
                if(!(\Auth::check() && \Auth::user()->login_backend)) abort(404);
                $ctrl = 'App\Http\Controllers\Com\\' . $route->extension_name . '\\' . $route->ctrl;
                if(count($paths) == 1) return \App::make($ctrl)->{'postIndex'}();
                return \App::make($ctrl)->{'post'.self::get_name($paths[1])}();
                break;
        }
    }

    public function get_name($route){
        $str = '';
        $routes = explode("-", $route);
        foreach ($routes as $route) {
            $str .= ucfirst($route);
        }
        return $str;
    }
}
