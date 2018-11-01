<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class MemberCard extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = [
        'member_id',
        'fullname',
        'position',
        'department',
        'phone',
        'email',
        'note',
        'current',
        'sort',
        'attribs'
    ];
    public static $rules = [
        'member_id'    => 'required',
        'fullname'      => '',
        'position'      => '',
        'department'    => '',
        'phone'         => '',
        'email'         => '',
        'note'          => '',
        'current'       => '',
        'sort'          => '',
        'attribs'       => ''
    ];
}
