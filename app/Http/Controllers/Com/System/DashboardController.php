<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public static function getIndex(){
        return view(\Path::viewAdmin('layouts.page'));
    }

    public static function postBlock(){
        return view(\Path::viewAdminCom(\Input::get('block')));
    }

    public static function postUpdate(){
        \DB::table('users')->where('id', \Auth::user()->id)->update([
            'attribs' => \Input::get('attribs')
        ]);
        return ['status'=>'success', 'message'=> \Language::get('global.message_crud_update_success')];
    }
}
