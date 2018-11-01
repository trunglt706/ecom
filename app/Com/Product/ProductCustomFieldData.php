<?php

namespace App\Com\Product;

use Illuminate\Database\Eloquent\Model;

class ProductCustomFieldData extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['field_id', 'product_id', 'value'];
    public static $rules = [
        'field_id'      => '',
        'product_id'    => '',
        'value'         => ''
    ];
}
