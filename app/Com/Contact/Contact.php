<?php

namespace App\Com\Contact;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['fullname','address', 'phone', 'fax', 'email', 'message'];
    public static $rules = [
        'fullname'  => 'required',
        'address'   => '',
        'phone'     => '',
        'fax'       => '',
        'email'     => 'required',
        'message'   => 'required',
    ];

    public static function cols() {
        return [
            'fullname'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'address'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'phone'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'email'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ]
        ];
    }

}
