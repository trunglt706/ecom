<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class MemberRequest extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = [
        'customer_id',
        'supplier_id',
        'customer_card',
        'supplier_card',
        'customer',
        'values',
        'attribs',
        'type',
        'status',
        'file',
        'note'
    ];
    public static $rules = [
        'customer_id'   => '',
        'supplier_id'   => '',
        'customer_card' => '',
        'supplier_card' => '',
        'customer'      => '',
        'values'        => '',
        'attribs'       => '',
        'type'          => '',
        'status'        => '',
        'file'          => '',
        'note'          => ''
    ];
    public static function cols() {
        return [
            'customer_id_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'=> 'customer_id',
                    'tbl' => 'members',
                    'col' => 'member_name'
                ]
            ],
            'customer_card_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'=> 'customer_card',
                    'tbl' => 'member_cards',
                    'col' => 'fullname'
                ]
            ],
            'status_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'=> 'status',
                    'tbl' => 'member_requests',
                    'col' => 'status'
                ]
            ],
            // 'note'   => [
            //     'filter' => ['srt', 'src'],
            //     'align'  => 'left',
            // ]
        ];
    }
    public static function fetchQuote() {
        $filters = [];
        array_push($filters, [
            'key'   => 'type',
            'value' => 'quote'
        ]);
        array_push($filters, [
            'key'   => 'status',
            'value' => -1
        ]);
        array_push($filters, [
            'key'   => 'status',
            'value' => 1
        ]);
        array_push($filters, [
            'key'   => 'supplier_id',
            'value' => \Input::get('auth_member')
        ]);
        \Input::merge(['filters'=>$filters]);
        $res = \CRUD::fetch(new self);
        foreach ($res['rows'] as $row) {
            $row->status_render = $row->status == -1 ? '<span class="label label-default">'.\Language::getTemplate('ecomtemplate.lbl_status_request').'</span>' : '<span class="label label-success">'.\Language::getTemplate('ecomtemplate.lbl_status_feedback').'</span>';
            if (is_null($row->customer_card)) {
                $mc = json_decode($row->customer);
                $row->customer_card_render = $mc->fullname;
            }
            else {
                $mc = MemberCard::find($row->customer_card);
            }
            $row->fullname = isset($mc->fullname) ? $mc->fullname : '';
            $row->address = isset($mc->address) ? $mc->address : '';
            $row->phone = isset($mc->phone) ? $mc->phone : '';
            $row->email = isset($mc->email) ? $mc->email : '';
        }
        return $res;
    }
    public static function fetchSample() {
        $filters = [];
        array_push($filters, [
            'key'   => 'type',
            'value' => 'sample'
        ]);
        array_push($filters, [
            'key'   => 'status',
            'value' => -1
        ]);
        array_push($filters, [
            'key'   => 'status',
            'value' => 1
        ]);
        array_push($filters, [
            'key'   => 'supplier_id',
            'value' => \Input::get('auth_member')
        ]);
        \Input::merge(['filters'=>$filters]);
        $res = \CRUD::fetch(new self);
        foreach ($res['rows'] as $row) {
            $row->status_render = $row->status == -1 ? '<span class="label label-default">'.\Language::getTemplate('ecomtemplate.lbl_status_request').'</span>' : '<span class="label label-success">'.\Language::getTemplate('ecomtemplate.lbl_status_feedback').'</span>';
            if (is_null($row->customer_card)) {
                $mc = json_decode($row->customer);
                $row->customer_card_render = $mc->fullname;
            }
            else {
                $mc = MemberCard::find($row->customer_card);
            }
            $row->fullname = isset($mc->fullname) ? $mc->fullname : '';
            $row->address = isset($mc->address) ? $mc->address : '';
            $row->phone = isset($mc->phone) ? $mc->phone : '';
            $row->email = isset($mc->email) ? $mc->email : '';
        }
        return $res;
    }
    public static function fetchRequest() {
        $filters = [];
        array_push($filters, [
            'key'   => 'type',
            'value' => 'sample'
        ]);
        array_push($filters, [
            'key'   => 'status',
            'value' => -1
        ]);
        array_push($filters, [
            'key'   => 'status',
            'value' => 1
        ]);
        array_push($filters, [
            'key'   => 'supplier_id',
            'value' => \Input::get('auth_member')
        ]);
        \Input::merge(['filters'=>$filters]);
        $res = \CRUD::fetch(new self);
        foreach ($res['rows'] as $row) {
            $row->status_render = $row->status == -1 ? '<span class="label label-default">'.\Language::getTemplate('ecomtemplate.lbl_status_request').'</span>' : '<span class="label label-success">'.\Language::getTemplate('ecomtemplate.lbl_status_feedback').'</span>';
            if (is_null($row->customer_card)) {
                $mc = json_decode($row->customer);
                $row->customer_card_render = $mc->fullname;
            }
            else {
                $mc = MemberCard::find($row->customer_card);
            }
            $row->fullname = isset($mc->fullname) ? $mc->fullname : '';
            $row->address = isset($mc->address) ? $mc->address : '';
            $row->phone = isset($mc->phone) ? $mc->phone : '';
            $row->email = isset($mc->email) ? $mc->email : '';
        }
        return $res;
    }
}
