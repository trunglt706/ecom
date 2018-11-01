<?php

namespace App\Http\Controllers\Com\Member;

use App\Http\Controllers\Controller;
use App\Com\Member\MemberCategory;

class MemberCategoryController extends Controller
{
    private $model;

    public function __construct(MemberCategory $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }

    function postIndex() {
        if(\Input::has('id')) return MemberCategory::find(\Input::get('id'));
        return MemberCategory::fetch();
    }

    function postAdd() {
        return \CRUD::insert($this->model);
    }

    function postUpdate() {
        return \CRUD::update($this->model);
    }

    function postDelete() {
        $num = MemberCategory::del(\Input::get('id', -1));
        return ['status'=>'success', 'message' => \Language::get('global.message_crud_delete_success', ["delNum"=>$num])];
    }

    function postTree(){
        if(\Input::has('ids')){
            // sort tree
            MemberCategory::sort(0, json_decode(\Input::get('ids')));
        }
        return MemberCategory::treeHtml(0);
    }
}
