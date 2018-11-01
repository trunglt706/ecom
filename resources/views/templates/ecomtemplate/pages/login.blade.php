<?php
    $uri = $_SERVER['REQUEST_URI'];
    if($data['page']->content == 'index') $uri .= '/'.$data['page']->alias;
?>

@if(Auth::check() && (Auth::user()->login_frontend == 1))
<script type="text/javascript">
    function signout(){
        $.post("{{ Path::urlSite('ecom/logout') }}", { _token: '{{ csrf_token() }}' }, function( data ) {
            location.href= '{{ Path::url('/') }}';
        });
    };
</script>
@else
<div class="modal" id="signinModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loader" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="form-signin">
                <div class="modal-body">
                    <div class="icon icon-account pulseGrey">
                        <span class="body pulseGrey"></span>
                        <i class="pulseGrey zmdi zmdi-account"></i>
                    </div>
                    <div class="icon success" style="display: none;">
                        <span class="line tip"></span>
                        <span class="line long"></span>
                        <div class="placeholder"></div>
                        <div class="fix"></div>
                    </div>
                    <div class="icon error animateErrorIcon" style="display: none;">
                        <span class="x-mark animateXMark">
                            <span class="line left"></span>
                            <span class="line right"></span>
                        </span>
                    </div>
                    <h3 class="text-center" style="margin-bottom: 5px;">{{ \Language::get('global.lbl_auth_login') }}</h3>
                    <div class="form-group">
                        <div class="fg-line">
                            <input type="text" class="form-control fc-alt" id="username" required placeholder="{{ Language::get('global.lbl_auth_username') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fg-line">
                            <input type="password" class="form-control fc-alt" id="password" required placeholder="{{ Language::get('global.lbl_auth_password') }}">
                        </div>
                        <a class="pull-right" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#forgetModal">{{ \Language::getTemplate('ecomtemplate.lbl_auth_forget') }}</a>
                    </div>
                    <div class="p-t-10">
                        <center id="toolbar">
                            <button class="btn btn-icon-text btn-primary waves-effect" type="submit">{{ Language::get('global.lbl_auth_login') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></button>
                            <button class="btn btn-default waves-effect" data-dismiss="modal" aria-label="Close">{{ Language::get('global.lbl_exit') }}</button>
                        </center>
                    </div>
                    <hr>
                    <center id="toolbar">
                        <a href="{{ $data['menus']->register }}">{{ \Language::getTemplate('ecomtemplate.lbl_register_member') }}</a>
                    </center>
                </div>
                <div class="notify"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var frmSigninReset = function(){
            $('#form-signin .success').removeClass('animate').hide();
            $('#form-signin .error').removeClass('animate').hide();
            $('#form-signin .notify').fadeOut();
            $('#form-signin .icon-account').fadeIn();
        };
        $('#form-signin').on('submit', function(){
            $('#form-signin #toolbar button').prop('disabled', true);
            $('#form-signin #toolbar button .zmdi-refresh').show();
            $.post("{{ Path::urlSite('ecom/login') }}", { username: $('#username').val(), password: $('#password').val(), _token: '{{ csrf_token() }}' }, function( data ) {
                $('#form-signin .icon-account').hide();
                if(data.status === 'success') {
                    $('#form-signin .success').addClass('animate').show();
                    setTimeout('location.reload();', 1000);
                }else{
                    $('#form-signin .error').addClass('animate').show();
                    $('#form-signin .notify').addClass('alert alert-danger').html(data.message).show();
                    $('#form-signin #toolbar button .zmdi-refresh').hide();
                    $('#form-signin #toolbar button').prop('disabled', false);
                }
            });
            return false;
        });
        $('#form-signin .form-control').on('focus', frmSigninReset);
        $('#signinModal').on('shown.bs.modal', frmSigninReset);
    });
</script>
@endif
