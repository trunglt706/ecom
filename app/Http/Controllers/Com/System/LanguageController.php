<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    private $model;

    public function __construct(\Language $model) {
        $this->model = $model;
    }
    
    public function getIndex(){
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }
    
    function postIndex() {
        return \Language::fetch();
    }
    
    function postAdd() {
        \Input::merge(['alias'=>\_Route::urlencode(\Input::get('alias', ''))]);
        if(\Input::get('default', '') == '1') \DB::table('languages')->update(['default'=>0]);
        return \CRUD::insert($this->model);
    }

    function postUpdate() {
        \Input::merge(['alias'=>\_Route::urlencode(\Input::get('alias', ''))]);
        if(\Input::get('default', '') == '1') \DB::table('languages')->update(['default'=>0]);
        $rules = \Language::$rules;
        $rules['alias'] .= ','.\Input::get('id');
        return \CRUD::update($this->model, $rules);
    }

    function postDelete() {
        return \CRUD::delete($this->model);
    }
    
    function postTemplates() {
        return \DB::table('templates')
                ->join('extensions', 'templates.extension_id', '=', 'extensions.id')
                ->select('templates.id', 'extensions.name as text')
                ->get();
    }
}
