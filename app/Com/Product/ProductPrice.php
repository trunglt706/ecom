<?php

namespace App\Com\Product;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model {

    public static function fetch($product_id = null){
        if(is_null($product_id)) return [];
        return self::select('price', 'note')->where('product_id', $product_id)->get();
    }
    
    public static function savePrice($prices, $product_id){
        self::Where('product_id', $product_id)->delete();
        foreach ($prices as $price) {
            self::insert([
                'product_id' => $product_id,
                'price'      => $price['price'],
                'note'       => $price['note']
            ]);
        }
    }
}
