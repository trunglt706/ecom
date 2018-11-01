<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    private $model;

    public function __construct(\Block $model) {
        $this->model = $model;
    }
    
    public function getIndex(){
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }
    
    function postIndex() {
        return \Block::fetch();
    }
    
    function postAdd() {
        return \CRUD::insert($this->model);
    }

    function postUpdate() {
        return \CRUD::update($this->model);
    }

    function postDelete() {
        return \CRUD::delete($this->model);
    }
    
    function postConfig(){
        $input = \Input::all();
        if(isset($input['module_id'])){
            $module = \Module::fetch($input['module_id']);
            return [
                    'status'=>'success',
                    'data' => view(\Path::viewAdminCom(strtolower($module->extension_name).'.blocks.'.$module->name))->with('module', $module)->with('block', \Block::find( \Input::get('block_id', 0) ))->render()
                ];
        }
        abort(404);
    }
    
    function postMenus(){
        if(class_exists('\App\Com\Menu\Menu'))
            return \App\Com\Menu\Menu::fetch();
        return [];
    }
}
