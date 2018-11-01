<?php

namespace App\Com\Product;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model {
    
    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['title', 'caption', 'content', 'sort', 'media_category_id', 'product_id'];
    protected $table = 'product_medias';
    public static $rules = [
        'title'          => '',
        'caption'        => '',
        'content'        => 'required',
        'sort'           => '',
        'media_category_id' => 'required',
        'product_id'     => 'required'
    ];
    
    public static function fetch($product_id = null, $media_category_id = null) {
        $res = \DB::table('product_medias');
        if(!is_null($product_id)) $res->Where('product_id', $product_id);
        if(!is_null($media_category_id)) $res->Where('media_category_id', $media_category_id);
        return $res->select('caption', 'content', 'sort')->orderBy('sort', 'asc')->get();
    }
    
    public static function saveMedia($productMedias, $product_id) {
        \DB::table('product_medias')->Where('product_id', $product_id)->delete();
        foreach ($productMedias as $productMedia) {
            if (isset($productMedia['medias']))
            foreach ($productMedia['medias'] as $media) {
                \DB::table('product_medias')->insert([
                    'product_id'        => $product_id,
                    'media_category_id' => $productMedia['id'],
                    'title'             => '',
                    'caption'           => $media['caption'],
                    'content'           => $media['content'],
                    'sort'              => $media['sort']
                ]);
            }
        }
    }
}
