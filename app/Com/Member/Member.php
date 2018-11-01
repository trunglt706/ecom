<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = [
        'member_name',
        'member_shortname',
        'member_othername',
        'member_tin',
        'member_address',
        'member_phone',
        'member_fax',
        'member_alias',
        'member_email',
        'member_website',
        'member_facebook',
        'member_twitter',
        'member_google',
        'member_youtube',
        'member_types',
        'member_categories',
        'member_level',
        'member_seo',
        'member_ads',
        'member_approve',
        'info_basic',
        'info_factory',
        'info_commerce',
        'info_about',
        'info_contact',
        'info',
        'active',
        'views',
        'sort',
        'lang',
        'attribs',
        'settings'
    ];
    public static $rules = [
        'member_name'       => 'required',
        'member_shortname'  => '',
        'member_othername'  => '',
        'member_tin'        => '',
        'member_address'    => 'required',
        'member_phone'      => 'required',
        'member_fax'        => '',
        'member_alias'      => 'unique:members,member_alias',
        'member_email'      => '',
        'member_website'    => '',
        'member_facebook'   => '',
        'member_twitter'    => '',
        'member_google'     => '',
        'member_youtube'    => '',
        'member_types'      => '',
        'member_categories' => '',
        'member_level'      => '',
        'member_seo'        => '',
        'member_ads'        => '',
        'member_approve'    => '',
        'info_basic'        => '',
        'info_factory'      => '',
        'info_commerce'     => '',
        'info_about'        => '',
        'info_contact'      => '',
        'info'              => '',
        'active'            => '',
        'views'             => '',
        'sort'              => '',
        'lang'              => 'required',
        'attribs'           => '',
        'settings'          => ''
    ];
    public static function cols() {
        return [
            'logo'               => [
                'filter' => [],
                'align'  => 'center',
            ],
            'member_name'                => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'member_tin'                => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'member_address'            => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            // 'member_phone'              => [
            //     'filter' => ['srt', 'src'],
            //     'align'  => 'left',
            // ],
            // 'member_website'            => [
            //     'filter' => ['srt', 'src'],
            //     'align'  => 'left',
            // ],
            'member_level_render'    => [
                'filter' => ['srt'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'  => 'member_level',
                    'col'   => 'member_level',
                    'tbl'   => 'members'
                ],
                'group' => [
                    'key' => 'member_level',
                    'val' => 'level',
                    'col' => 'name',
                    'tbl' => 'member_levels'
                ]
            ],
            'member_approve_render'    => [
                'filter' => ['srt'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'  => 'member_approve',
                    'col'   => 'member_approve',
                    'tbl'   => 'members'
                ]
            ],
            'active_render'    => [
                'filter' => ['srt'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'  => 'active',
                    'col'   => 'active',
                    'tbl'   => 'members'
                ]
            ],
            'views'   => [
                'filter' => [],
                'align'  => 'center'
            ],
            'lang'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'group' => [
                    'key' => 'lang',
                    'val' => 'lang_code',
                    'col' => 'title',
                    'tbl' => 'languages'
                ]
            ],
            'id'    => [
                'filter' => ['srt'],
                'align'  => 'center',
            ]
        ];
    }

    public static function fetch() {
        $res = \CRUD::fetch(new self);
        foreach ($res['rows'] as $row) {
            $member_media = \DB::table('vmember')->where('data_type', 'AVATAR')->where('member_id', $row->id)->value('media');
            // $row->logo = '<img style="max-width: 50px;" src="'.MemberMedia::where('media_category_id', $cat_logo_id)->where('member_id', $row->id)->value('content').'">';
            $row->logo = '<img style="max-width: 50px;" src="'.($member_media != '' ? config("data.PATH_ROOT").$member_media : \Path::urlTemplate('ecomtemplate/images/product_bg.jpg')).'">';
            $row->active_render = $row->active ? "<span class='label label-primary'>". \Language::getCom('member.lbl_active') ."</span>" : "<span class='label label-danger'>". \Language::getCom('member.lbl_block') ."</span>";
            switch ($row->member_approve) {
                case 1:
                    $is_gold = false;
                    if ($row->member_level == 2) {
                        $lvl_app = MemberLevelApprove::where('member_id', $row->id)->where('member_level', 2)->where('member_approve', 1)->orderBy('id', 'desc')->first();
                        if (isset($lvl_app)) {
                            $date_now = (new \DateTime('NOW'))->modify('+7 hours');
                            $is_gold = ($date_now >= (new \DateTime($lvl_app->start_at)) && $date_now <= (new \DateTime($lvl_app->ended_at)));
                        }
                        if (!$is_gold)
                            $row->member_approve_render = "<span class='label label-danger'>". \Language::getCom('member.lbl_member_expired') ."</span>";
                    }
                    if ($row->member_level == 0)
                        $row->member_approve_render = "<span class='label label-primary'>". \Language::getCom('member.lbl_member_feedback') ."</span>";
                    if ($row->member_level == 1 || $is_gold)
                        $row->member_approve_render = "<span class='label label-success'>". \Language::getCom('member.lbl_member_approved') ."</span>";
                    break;
                case -1:
                    if ($row->member_level == 0)
                        $row->member_approve_render =  "<span class='label label-default'>". \Language::getCom('member.lbl_member_wait') ."</span>";
                    else {
                        $row->member_approve_render =  "<span class='label label-default'>". \Language::getCom('member.lbl_member_promoted') ."</span>";
                        $lvl_app = MemberLevelApprove::where('member_id', $row->id)->where('member_approve', -1)->where('member_level', 1)->orderBy('id', 'desc')->first();
                        $row->start_at = (new \DateTime($lvl_app->start_at))->format('Y-m-d');
                        $row->ended_at = (new \DateTime($lvl_app->ended_at))->format('Y-m-d');
                    }
                    break;
                default:
                    $row->member_approve_render = "<span class='label label-primary'>". \Language::getCom('member.lbl_member_feedback') ."</span>";
                    break;
            }
            switch ($row->member_level) {
                case '1':
                    $row->member_level_render = "<span class='label label-success'>". \Language::getCom('member.lbl_member_default') ."</span>";
                    break;
                case '2':
                    // $ended_at = MemberLevelApprove::where('member_id', $row->id)->where('member_level', 2)->orderBy('created_at', 'desc')->value('ended_at');
                    // if ($ended_at != '' && $ended_at)
                    $row->member_level_render = "<span class='label label-warning'>". \Language::getCom('member.lbl_member_gold') ."</span>";
                    break;
                default:
                    $row->member_level_render = "<span class='label label-primary'>". \Language::getCom('member.lbl_member_new') ."</span>";
                    break;
            }
        }
        return $res;
    }
}
