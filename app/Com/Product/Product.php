<?php

namespace App\Com\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['product_name', 'alias', 'desc', 'category_id', 'public', 'stocking', 'featured', 'new', 'sort', 'views', 'lang'];
    public static $rules = [
        'product_name'  => 'required',
        'alias'         => 'required|unique:products,alias',
        'desc'          => '',
        'category_id'   => 'required',
        'public'        => '',
        'stocking'      => '',
        'featured'      => '',
        'new'           => '',
        'sort'          => '',
        'views'         => '',
        'lang'          => ''
    ];
    public static function cols() {
        return [
            'product_name'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'alias'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'lang'   => [
                'filter' => ['srt'],
                'align'  => 'left',
                'group' => [
                    'key' => 'lang',
                    'val' => 'lang_code',
                    'col' => 'title',
                    'tbl' => 'languages'
                ]
            ],
            'views'   => [
                'filter' => ['srt'],
                'align'  => 'center',
            ],
            'id'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
            ]
        ];
    }

    public static function getDetails($id) {
        $product = self::find($id);
        if (isset($product)) {
            $product->prices = ProductPrice::where('product_id', $product->id)->orderBy('created_at', 'desc')->get();
            $field = json_decode(ProductCategory::find($product->category_id)->product_custom_fields);
            $custom_fields = [];
            for ($i = 0; $i < count($field); $i++) {
                $custom_fields[$i] = ProductCustomField::find($field[$i]);
                $data = ProductCustomFieldData::where('product_id', $product->id)->where('field_id', $field[$i])->first();
                $custom_fields[$i]['data'] = isset($data) ? $data : '';
//                $custom_fields = [];
//                $product->custom_fields->$i = ProductCustomField::find($field[$i]);
//                $data = ProductCustomFieldData::where('product_id', $product->id)->where('field_id', $field[$i])->first();
//                $product->custom_fields->$i->data = isset($data) ? $data : '';
            }
            $product->custom_fields = $custom_fields;
        }
        return isset($product) ? $product : '';
    }
}
