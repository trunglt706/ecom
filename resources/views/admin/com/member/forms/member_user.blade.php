<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <legend>{{ \Language::getCom('system.lbl_group_info_user') }}</legend>
                <div class="form-group">
                    <label for="fullname" class="control-label">{{ \Language::getCom('system.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="fullname" id="fullname" data-bind="value: user().fullname" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label for="address" class="control-label">{{ \Language::getCom('system.lbl_address') }}</label>
                    <input type="text" class="form-control" name="address" id="address" data-bind="value: user().address" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">{{ \Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                    <input type="email" class="form-control" name="email" id="email" data-bind="value: user().email" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">{{ \Language::getCom('system.lbl_phone') }}</label>
                    <input type="text" class="form-control" name="phone" id="phone" onkeydown="return ( event.ctrlKey || event.altKey
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9)
                            || (event.keyCode>34 && event.keyCode<40)
                            || (event.keyCode==46) )"
                        maxlength="11" data-bind="value: user().phone">
                </div>
                <div class="form-group">
                    <label for="note">{{ \Language::getCom('system.lbl_note') }}</label>
                    <textarea class="form-control" name="note" id="note" rows="5" data-bind="value: user().note"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <legend>{{ \Language::getCom('system.lbl_group_account') }}</legend>
                <div class="form-group">
                    <label for="username" class="control-label">{{ \Language::getCom('system.lbl_username') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="username" id="username" data-bind="value: user().username" maxlength="255" required>
                </div>
                <div class="form-group" data-bind="visible: new_user">
                    <label for="password" class="control-label">{{ \Language::getCom('system.lbl_password') }} <sup class="text-danger">(*)</sup></label>
                    <input type="password" class="form-control" name="password" id="password" data-bind="value: user().password" maxlength="255" required>
                </div>
                <div class="form-group">
                    <label for="user_group_id" class="control-label">{{ \Language::getCom('system.lbl_user_groups_render') }} <sup class="text-danger">(*)</sup></label>
                    <select class="select2" id="user_group_id" name="user_group_id" required data-url="{{ $uri }}/usergroups" required></select>
                </div>
                <div class="form-group">
                    <label for="member_id" class="control-label">{{ \Language::getCom('member.lbl_member_id_render') }} <sup class="text-danger">(*)</sup></label>
                    <select class="select2" id="member_id" name="member_id" required data-url="{{ $uri }}/members"></select>
                </div>
                <div class="form-group">
                    <label for="active" class="control-label">{{ \Language::getCom('system.lbl_active_render') }} <sup class="text-danger">(*)</sup></label>
                    <div>
                        <label class="radio-inline">
                            <input type="radio" name="active" value="1" data-bind="attr:{'checked': user().active == '1'} "> {{ \Language::getCom('system.lbl_active') }}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="active" value="0" data-bind="attr:{'checked': user().active == '0'} "> {{ \Language::getCom('system.lbl_disable') }}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="option" class="control-label">{{ \Language::get('global.lbl_option') }}</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="login_backend" value="1" data-bind="attr:{'checked': user().login_backend == '1'} "> {{ \Language::getCom('system.lbl_login_backend') }}
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="login_frontend" value="1" data-bind="attr:{'checked': user().login_frontend == '1'} "> {{ \Language::getCom('system.lbl_login_frontend') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <legend>{{ \Language::getCom('system.lbl_group_account_member_user') }}</legend>
                <div class="form-group">
                    <label for="ic" class="control-label">{{ \Language::getCom('member.lbl_ic') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="ic" id="ic" onkeydown="return ( event.ctrlKey || event.altKey
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9)
                            || (event.keyCode>34 && event.keyCode<40)
                            || (event.keyCode==46) )"
                        maxlength="12" data-bind="value: current().ic" required>
                </div>
                <div class="form-group">
                    <label for="ic_certified_by" class="control-label">{{ \Language::getCom('member.lbl_ic_certified_by') }}</label>
                    <input type="text" class="form-control" name="ic_certified_by" id="ic_certified_by" data-bind="value: current().ic_certified_by" maxlength="50">
                </div>
                <div class="form-group">
                    <label for="ic_certified_at" class="control-label">{{ \Language::getCom('member.lbl_ic_certified_at') }}</label>
                    <div class='input-group date' id='certified_at'>
                        <input type='text' class="form-control" id='ic_certified_at'/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>
                </div>
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#certified_at').datetimepicker({
            viewMode: 'years',
            format: 'YYYY/MM/DD'
        });
    });
</script>

@section('incAdd')
    $('#user_group_id').select2('val', '');
    $('#member_id').select2('val', '');
    self.user({active: 1});
    self.new_user(true);
@stop

@section('incUpd')
    $('#ic_certified_at').val(self.current().ic_certified_at);
    $('#member_id').select2('val', self.current().member_id);
    $.ajax({url: '{{ url($uri) }}/user', type: 'post', data: { _token: '{{ csrf_token() }}', user_id: self.current().user_id },
                success: function (data) {
                    self.user(data);
                    $('#user_group_id').select2('val', data.user_group_id);
                }
            });
    self.new_user(false);
@stop

@section('incSave')
    self.user().user_group_id = $('#user_group_id').val();
    self.user().active = $('input[name="active"]:checked').val();
    self.user().login_backend = $('input[name="login_backend"]').is(':checked') ? 1:0;
    self.user().login_frontend = $('input[name="login_frontend"]').is(':checked') ? 1:0;
    self.current().ic_certified_at = $('#ic_certified_at').val();
    self.current().member_id = $('#member_id').val();
    self.current().user = self.user();
@stop

@section('incFun')
    self.user = ko.observable({});
    self.new_user = ko.observable(true);
@stop