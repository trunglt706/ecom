<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class MemberProduct extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['member_id', 'product_id', 'attribs', 'price', 'unit', 'certs', 'created_by'];
    public static $rules = [
        'member_id'     => '',
        'product_id'    => '',
        'attribs'       => '',
        'price'        => '',
        'unit'          => '',
        'certs'         => '',
        'created_by'    => ''
    ];

    public static function cols() {
        return [
            'avatar'   => [
                'filter' => [],
                'align'  => 'center',
            ],
            'product_id_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'=> 'product_id',
                    'tbl' => 'products',
                    'col' => 'product_name'
                ]
            ],
            'category_render'   => [
                'filter' => [],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'=> 'category_id',
                    'tbl' => 'product_categories',
                    'col' => 'category_name'
                ]
            ],
            'member_id_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'=> 'member_id',
                    'tbl' => 'members',
                    'col' => 'member_name'
                ],
                'group' => [
                    'key' => 'member_id',
                    'val' => 'id',
                    'col' => 'member_name',
                    'tbl' => 'members'
                ]
            ],
            'created_by_render'   => [
                'filter' => ['srt'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'=> 'created_by',
                    'tbl' => 'users',
                    'col' => 'fullname'
                ]
            ],
            'views'   => [
                'filter' => [],
                'align'  => 'center'
            ],
            'featured'   => [
                'filter' => [],
                'align'  => 'center'
            ],
            'lang'   => [
                'filter' => [],
                'align'  => 'center'
            ],
            'id'   => [
                'filter' => ['srt'],
                'align'  => 'center'
            ],
        ];
    }

    public static function approveProduct($memberProducts, $member_id) {
        foreach ($memberProducts as $memberProduct) {
            if (isset($memberProduct['products']))
            foreach ($memberProduct['products'] as $product) {
                if ($product['approved_at'] == '' && $product['approved'] == 'true') {
                    self::where('id', $product['member_product_id'])->update([
                        'approved_by' => \Auth::user()->id,
                        'approved_at' => (new \DateTime())->format('Y-m-d')
                    ]);
                }
            }
        }
    }

    public static function fetch() {
        $res = \CRUD::fetch(new self);
        foreach ($res['rows'] as $key=>$r) {
            $media = \DB::table('vproduct')->where('product_id', $r->product_id)->where('data_type', 'AVATAR')->value('media');
            $r->avatar = '<img style="max-width: 50px;" src="'.($media != '' ? config("data.PATH_ROOT").$media : \Path::urlTemplate('ecomtemplate/images/product_bg.jpg')).'">';
            $r->image = !empty($media) ? config("data.PATH_ROOT").$media : '';
            $pro = \App\Com\Product\Product::find($r->product_id);
            if (isset($pro)) {
                $r->product_name = $pro->product_name;
                $r->alias = $pro->alias;
                $r->category_id = $pro->category_id;
                $r->sort = $pro->sort;
                $r->public = $pro->public;
                $r->stocking = $pro->stocking;
                $r->featured = $pro->featured == '1' ? \Language::get('global.var_featured') : \Language::get('global.var_unfeatured');
                $r->new = $pro->new;
                $r->desc = $pro->desc;
                $r->views = $pro->views;
                $r->lang = $pro->lang;
            }
            else {
                $r->product_id_render = $r->product_id;
                $r->category_id = 0;
                $r->lang = 'none';
            }
            $r->category_render = \DB::table('product_categories')->where('id', $r->category_id)->value('category_name');
        }
        return $res;
    }
}
