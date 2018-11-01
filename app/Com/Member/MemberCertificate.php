<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class MemberCertificate extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = [ 'member_certificate_name', 'member_certificate_certified_by', 'member_certificate_certified_at', 'member_certificate_content', 'note', 'content', 'member_id', 'member_certificate_type_id', 'lang'];
    public static $rules = [
        'member_certificate_name'               => 'required',
        'member_certificate_certified_by'       => '',
        'member_certificate_certified_at'       => '',
        'content'                               => '',
        'note'                                  => '',
        'member_id'                             => 'required',
        'member_certificate_type_id'            => 'required',
        'lang'                                  => 'required'
    ];
    public static function cols() {
        return [
            'member_certificate_type_id_render'      => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'=> 'member_certificate_type_id',
                    'tbl' => 'member_certificate_types',
                    'col' => 'member_certificate_type_name'
                ]
            ],
            'member_certificate_name'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'member_certificate_certified_by'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'member_certificate_certified_at'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            // 'member_id_render'   => [
            //     'filter' => ['srt'],
            //     'align'  => 'left',
            //     'fkey'   => [
            //         'fkey'=> 'member_id',
            //         'tbl' => 'members',
            //         'col' => 'member_name'
            //     ]
            // ],

        ];
    }

    public static function fetch() {
//        $res = array();
        $filters = [];
        array_push($filters, [
            'key'   => 'member_id',
            'value' => \Input::get('auth_member')
        ]);
        \Input::merge(['filters'=>$filters]);
        $result = \CRUD::fetch(new self);
//        foreach ($result['rows'] as $row) {
//            $member_level_approves = \DB::table('member_level_approves')->where('member_id', $row->id)->first();
//            if ($member_level_approves != NULL) {
//                $member_levels = \DB::table('member_levels')->where('id', $member_level_approves->member_level_id)->first();
//                if ($row->member_block == 1) {
//                    $row->member_level_id_render = "<span class='label label-danger'>". \Language::getCom('member.lbl_block') ."</span>";
//                } else {
//                    if ($member_levels->id == 2) {
//                        $row->member_level_id_render = "<span class='label label-warning'>". \Language::getCom('member.lbl_member_gold') ."</span>";
//                    } else{
//                        $row->member_level_id_render = "<span class='label label-success'>". \Language::getCom('member.lbl_member_default') ."</span>";
//                    }
//                }
//            } else {
//                $row->member_level_id_render = "<span class='label label-default label-large'>". \Language::getCom('member.lbl_wait') ."</span>";
//            }
//        }
       return $result;
    }
}
