<div data-bind="visible: userView() == 'tbl' ">
    <div class="form-group">
        <div class="btn btn-default" data-bind="visible: userView() == 'tbl', click: addUser  "><span class="glyphicon glyphicon-plus"></span> {{ Language::get('global.lbl_add') }}</div>
        <div class="btn btn-default" data-bind="visible: userView() == 'tbl', click: fetchUser "><span class="glyphicon glyphicon-refresh"></span></div>
        <div class="btn btn-default" data-bind="visible: userView() == 'tbl', click: delUser "><span class="glyphicon glyphicon-trash"></span></div>
    </div>
    <hr>
    <legend>{{ Language::getCom('member.lbl_user_list') }}</legend>
    <section class="table-header-fixed-top" id="table-user">
        <table class="table table-header">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{ Language::getCom('system.lbl_fullname') }}</th>
                    <th>{{ Language::getCom('system.lbl_email') }}</th>
                    <th>{{ Language::getCom('system.lbl_username') }}</th>
                    <th>{{ Language::getCom('system.lbl_active_render') }}</th>
                    <th>{{ Language::getCom('system.lbl_note') }}</th>
                    <th></th>
                </tr>
            </thead>
        </table>
        <div class="grid-container loading-container wrap-scroll" style="height: 200px;">
            <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
            <table class="table table-user table-content thead-hide">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>{{ Language::getCom('system.lbl_fullname') }}</th>
                        <th>{{ Language::getCom('system.lbl_email') }}</th>
                        <th>{{ Language::getCom('system.lbl_username') }}</th>
                        <th>{{ Language::getCom('system.lbl_active_render') }}</th>
                        <th>{{ Language::getCom('system.lbl_note') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!--ko foreach: users()-->
                    <tr>
                        <td width="30px"><input type="checkbox" class="tblUserCheckbox" data-bind="attr:{'value': idx} "/></td>
                        <td>
                            <span data-bind="html: $index()+1 "></span>
                        </td>
                        <td>
                            <span data-bind="html: fullname, attr:{'title': fullname} "></span>
                        </td>
                        <td>
                            <span data-bind="html: email, attr:{'title': email} "></span>
                        </td>
                        <td>
                            <span data-bind="html: username, attr:{'title': username} "></span>
                        </td>
                        <td class="text-center">
                            <span data-bind="attr:{'class': active == 1 ? 'glyphicon glyphicon-ok-sign text-success' : 'glyphicon glyphicon-ok-sign text-danger'} "></span>
                        </td>
                        <td>
                            <span data-bind="html: note, attr:{'title': note} "></span>
                        </td>
                        <td class="text-right actions">
                            <div class="btn btn-default" data-bind="click: $parent.editUser.bind($data, $rawData)"><span class="glyphicon glyphicon-edit"></span></div>
                        </td>
                    </tr>
                    <!--/ko-->
                    <tr data-bind="visible: users().length==0 " style="display: none;">
                        <td colspan="8" class="text-center active">{{ \Language::get('global.message_table_empty') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <span class="text-muted">{{ Language::getCom('member.lbl_total_user') }}:</span> <b data-bind="html: users().length "></b>
    </section>
</div>
<div data-bind="visible: userView() == 'frm' ">
    <div class="form-group">
        <div class="btn btn-default" data-bind="visible: userView() == 'frm', click: cancelUser "><span class="glyphicon glyphicon-remove"></span> {{ Language::get('global.lbl_cancel') }}</div>
        <div class="btn btn-primary" data-bind="visible: userView() == 'frm', click: saveUser "><span class="glyphicon glyphicon-floppy-disk"></span> {{ Language::get('global.lbl_save') }}</div>
    </div>
    <hr>
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
            <div class="form-group">
                <label for="user_group_id" class="control-label">{{ \Language::getCom('system.lbl_user_groups_render') }} <sup class="text-danger">(*)</sup></label>
                <select class="select2" id="user_group_id" name="user_group_id" required>
                    @foreach (DB::table('user_groups')->select('id', 'group_name')->get() as $user_group)
                    <option value="{{ $user_group->id }}">{{ $user_group->group_name }}</option>
                    @endforeach
                </select>
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
                    maxlength="12" data-bind="value: user().ic" required>
            </div>
            <div class="form-group">
                <label for="ic_certified_by" class="control-label">{{ \Language::getCom('member.lbl_ic_certified_by') }}</label>
                <input type="text" class="form-control" name="ic_certified_by" id="ic_certified_by" data-bind="value: user().ic_certified_by" maxlength="50">
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