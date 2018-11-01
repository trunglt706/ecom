<?php
    $akey = App\Com\FileManager\FileManager::getSecretKey();
    $filemanager_path = 'filemanager?akey='.$akey; 
?>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="form-tabs">
    <li role="presentation" class="active"><a href="#content" aria-controls="content" role="tab" data-toggle="tab">{{ \Language::getCom('content.lbl_content_text') }}</a></li>
    <li role="presentation"><a href="#options" aria-controls="options" role="tab" data-toggle="tab">{{ \Language::getCom('content.lbl_options') }}</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="content">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="title" class="control-label">{{ \Language::getCom('content.lbl_title') }} *</label>
                    <input type="text" class="form-control" name="title" id="title" data-bind="value: current().title" required placeholder="{{ \Language::getCom('content.lbl_content') }}">
                </div>
                <div class="form-group">
                    <label for="alias" class="control-label">{{ \Language::getCom('content.lbl_alias') }}</label>
                    <input type="text" class="form-control" name="alias" id="alias" data-bind="value: current().alias" placeholder="{{ \Language::getCom('content.lbl_alias') }}">
                </div>
                <div class="form-group">
                    <label for="content" class="control-label">{{ \Language::getCom('content.lbl_content_text') }} *</label>
                    <textarea class="ckeditor" name="content" id="content" rows="10" cols="80"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category_id" class="control-label">{{ \Language::getCom('content.lbl_category_id_render') }} *</label>
                    <select class="select2" id="category_id" name="category_id" data-placeholder="- {{ \Language::getCom('content.lbl_category_id_render') }} -" data-url="{{ url($uri) }}/categories"></select>
                </div>
                <div class="form-group">
                    <label for="public" class="control-label">{{ \Language::getCom('content.lbl_state') }} *</label>
                    <select class="select2" id="public" name="public">
                        <option value="1">{{ \Language::getCom('content.lbl_public') }}</option>
                        <option value="0">{{ \Language::getCom('content.lbl_unpublic') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="featured" class="control-label">{{ \Language::getCom('content.lbl_featured') }} *</label>
                    <select class="select2" id="featured" name="featured">
                        <option value="1">{{ \Language::getCom('content.lbl_true') }}</option>
                        <option value="0">{{ \Language::getCom('content.lbl_false') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sort" class="control-label">{{ \Language::getCom('content.lbl_sort') }}</label>
                    <input type="number" class="form-control" name="sort" id="sort" data-bind="value: current().sort" placeholder="{{ \Language::getCom('content.lbl_sort') }}">
                </div>
                <!--include('administrator.modules.mod_selLang')-->
                <div class="form-group">
                    <label for="tags" class="control-label">{{ \Language::getCom('content.lbl_tags') }}</label>
                    <textarea class="form-control" id="tags" data-bind="value: current().tags" rows="5" cols="80"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="options">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ \Language::getCom('content.lbl_image_intro') }}</label>
                    <div class="input-group">
                        <div class="input-group-addon btn btn-default" onclick="javascript:open_popup('{{ url('media') }}/'+($('#image_intro').val()=='' ? 'image_intro.jpg' : $('#image_intro').val()))">
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </div>
                        <input type="text" class="form-control" id="image_intro" name="image_intro" readonly>
                        <div class="input-group-addon btn btn-default" onclick="javascript:delImg('image_intro')">
                            <i class="glyphicon glyphicon-remove"></i>
                        </div>
                        <span class="input-group-addon btn btn-default">click: $parent.chooseMedia.bind($data, 'mediaContent'+$index())
                            <div onclick="javascript:open_popup('{{ url('dist/plugins/filemanager/filemanager/dialog.php?type=0&popup=1&field_id=image_intro&relative_url=1&akey='.config('app.key')) }}')" >
                                {{ \Language::getCom('content.lbl_browse_server') }}
                            </div>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">{{ \Language::getCom('content.lbl_image_fulltext') }}</label>
                    <div class="input-group">
                        <div class="input-group-addon btn btn-default" onclick="javascript:open_popup('{{ url('media') }}/'+($('#image_fulltext').val()=='' ? 'image_fulltext.jpg' : $('#image_fulltext').val()))">
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </div>
                        <input type="text" class="form-control" id="image_fulltext" name="image_fulltext" readonly>
                        <div class="input-group-addon btn btn-default" onclick="javascript:delImg('image_fulltext')">
                            <i class="glyphicon glyphicon-remove"></i>
                        </div>
                        <span class="input-group-addon btn btn-default">
                            <div onclick="javascript:open_popup('{{ url('dist/plugins/filemanager/filemanager/dialog.php?type=0&popup=1&field_id=image_fulltext&relative_url=1&akey='.config('app.key')) }}')" >
                                {{ \Language::getCom('content.lbl_browse_server') }}
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</div>

@section('incAdd')
    CKEDITOR.instances.content.setData('');
    $('#category_id').select2('val', '');
    $('#public').select2('val', '0');
    $('#featured').select2('val', '0');
    $('#lang').select2('val', '{{ App::getLocale() }}');
    $('#form-tabs a:first').tab('show');
    $('#image_intro').val('');
    $('#image_fulltext').val('');
@endsection

@section('incUpd')
    CKEDITOR.instances.content.setData(self.current().content);
    $('#category_id').select2('val', self.current().category_id);
    $('#public').select2('val', self.current().public);
    $('#featured').select2('val', self.current().featured);
    $('#lang').select2('val', self.current().lang);
    $('#form-tabs a:first').tab('show');
    var attribs = JSON.parse(self.current().attribs);
    $('#image_intro').val(attribs.image_intro);
    $('#image_fulltext').val(attribs.image_fulltext);
@endsection

@section('incSave')
    self.current().content = CKEDITOR.instances.content.getData();
    self.current().category_id = $('#category_id').val();
    self.current().public = $('#public').val();
    self.current().featured = $('#featured').val();
    self.current().lang = $('#lang').val();
    self.current().attribs = JSON.stringify({image_intro: $('#image_intro').val(), image_fulltext: $('#image_fulltext').val()});
@endsection