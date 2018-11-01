@if(Auth::check() && (Auth::user()->login_frontend == 1))
<script type="text/javascript">
    function signout(){
        $.post("{{ Path::urlSite('ecom/logout') }}", { _token: '{{ csrf_token() }}' }, function( data ) {
            location.href= '{{ Path::url('/') }}';
        });
    };
</script>
@else
<div class="modal" id="forgetModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loader" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="frmForget">
                <div class="modal-body">
                    <h3 class="text-center" style="margin-bottom: 5px;">{{ \Language::getTemplate('ecomtemplate.lbl_auth_forget') }}</h3>
                    <div class="form-group">
                        <div class="fg-line">
                            <input type="text" class="form-control fc-alt" id="forget_user" required placeholder="{{ Language::get('global.lbl_auth_username') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fg-line">
                            <input type="email" class="form-control fc-alt" id="forget_email" required placeholder="Email">
                        </div>
                        <a class="pull-right" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#signinModal">{{ \Language::get('global.lbl_auth_login') }}</a>
                    </div>
                    <center id="toolbar">
                        <button class="btn btn-icon-text btn-primary waves-effect" type="submit">{{ Language::getTemplate('ecomtemplate.lbl_get_pass') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></button>
                        <button class="btn btn-default waves-effect" data-dismiss="modal" aria-label="Close">{{ Language::get('global.lbl_exit') }}</button>
                    </center>
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
        $('#frmForget').on('submit', function() {
            $('#frmForget #toolbar button').prop('disabled', true);
            $('#frmForget #toolbar button .zmdi-refresh').show();
            $.post("{{ Path::urlSite('ecom/forget') }}", { username: $('#forget_user').val(), email: $('#forget_email').val(), _token: '{{ csrf_token() }}', lang: '{{ $data['page']->lang }}' }, function( data ) {
                toastr[data.status](data.message);
                if (data.status === 'success') {
                    setTimeout('location.reload();', 1000);
                } else {
                    $('#frmForget #toolbar button .zmdi-refresh').hide();
                    $('#frmForget #toolbar button').prop('disabled', false);
                }
            });
            return false;
        });
    });
</script>
@endif
