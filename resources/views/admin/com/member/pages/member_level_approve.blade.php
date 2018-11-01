<div>
    <div class="form-group">
        <div class="btn btn-default" data-bind="visible: userView() == 'tbl', click: addUser"><span class="glyphicon glyphicon-plus"></span> {{ Language::get('global.lbl_add') }}</div>
        <div class="btn btn-default" data-bind="visible: userView() == 'tbl', click: fetchUser"><span class="glyphicon glyphicon-refresh"></span></div>
        <div class="btn btn-default" data-bind="visible: userView() == 'tbl', click: delUser"><span class="glyphicon glyphicon-trash"></span></div>
    </div>
    <hr>
    <legend>{{ Language::getCom('member.lbl_user_list') }}</legend>
    <section class="table-header-fixed-top" id="table-user">
        <table class="table table-header">
            <thead>
                <tr>
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