<!-- toolbar-->
<nav class="navbar navbar-default app-comm">
    <div class="container-fluid">
        <div data-bind="visible: view()==='table'">
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: add "><span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_add') }}</button>
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: ref " data-toggle="tooltip" title="{{ \Language::get('global.lbl_refresh') }}"><span class="glyphicon glyphicon-refresh"></span></button>
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: collapseChange "><span data-bind="attr: {'class': 'fa fa-'+collapse()}"></span></button>
            <button type="button" class="btn btn-primary navbar-btn" data-bind="visible: sort() == true, click: doSort "><span class="glyphicon glyphicon-ok"></span></button>
        </div>
        <div data-bind="visible: view()==='form'" style="display: none;">
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: back"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> {{ \Language::get('global.lbl_back') }}</button>
            <div class="navbar-form pull-right navbar-right">
                <button type="button" class="btn btn-default" data-bind="visible: method()=='add', click: doResetForm"><i class="glyphicon glyphicon-refresh"></i> {{ \Language::get('global.lbl_reset') }}</button>
                <button type="button" class="btn btn-primary" data-bind="click: doSave"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> {{ \Language::get('global.lbl_save') }}</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid" style="margin-bottom: 50px;">
    <div data-bind="visible: view()==='table'">
        <section class="loading-container">
            <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
            <div class="alert alert-info" data-bind="visible: rows() == ''">
                <i>{{ \Language::get('global.message_table_empty') }}</i>
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
                    <form role="form" id="edit-form">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="category_name">{{ \Language::getCom('content.lbl_category_name') }} <sup class="text-danger">(*)</sup></label>
                                <input type="text" class="form-control" id="category_name" data-bind="value: current().category_name" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label" for="note">{{ \Language::getCom('content.lbl_note') }}</label>
                                <textarea class="form-control" id="note" rows="5" placeholder="{{ \Language::getCom('content.lbl_note') }}" data-bind="value: current().note"></textarea>
                            </div>
                            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include(Path::viewAdmin('blocks.cfmDel'))
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

        self.collapse = ko.observable('expand');
        self.add = function () {
            self.doResetForm();
            self.view('form');
            self.method('add');
        };
        self.edit = function (id) {
            $.post('{{ $uri }}', {_token: '{{ csrf_token() }}', id: id}, function (data) {
                self.current(data);
                self.view('form');
                self.method('update');
                self.active(id);
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

        // computed
        ko.computed(self.fetch);
    }
    var viewMode = new ViewModel();
    ko.applyBindings(viewMode);
</script>
