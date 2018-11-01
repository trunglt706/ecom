<?php

namespace App\Http\Controllers\Com\Content;

use App\Http\Controllers\Controller;
use App\Com\Content\ContentSubcribe;

class ContentSubcribeController extends Controller {

    private $model;

    public function __construct(ContentSubcribe $model) {
        $this->model = $model;
    }

    function getIndex() {
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }

    function postIndex() {
        return ContentSubcribe::fetch();
    }

    function postAdd() {
        \Input::merge( ['lang' => \App::getLocale() ]);
        return \CRUD::insert($this->model);
    }

    function postUpdate() {
        return \CRUD::update($this->model, ContentSubcribe::$rules);
    }

    function postDelete() {
        return \CRUD::delete($this->model);
    }
}
