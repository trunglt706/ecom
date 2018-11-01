<?php

namespace App\Http\Controllers\Com\Product;

use App\Http\Controllers\Controller;

use App\Com\Member\Member;
use App\Com\Member\MemberProduct;

use App\Com\Menu\Menu;

use App\Com\Product\Product;
use App\Com\Product\ProductCategory;
use App\Com\Product\ProductCustomField;
use App\Com\Product\ProductMediaCategory;
use App\Com\Product\ProductMedia;
use App\Com\Product\ProductPrice;

class ProductController extends Controller
{
    private $model;

    public function __construct(Product $model) {
        $this->model = $model;
    }

    public function getIndex() {
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }

    public function postIndex() {
        return \CRUD::fetch($this->model);
    }

    public function postAdd() {
        $alias = \Input::has('alias') ? \Input::get('alias') : \Input::get('product_name');
        \Input::merge(["alias"=>\_Route::urlencode($alias)]);
        $res = \CRUD::insert($this->model);
        if($res['status'] == 'success') {
            $input = \Input::all();
            ProductCustomField::saveFields($input['productInfo'], $res['model']->id);
            if (\Input::has('productPrices'))
                ProductPrice::savePrice($input['productPrices'], $res['model']->id);
            ProductMedia::saveMedia($input['productMedias'], $res['model']->id);
        }
        return $res;
    }

    public function postUpdate() {
        $input = \Input::all();
        ProductCustomField::saveFields($input['productInfo'], $input['id']);
        if (\Input::has('productPrices'))
            ProductPrice::savePrice($input['productPrices'], $input['id']);
        ProductMedia::saveMedia($input['productMedias'], $input['id']);
        $alias = \Input::has('alias') ? \Input::get('alias') : \Input::get('product_name');
        \Input::merge(["alias"=>\_Route::urlencode($alias)]);
        $rules = Product::$rules;
        $rules['alias'] .=','.\Input::get('id');
        return \CRUD::update($this->model, $rules);
    }

    public function postDelete() {
        return \CRUD::delete($this->model);
    }

    public function postCategories() {
        return ProductCategory::fetch();
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

    public static function postImport() {

    }

    public static function postExport() {

    }

    public function product_option($page, $block) {
        $res = [];
        $res['block'] = $block;
        $res['page'] = $page;
        $menus = self::MenuAll($page);
        $res['product_category'] = ProductCategory::where('category_name', '<>', 'Other products')->orderByRaw("RAND()")->take(4)->get();
        foreach ($res['product_category'] as $cat) {
            $menu_category = Menu::where('lang', $page->lang)->where('content', 'product_category')->where('attribs', '{"category_id":"' . $cat->id . '"}')->where('public', 1)->first();
            $menu_featured = Menu::where('lang', $page->lang)->where('content', 'featured')->where('public', 1)->value('alias');
            $cat->url = isset($menu_category->alias) ? \Path::url($page->lang . '/' . $menu_category->alias) . ($menu_featured != '' ? '/' . $menu_featured : '') : '';
        }
        $products = \DB::table('vmember_products')->where('lang', $page->lang)->where('featured', 1)->where('public', 1)->where('member_level', '>', 0)->orderByRaw("RAND()")->orderBy('member_level', 'desc');
        if ($products->count() < 4) {
            $products = \DB::table('vmember_products')->where('lang', $page->lang)->where('public', 1)->where('member_level', '>', 0)->orderByRaw("RAND()")->orderBy('featured', 'desc')->orderBy('member_level', 'desc');
        }
        $res['count'] = $products->count();
        $products = $products->take(json_decode($block->attribs)->limit)->get();
        foreach ($products as $product) {
            $product_media = \DB::table('vproduct')->where('data_type', 'AVATAR')->where('product_id', $product->product_id)->value('media');
            $product->media = $product_media != '' ? config("data.PATH_ROOT").$product_media : \Path::urlCurrentTemplate($page->lang, 'images/product_bg.jpg');
            $product->url = $menus->product . '/' . $product->alias;
            $product->member_url = isset($menus->member) ? $menus->member . '/' . $product->member_alias : '';
            $product->info = \DB::table('vproduct_fields')->where('product_id', $product->product_id)->where('lang', $page->lang)->get();
        }
        $res['products'] = $products;
        return $res;
    }

    public function product_category($page, $block) {
        $res = [];
        $res['block'] = $block;
        $res['page'] = $page;
        $menus = self::MenuAll($page);
        $product_category_id = json_decode($block->attribs)->category_id;
        $menu_category = Menu::where('lang', $page->lang)->where('content', 'product_category')->where('attribs', '{"category_id":"' . $product_category_id . '"}')->where('public', 1)->first();
        $res['menu_category_alias'] = isset($menu_category->alias) ? \Path::url($page->lang . '/' . $menu_category->alias) : '';
        $product_category = ProductCategory::find($product_category_id);
        $res['category_name'] = isset($product_category->category_name) ? $product_category->category_name : '';
        $product_featured = \DB::table('vmember_products')->where('lang', $page->lang)->where('member_level', 1)->where('category_id', $product_category_id)->where('public', 1)->where('member_level', '>', 0)->where('featured', 1)->orderByRaw("RAND()")->first();
        if (isset($product_featured->id)) {
            $product_featured->url = $menus->product . '/' . $product_featured->alias;
            $product_media_featured = \DB::table('vproduct')->where('data_type', 'AVATAR')->where('product_id', $product_featured->product_id)->value('media');
            $product_featured->media = $product_media_featured != '' ? config("data.PATH_ROOT").$product_media_featured : \Path::urlCurrentTemplate($page->lang, 'images/product_bg.jpg');
            $limit = json_decode($block->attribs)->limit - 1;
        }
        else $limit = json_decode($block->attribs)->limit + 1;
        $res['product_featured'] = $product_featured;
        $products = \DB::table('vmember_products')->where('lang', $page->lang)->where('category_id', $product_category_id)->where('public', 1)->where('member_level', '>', 0);
        $res['count'] = $products->count();
        $products = $products->where('featured', 0)->orderByRaw("RAND()")->orderBy('member_level', 'desc')->take($limit)->get();
        foreach($products as $product) {
            $product_media = \DB::table('vproduct')->where('data_type', 'AVATAR')->where('product_id', $product->product_id)->value('media');
            $product->media = $product_media != '' ? config("data.PATH_ROOT").$product_media : \Path::urlCurrentTemplate($page->lang, 'images/product_bg.jpg');
            $product->url = $menus->product . '/' . $product->alias;
            $product->member_url = isset($menus->member) ? $menus->member . '/' . $product->member_alias : '';
            $product->info = \DB::table('vproduct_fields')->where('product_id', $product->product_id)->where('lang', $page->lang)->get();
    //            $product_custom_fields_id = json_decode(\DB::table('product_categories')->where('id', $product->category_id)->value('product_custom_fields'));
    //            $product_custom_fields = \DB::table('product_custom_fields')->whereIn('id', $product_custom_fields_id)->get();
            // $res['products'][] = $product;
        }
        $res['products'] = $products;
        return $res;
    }

    public function MenuAll($page) {
        $menu_member = Menu::where('lang', $page->lang)->where('content', 'member')->where('public', 1)->first();
        $menu_product = Menu::where('lang', $page->lang)->where('content', 'product')->where('public', 1)->first();
        $menus = (object)[];
        $menus->member = isset($menu_member->alias) ? \Path::url($page->lang . '/' . $menu_member->alias) : '';
        $menus->member_name = isset($menu_member->menu_name) ? strip_tags($menu_member->menu_name) : '';
        $menus->product = isset($menu_product->alias) ? \Path::url($page->lang . '/' . $menu_product->alias) : '';
        $menus->product_name = isset($menu_product->menu_name) ? strip_tags($menu_product->menu_name) : '';
        return $menus;
    }
}
