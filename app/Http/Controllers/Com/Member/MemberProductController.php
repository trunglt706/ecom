<?php

namespace App\Http\Controllers\Com\Member;

use App\Http\Controllers\Controller;
use App\Com\Member\Member;
use App\Com\Member\MemberMediaCategory;
use App\Com\Member\MemberMedia;
use App\Com\Member\MemberLevelApprove;
use App\Com\Member\MemberProduct;
use App\Com\Product\Product;
use App\Com\Product\ProductMedia;
use App\Com\Product\ProductCategory;
use App\Com\Product\ProductPrice;
use App\Com\Product\ProductMediaCategory;
use App\Com\Product\ProductCustomField;

class MemberProductController extends Controller
{
    private $model;

    public function __construct(MemberProduct $model) {
        $this->model = $model;
    }

    public function getIndex() {
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }

    public function postIndex() {
        return MemberProduct::fetch();
    }

    public function postAdd() {
        $input = \Input::all();
        $input['created_by'] = \Auth::user()->id;
        $alias = \Input::has('alias') ? \Input::get('alias') : \Input::get('product_name');
        $input['alias'] = \_Route::urlencode($alias);
        $res = \CRUD::insert(new Product, $input);
        if($res['status'] == 'success') {
            ProductCustomField::saveFields($input['productInfo'], $res['model']->id);
            if (\Input::has('productPrices'))
                ProductPrice::savePrice($input['productPrices'], $res['model']->id);
            ProductMedia::saveMedia($input['productMedias'], $res['model']->id);
            $input['product_id'] = $res['model']->id;
            $res2 = \CRUD::insert(new MemberProduct, $input);
        }
        return $res2;
    }

    public function postUpdate() {
        $input = \Input::all();
//        if (\Input::has('productInfo'))
//            ProductCustomField::saveFields($input['productInfo'], $input['product_id']);
//        if (\Input::has('productPrices'))
//            ProductPrice::savePrice($input['productPrices'], $input['product_id']);
//        ProductMedia::saveMedia($input['productMedias'], $input['product_id']);

        $alias = \Input::has('alias') ? \Input::get('alias') : \Input::get('product_name');
        $input['alias'] = \_Route::urlencode($alias);
        $rules = Product::$rules;
        $rules['alias'] .=','.\Input::get('product_id');
        $input['id'] = \Input::get('product_id');
        if (!empty($input['image'])) { 
            \DB::table('vproduct')->where('product_id', $input['id'])->where('data_type', 'AVATAR')->update(array('media' => $input['image']));
        }
        unset($input['views']);
        $res = \CRUD::update(new Product, $rules, $input);
        if ($res['status'] == 'success'){
            $res2 = \CRUD::update($this->model);
        }
        return $res2;
    }

    public function postDelete() {
        $product_id = json_decode(\Input::get('ids'));
        foreach ($product_id as $id) {
            $pid = \DB::table('member_products')->where('id', $id)->value('product_id');
            \DB::table('product_custom_field_datas')->where('product_id', $pid)->delete();
            \DB::table('product_medias')->where('product_id', $pid)->delete();
            \DB::table('products')->where('id', $pid)->delete();
        }
        return \CRUD::delete($this->model);
    }

    // key key
    public static function acceptSecretKey($key) {
        $str = \Auth::user()->id.config('app.key');
        return \Hash::check($str, $key);
    }

    public function postMember() {
//	$member_tin = \DB::table('member_users')->where('user_id', \Auth::user()->id)->first()->member_tin;
//        $res = \DB::table('members')->select('id', 'member_name AS text')->where('member_tin', $member_tin)->where('lang', 'en')->get();
        $res = \DB::table('members')->select('id', 'member_name AS text')->get();
        return $res;
    }

    public function postCategory() {
        $res = \DB::table('product_categories')->select('id', 'category_name AS text')->get();
        return $res;
    }

    public function postCategories() {
        return ProductCategory::fetch();
    }

    public function postProduct() {
        if (\Input::has('category')) {
            $res = \DB::table('products')->select('id', 'product_name AS text')->where('category_id', \Input::get('category'))->get();
        } else {
            $res = \DB::table('products')->select('id', 'product_name AS text')->get();
        }
        return $res;
    }

    public function postProductInfo() {
        return ProductCustomField::getFieldControl(\Input::get('category_id'), \Input::get('product_id'));
    }

    public function postProductPrice() {
        return ProductPrice::fetch(\Input::get('product_id'));
    }

    public function postProductMedia() {
        $res = ProductMediaCategory::fetch();
        foreach ($res as $cat) {
            $cat->medias = \Input::has('product_id') ? ProductMedia::fetch(\Input::get('product_id'), $cat->id) : [];
        }
        return $res;
    }
}
