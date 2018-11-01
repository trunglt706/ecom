<?php

namespace App\Http\Controllers\Com\Member;

use App\Http\Controllers\Controller;
use App\Com\Member\Member;
use App\Com\Member\MemberMediaCategory;
use App\Com\Member\MemberMedia;
use App\Com\Member\MemberUser;
use App\Com\System\User;

class MemberUserController extends Controller
{
    private $model;

    public function __construct(MemberUser $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }
    
    public function postIndex(){
        return \CRUD::fetch($this->model);
    }
    
    public function postAdd(){
        $input = \Input::all();
        $input['user']['password'] = \Hash::make($input['user']['password']);
        $input['ic_certified_at'] = date('Y-m-d', strtotime($input['ic_certified_at']));
        $res = \CRUD::insert(new \User, $input['user']);
        if($res['status'] == 'success') {
            $input['user_id'] = $res['model']->id;
            return \CRUD::insert($this->model, $input);
        }
        return $res;
    }

    public function postUpdate(){
        $input = \Input::all();
        $rules = \User::$rules;
        $rules['username'] .= ','.\Input::get('user')['id'];
        $rules['password'] = '';
        $input['ic_certified_at'] = date('Y-m-d', strtotime($input['ic_certified_at']));
        $res = \CRUD::update(new \User, $rules, $input['user']);
        if($res['status'] == 'success') {
            return \CRUD::update($this->model);
        }
        return $res;
        
    }
        
    public function postDelete(){
        $user_id = json_decode(\Input::get('ids'));
        foreach ($user_id as $id){
            $usr_id = MemberUser::find($id)->user_id;
            \DB::table('users')->where('id', '=', $usr_id)->delete();
        }
        return \CRUD::delete($this->model);
    }
    
    public function postUsergroups(){
        return \UserGroup::select('id', 'group_name as text')->get();
    }
    
    public function postMembers(){
        return \DB::table('members')->select('id', 'member_name AS text')->get();
    }
    
    public function postUser(){
        return \User::find(\Input::get('user_id'));
    }
}
