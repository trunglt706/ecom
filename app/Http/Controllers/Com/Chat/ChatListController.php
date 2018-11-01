<?php namespace App\Http\Controllers\Com\Chat;

use App\Http\Controllers\Controller;

class ChatListController extends Controller {

        private $model;

        public function __construct() {
            if(!\Permission::hasPerm('chat-list', 'CAN_ACCESS')) abort(404);

        }

        public function getIndex(){
            return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
        }
}
