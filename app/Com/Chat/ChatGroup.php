<?php

namespace App\Com\Chat;

use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model {

    protected $fillable = ['group_code', 'group_name', 'note', 'attribs', 'protected', 'active'];
    public static $rules = [
        'group_code'  => '',
        'group_name'  => 'required',
        'note'        => '',
        'attribs'     => '',
        'protected'   => '',
        'active'      => ''
    ];
    public static function cols(){
            return [
            'group_name'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'note'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'active_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey' => 'active',
                    'col'  => 'active',
                    'tbl'  => 'chat_groups'
                ]
            ],
            'id'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'right',
            ]
        ];
    }

    public static function fetch() {
        $res = \CRUD::fetch(new self);
       foreach($res['rows'] as $row) {
           $row->active_render = $row->active == '1' ? \Language::get('global.var_public') : \Language::get('global.var_unpublic');
       }
        return $res;
    }

    public static function get_all_user() {
        $res = \DB::table('users')->get();
        $rows = [];
        foreach($res as $row) {
            $row->group_name = \UserGroup::where('id', $row->user_group_id)->value('group_name');

            $user_group = \App\Com\System\UserGroup::find($row->user_group_id);
            if($user_group->anonymous == 1) {
                if(\Auth::user()->user_group_id == $user_group->id) array_push($rows, $row);
            } else {
                if(!($row->anonymous == 1 && \Auth::user()->id != $row->id)) array_push($rows, $row);
            }
        }
        return $rows;
    }

    public static function update_user_in_group($users, $group_id){
        $user_lists = [];
        foreach ($users as $user) {
            $chk = \DB::table('chat_users')->where('user_id', $user->user_id)->where('chat_group_id', $group_id)->count();
            if(!$chk){
                \DB::table('chat_users')->insert([
                    'user_id' => $user->user_id,
                    'chat_group_id'=>$group_id
                ]);
            }
            array_push($user_lists, $user->user_id);
        }

        \DB::table('chat_users')->where('chat_group_id', $group_id)->whereNotIn('user_id', $user_lists)->delete();
    }

    public static function get_user_in_group($group_id){
        $users = \DB::table('chat_users')->where('chat_group_id', $group_id)->get();
        $res = [];
        foreach ($users as $user) {
            $usr = \User::find($user->user_id);
            array_push($res, [
                'id' => $user->id,
                'user_id' => $user->user_id,
                'fullname' => $usr->fullname,
                'group_name' => \UserGroup::where('id', $usr->user_group_id)->value('group_name')
            ]);
        }
        return $res;
    }
}
