<?php
    $akey = App\Com\FileManager\FileManager::getSecretKey();
    $filemanager_path = 'filemanager?akey='.$akey;
?>
<link rel="stylesheet" href="{{ Path::urlCom('slider/css/slider.css') }}" media="screen" charset="utf-8">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="title" class="control-label">{{ Language::getCom('slider.lbl_title') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="title" id="title" data-bind="value: current().title" required>
                </div>
                <div class="form-group">
                    <label for="note" class="control-label">{{ Language::getCom('slider.lbl_note') }}</label>
                    <textarea class="form-control" name="note" id="note" data-bind="value: current().note" rows="5"></textarea>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label class="control-label">{{ Language::getCom('slider.lbl_content') }}</label>
                    <div class="dd slide-nestable">
                        <ol class="dd-list">
                            <!-- ko foreach: slides -->
                            <li class="dd-item" data-bind="attr: {'data-id': idx, 'id': idx}">
                                <div class="dd-handle toolbar">
                                    <span class="glyphicon glyphicon-fullscreen"></span>
                                </div>
                                <div class="toolbar-right btn-group-vertical" role="group" aria-label="Vertical button group">
                                    <div class="btn-group btn-group-dropdown" role="group" data-toggle="false">
                                        <button type="button" class="btn btn-default" data-bind="click: $parent.linkToggle.bind($data, idx)">
                                            <span class="glyphicon glyphicon-link"></span>
                                        </button>
                                        <div class="dropdown-content">
                                            <input id="url" data-bind="value: url" type="text" class="form-control" style="border-radius: 0px;">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-default" data-bind="click: $parent.delSlide.bind($data, $rawData)">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                                <div class="content">
                                    <div class="media">
                                        <div class="media-left">
                                            <a class="thumbnail" data-bind="click: $parent.chooseImg.bind($data, idx)" style="width:150px; height: 98px; border: 0px;">
                                                <div class="thumbnail-img" data-bind="attr: {'id': 'image_'+idx}, style: {'background-image': 'url({{ config("data.PATH_ROOT") }}'+img+')'}"></div>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="editable" data-bind="html: caption"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- /ko -->
                        </ol>
                    </div>
                    <button type="button" class="btn btn-default" data-bind="click: addSlide">
                        <span class="glyphicon glyphicon-plus"></span> {{ Language::getCom('slider.lbl_add_slide') }}
                    </button>
                </div>
            </div>
        </div>
        <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
    </div>
</div>
@section('incAdd')
    self.slides([]);
@endsection

@section('incUpd')
    self.slides(JSON.parse(e.content));
    $('.slide-nestable').nestable({maxDepth: 1});
    editable();
@endsection

@section('incSave')
    self.current().content = JSON.stringify( sliderData() );
@endsection

@section('incFun')
    self.slides = ko.observableArray([]);

    self.addSlide = function(){
        var idx = Date.now();
        self.slides.push({
            idx: idx,
            img: '{!! Path::urlCom('slider/images/img.jpg') !!}',
            caption: 'Caption '+(self.slides().length + 1),
            url: ''
        });
        $('.slide-nestable').nestable({maxDepth: 1});
        editable();
    };
    self.delSlide = function(item){
        self.slides.remove( item );
        self.slides( self.slides() );
    };
    self.chooseImg = function(id){
        open_popup('{!! $filemanager_path.'&backgroundID=image_' !!}' + id);
    };

    self.linkToggle = function(id){
        if($('#'+id+' .btn-group-dropdown').attr('data-toggle') == 'true') $('#'+id+' .btn-group-dropdown').attr('data-toggle', 'false');
        else $('#'+id+' .btn-group-dropdown').attr('data-toggle', 'true');
    };

    function editable(){
        for(name in CKEDITOR.instances){
            CKEDITOR.instances[name].destroy(true);
        }
        $('.editable').each(function(){
            $(this).attr('contenteditable', true);
            CKEDITOR.inline( this , {
                toolbar: [
                    ['Bold','Italic','Underline','RemoveFormat', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],
                    [ 'Format', 'ShowBlocks' ]
                ]
            });
        });
    }
    function sliderData(){
        var nestable = $('.slide-nestable').nestable('serialize');
        var slides = [];
        $.each(nestable, function(idx, val){
            var bg = $('.slide-nestable .dd-list li#' + val.id + ' .thumbnail-img').css('background-image');
            slides.push({
                idx: val.id,
                img: bg.substr(bg.indexOf('{{ config("data.UPLOAD_DIR") }}')).replace('\"\)', ''),
                caption: $('.slide-nestable .dd-list li#' + val.id + ' .editable').html(),
                url: $('#'+val.id+' .btn-group-dropdown #url').val()
            });
        });
        return slides;
    }
    $('.slide-nestable').on('change', function() {
        self.slides( sliderData() );
        editable();
    });
@endsection
