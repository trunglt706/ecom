<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function __construct() {
        if(!\Permission::hasPerm('configs', 'CAN_ACCESS')) abort(404);
    }

    public static function getIndex(){
        return view(\Path::viewAdmin('layouts.page'));
    }

    public static function postUpdate(){
        return \Permission::is_allowed('configs', 'CAN_UPDATE', function(){
            \System::where('code', 'system')->update(['attribs'=>\Input::get('system')]);
            \System::where('code', 'mail')->update(['attribs'=>\Input::get('mail')]);
            \System::where('code', 'en')->update(['attribs'=>json_encode(\Input::get('en'))]);
            \System::where('code', 'vi')->update(['attribs'=>json_encode(\Input::get('vi'))]);
            return ['status'=>'success', 'message'=> \Language::get('global.message_crud_update_success')];
        });
    }
}
