<?php namespace App\Http\Controllers\Com\Content;

use App\Http\Controllers\Controller;
use App\Com\Content\ContentCategory;

class ContentCategoryController extends Controller {

    private $model;

    public function __construct(ContentCategory $model) {
        $this->model = $model;
    }

    function getIndex() {
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }

    function postIndex() {
        if(\Input::has('id')) return ContentCategory::find(\Input::get('id'));
        return ContentCategory::fetch();
    }

    function postAdd() {
        return \CRUD::insert($this->model);
    }

    function postUpdate() {
        return \CRUD::update($this->model, ContentCategory::$rules);
    }

    function postDelete() {
        $num = ContentCategory::del(\Input::get('id', -1));
        return array('status' => 'success', 'message' => trans('administrator/messages.crud.delete.success', array("delNum"=>$num)));
    }

    function postTree() {
        if(\Input::has('ids')){
            // sort tree
            ContentCategory::sort(0, json_decode(\Input::get('ids')));
        }
        return ContentCategory::treeHtml(0);
    }
}
