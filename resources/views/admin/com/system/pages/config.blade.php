<!-- toolbar-->
<nav class="navbar navbar-default app-comm">
    <div class="container-fluid">
        <div class="navbar-form pull-right navbar-right">
            <button type="button" class="btn btn-primary" data-bind="click: doSave"><span class="glyphicon glyphicon-floppy-disk"></span> {{ Language::get('global.lbl_save') }}</button>
        </div>
    </div>
</nav><!-- /toolbar-->
<div class="container-fluid" style="margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form role="form" id="frm_system_config">
                        <div class="row">
                            <div class="col-md-6">
                                <legend>{{ Language::getCom('system.lbl_site_config') }}</legend>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="offline" value="1" data-bind="attr:{'checked': system().offline == '1'} "> {{ Language::getCom('system.lbl_offline') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title_vi" class="control-label">{{ Language::getCom('system.lbl_title_vi') }}</label>
                                    <textarea class="form-control" name="title_vi" id="title_vi" required rows="3" data-bind="value: system().title_vi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title_en" class="control-label">{{ Language::getCom('system.lbl_title_en') }}</label>
                                    <textarea class="form-control" name="title_en" id="title_en" required rows="3" data-bind="value: system().title_en"></textarea>
                                </div>
                                <legend>{{ Language::getCom('system.lbl_seo') }}</legend>
                                <div class="form-group">
                                    <label for="keywords" class="control-label">{{ Language::getCom('system.lbl_keyword') }}</label>
                                    <textarea class="form-control" name="keywords" id="keywords" required rows="3" data-bind="value: system().keywords"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label">{{ Language::getCom('system.lbl_description') }}</label>
                                    <textarea class="form-control" name="description" id="description" required rows="3" data-bind="value: system().description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <legend>{{ Language::getCom('system.lbl_mail_config') }}</legend>
                                <div class="form-group">
                                    <label for="mail_driver" class="control-label">{{ Language::getCom('system.lbl_driver') }}</label>
                                    <input type="text" class="form-control" name="mail_driver" id="mail_driver" required data-bind="value: mail().mail_driver">
                                </div>
                                <div class="form-group">
                                    <label for="mail_host" class="control-label">{{ Language::getCom('system.lbl_host') }}</label>
                                    <input type="text" class="form-control" name="mail_host" id="mail_host" required  data-bind="value: mail().mail_host">
                                </div>
                                <div class="form-group">
                                    <label for="mail_port" class="control-label">{{ Language::getCom('system.lbl_port') }}</label>
                                    <input type="text" class="form-control" name="mail_port" id="mail_port" required data-bind="value: mail().mail_port">
                                </div>
                                <div class="form-group">
                                    <label for="mail_username" class="control-label">{{ Language::getCom('system.lbl_username') }}</label>
                                    <input type="text" class="form-control" name="mail_username" id="mail_username" required data-bind="value: mail().mail_username">
                                </div>
                                <div class="form-group">
                                    <label for="mail_password" class="control-label">{{ Language::getCom('system.lbl_password') }}</label>
                                    <input type="password" class="form-control" name="mail_password" id="mail_password" required data-bind="value: mail().mail_password">
                                </div>
                                <div class="form-group">
                                    <label for="mail_encryption" class="control-label">{{ Language::getCom('system.lbl_encryption') }}</label>
                                    <input type="text" class="form-control" name="mail_encryption" id="mail_encryption" required data-bind="value: mail().mail_encryption">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <section>
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-cogs"></i> {{ Language::getCom('system.lbl_system_dir_permissions') }}</div>
                    <ul class="list-group">
                        <?php $dirs = ['PATH_MODEL', 'PATH_CONTROLLER', 'PATH_LANG', 'PATH_VIEW_ADMIN', 'PATH_VIEW_SITE', 'PATH_VIEW_TEMPLATE', 'PATH_LIB', 'PATH_LIB_TEMPLATE', 'PATH_UPLOAD', 'PATH_DOWNLOAD', 'PATH_EXTRACT']; ?>
                        @foreach($dirs as $dir)
                        <li class="list-group-item">
                            @if(is_writable(config('data.'.$dir)))
                                <span class="badge badge-success">{{ Language::getCom('system.lbl_system_dir_can_writable') }}</span>
                            @else
                                <span class="badge badge-error">{{ Language::getCom('system.lbl_system_dir_can_writable') }}</span>
                            @endif
                            {{ explode(base_path(), config('data.'.$dir))[1] }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    // validate form
    var validate = $('#frm_system_config').validate({
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
        self.system = ko.observable(
            JSON.parse('<?php echo json_encode(\System::getValue("system")); ?>')
        );
        self.mail = ko.observable(
            JSON.parse('<?php echo json_encode(\System::getValue("mail")); ?>')
        );

        self.doSave = function(){
            if (!$('#frm_system_config').valid())
                return false;
            self.system().show_lang_code = $('#show_lang_code').is(':checked') ? 1:0;
            self.system().offline = $('#offline').is(':checked') ? 1:0;
            $.ajax({url: '{{ $uri }}/update', type: 'post', data: {
                    _token: '{{ csrf_token() }}',
                    system: JSON.stringify(self.system()),
                    mail: JSON.stringify(self.mail()),
                    en: self.system().title_en,
                    vi: self.system().title_vi
                },
                beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
                success: function (data) {
                    toastr[data.status](data.message);
                    if (data.status === 'success'){
                        window.location.reload();
                    }
                }
            });
        };
    }
    var viewModel = new ViewModel();
    ko.applyBindings(viewModel);
</script>
