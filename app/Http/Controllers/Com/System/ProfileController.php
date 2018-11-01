<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    private $model;

    public function __construct(\User $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }

    public function postIndex() {
        $input = \Input::all();
        $input['id'] = \Auth::user()->id;
        $rules = [
            'fullname'      => 'required',
            'email'         => 'required',
            'password'      => 'required'
        ];
        if(\Input::get('password') == ''){
            unset($input['password']);
            $rules['password'] = '';
        }else {
            $input['password'] = \Hash::make(\Input::get('password'));
        }
        return \CRUD::update($this->model, $rules, $input);
    }
}
