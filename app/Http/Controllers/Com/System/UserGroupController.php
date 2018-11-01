<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class UserGroupController extends Controller
{
    private $model;

    public function __construct(\UserGroup $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }

    function postIndex() {
        $res = \CRUD::fetch($this->model);
        $rows = [];
        foreach ($res['rows'] as $row) {
            if(!($row->anonymous == 1 && \Auth::user()->user_group_id != $row->id)) {
                array_push($rows, $row);
            }
        }
        $res['rows'] = $rows;
        return $res;
    }

    function postAdd() {
        $res = \CRUD::insert($this->model);
        $perm = json_decode(\Input::get('permission'));
        \Permission::updatePerm($res['model']->id, $perm->data);
        \FileSystem::createFolderNameOfUserGroup($res['model']->id);
        return $res;
    }

    function postUpdate() {
        $perm = json_decode(\Input::get('permission'));
        \Permission::updatePerm(\Input::get('id'), $perm->data);
        \FileSystem::createFolderNameOfUserGroup(\Input::get('id'));
        return \CRUD::update($this->model);
    }

    function postDelete() {
        $ids = json_decode(\Input::get('ids'));
        foreach ($ids as $key=>$id) {
            if(\App\Com\System\UserGroup::where('id', $id)->value('protected') == 1 || \Auth::user()->user_group_id == $id) unset($ids[$key]);
        }
        \Permission::deleteGroup( $ids );
        \FileSystem::removeFolderNameOfUserGroup($ids);
        return \CRUD::delete($this->model, $ids);
    }

    function postPermission() {
        return \Permission::get( \Input::get('id', null) );
    }
}
