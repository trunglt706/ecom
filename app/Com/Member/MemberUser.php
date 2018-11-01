<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;

class MemberUser extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['ic', 'ic_certified_by', 'ic_certified_at', 'user_id', 'member_tin'];
    public static $rules = [
        'ic'                => '',
        'ic_certified_by'   => '',
        'ic_certified_at'   => '',
        'user_id'           => 'required',
        'member_tin'        => 'required'
    ];
    public static function cols() {
        return [
            'user_id_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'=> 'user_id',
                    'tbl' => 'users',
                    'col' => 'fullname'
                ]
            ],
//            'member_render'   => [
//                'filter' => ['srt', 'src'],
//                'align'  => 'left',
//                'fkey'   => [
//                    'fkey'=> 'member_tin',
//                    'tbl' => 'member_users',
//                    'col' => 'member_tin'
//                ]
//            ],
            'member_tin'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'ic'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'ic_certified_by'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'ic_certified_at'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ]
           
        ];
    }
    
    public static function fetch() {
        $idx = 0;
        $res = \DB::table('member_users')->where('member_tin', \Input::get('member_tin'))
                ->join('users', 'member_users.user_id', '=', 'users.id')
                ->get();
        foreach ($res as $member_user) {
            $member_user->idx = $idx++;
        }
        return $res;
    }
    
    public static function saveUser($users, $member_tin) {
        $pond_codes = [];
        foreach ($users as $user) {
            $exists = self::where('member_id', $member_id)->count();
            if ($exists) {
                self::where('member_id', $area_id)
                        ->where('pond_code', $pond->pond_code)
                        ->update([
                            'pond_code' => $pond->pond_code,
                            'pond_name' => $pond->pond_name,
                            'area_id'   => $area_id,
                            'acreage'   => $pond->acreage,
                            'areas'     => $pond->areas,
                            'show'      => $pond->show,
                            'note'      => $pond->note
                        ]);
            }else{
                self::insert([
                    'pond_code' => $pond->pond_code,
                    'pond_name' => $pond->pond_name,
                    'area_id'   => $area_id,
                    'acreage'   => $pond->acreage,
                    'areas'     => $pond->areas,
                    'show'      => $pond->show,
                    'note'      => $pond->note,
                    'created_at'=> date('Y-m-d H:i:s')
                ]);
            }
            array_push($pond_codes, $pond->pond_code);
        }
        self::Where('area_id', $area_id)->whereNotIn('pond_code', $pond_codes)->delete();
        $input = \Input::all();
        $res = \CRUD::insert(new \User, $input['user']);
    }
}
