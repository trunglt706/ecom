<?php
    $attribs = json_decode($module->attribs);
    $assignment = json_decode(json_encode([
        "mode"=>"and", "assignment"=>[]
    ]));
    if(isset($block)){
        $attribs = json_decode($block->attribs);
        $assignment = json_decode($block->assignment);
    }
?>
<section id="contact-block-config">
    <div class="row">
        <form role="form" id="frm-contact-block-config">
            <div class="col-md-4">
                <legend>{{ \Language::getCom('system.lbl_global_config') }}</legend>
                <div class="form-group">
                    <label for="title" class="control-label">{{ \Language::getCom('system.lbl_title') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="title" id="title" data-bind="value: current().title" required>
                </div>
                <div class="form-group">
                    <label for="sort" class="control-label">{{ \Language::getCom('system.lbl_sort') }}</label>
                    <input type="number" class="form-control" name="sort" id="sort" data-bind="value: current().sort" required min="0">
                </div>
                <div class="form-group">
                    <label class="control-label">{{ \Language::get('global.lbl_option') }}</label>
                    <div>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="public" value="1" data-bind="attr:{'checked': current().public == '1'} "> {{ \Language::getCom('system.lbl_public_render') }}
                        </label>
                    </div>
                </div>
                <legend>{{ \Language::getCom('system.lbl_mail_config') }}</legend>
                <div class="form-group">
                    <label for="email" class="control-label">{{ \Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="email" id="email" data-bind="value: attribs().email" required>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">{{ \Language::getCom('system.lbl_password') }} <sup class="text-danger">(*)</sup></label>
                    <input type="password" class="form-control" name="password" id="password" data-bind="value: attribs().password" required>
                </div>
                <div class="form-group">
                    <label for="driver" class="control-label">{{ \Language::getCom('system.lbl_driver') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="driver" id="driver" data-bind="value: attribs().driver" required>
                </div>
                <div class="form-group">
                    <label for="host" class="control-label">{{ \Language::getCom('system.lbl_host') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="host" id="host" data-bind="value: attribs().host" required>
                </div>
                <div class="form-group">
                    <label for="port" class="control-label">{{ \Language::getCom('system.lbl_port') }} <sup class="text-danger">(*)</sup></label>
                    <input type="number" class="form-control" name="port" id="port" data-bind="value: attribs().port" required min="0">
                </div>
                <div class="form-group">
                    <label for="encryption" class="control-label">{{ \Language::getCom('system.lbl_encryption') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="encryption" id="encryption" data-bind="value: attribs().encryption" required>
                </div>
            </div>
            <div class="col-md-8">
                <legend>{{ \Language::getCom('system.lbl_assignment') }}</legend>
                <div class="form-group">
                    <label class="control-label">{{ \Language::get('global.lbl_option') }} <sup class="text-danger">(*)</sup></label><br>
                    <label class="radio-inline">
                        <input type="radio" name="assignmentMode" value="and" {{ $assignment->mode == 'and'?'checked':'' }}> {{ \Language::getCom('system.lbl_show_block_at_menu') }}
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="assignmentMode" value="not" {{ $assignment->mode == 'not'?'checked':'' }}> {{ \Language::getCom('system.lbl_not_show_block_at_menu') }}
                    </label>
                </div>
                <section class="table-header-fixed-top" id="assignment">
                    <table class="table table-header">
                        <thead>
                            <tr>
                                <th><input type="checkbox" data-bind="click: toogleAll,checked: assignment().length===menus().length"/></th>
                                <th>{{ Language::getCom('system.lbl_assignment') }}</th>
                            </tr>
                         </thead>
                    </table>
                    <div class="grid-container loading-container wrap-scroll" style="height: 200px;">
                        <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
                        <table class="table table-hover table-content thead-hide">
                            <thead>
                                <tr>
                                    <th width="30px"><input type="checkbox" data-bind="click: toogleAll,checked: assignment().length===assignment().length"/></th>
                                    <th>{{ Language::getCom('system.lbl_assignment') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--ko foreach: menus-->
                                <tr>
                                    <td><input type="checkbox" data-bind="checkedValue: id,checked: viewModelContactConfig.assignment"/></td>
                                    <td data-bind="html: text "></td>
                                </tr>
                                <!--/ko-->
                                <tr data-bind="visible: menus().length==0 ">
                                    <td colspan="2" class="text-center active">{{ \Language::get('global.message_table_empty') }}</td>
                                </tr>
                            </tbody>
                       </table>
                    </div>
                </section>
                    
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
                <div class="btn btn-primary pull-right" data-bind="click: doSave">
                    <span class="glyphicon glyphicon-floppy-disk"></span> {{ Language::get('global.lbl_save') }}
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    // validate form
    var validate = $('#frm-contact-block-config').validate({
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
    function ViewModelContactConfig() {
        var self = this;
        self.menus = ko.observableArray([]);
        self.assignment = ko.observableArray(JSON.parse('{{ json_encode($assignment->assignment) }}'));
        
        @if(isset($block))
            self.current = ko.observable({
                id: {{ $block->id }},
                title: '{{ $block->title }}',
                module_id: {{ $block->module_id }},
                public: {{ $block->public }},
                sort: {{ $block->sort }},
                created_at: '{{ $block->created_at }}',
                updated_at: '{{ $block->updated_at }}'
            });
        @else 
            self.current = ko.observable({});
        @endif
        
        self.attribs = ko.observable({
            email: '{{ $attribs->email }}',
            password: '{{ $attribs->password }}',
            host: '{{ $attribs->host }}',
            port: '{{ $attribs->port }}',
            driver: '{{ $attribs->driver }}',
            encryption : '{{ $attribs->encryption }}'
        });
        
        self.toogleAll = function () {
            if (self.assignment().length === self.menus().length) {
                self.assignment([]);
            } else {
                var t = [];
                ko.utils.arrayForEach(self.menus(), function (item) {
                    t.push(item.id);
                });
                self.assignment(t);
            }
            return true;
        };
        self.fetch = function () {
            $.ajax({url: 'blocks/menus', type: 'post', data: { _token: '{{ csrf_token() }}'},
                beforeSend: showLoading, error: errorConnect, complete: hideLoading,
                success: function (data) {
                    self.menus(data);
                    tableRefesh('#assignment');
                }
            });
        };
        
        self.doSave = function(){
            if (!$('#frm-contact-block-config').valid())
                return false;
            self.current().module_id = '{{ $module->id }}';
            self.current().assignment = JSON.stringify({
                mode: $('input[name="assignmentMode"]:checked').val(),
                assignment: self.assignment()
            });
            self.current().attribs = JSON.stringify(self.attribs());
            self.current().public = $('input[name="public"]:checked').val();
            viewModel.current(self.current());
            viewModel.doSave();
        }
        
        ko.computed(self.fetch);
    }
    var viewModelContactConfig = new ViewModelContactConfig();
    ko.applyBindings(viewModelContactConfig, document.getElementById('contact-block-config'));
</script>