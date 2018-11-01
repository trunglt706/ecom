<?php namespace App\Http\Controllers\Com\Chat;

use App\Http\Controllers\Controller;

class ChatCustomerController extends Controller {

    private $model;

    public function __construct() {
        if(!\Permission::hasPerm('chat-customer', 'CAN_ACCESS')) abort(404);

    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }
}
