<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="field_name" class="control-label">{{ \Language::getCom('product.lbl_field_name') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="field_name" id="field_name" data-bind="value: current().field_name" required>
                </div>
                <div class="form-group">
                    <label for="data_type" class="control-label">{{ \Language::getCom('product.lbl_data_type') }} <sup class="text-danger">(*)</sup></label>
                    <select class="form-control" name="data_type" id="data_type" data-bind="value: current().data_type" required>
                        <option value="text">Text</option>
                        <option value="number">number</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="input_type" class="control-label">{{ \Language::getCom('product.lbl_input_type') }} <sup class="text-danger">(*)</sup></label>
                    <select class="form-control" name="input_type" id="input_type" data-bind="value: current().input_type" required>
                        <option value="input">Input</option>
                        <option value="textarea">Textarea</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="unit" class="control-label">{{ \Language::getCom('product.lbl_unit') }}</label>
                    <input type="text" class="form-control" name="unit" id="unit" data-bind="value: current().unit">
                </div>
                <div class="form-group">
                    <label for="not_null" class="control-label">{{ \Language::getCom('product.lbl_not_null') }}</label>
                    <select class="form-control" name="not_null" id="not_null" data-bind="value: current().not_null" required>
                        <option value="1">{{ \Language::getCom('product.lbl_not_null_input') }}</option>
                        <option value="0">{{ \Language::getCom('product.lbl_null_input') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sort" class="control-label">{{ \Language::getCom('product.lbl_sort') }}</label>
                    <input type="number" class="form-control" name="sort" id="sort" data-bind="value: current().sort">
                </div>
                <div class="form-group">
                    <label for="lang" class="control-label">{{ \Language::getCom('system.lbl_language') }} <sup class="text-danger">(*)</sup></label>
                    <select class="form-control" id="lang" name="lang" data-bind="value: current().lang" required>
                        @foreach(Language::getLang() as $code=>$lang)
                        <option value="{{ $code }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="note" class="control-label">{{ \Language::getCom('product.lbl_note') }}</label>
                    <textarea class="form-control" name="note" id="note" data-bind="value: current().note"></textarea>
                </div>
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
            </div>
        </div>
    </div>
</div>