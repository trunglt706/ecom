<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class MemberContact extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = [
        'member_id',
        'card_id',
        'fullname',
        'address',
        'email',
        'phone',
        'gender',
        'note',
        'type',
        'status',
        'attribs'
    ];
    public static $rules = [
        'member_id' => '',
        'card_id'   => '',
        'fullname'  => '',
        'address'   => '',
        'email'     => '',
        'phone'     => '',
        'gender'    => '',
        'note'      => '',
        'type'      => '',
        'status'    => '',
        'attribs'   => ''
    ];
    public static function cols() {
        return [
            'fullname'                => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'phone'                => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'email'            => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'status_render'            => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'  => 'status',
                    'col'   => 'status',
                    'tbl'   => 'member_contacts'
                ]
            ]
        ];
    }

    public static function fetch() {
        $filters = [];
        array_push($filters, [
            'key'   => 'member_id',
            'value' => \Input::get('auth_member')
        ]);
        array_push($filters, [
            'key'   => 'type',
            'value' => 'contact'
        ]);
        \Input::merge(['filters'=>$filters]);
        \Input::merge(['sort'=>'status_render']);
        \Input::merge(['order'=>'asc']);
        $res = \CRUD::fetch(new self);
        foreach ($res['rows'] as $row) {
            $row->status_render = $row->status == 0 ? '<span class="label label-default">'.\Language::getTemplate('ecomtemplate.lbl_status_contact').'</span>' : '<span class="label label-success">'.\Language::getTemplate('ecomtemplate.lbl_status_feedback').'</span>';
            if (is_null($row->fullname)) {
                $card = MemberCard::find($row->card_id);
                $row->fullname = $card->fullname;
                $row->phone = $card->phone;
                $row->email = $card->email;
            }
        }
        return $res;
    }
}
