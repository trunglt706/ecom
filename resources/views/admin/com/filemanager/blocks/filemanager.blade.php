<div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
<div class="file-detail">
    <div class="header">
        <span data-bind="html: file().name "></span>
        <span class="glyphicon glyphicon-remove btn-close" data-bind="click: hide.bind($data, 'file-detail')"></span>
    </div>
    <!--ko if: file() !== null-->
    <div class="file-detail-container">
        <img class="overview" data-bind="attr:{'src': file().thumb} ">
        <div class="detail">
            <b data-bind="html: '{{ Language::getCom('filemanager.lbl_filename') }}: ' + file().name"></b><br>
            <b data-bind="html: '{{ Language::getCom('filemanager.lbl_filesize') }}: ' + file().size + ' bytes'"></b>
        </div>
    </div>
    <!--/ko-->
</div>
<div class="upload" data-bind="visible: mode()=='upload' " style="display: none;" id="upload">
    <input id="fileupload" type="file" name="fileupload" multiple>
    <div class="uploadbar">
        <ul class="list-group"></ul>
    </div>
</div>
<section class="filemanager">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="toolbar" data-bind="visible: mode()=='tbl' ">
            <button class="btn btn-default navbar-btn" data-bind="click: createDir "><span class="glyphicon glyphicon-folder-open"></span> {{ Language::getCom('filemanager.lbl_new_dir') }}</button>
            <button class="btn btn-default navbar-btn" data-bind="click: setMode.bind($data, 'upload') "><span class="glyphicon glyphicon-upload"></span> {{ Language::getCom('filemanager.lbl_upload') }}</button>
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: fetch " data-toggle="tooltip" title="{{ \Language::get('global.lbl_refresh') }}"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-default navbar-btn" data-bind="enable: ids().length > 0, click: del  " data-toggle="tooltip" title="{{ \Language::get('global.lbl_delete') }}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
            <div class="navbar-form pull-right navbar-right">
                <input type="text" class="form-control" id="search" placeholder="{{ Language::get('global.lbl_search') }}" data-bind="event:{'keyup': searchFile} " >
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default navbar-btn" data-toggle="tooltip" data-placement="bottom" title="{{ Language::getCom('filemanager.lbl_grid') }}" data-bind="enable: viewMode()!='grid', click: setViewMode.bind($data, 'grid') "><span class="glyphicon glyphicon-th-large"></span></button>
                    <button type="button" class="btn btn-default navbar-btn" data-toggle="tooltip" data-placement="bottom" title="{{ Language::getCom('filemanager.lbl_list') }}" data-bind="enable: viewMode()!='list', click: setViewMode.bind($data, 'list')  "><span class="glyphicon glyphicon-th-list"></span></button>
                </div>
            </div>
        </div>
        <div class="toolbar" data-bind="visible: mode()=='upload' " style="display: none;">
            <button class="btn btn-default navbar-btn" data-bind="click: bak "><span class="glyphicon glyphicon-chevron-left"></span> {{ Language::get('global.lbl_back') }}</button>
        </div>
        <ol class="breadcrumb">
            <li data-bind="click: move.bind($data, '/') "><span class="badge"><i class="glyphicon glyphicon-home"></i></span></li>
            <!-- ko foreach: paths -->
            <li data-bind="click: $parent.move.bind($data, path)"><span class="badge" data-bind="html: dir  ">/</span></li>
            <!-- /ko -->
        </ol>
    </nav>
    <div class="main" data-bind="visible: mode()=='tbl'">
        <ul data-bind="attr:{'class': 'ul-'+viewMode()}">
            <!-- ko foreach: files -->
            <li data-bind="attr: {'title': name, 'class': $.inArray($rawData, $parent.ids())>=0 ? 'active':'' } ">
                <div data-bind="attr: {'class': is_image === true ? 'thumb img':'thumb', 'style': 'background-image: url('+ thumb +')'}">
                    <div class="edit-toolbar">
                        <div class="btn-group" role="group">
                            <!--ko if: type == 'file'-->
                            <button type="button" class="btn btn-default btn-sm" data-bind="click: $parent.viewFile.bind($data, $rawData)"><span class="glyphicon glyphicon-eye-open"></span></button>
                            <button type="button" class="btn btn-default btn-sm" data-bind="click: $parent.chooseItem.bind($data, path)"><span class="glyphicon glyphicon-ok"></span></button>
                            <!--/ko-->
                            <!--ko if: type == 'dir'-->
                            <button type="button" class="btn btn-default btn-sm" data-bind="click: $parent.move.bind($data, $parent.path()+name+'/')"><span class="glyphicon glyphicon-eye-open"></span></button>
                            <!--/ko-->
                            <button type="button" class="btn btn-default btn-sm" data-bind="click: $parent.edit.bind($data, $rawData)"><span class="glyphicon glyphicon-edit"></span></button>
                        </div>
                    </div>
                </div>
                <div class="caption" data-bind="html: name, click: $parent.select.bind($data, $rawData) "></div>
            </li>
            <!-- /ko -->
        </ul>
    </div>
    <div class="status-bar text-muted">
        <span data-bind="html: files().length"></span> {{ Language::getCom('filemanager.lbl_items') }}
    </div>
</section>
<!--cfmRename-->
<div class="modal" id="cfmRename" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmRename" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-info">
            <div class="modal-body">
                <form role="form" id="edit-form">
                    <div class="form-group">
                        <label for="filename" class="control-label">{{ \Language::getCom('filemanager.lbl_filename') }} <sup class="text-danger">(*)</sup></label>
                        <input type="text" class="form-control" name="filename" id="filename" data-bind="value: current().filename" required>
                    </div>
                    <button class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> {{ \Language::get('global.lbl_cancel') }}</button>
                    <button class="btn btn-primary" data-bind="click: save "><i class="glyphicon glyphicon-floppy-disk"></i> {{ \Language::get('global.lbl_save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--cfmCreateDir-->
<div class="modal" id="cfmCreateDir" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmCreateDir" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-info">
            <div class="modal-body">
                <form role="form" id="edit-form">
                    <div class="form-group">
                        <label for="dirname" class="control-label">{{ \Language::getCom('filemanager.lbl_dirname') }} <sup class="text-danger">(*)</sup></label>
                        <input type="text" class="form-control" name="dirname" id="dirname" required>
                    </div>
                    <button class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> {{ \Language::get('global.lbl_cancel') }}</button>
                    <button class="btn btn-primary" data-bind="click: doCreateDir "><i class="glyphicon glyphicon-floppy-disk"></i> {{ \Language::get('global.lbl_save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include(Path::viewAdmin('blocks.cfmDel'))
<script>
    $(function(){
        function ViewFileManagerModel() {
            var self = this;
            self.mode  = ko.observable('tbl');
            self.viewMode  = ko.observable('grid');
            self.paths = ko.observableArray([]);
            self.files = ko.observableArray([]);
            self.path  = ko.observable('/');
            self.file  = ko.observable({});
            self.current  = ko.observable({});
            self.ids   = ko.observableArray([]);
            self.search  = ko.observable();
            self.is_search  = ko.observable(false);

            self.setViewMode = function(viewMode){
                self.viewMode(viewMode);
            };
            self.setMode = function(mode){
                self.mode(mode);
                $('.uploadbar').removeClass('open');
            };
            self.viewFile = function(file){
                self.file(file);
                console.log(self.file());
                self.show('file-detail');
            };
            self.show = function(element){
                $('.'+element).addClass('open');
            };
            self.hide = function(element){
                $('.'+element).removeClass('open');
            };
            self.edit = function(file){
                self.current(file);
                $('#cfmRename').modal('show');
            };
            self.bak = function(){
                self.mode('tbl');
                self.fetch();
            };

            self.save = function () {
                if(self.current().filename !== ''){
                    $('#cfmRename').modal('hide');
                    $.ajax({url: '{{ $uri }}/rename', type: 'post', data: {_token: '{{ csrf_token() }}', file: self.current()},
                        beforeSend: showLoading, error: errorConnect, complete: hideLoading,
                        success: function (data) {
                            toastr[data.status](data.message);
                            if(data.status == 'success') self.fetch();
                        }
                    });
                }
            };
            self.searchFile = function(){
                if(!self.is_search()){
                    self.search($('#search').val());
                }
            };
            self.select = function(file){
                var ids = self.ids();
                var idx = ids.indexOf(file);
                if(idx < 0 ) ids.push(file);
                else ids.splice(idx, 1);
                self.ids(ids);
            };
            self.chooseItem = function(file){
                var path_root = '{{ config("data.PATH_ROOT") }}';
                @if( Input::has('CKEditorFuncNum') )
                window.opener.CKEDITOR.tools.callFunction( '{{ Input::get("CKEditorFuncNum") }}', path_root + file );
                @endif
                @if( Input::has('fieldID') )
                // $('#{{ Input::get("fieldID") }}',window.opener.document).val(path_root + file);
                $('#{{ Input::get("fieldID") }}',window.opener.document).val(file);
                @endif
                @if( Input::has('backgroundID') )
                $('#{{ Input::get("backgroundID") }}',window.opener.document).css('background-image', 'url("'+path_root + file+'")');
                @endif
                window.close();
            };
            self.del = function(){
                $('#cfmDel').modal('show');
            };
            self.createDir = function(){
                $('#dirname').val('');
                $('#cfmCreateDir').modal('show');
            };
            self.doCreateDir = function(){
                if($('#dirname').val() !== ''){
                    $('#cfmCreateDir').modal('hide');
                    $.ajax({url: '{{ $uri }}/create-dir', type: 'post', data: {_token: '{{ csrf_token() }}', path: self.path(), name: $('#dirname').val() },
                        beforeSend: showLoading, error: errorConnect, complete: hideLoading,
                        success: function (data) {
                            toastr[data.status](data.message);
                            if(data.status == 'success') self.fetch();
                        }
                    });
                }
            };
            self.doDel = function(){
                var files = [];
                $.each(self.ids(), function(){
                    files.push(this.name);
                });
                $.ajax({url: '{{ $uri }}/delete', type: 'post', data: {_token: '{{ csrf_token() }}', path: self.path, files: files},
                    beforeSend: showLoading, error: errorConnect, complete: hideLoading,
                    success: function (data) {
                        toastr[data.status](data.message);
                        if(data.status == 'success'){
                            self.fetch();
                            self.ids([]);
                        }
                    }
                });
            };
            self.move = function(path){
                self.path(path);
            };
            self.fetch = function () {
                $.ajax({url: '{{ $uri }}', type: 'post', data: {_token: '{{ csrf_token() }}', path: self.path, search: self.search()},
                    beforeSend: function(){
                        self.is_search(true);
                        showLoading();
                    }, error: errorConnect
                    , complete: function(){
                        self.is_search(false);
                        hideLoading();
                    },
                    success: function (data) {
                        if(data.status == 'success'){
                            self.paths(data.paths);
                            self.files(data.files);
                            self.ids([]);
                        }else toastr[data.status](data.message);
                    }
                });
            };
            ko.computed(self.fetch);

            var obj = $(document);
            obj.on('dragover', function (e)
            {
                $('#upload').css('background-color', '#bdbdbd');
                self.mode('upload');
                $('.uploadbar').removeClass('open');
                e.stopPropagation();
                e.preventDefault();
            });
            obj.on('dragleave', function (e)
            {
                $('#upload').css('background-color', 'transparent');
                e.stopPropagation();
                e.preventDefault();
            });
            obj.on('drop', function (e)
            {
                $('#upload').css('background-color', 'transparent');
                e.preventDefault();
                var files = e.originalEvent.dataTransfer.files;
                upload(files);
            });
            $('.upload #fileupload').change(function(){
                var files = $(this)[0].files;
                upload(files);
                $(this).val('');
            });
            function upload(files)
            {
                $('.uploadbar').addClass('open');
                $('.uploadbar .list-group').html('');
                for (var i = 0; i < files.length; i++) {
                    var data = new FormData();
                    data.append('file', files[i]);
                    data.append('path', self.path());
                    data.append('idx', i);
                    data.append('_token', '{{ csrf_token() }}');
                    $html = '<li class="list-group-item file-'+ i +'"><span class="filename">'+files[i].name+'</span><div class="progress progress-'+i+'"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div></li>';
                    $('.uploadbar .list-group').append($html);
                    $('.uploadbar .progress-'+i+' .progress-bar').css('width', '0%');
                    $.ajax({url: '{{ $uri }}/upload', type: 'post', data: data,
                        cache: false, contentType: false, processData: false,
                        beforeSend: showLoading, error: errorConnect, complete: hideLoading,
                        xhr: function()
                        {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt){
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    $('.progress .progress-bar').css('width', percentComplete*100 + '%')
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (data) {
                            $('.progress-'+data.idx).remove();
                            var status = '<span class="badge badge-'+data.status+'">'+data.message+'</span>';
                            $('.file-'+data.idx).append(status);
                        }
                    });
                }
            }
        }
        ko.applyBindings(new ViewFileManagerModel);
    });
</script>
