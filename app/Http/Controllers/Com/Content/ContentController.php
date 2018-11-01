<?php

namespace App\Http\Controllers\Com\Content;

use App\Http\Controllers\Controller;
use App\Com\Content\Content;
use App\Com\Content\ContentCategory;
use App\Com\Content\ContentSubcribe;
use App\Com\System\Route;

class ContentController extends Controller {

    private $model;

    public function __construct(Content $model) {
        $this->model = $model;
    }

    function getIndex() {
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }

    function postIndex() {
        return Content::fetch();
    }

    function postAdd() {
        \Input::merge(["user_id" => \Auth::user()->id]);
        $alias = \Input::has('alias') ? \Input::get('alias') : \Input::get('title');
        \Input::merge(["alias" => Route::urlencode($alias, $this->model)]);
        $res = \CRUD::insert($this->model);
        if ($res['status'] == 'success')
            ContentSubcribe::sendToUserSubcribe ($res['model']);
        return $res;
    }

    function postUpdate() {
        $alias = \Input::has('alias') ? \Input::get('alias') : \Input::get('title');
        \Input::merge(["alias" => Route::urlencode($alias, $this->model)]);
        $rules = Content::$rules;
        $rules['alias'] .=',alias,'.\Input::get('id');
        $res = \CRUD::update($this->model, $rules);
//        if ($res['status'] == 'success')
//            ContentSubcribe::sendToUserSubcribe ($res['model']);
        return $res;
    }

    function postDelete() {
        return \CRUD::delete($this->model);
    }

    function postCategories() {
        return ContentCategory::fetch();
    }

}
