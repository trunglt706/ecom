<?php
    $akey = App\Com\FileManager\FileManager::getSecretKey();
    $filemanager_path = 'filemanager?akey='.$akey;
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="image" class="control-label">{{ \Language::getCom('content.lbl_image') }}</label>
                            <a class="thumbnail" style="width:150px; height: 150px;" onclick="javascript:open_popup('{{ $filemanager_path.'&backgroundID=image' }}')">
                                <div class="thumbnail-img" id="image" data-bind="attr:{'style':current().image!=null? 'background-image: url('+current().image+');' : 'background-image:none;'}"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="title" class="control-label">{{ \Language::getCom('content.lbl_title') }} <sup class="text-danger">(*)</sup></label>
                            <input type="text" class="form-control" name="title" id="title" data-bind="value: current().title" required placeholder="{{ \Language::getCom('content.lbl_title') }}">
                        </div>
                        <div class="form-group">
                            <label for="alias" class="control-label">{{ \Language::getCom('content.lbl_alias') }}</label>
                            <input type="text" class="form-control" name="alias" id="alias" data-bind="value: current().alias" placeholder="{{ \Language::getCom('content.lbl_alias') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="control-label">{{ \Language::getCom('content.lbl_content_text') }} <sup class="text-danger">(*)</sup></label>
                    <textarea class="ckeditor" name="content" id="content" rows="10" cols="80"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category_id" class="control-label">{{ \Language::getCom('content.lbl_category_id_render') }} <sup class="text-danger">(*)</sup></label>
                    <select class="select2" id="category_id" name="category_id" data-placeholder="- {{ \Language::getCom('content.lbl_category_id_render') }} -" data-url="{{ $uri }}/categories"></select>
                </div>
                <div class="form-group">
                    <label for="public" class="control-label">{{ \Language::getCom('content.lbl_state') }} <sup class="text-danger">(*)</sup></label>
                    <select class="select2" id="public" name="public">
                        <option value="1">{{ \Language::getCom('content.lbl_public') }}</option>
                        <option value="0">{{ \Language::getCom('content.lbl_unpublic') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="featured" class="control-label">{{ \Language::getCom('content.lbl_featured') }} <sup class="text-danger">(*)</sup></label>
                    <select class="select2" id="featured" name="featured">
                        <option value="1">{{ \Language::getCom('content.lbl_true') }}</option>
                        <option value="0">{{ \Language::getCom('content.lbl_false') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sort" class="control-label">{{ \Language::getCom('content.lbl_sort') }}</label>
                    <input type="number" class="form-control" name="sort" id="sort" data-bind="value: current().sort" placeholder="{{ \Language::getCom('content.lbl_sort') }}">
                </div>
                <div class="form-group">
                    <label for="lang" class="control-label">{{ \Language::getCom('system.lbl_language') }} <sup class="text-danger">(*)</sup></label>
                    <select class="select2" id="lang" name="lang" required>
                        @foreach(Language::getLang() as $code=>$lang)
                        <option value="{{ $code }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags" class="control-label">{{ \Language::getCom('content.lbl_tags') }}</label>
                    <textarea class="form-control" id="tags" data-bind="value: current().tags" rows="4" cols="80"></textarea>
                </div>
                <div class="form-group">
                    <label for="keywords" class="control-label">{{ \Language::getCom('content.lbl_keywords') }}</label>
                    <textarea class="form-control" id="keywords" data-bind="value: current().keywords" rows="4" cols="80"></textarea>
                </div>
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
            </div>
        </div>
    </div>
</div>

@section('incAdd')
    CKEDITOR.instances.content.setData('');
    $('#category_id').select2('val', '');
    $('#public').select2('val', 0);
    $('#featured').select2('val', 0);
    $('#lang').select2('val', '{{ App::getLocale() }}');

@endsection

@section('incUpd')
    CKEDITOR.instances.content.setData(self.current().content);
    $('#category_id').select2('val', self.current().category_id);
    $('#public').select2('val', self.current().public);
    $('#featured').select2('val', self.current().featured);
    $('#lang').select2('val', self.current().lang);
    $('#image').css('background-image', 'url('+self.current().image+')');
@endsection

@section('incSave')
    self.current().content = CKEDITOR.instances.content.getData();
    self.current().category_id = $('#category_id').val();
    self.current().public = $('#public').val();
    self.current().featured = $('#featured').val();
    self.current().lang = $('#lang').val();
    var bg = $('#image').css('background-image');
    self.current().image = bg.substr(bg.indexOf('{{ config("data.UPLOAD_DIR") }}')).replace('\"\)', '');
    //var bg = $('#image').css('background-image');
    //self.current().image = bg.replace('url("','').replace('")','');
@endsection
