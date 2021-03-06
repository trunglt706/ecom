<?php

namespace App\Http\Controllers\Com\Product;

use App\Http\Controllers\Controller;
use App\Com\Product\ProductCategory;
use App\Com\Product\ProductCustomField;

class ProductCategoryController extends Controller
{
    private $model;

    public function __construct(ProductCategory $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }

    function postIndex() {
        if(\Input::has('id')) return ProductCategory::find(\Input::get('id'));
        return ProductCategory::fetch();
    }

    function postAdd() {
        return \CRUD::insert($this->model);
    }

    function postUpdate() {
        return \CRUD::update($this->model);
    }

    function postDelete() {
        $num = ProductCategory::del(\Input::get('id', -1));
        return ['status'=>'success', 'message' => \Language::get('global.message_crud_delete_success', ["delNum"=>$num])];
    }

    function postTree(){
        if(\Input::has('ids')){
            // sort tree
            ProductCategory::sort(0, json_decode(\Input::get('ids')));
        }
        return ProductCategory::treeHtml(0);
    }
    
    function postProductCustomFields(){
        return ProductCustomField::select('id', 'field_name as text')->orderBy('sort', 'asc')->get();
    }
}
