<?php

namespace App\Com\System;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['group_name','note'];
    public static $rules = [
        'group_name' => 'required',
        'note'       => ''
    ];
    
    public static function cols() {
        return [
            'group_name'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'note'   => [
                'filter' => [],
                'align'  => 'left',
            ]
        ];
    }
}
