<?php

namespace App\Http\Controllers\Com\Product;

use App\Http\Controllers\Controller;
use App\Com\Product\ProductCustomField;

class ProductCustomFieldController extends Controller
{
    private $model;

    public function __construct(ProductCustomField $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }
    
    function postIndex() {
        return \CRUD::fetch($this->model);
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
}
