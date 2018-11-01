<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{


    public function pathHandle($lang, $paths = null)
    {
        // menu installed
        if (!class_exists('\App\Com\Menu\Menu')) return view('errors.menunotfound')->with('lang', $lang);
        // $site exists
        $template = \Template::current($lang);
        if (is_null($template)) abort(404);

        $paths = explode("/", $paths);
        foreach ($paths as $path) {
            \_Route::urlencode($path);
        }
        // $page exists
        if ($paths[0] == "") {
            // index page
            $menu = \App\Com\Menu\Menu::Where('lang', $lang)->where('content', 'index')->where('public', 1)->first();
        }
        else {
            $menu = \App\Com\Menu\Menu::Where('lang', $lang)->where('alias', $paths[0])->where('public', 1)->first();
            if (is_null($menu)) abort(404);
            if ($menu->content == 'index') return redirect('/'.$lang);
        }
        if (is_null($menu)) abort(404);
        // check auth
        if(!\Permission::can_access(json_decode($menu->assignment))) abort(404);
        $template_controller = 'App\Http\Controllers\Com\\' . $template->extension_name . '\\' . $template->extension_name . 'Controller';
        switch (\Request::method()) {
            case 'GET':
                unset($paths[0]);
                $menu->template = $template;
                return \App::make($template_controller)->{'get'.ucfirst($menu->content)}($menu, $paths);
                break;
            case 'POST':
                return \App::make($template_controller)->{'post'.ucfirst($paths[1])}();
                break;
        }
        abort(404);
    }
}
