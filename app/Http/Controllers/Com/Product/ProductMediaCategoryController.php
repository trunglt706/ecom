<?php

namespace App\Http\Controllers\Com\Product;

use App\Http\Controllers\Controller;
use App\Com\Product\ProductMediaCategory;

class ProductMediaCategoryController extends Controller
{
    private $model;

    public function __construct(ProductMediaCategory $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }

    function postIndex() {
        if(\Input::has('id')) return ProductMediaCategory::find(\Input::get('id'));
        return ProductMediaCategory::fetch();
    }

    function postAdd() {
        return \CRUD::insert($this->model);
    }

    function postUpdate() {
        return \CRUD::update($this->model);
    }

    function postDelete() {
        $num = ProductMediaCategory::del(\Input::get('id', -1));
        return ['status'=>'success', 'message' => \Language::get('global.message_crud_delete_success', ["delNum"=>$num])];
    }
    
    function postTree(){
        if(\Input::has('ids')){
            // sort tree
            ProductMediaCategory::sort(0, json_decode(\Input::get('ids')));
        }
        return ProductMediaCategory::treeHtml(0);
    }
}
