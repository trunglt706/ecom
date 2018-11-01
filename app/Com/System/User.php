<?php

namespace App\Com\System;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract {

    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['profile_pic', 'fullname','gender','phone','email','address','username','password','user_group_id', 'active', 'note', 'attribs', 'rights', 'login_backend', 'login_frontend'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    public static $rules = [
        'profile_pic'   => '',
        'fullname'      => 'required',
        'gender'        => '',
        'phone'         => '',
        'email'         => 'required',
        'address'       => '',
        'username'      => 'required|unique:users,username',
        'password'      => '',
        'user_group_id' => 'required',
        'active'        => 'required',
        'rights'        => '',
        'login_backend' => 'required',
        'login_frontend'=> 'required'
    ];

    public static function cols() {
        return [
            'fullname'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'email'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'user_groups_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey'=> 'user_group_id',
                    'tbl' => 'user_groups',
                    'col' => 'group_name'
                ]
            ],
            'active_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'=> 'active',
                    'tbl' => 'users',
                    'col' => 'active'
                ]
            ]
        ];
    }

    public static function fetch() {
        $res = \CRUD::fetch(new self);
        $rows = [];
        foreach($res['rows'] as $row) {
            $row->user_groups_render = \UserGroup::where('id', $row->user_group_id)->pluck('group_name');
            $row->active_render = $row->active == 1 ? \Language::get('global.var_public') : \Language::get('global.var_unpublic');

            $user_group = \App\Com\System\UserGroup::find($row->user_group_id);
            if($user_group->anonymous == 1) {
                if(\Auth::user()->user_group_id == $user_group->id) array_push($rows, $row);
            } else {
                if(!($row->anonymous == 1 && \Auth::user()->id != $row->id)) array_push($rows, $row);
            }
        }
        $res['rows'] = $rows;
        return $res;
    }

    public static function changePass() {
        $rules      = array(
            'password'  => 'required',
            'newpass'   => 'required',
            'renewpass' => 'required'
        );
        $validation = \Validator::make(\Input::all(), $rules);
        if ($validation->passes())
            if (\Input::get('newpass') == \Input::get('renewpass')) {
                \Auth::user()->password = \DB::table('users')->where('id', \Auth::user()->id)->value('password');
                if (\Hash::check(\Input::get('password'), \Auth::user()->password)) {
                    $newpass = \Hash::make(\Input::get('newpass'));
                    $res = \DB::table('users')->where('id', \Auth::user()->id)->update(['password' => $newpass]);
                    if ($res) return ['status' => 'success', 'message' => \Language::getCom('system.message_change_pass_success')];
                }
                return ['status' => 'error', 'message' => \Language::getCom('system.message_change_pass_error')];
            }
        return ['status' => 'error', 'message' => \Language::getCom('system.message_change_pass_input_error')];
    }

    public static function forgetPass() {
        $rules      = array(
            'username'  => 'required',
            'email'     => 'required'
        );
        $validation = \Validator::make(\Input::all(), $rules);
        if ($validation->passes()) {
            $forget_user = self::where('username', \Input::get('username'))->first();
            if (!is_null($forget_user))
                if ($forget_user->email == \Input::get('email')) {
                    if (is_null($forget_user->attribs) || $forget_user->attribs == '') {
                        $hash_email = \Hash::make(\Input::get('email'));
                        if ($forget_user->update(['attribs'=>$hash_email])) {
                            $menu_pass = \App\Com\Menu\Menu::where('content', 'password')->where('lang', \Input::get('lang'))->value('alias');
                            $mail_message = \Language::getCom('system.message_forget_pass_info', [
                                'name' => $forget_user->fullname,
                                'link' => \Path::url('/' . \Input::get('lang') . '/' . $menu_pass . '/') . '?k=' . $hash_email . '&u=' . \Input::get('username')]);
                            $tos = [];
                            array_push($tos, ['address'=>\Input::get('email')]);
                            $mail_title = 'Tạo lại mật khẩu';
                            $mail_config = \System::getValue('mail');
                            \Mailer::send(
                                $mail_message,
                                $tos,
                                $mail_title,
                                \Path::viewTemplate('ecomtemplate.layouts.mailTemplate'),
                                [], [], [], [], [
                                    'driver'    => $mail_config->mail_driver,
                                    'host'      => $mail_config->mail_host,
                                    'port'      => $mail_config->mail_port,
                                    'encryption'=> $mail_config->mail_encryption,
                                    'username'  => $mail_config->mail_username,
                                    'password'  => $mail_config->mail_password
                                ]
                            );
                            return ['status' => 'success', 'message' => \Language::getCom('system.message_forget_pass_success') . \Input::get('email')];
                        }
                        return ['status' => 'warning', 'message' => \Language::getCom('system.message_forget_pass_error')];
                    }
                    return ['status' => 'warning', 'message' => \Language::getCom('system.message_forget_pass_warning')];
                }
        }
        return ['status' => 'error', 'message'=>\Language::getCom('system.message_forget_pass_input_error')];
    }

    public static function resetPass() {
        $rules      = array(
            'ic'        => 'required',
            'newpass'   => 'required',
            'renewpass' => 'required'
        );
        $validation = \Validator::make(\Input::all(), $rules);
        if ($validation->passes()) {
            if (\Input::get('newpass') == \Input::get('renewpass')) {
                $forget_user = self::where('attribs', \Input::get('r'))->first();
                if (!is_null($forget_user)) {
                    if (class_exists('\App\Com\Member\MemberUser')) {
                        $member_forget = \App\Com\Member\MemberUser::where('user_id', $forget_user->id)->first();
                        if (!is_null($member_forget)) {
                            if ($member_forget->ic == \Input::get('ic')) {
                                $newpass = \Hash::make(\Input::get('newpass'));
                                $res = \DB::table('users')->where('id', $forget_user->id)->update(['password' => $newpass,'attribs' => '']);
                                if ($res) return ['status' => 'success', 'message' => \Language::getCom('system.message_change_pass_success')];
                                return ['status' => 'warning', 'message' => \Language::getCom('system.message_forget_pass_error')];
                            }
                        }
                        return ['status' => 'error', 'message' => \Language::getCom('system.message_reset_pass_member_error')];
                    }
                    return ['status' => 'error', 'message' => \Language::get('global.message_system_miss_extension')];
                }
                return ['status' => 'error', 'message' => \Language::getCom('system.message_reset_pass_error')];
            }
            return ['status' => 'error', 'message' => \Language::getCom('system.message_change_pass_input_error')];
        }
        return ['status' => 'error', 'message' => \Language::getCom('system.message_input_error')];

    }
}
