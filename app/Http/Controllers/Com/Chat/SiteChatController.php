<?php namespace App\Http\Controllers\Com\Chat;

use App\Http\Controllers\Controller;
use App\Com\Chat\ChatGroup;

class SiteChatController extends Controller {

    public function postDialogToggle(){
        $chat = \Cookie::get('chat');
        $chat['dialog'] = \Input::get('dialog');
        return response()->json([])->withCookie(cookie('chat', $chat));
    }

    public function postJoinChatRoom(){
        $chat = \Cookie::get('chat');
        $chat['room'] = \Input::get('room');
        return response()->json([])->withCookie(cookie('chat', $chat));
    }
}
