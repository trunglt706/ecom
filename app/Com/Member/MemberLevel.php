<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class MemberLevel extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['name', 'icon', 'level'];
    public static $rules = [
        'name'      => 'required',
        'icon'      => '',
        'level'     => 'required'
    ];
    public static function cols() {
        return [
            'name'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'level'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ]
        ];
    }
}
