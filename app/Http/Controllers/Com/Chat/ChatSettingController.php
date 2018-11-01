<?php namespace App\Http\Controllers\Com\Chat;

use App\Http\Controllers\Controller;

class ChatSettingController extends Controller {

    private $model;

    public function __construct() {
        if(!\Permission::hasPerm('chat-setting', 'CAN_ACCESS')) abort(404);
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }

    function postUpdate() {
        return \Permission::is_allowed('chat', 'CAN_UPDATE', function(){
            \System::where('code', 'chat')->update(['attribs'=>\Input::get('chat')]);
            return ['status'=>'success', 'message'=> \Language::get('global.message_crud_update_success')];
        });
    }
}
