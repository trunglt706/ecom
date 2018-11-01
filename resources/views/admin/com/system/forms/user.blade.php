<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 frm-desc">
                <div class="media">
                    <div class="media-left">
                        <a>
                            <img class="media-object" src="{{ Path::url('images/users.png') }}" width="128" height="128">
                        </a>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">{{ Language::getCom('system.lbl_user') }}</h3>
                        <hr style="border-top: solid 5px #555">
                        <?php echo Language::getCom('system.help_user') ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <legend>{{ \Language::getCom('system.lbl_group_info_user') }}</legend>
                <div class="form-group">
                    <label for="fullname" class="control-label">{{ \Language::getCom('system.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="fullname" id="fullname" data-bind="value: current().fullname" required maxlength="50">
                </div>
                <div class="form-group">
                    <label for="address" class="control-label">{{ \Language::getCom('system.lbl_address') }}</label>
                    <input type="text" class="form-control" name="address" id="address" data-bind="value: current().address" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">{{ \Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                    <input type="email" class="form-control" name="email" id="email" data-bind="value: current().email" required maxlength="50">
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">{{ \Language::getCom('system.lbl_phone') }}</label>
                    <input type="text" class="form-control" name="phone" id="phone" onkeydown="return ( event.ctrlKey || event.altKey
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9)
                            || (event.keyCode>34 && event.keyCode<40)
                            || (event.keyCode==46) )"
                        maxlength="11" data-bind="value: current().phone">
                </div>
                <div class="form-group">
                    <label for="fax" class="control-label">{{ \Language::getCom('system.lbl_fax') }}</label>
                    <input type="text" class="form-control" name="fax" id="fax" onkeydown="return ( event.ctrlKey || event.altKey
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9)
                            || (event.keyCode>34 && event.keyCode<40)
                            || (event.keyCode==46) )"
                        maxlength="11" data-bind="value: current().fax">
                </div>
                <div class="form-group">
                    <label for="note">{{ \Language::getCom('system.lbl_note') }}</label>
                    <textarea class="form-control" name="note" id="note" rows="5" data-bind="value: current().note"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <legend>{{ \Language::getCom('system.lbl_group_account') }}</legend>
                <div class="form-group">
                    <label for="username" class="control-label">{{ \Language::getCom('system.lbl_username') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="username" id="username" data-bind="value: current().username" required maxlength="255">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">{{ \Language::getCom('system.lbl_password') }}</label>
                    <input type="password" class="form-control" name="password" id="password" data-bind="value: current().password" maxlength="255" placeholder="{{ Language::getCom('system.lbl_new_input_for_change') }}">
                </div>
                <div class="form-group">
                    <label for="user_group_id" class="control-label">{{ \Language::getCom('system.lbl_user_groups_render') }} <sup class="text-danger">(*)</sup></label>
                    <select class="select2" id="user_group_id" name="user_group_id" required data-url="{{ $uri }}/usergroups"></select>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">{{ \Language::getCom('system.lbl_active_render') }} <sup class="text-danger">(*)</sup></label>
                    <div>
                        <label class="radio-inline">
                            <input type="radio" name="active" value="1" data-bind="attr:{'checked': current().active == '1'} "> {{ \Language::getCom('system.lbl_active') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="active" value="0" data-bind="attr:{'checked': current().active == '0'} "> {{ \Language::getCom('system.lbl_disable') }}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="option" class="control-label">{{ \Language::get('global.lbl_option') }} <sup class="text-danger">(*)</sup></label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="login_backend" value="1" data-bind="attr:{'checked': current().login_backend == '1'} "> {{ \Language::getCom('system.lbl_login_backend') }}
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="login_frontend" value="1" data-bind="attr:{'checked': current().login_frontend == '1'} "> {{ \Language::getCom('system.lbl_login_frontend') }}
                        </label>
                    </div>
                </div>
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
</div>

@section('incAdd')
    $('#user_group_id').select2('val', '');
@stop

@section('incUpd')
    $('#user_group_id').select2('val', self.current().user_group_id);
@stop

@section('incSave')
    self.current().user_group_id = $('#user_group_id').val();
    self.current().active = $('input[name="active"]:checked').val();
    self.current().login_backend = $('input[name="login_backend"]').is(':checked') ? 1:0;
    self.current().login_frontend = $('input[name="login_frontend"]').is(':checked') ? 1:0;
@stop
