<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;
use App\Com\Member\Member;
use App\Com\Member\MemberLevel;

class MemberLevelApprove extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['member_id', 'member_level', 'member_approve', 'note', 'approved_by', 'start_at', 'ended_at', 'created_at'];
    public static $rules = [
        'member_id'         => '',
        'member_level'      => '',
        'member_approve'    => '',
        'note'              => '',
        'approved_by'       => '',
        'start_at'          => '',
        'ended_at'          => '',
        'created_at'        => ''
    ];
    public static function cols() {
        return [
            'member_id_render'          => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'  => 'member_id',
                    'col'   => 'member_id',
                    'tbl'   => 'member_level_approves'
                ]
            ],
            'member_level_render'    => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'  => 'member_level',
                    'col'   => 'member_level',
                    'tbl'   => 'member_level_approves'
                ]
            ],
            'approved_by_render'        => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'  => 'approved_by',
                    'col'   => 'fullname',
                    'tbl'   => 'users'
                ]
            ],
            'start_at'                  => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'ended_at'                  => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'created_at'                => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'note'                      => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ]
        ];
    }

    public static function fetch() {
        $res = \CRUD::fetch(new self);
        foreach($res['rows'] as $row) {
            $row->member_id_render = Member::where('id', $row->member_id)->pluck('member_name');
            $row->member_level_render = MemberLevel::where('level', $row->member_level)->pluck('name');
//            $row->approved_by_render = \User::where('id', $row->approved_by)->pluck('fullname');
        }
        return $res;
    }

    public static function approve() {
        return \CRUD::insert(new self, [
            'member_id' => \Input::get('member_id'),
            'approved_by' => \Input::has('approved_by') ? \Input::get('approved_by') : \Auth::user()->id,
            'member_level' => \Input::get('member_level'),
            'member_approve' => \Input::get('member_approve'),
            'note' => \Input::get('note')
        ]);
    }
}
