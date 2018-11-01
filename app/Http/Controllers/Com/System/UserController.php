<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $model;

    public function __construct(\User $model) {
        $this->model = $model;
    }
    
    public function getIndex() {
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }
    
    function postIndex() {
        return \User::fetch();
    }

    function postAdd() {
        if (\Input::has('password') && \Input::get('password') != '' && !is_null(\Input::get('password')))
            \Input::merge(array('password' => \Hash::make(\Input::get('password'))));
        return \CRUD::insert($this->model);
    }

    function postUpdate() {
        if (\Input::has('password') && \Input::get('password') != '' && !is_null(\Input::get('password')))
            \Input::merge(array('password' => \Hash::make(\Input::get('password'))));
        $rules = \User::$rules;
        $rules['username'] .= ','.\Input::get('id');
        return \CRUD::update($this->model, $rules);
    }

    function postDelete() {
        $ids = json_decode(\Input::get('ids'));
        foreach ($ids as $key=>$id) {
            if(\App\Com\System\User::where('id', $id)->value('protected') == 1 || \Auth::user()->id == $id) unset($ids[$key]);
        }
        return \CRUD::delete($this->model, $ids);
    }

    function postUsergroups() {
        return \UserGroup::select('id', 'group_name as text')->get();
    }
}
