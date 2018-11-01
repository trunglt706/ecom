@extends('admin.layouts.base')

@section('css')
<link href="{{ Path::url('css/login.css') }}" rel="stylesheet">
@stop
@section('main')
<div class="container">
    <div class="panel panel-default panel-login">
        <div class="panel-body">
            <form class="form-signin" method="post" action="{{ Path::url(config('data.ROUTE_PREFIX_ADMIN').'/login') }}">
                <img src="{{ Path::url('images/logo.png') }}" alt="logo" id="logo"/>
                {{ csrf_field() }}
                @if(isset($login_flash_notify))
                    <div class="alert alert-{{ $login_flash_notify['status'] }}">
                        {{ $login_flash_notify['message'] }}
                    </div>
                @endif
                <label for="inputUsername" class="sr-only">{{ \Language::get('global.lbl_auth_username') }}</label>
                <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="{{ \Language::get('global.lbl_auth_username') }}" required="" autofocus="">
                <label for="inputPassword" class="sr-only">{{ \Language::get('global.lbl_auth_password') }}</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="{{ \Language::get('global.lbl_auth_password') }}" required="">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    <span class="glyphicon glyphicon-log-in"></span>
                    {{ \Language::get('global.lbl_auth_login') }}
                </button>
            </form>
        </div>
    </div>
    <footer>
        <center>Copyright © 2015 <a href="{{ env('APP_AUTHOR_URL', '#!') }}" target="_blank">{{ env('APP_AUTHOR', '') }}</a></center>
    </footer>
</div>
@stop
