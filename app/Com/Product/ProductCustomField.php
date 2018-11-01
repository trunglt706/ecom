<?php

namespace App\Com\Product;

use Illuminate\Database\Eloquent\Model;
use App\Com\Product\ProductCategory;

class ProductCustomField extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['field_name', 'data_type', 'input_type', 'unit', 'default', 'not_null', 'sort', 'note', 'lang'];
    public static $rules = [
        'field_name'    => 'required',
        'data_type'     => 'required',
        'input_type'    => 'required',
        'unit'          => '',
        'default'       => '',
        'not_null'      => '',
        'sort'          => '',
        'note'          => '',
        'lang'          => 'required'
    ];
    public static function cols() {
        return [
            'field_name'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'data_type'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'input_type'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'note'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'lang'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'group' => [
                    'key' => 'lang',
                    'val' => 'lang_code',
                    'col' => 'title',
                    'tbl' => 'languages'
                ]
            ],
            'sort'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    |
    */
    public static function getFieldControl($category_id, $product_id) {
//        $fields = json_decode(ProductCategory::Where('id', $category_id)->value('product_custom_fields'));
//        if(!is_array($fields)) return '';
//        $fields = self::WhereIn('id', $fields)->get();
        $fields = self::get();
        foreach ($fields as $field) {
            $field->value = self::getValue($field->id, $product_id);
        }
        return view(\Path::viewAdminCom('product.forms.product_custom_field_control'))->with('fields', $fields)->render();
    }

    public static function getValue($field_id, $product_id) {
        return \DB::table('product_custom_field_datas')->where('field_id', $field_id)->where('product_id', $product_id)->value('value');
    }

    public static function saveFields($fields, $product_id) {
        \DB::table('product_custom_field_datas')->where('product_id', $product_id)->delete();
        foreach ($fields as $key => $value) {
            $field_id = explode('field_', $key)[1];
            \DB::table('product_custom_field_datas')->insert([
                'field_id'   => $field_id,
                'product_id' => $product_id,
                'value'      => $value
            ]);
        }
    }
}
