<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class MemberCertificateType extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['member_certificate_type_name', 'member_certificate_type_note', 'logo'];
    public static $rules = [
        'member_certificate_type_name'              => 'required',
        'member_certificate_type_note'              => '',
        'logo'                                      => ''
    ];
    public static function cols() {
        return [
            'member_certificate_type_name'       => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'member_certificate_type_note'       => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
        ];
    }

    public static function fetch(){
        $res = \CRUD::fetch(new self);
        foreach($res['rows'] as $row) {
           $row->logo = config("data.PATH_ROOT").$row->logo;
        }
        return $res;
    }
}
