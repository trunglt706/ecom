<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="text-right col-md-12">
                <div class="btn btn-success" data-toggle="popover" data-placement="bottom" data-content="<?php echo Language::getCom('system.help_usergroup') ?>">
                    <i class="glyphicon glyphicon-question-sign"></i>
                </div>
            </div>
            <div class="col-md-4">
                <legend>{{ \Language::getCom('system.lbl_group_usergroup') }}</legend>
                <div class="form-group">
                    <label for="group_name" class="control-label">{{ Language::getCom('system.lbl_group_name') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="group_name" id="group_name" data-bind="value: current().group_name" required maxlength="50">
                </div>
                <div class="form-group">
                    <label for="note" class="control-label">{{ Language::getCom('system.lbl_note') }}</label>
                    <textarea type="text" class="form-control" name="note" id="note" rows="5" data-bind="value: current().note" ></textarea>
                </div>
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
            </div>
            <div class="col-md-8">
                <legend>{{ \Language::getCom('system.lbl_group_permission') }}</legend>
                <div class="form-group">
                    <label class="control-label">{{ Language::getCom('system.lbl_permission') }} <sup class="text-danger">(*)</sup></label>
                    <section class="table-header-fixed-top" id="table-permission">
                        <table class="table table-header">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ Language::getCom('system.lbl_function') }}</th>
                                    <th>{{ Language::getCom('system.lbl_permission') }}</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="grid-container loading-container wrap-scroll" style="height: 200px;">
                            <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
                            <table class="table table-permission table-content thead-hide">
                                <thead>
                                    <tr>
                                        <th width="50px"></th>
                                        <th>{{ Language::getCom('system.lbl_function') }}</th>
                                        <th>{{ Language::getCom('system.lbl_permission') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--ko foreach: permissions().data-->
                                    <tr>
                                        <td class="text-center">
                                            <span data-bind="html: $index() + 1 "></span>
                                        </td>
                                        <td width="150px">
                                            <span data-bind="html: fn(), attr:{'title': fn()} "></span>
                                        </td>
                                        <td>
                                            <!--ko foreach: perm()-->
                                            <div data-bind="click: check.bind($data, val), attr:{'class': val() == 'T' ? 'btn btn-default btn-xs text-success' : 'btn btn-default btn-xs text-danger'} ">
                                                <i data-bind="attr:{'class': val()=='T' ? 'glyphicon glyphicon-ok' : 'glyphicon glyphicon-remove'} "></i><br>
                                                <small data-bind="html: code() "></small>
                                            </div>
                                            <!--/ko-->
                                        </td>
                                    </tr>
                                    <!--/ko-->
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var permissions = ko.observableArray([]);
    function fetchPerm(id){
        $.ajax({url: '{{ $uri }}/permission', type: 'post', data: {_token: '{{ csrf_token() }}', id: id},
            beforeSend: showLoading , error: errorConnect, complete: hideLoading ,
            success: function (data) {
                permissions({data: ko.mapping.fromJS(data)});
                tableRefesh('#table-permission');
            }
        });
    }
    function check(val){
        val(val()=='T' ? 'F':'T');
    }
</script>

@section('incAdd')
    fetchPerm();
@endsection

@section('incUpd')
    fetchPerm(self.current().id);
@endsection

@section('incSave')
    self.current().permission = JSON.stringify(ko.mapping.toJS(permissions));
@endsection
