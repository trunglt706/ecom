<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    function getIndex()
    {
        return redirect(config('data.ROUTE_PREFIX_ADMIN').'/login');
    }
    
    function getLogin()
    {
        if (\Auth::check() && \Auth::user()->login_backend)
        {
            return redirect(config('data.ROUTE_PREFIX_ADMIN').'/dashboard');
        }
        return session()->has('login_flash_notify') ? view(\Path::viewAdminCom('system.pages.login'))->with('login_flash_notify', session('login_flash_notify')) : view(\Path::viewAdminCom('system.pages.login'));
    }

    function postLogin()
    {
        $rules      = array(
            'inputUsername' => 'required',
            'inputPassword' => 'required'
        );
        $user_login = array(
            'username'      => trim(\Input::get('inputUsername')),
            'password'      => \Input::get('inputPassword'),
            'active'        => 1,
            'login_backend' => 1
        );
        $validation = \Validator::make(\Input::all(), $rules);
        if ($validation->passes())
        {
            if (\Auth::attempt($user_login))
            {
                \User::where('id', \Auth::user()->id)->update(['last_login'=>date("Y-m-d H:i:s", time() )]);
                return redirect(config('data.ROUTE_PREFIX_ADMIN').'/dashboard');
            }
        }
        return redirect()->back()->withInput()->with('login_flash_notify', ['status'=>'danger', 'message'=>\Language::get('global.message_auth_login_error')]);
    }

    function getLogout()
    {
        \Auth::logout();
        return redirect(config('data.ROUTE_PREFIX_ADMIN').'/login')->with('login_flash_notify', ['status'=>'success', 'message'=>\Language::get('global.message_auth_logout_success')]);
    }
    
    function postChangepass()
    {
        return \User::changePass();
    }
    
}
