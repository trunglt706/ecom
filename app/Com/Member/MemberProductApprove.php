<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class MemberProductApprove extends Model {
    
    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['member_product_id', 'member_product_request_id', 'approved', 'approved_by', 'note'];
    public static $rules = [
        'member_product_id'         => '',
        'member_product_request_id' => '',
        'approved'                  => '',
        'approved_by'               => '',
        'note'                      => ''
    ];
    public static function cols() {
        return [
            'member_product_id_render'   => [
                'filter' => ['srt'],
                'align'  => 'left',
            ],
            'member_product_request_id_render'   => [
                'filter' => ['srt'],
                'align'  => 'left',
            ],
            'approved'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'approved_by_render'   => [
                'filter' => ['srt'],
                'align'  => 'left',
            ],
            'note'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ]
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
}
