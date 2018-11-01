<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="title" class="control-label">{{ \Language::getCom('system.lbl_title') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="title" id="title" data-bind="value: current().title" required>
                </div>
                <div class="form-group">
                    <label for="alias" class="control-label">{{ \Language::getCom('system.lbl_alias') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="alias" id="alias" data-bind="value: current().alias" required>
                </div>
                <div class="form-group">
                    <label for="lang_code" class="control-label">{{ \Language::getCom('system.lbl_lang_code_render') }} <sup class="text-danger">(*)</sup></label>
                    <select class="select2" id="lang_code" name="lang_code" required>
                        @foreach(Language::getLang() as $code=>$lang)
                        <option value="{{ $code }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="template_id" class="control-label">{{ \Language::getCom('system.lbl_template_id_render') }} <sup class="text-danger">(*)</sup></label>
                    <select class="select2" id="template_id" name="template_id" required data-url="{{ $uri }}/templates"></select>
                </div>
                <div class="form-group">
                    <label class="control-label">{{ \Language::get('global.lbl_option') }}</label>
                    <div>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="default" value="1" data-bind="attr:{'checked': current().default == '1'} "> {{ \Language::getCom('system.lbl_default_render') }}
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="public" value="1" data-bind="attr:{'checked': current().public == '1'} "> {{ \Language::getCom('system.lbl_public_render') }}
                        </label>
                    </div>
                </div>
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
            </div>
        </div>
    </div>
</div>

@section('incAdd')
    $('#lang_code').select2('val', '');
    $('#template_id').select2('val', '');
@stop

@section('incUpd')
    $('#template_id').select2('val', self.current().template_id);
    $('#lang_code').select2('val', self.current().lang_code);
@stop

@section('incSave')
    self.current().template_id = $('#template_id').val();
    self.current().lang_code = $('#lang_code').val();
    self.current().default = $('input[name="default"]:checked').val() != null ? $('input[name="default"]:checked').val() : 0;
    self.current().public = $('input[name="public"]:checked').val() != null ? $('input[name="public"]:checked').val() : 0;
@stop
