<?php

namespace App\Com\Slider;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['title', 'note','content'];
    public static $rules = [
        'title'     => 'required',
        'note'            => '',
        'content'         => 'required'
    ];
    public static function cols() {
        return [
            'title'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'note'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'id'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ]
        ];
    }
}
