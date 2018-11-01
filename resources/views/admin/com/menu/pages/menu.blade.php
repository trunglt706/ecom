<!-- toolbar-->
<nav class="navbar navbar-default app-comm">
    <div class="container-fluid">
        <div data-bind="visible: view()==='table'">
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: add "><span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_add') }}</button>
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: ref " data-toggle="tooltip" title="{{ \Language::get('global.lbl_refesh') }}"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: collapseChange , enable: rows()!=''"><span data-bind="attr: {'class': 'fa fa-'+collapse()}"></span></button>
            <button type="button" class="btn btn-primary navbar-btn" data-bind="visible: sort() == true, click: doSort " style="display: none;"><span class="glyphicon glyphicon-floppy-disk"></span> {{ \Language::get('global.lbl_save') }}</button>
        </div>
        <div data-bind="visible: view()==='form'" style="display: none;">
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: back"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> {{ \Language::get('global.lbl_back') }}</button>
            <div class="navbar-form pull-right navbar-right">
                <button type="button" class="btn btn-default" data-bind="visible: method()=='add', click: doResetForm"><i class="glyphicon glyphicon-refresh"></i> {{ \Language::get('global.lbl_reset') }}</button>
                <button type="button" class="btn btn-primary" data-bind="click: doSave"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> {{ \Language::get('global.lbl_save') }}</button>
            </div>
        </div>
    </div>
</nav><!-- /toolbar-->
<div class="container-fluid">
    <div data-bind="visible: view()==='table'">
        <section class="loading-container">
            <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
            <div data-bind="visible: rows() == ''">
                <div class="text-center data-empty">
                    <span>
                        <i class="fa fa-sitemap"></i>
                    </span>
                    <h4>{{ Language::get('global.message_table_empty') }}</h4>
                </div>
            </div>
            <section data-bind="visible: rows() != ''">
                <div class="dd nestable" data-bind="html: rows"></div>
            </section>
        </section>
    </div>
    <div data-bind="visible: view()==='form'" style="display: none;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <form role="form" id="edit-form">
                            <div class="form-group">
                                <label class="control-label" for="menu_name">{{ \Language::getCom('menu.lbl_menu_name') }} <sup class="text-danger">(*)</sup></label>
                                <input type="text" class="form-control" id="menu_name" data-bind="value: current().menu_name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="alias">{{ \Language::getCom('menu.lbl_alias') }}</label>
                                <input type="text" class="form-control" id="alias" data-bind="value: current().alias">
                            </div>
                            <div class="form-group">
                                <label for="lang" class="control-label">{{ \Language::getCom('menu.lbl_lang') }} <sup class="text-danger">(*)</sup></label>
                                <select class="select2" id="lang" name="lang" required data-url="{{ $uri }}/lang"></select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="menu_type">{{ \Language::getCom('menu.lbl_menu_type') }} <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name="menu_type" id="menu_type" value="url" > {{ Language::getCom('menu.lbl_url') }}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="menu_type" id="menu_type" value="layout" > {{ Language::getCom('menu.lbl_layout') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group" data-bind="if: menu_type()=='url'">
                                <label class="control-label" for="menu_type_url">{{ \Language::getCom('menu.lbl_url') }} <sup class="text-danger">(*)</sup></label>
                                <input type="text" class="form-control" id="content" required>
                            </div>
                            <div class="form-group" data-bind="if: menu_type()=='layout'">
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly id="content" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" data-bind="click: cfmTemplateLayout "><i class="glyphicon glyphicon-th-large"></i> {{ \Language::get('global.lbl_choose') }}</button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label">{{ \Language::get('global.lbl_state') }} <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name="public" value="1" data-bind="attr:{'checked': current().public == '1'} "> {{ \Language::get('global.lbl_public') }}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="public" value="0" data-bind="attr:{'checked': current().public == '0'} "> {{ \Language::get('global.lbl_unpublic') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="option" class="control-label">{{ \Language::getCom('menu.lbl_options') }}</label>
                                <div>
                                    <label>
                                        <input type="checkbox" name="featured" value="1" data-bind="attr:{'checked': current().featured == '1'} "> {{ \Language::getCom('menu.lbl_featured') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="advance_class">{{ \Language::getCom('menu.lbl_advance_class') }}</label>
                                <input type="text" class="form-control" id="advance_class" data-bind="value: current().advance_class">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="icon">{{ \Language::getCom('menu.lbl_icon') }}</label>
                                <input type="text" class="form-control" id="icon" data-bind="value: current().icon">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="note">{{ \Language::getCom('menu.lbl_note') }}</label>
                                <textarea class="form-control" id="note" data-bind="value: current().note"></textarea>
                            </div>

                            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <section id="menu-assignment">
                                <div class="form-group">
                                    <label class="control-label">{{ \Language::getCom('system.lbl_assignment') }} <sup class="text-danger">(*)</sup></label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="assignmentMode" value="and"> {{ \Language::getCom('menu.lbl_allow_usergroup_assignment') }}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="assignmentMode" value="not"> {{ \Language::getCom('menu.lbl_disallow_usergroup_assignment') }}
                                    </label>
                                </div>
                                <section class="table-header-fixed-top" id="assignment">
                                    <table class="table table-header">
                                        <thead>
                                            <tr>
                                                <th width="30px"><input type="checkbox" data-bind="click: toogleAll,checked: assignments().length===assignmentIDs().length"/></th>
                                                <th>{{ Language::getCom('menu.lbl_usergroup') }}</th>
                                            </tr>
                                         </thead>
                                    </table>
                                    <div class="grid-container loading-container wrap-scroll" style="height: 200px;">
                                        <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
                                        <table class="table table-hover table-content thead-hide">
                                            <thead>
                                                <tr>
                                                    <th width="30px"><input type="checkbox" data-bind="click: toogleAll,checked: assignments().length===assignmentIDs().length"/></th>
                                                    <th>{{ Language::getCom('system.lbl_assignment') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--ko foreach: assignments-->
                                                <tr>
                                                    <td><input type="checkbox" data-bind="checkedValue: id, checked: $parent.assignmentIDs.indexOf(id) >=0, click: $parent.assignment.bind($data, $rawData) "/></td>
                                                    <td data-bind="html: group_name "></td>
                                                </tr>
                                                <!--/ko-->
                                                <tr data-bind="visible: assignments().length==0 ">
                                                    <td colspan="2" class="text-center active">{{ \Language::get('global.message_table_empty') }}</td>
                                                </tr>
                                            </tbody>
                                       </table>
                                    </div>
                                </section>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--cfmTemplateLayout-->
<div class="modal" id="cfmTemplateLayout" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmTemplateLayout" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="container-fluid">
                <h4>{{ \Language::getCom('system.lbl_template_select_layout') }}</h4>
            </div>

            <div class="wrap-scroll grey-lighten-2" style="height: 500px;" id="layoutConfig"></div>
        </div>
    </div>
</div>
@include(\Path::viewAdmin('blocks.cfmDel'))
<script>
    // validate form
    var validate = $('#edit-form').validate({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    function ViewModel() {
        var self = this;
        self.current = ko.observable({});
        self.view = ko.observable('table');
        self.method = ko.observable('');
        self.rows = ko.observable('');
        self.active = ko.observable(null);
        self.ids = ko.observable('');
        self.sort = ko.observable(false);
        self.menu_type = ko.observable();

        self.collapse = ko.observable('expand');
        self.add = function () {
            self.doResetForm();
            self.view('form');
            self.method('add');
            self.menu_type('layout');
            $('input[name="menu_type"][value="layout"]').prop('checked',true);
            $('input[name="public"][value="1"]').prop('checked',true);
            $('#lang').select2('val', '');
            self.assignmentIDs([]);
            $('input[name="assignmentMode"][value="and"]').prop('checked', true);
        };
        self.edit = function (id) {
            $.post('{{ $uri }}', {_token: '{{ csrf_token() }}', id: id}, function (data) {
                self.current(data);
                self.view('form');
                self.method('update');
                self.active(id);
                self.menu_type(data.menu_type);
                $('input[name="menu_type"][value="'+data.menu_type+'"]').prop('checked',true);
                $('#content').val(data.content);
                $('#lang').select2('val', self.current().lang);
                var assignment = JSON.parse(self.current().assignment);
                self.assignmentIDs(assignment.assignment);
                $('input[name="assignmentMode"][value="'+assignment.mode+'"]').prop('checked', true);
            });
        };
        self.back = function () {
            self.view('table');
        };
        self.del = function (id) {
            self.active(id);
            $('#cfmDel').modal('show');
        };
        self.doDel = function () {
            $.ajax({url: '{{ $uri }}/delete', type: 'post', data: {_token: '{{ csrf_token() }}', id: self.active()},
                beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
                success: function (data) {
                    toastr[data.status](data.message);
                    if (data.status === 'success'){
                        self.fetch();
                    }
                }
            });
        };
        self.doSort = function () {
            self.ids(JSON.stringify($('.nestable').nestable('serialize')));
        };
        self.nestablechange = function (){
            self.sort(self.ids() != JSON.stringify($('.nestable').nestable('serialize')));
        }
        self.ref = function () {
            self.fetch();
        };
        self.doResetForm = function(){
            self.current({});
            if($('#edit-form').length > 0){
                $('#edit-form')[0].reset();
                $('#edit-form .form-group').removeClass('has-error');
                validate.resetForm();
            }
        };
        self.doSave = function(){
            if (!$('#edit-form').valid())
                return false;
            self.current().menu_type = self.menu_type();
            self.current().content = $('#content').val();
            self.current().public = $('input[name="public"]:checked').val();
            self.current().featured = $('input[name="featured"]:checked').val();
            self.current().lang = $('#lang').val();
            self.current().assignment = JSON.stringify({
                mode: $('input[name="assignmentMode"]:checked').val(),
                assignment: self.assignmentIDs()
            });
            self.current()._token = '{{ csrf_token() }}';
            $.ajax({url: '{{ $uri }}/' +  self.method(), type: 'post', data: self.current(),
                beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
                success: function (data) {
                    toastr[data.status](data.message);
                    if (data.status === 'success'){
                        self.fetch();
                        self.view('table');
                    }
                }
            });
        }
        self.fetch = function () {
            $.ajax({url: '{{ $uri }}/tree', type: 'post', data: {_token: '{{ csrf_token() }}', ids: self.ids()},
                beforeSend: function () {
                    $('.loading').addClass('open');
                },
                error: errorConnect,
                complete: function () {
                    $('.loading').removeClass('open');
                },
                success: function (data) {
                    self.sort(false);
                    self.rows('');
                    if(data != ''){
                        self.rows(data);
                        $('.nestable').nestable().on('change', self.nestablechange);
                        self.ids(JSON.stringify($('.nestable').nestable('serialize')));
                        ko.applyBindings(self, $('.nestable .dd-list')[0]);
                    }
                    self.collapse('expand');
                }
            });
        };
        self.collapseChange = function(){
            switch (self.collapse()) {
                case 'compress':
                    self.collapse('expand');
                    $('.nestable').nestable('expandAll');
                    break;
                default:
                    // expand
                    self.collapse('compress');
                    $('.dd').nestable('collapseAll');
                    break;
            }
        };
        self.cfmTemplateLayout = function(){
            $.ajax({url: '{{ $uri }}/layout-config', type: 'post', data: {_token: '{{ csrf_token() }}', lang: $('#lang').val(), layout: $('#content').val(), attribs: self.method()=='update' ? self.current().attribs : null },
                beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
                success: function (data) {
                    if (data.status === 'success'){
                        $('#layoutConfig').html(data.data);
                        $('#cfmTemplateLayout').modal('show');
                    }else toastr[data.status](data.message);
                }
            });
        };
        self.setTemplateLayout = function(layout, attribs){
            self.current().content = layout;
            self.current().attribs = attribs;
            $('#content').val(layout);
            $('#cfmTemplateLayout').modal('hide');
        };

        $('input[name="menu_type"]').change(function(){
            var menu_type = $('input[name="menu_type"]:checked').val();
            self.menu_type(menu_type);
        });

        // assignment
        self.assignments = ko.observableArray([]);
        self.assignmentIDs = ko.observableArray([]);
        $.post( "{{ $uri }}/user-group", {_token: '{{ csrf_token() }}'}, function( data ) {
            self.assignments(data);
        });
        self.toogleAll = function () {
            if (self.assignmentIDs().length === self.assignments().length) {
                self.assignmentIDs([]);
            } else {
                var t = [];
                ko.utils.arrayForEach(self.assignments(), function (item) {
                    t.push(item.id);
                });
                self.assignmentIDs(t);
            }
            return true;
        };
        self.assignment = function (data) {
            if(self.assignmentIDs.indexOf(data.id) >= 0){
                self.assignmentIDs.remove(data.id);
            }else {
                self.assignmentIDs.push(data.id);
            }
            return true;
        };

        // computed
        ko.computed(self.fetch);
    }
    var viewMode = new ViewModel();
    ko.applyBindings(viewMode);

    // select 2 fetch data using html attributes
    selectFetchData();
    function selectFetchData() {
        $('.select2').each(function () {
            var selector = '#' + $(this).attr('id');
            $.post($(selector).attr('data-url'), {_token: '{{ csrf_token() }}'}, function (data) {
                $(selector).select2({data: data, width: '100%', language: '{{ \App::getLocale() }}'});
            });
        });
    }
</script>
