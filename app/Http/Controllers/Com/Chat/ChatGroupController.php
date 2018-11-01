<?php namespace App\Http\Controllers\Com\Chat;

use App\Http\Controllers\Controller;
use App\Com\Chat\ChatGroup;

class ChatGroupController extends Controller {

    private $model;
    private $firebase;

    public function __construct(ChatGroup $model) {
        if(!\Permission::hasPerm('chat-group', 'CAN_ACCESS')) abort(404);
        $this->model = $model;
        if(env('FIREBASE')){
            $generator = new \Firebase\Token\TokenGenerator(env('FIREBASE_SECRETS'));
            $token = $generator->setData([
                        'uid'=> (string) \Auth::user()->id,
                        'perm'=>'admin'
                    ])->create();
            $this->firebase = new \Firebase\FirebaseLib(env('FIREBASE_APP'), $token);
        }else{
            $this->firebase = null;
        }
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }

    public function postIndex(){
        return ChatGroup::fetch();
    }

    public function postAdd(){
        $res =  \CRUD::insert($this->model);
        if($res['status'] == 'success'){
            ChatGroup::update_user_in_group(json_decode(\Input::get('users')), $res['model']->id);
            if(env('FIREBASE')){
                $this->firebase->set('chat/groups/' . md5($res['model']->id), [
                    "group_id"  => intval($res['model']->id),
                    "group_name" => $res['model']->group_name,
                    "note" => $res['model']->note
                ]);
            }
        }
        return $res;
    }

    public function postUpdate(){
        $res =  \CRUD::update($this->model);
        if($res['status'] == 'success'){
            ChatGroup::update_user_in_group(json_decode(\Input::get('users')), \Input::get('id'));
            $input = \Input::all();
            if(env('FIREBASE')){
                $this->firebase->update('chat/groups/' . md5($input['id']), [
                    "group_id"  => intval($input['id']),
                    "group_name" => $input['group_name'],
                    "note" => $input['note']
                ]);
            }
        }
        return $res;
    }

    function postDelete() {
        $res = \CRUD::delete($this->model);
        if($res['status'] == 'success'){
            $ids = json_decode(\Input::get('ids'));
            foreach ($ids as $id) {
                $this->firebase->delete('chat/groups/' . md5($id));
            }
        }
        return $res;
    }

    public function postUser(){
        return ChatGroup::get_user_in_group(\Input::get('id'));
    }
}
