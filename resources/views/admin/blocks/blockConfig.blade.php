<?php
    $assignment = json_decode(json_encode([
        "mode"=>"and", "assignment"=>[]
    ]));
    if(isset($block)){
        $assignment = json_decode($block->assignment);
    }
?>
<section id="block-config">
    <ul class="nav nav-tabs" role="tablist" id="blockConfigTablist">
        <li role="presentation" class="active"><a href="#config" aria-controls="config" role="tab" data-toggle="tab">{{ Language::getCom('system.lbl_global_config') }}</a></li>
        <li role="presentation"><a href="#assignment-setting" aria-controls="assignment-setting" role="tab" data-toggle="tab">{{ Language::getCom('system.lbl_assignment') }}</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="config">
            <div class="row">
                <form role="form" id="frm-block-config">
                    <div class="col-md-8">
                        @yield('block-config')
                    </div>
                    <div class="col-md-4">
                        <legend>{{ \Language::getCom('system.lbl_global_config') }}</legend>
                        <div class="form-group">
                            <label for="title" class="control-label">{{ \Language::getCom('system.lbl_title') }} <sup class="text-danger">(*)</sup></label>
                            <input type="text" class="form-control" name="title" id="title" data-bind="value: current().title" required>
                        </div>
                        <div class="form-group">
                            <label for="position" class="control-label">{{ \Language::getCom('system.lbl_position') }} <sup class="text-danger">(*)</sup></label>
                            <select class="select2" id="position" required>
                                <option value="">None</option>
                                @foreach ( Template::get() as $template)
                                    @foreach (json_decode($template->layout) as $layout)
                                        <optgroup label="[{{ $template->extension_name }}] {{ $layout->layout }}">
                                        @foreach ($layout->positions as $position )
                                            <option value="{{ $position }}">{{ $position }}</option>
                                        @endforeach
                                        </optgroup>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sort" class="control-label">{{ \Language::getCom('system.lbl_sort') }}</label>
                            <input type="number" class="form-control" name="sort" id="sort" data-bind="value: current().sort" min="0">
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ \Language::get('global.lbl_option') }}</label>
                            <div>
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="public" value="1" data-bind="attr:{'checked': current().public == '1'} "> {{ \Language::getCom('system.lbl_public_render') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
                    </div>
                </form>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="assignment-setting">
            <section id="block-assignment">
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
                                        <td><input type="checkbox" data-bind="checkedValue: id,checked: viewModelBlockConfig.assignment"/></td>
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
            </section>
        </div>
    </div>
</section>

<script>
    // validate form
    var validate = $('#frm-block-config').validate({
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
    function ViewModelBlockConfig() {
        var self = this;
        self.menus = ko.observableArray([]);
        self.assignment = ko.observableArray(JSON.parse('{{ json_encode($assignment->assignment) }}'));

        @if(isset($block))
            self.current = ko.observable({
                id: {{ $block->id }},
                title: '<?php echo $block->title ?>',
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
            @yield('attribs-init')
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
            self.current().module_id = '{{ $module->id }}';
            self.current().assignment = JSON.stringify({
                mode: $('input[name="assignmentMode"]:checked').val(),
                assignment: self.assignment()
            });
            self.current().position = $('#position').val();
            @yield('attribs-save')
            self.current().attribs = JSON.stringify(self.attribs());
            self.current().public = $('#public').is(':checked') ? 1 : 0;
            return self.current();
        }

        ko.computed(self.fetch);
    }
    var viewModelBlockConfig = new ViewModelBlockConfig();
    ko.applyBindings(viewModelBlockConfig, document.getElementById('block-config'));
    $('.select2').select2({width: "100%"});
    $('#position').select2('val', '{{ isset($block) ? $block->position : "" }}');
    @yield('block-config-function-include')
</script>
