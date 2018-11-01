<!-- toolbar-->
<nav class="navbar navbar-default app-comm">
    <div class="container-fluid">
        <div data-bind="visible: view()==='table'">
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: add "><span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_install') }}</button>
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: ref " data-toggle="tooltip" title="{{ \Language::get('global.lbl_refresh') }}"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: del, enable: ids().length>0 " data-toggle="tooltip" title="{{ \Language::get('global.lbl_delete') }}"><span class="glyphicon glyphicon-trash"></span></button>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span data-bind="text: pagesize"></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <!--ko foreach: sizes-->
                    <!-- ko if: $parent.sizes[$index() -1 ] <= $parent.total() || $index()==0 -->
                    <li data-bind="click: $parent.setSize"><a data-bind="text: $data"></a></li>
                    <!--/ko-->
                    <!--/ko-->
                </ul>
            </div>
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: doPublic.bind($data, 1), enable: ids().length>0" data-toggle="tooltip" title="{{ \Language::get('global.lbl_active') }}"><i class="glyphicon glyphicon-ok-sign text-success"></i></button>
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: doPublic.bind($data, 0), enable: ids().length>0" data-toggle="tooltip" title="{{ \Language::get('global.lbl_unactive') }}"><i class="glyphicon glyphicon-remove-sign text-danger"></i></button>
            <div class="navbar-form pull-right navbar-right">
                <span data-bind="visible: total() > 0"><b data-bind="text: start"></b>-<b data-bind="text: end"></b> {{ \Language::get('global.lbl_pagination_of_total') }} <b data-bind="text: total"></b></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-bind="click: prev, enable: pagenum()>1"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></button>
                    <button type="button" class="btn btn-default" data-bind="click: next,enable: pagenum()<pagemax()"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
                </div>
                <input type="text" class="form-control" id="botstrapTable-search" placeholder="{{ \Language::get('global.lbl_search') }}" data-bind="value: search, event: {'keyup': doSearch} ">
            </div>

        </div>
        <div data-bind="visible: view()==='form'" style="display: none;">
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: back"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> {{ \Language::get('global.lbl_back') }}</button>
            <div class="navbar-form pull-right navbar-right" data-bind="visible: method() == 'update'">
                <button class="btn btn-default" data-bind="visible: current().type != 'System',click: exportPackage"><i class="glyphicon glyphicon-export"></i></i> {{ \Language::get('global.lbl_export') }}</button>
            </div>
        </div>
    </div>
</nav><!-- /toolbar-->

<div class="container-fluid" style="margin-bottom: 50px">
    <div data-bind="visible: view()==='table'">
        @include(Path::viewAdmin('tables.default'))
    </div>
    <div data-bind="visible: view()==='form'" style="display: none;">
        <div class="panel panel-default">
            <div class="panel-body">
                <section data-bind="visible: method() == 'add'">
                    <form role="form" id="form-package-upload" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 hidden-sm hidden-xs text-right">
                                <img src="{{ Path::url('images/package.png') }}" alt="overview" width="50%">
                            </div>
                            <div class="col-md-4">
                                <h3 class="header-title">{{ \Language::getCom('system.tit_install_package') }}</h3>
                                <p class="text-muted">{{ \Language::getCom('system.comment_install_package') }}</p>
                                <div class="form-group">
                                    <input type="file" name="filePackage" required id="filePackage" style="display: none;" accept="application/zip">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="filePackageDisplay" readonly placeholder="{{ \Language::get('global.lbl_choose') }}...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" data-bind="click: choosePackage"><i class="fa fa-file-archive-o"></i> {{ \Language::get('global.lbl_choose') }}</button>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" data-bind="click: doUploadPakage"><i class="glyphicon glyphicon-ok"></i></i> {{ \Language::get('global.lbl_install') }}</button>
                            </div>
                        </div>
                    </form>
                </section>
                <section data-bind="visible: method() == 'update'">
                    <h3 class="col-md-12">{{ \Language::getCom('system.tit_package_info') }}</h3>
                    <div class="col-md-6">
                        <div class="form-group">
                            <table class="table table-bordered table-info">
                                <tbody>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_name') }}</td>
                                        <td data-bind="html: current().name"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_type') }}</td>
                                        <td data-bind="html: current().type"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_author') }}</td>
                                        <td data-bind="html: current().author"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_creation_date') }}</td>
                                        <td data-bind="html: current().creation_date"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_copyright') }}</td>
                                        <td data-bind="html: current().copyright"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_license') }}</td>
                                        <td data-bind="html: current().license"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_author_email') }}</td>
                                        <td data-bind="html: current().author_email"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_author_url') }}</td>
                                        <td data-bind="html: current().author_url"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_version') }}</td>
                                        <td data-bind="html: current().version"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Language::getCom('system.lbl_description') }}</td>
                                        <td data-bind="html: current().description"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 hidden-sm hidden-xs text-center">
                        <div class="box-shadow">
                            <div class="package-overview" data-bind="visible: current().overview != null,attr:{'style': 'background-image: url(' + current().overview + ');'}"></div>
                            <div class="shadow"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!--cfmPackageInfo-->
<div class="modal" id="cfmPackageInfo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmPackageInfo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-install">
            <div class="modal-body">
                <div class="form-group">
                    <section data-bind="visible: !is_install()">
                        <h3>{{ \Language::getCom('system.tit_package_info') }}</h3>
                        <table class="table table-bordered table-info" data-bind="if: config() != null">
                            <tbody>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_name') }}</td>
                                    <td data-bind="html: config().name"></td>
                                </tr>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_type') }}</td>
                                    <td data-bind="html: config().type"></td>
                                </tr>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_author') }}</td>
                                    <td data-bind="html: config().author"></td>
                                </tr>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_creation_date') }}</td>
                                    <td data-bind="html: config().creation_date"></td>
                                </tr>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_copyright') }}</td>
                                    <td data-bind="html: config().copyright"></td>
                                </tr>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_license') }}</td>
                                    <td data-bind="html: config().license"></td>
                                </tr>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_author_email') }}</td>
                                    <td data-bind="html: config().author_email"></td>
                                </tr>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_author_url') }}</td>
                                    <td data-bind="html: config().author_url"></td>
                                </tr>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_version') }}</td>
                                    <td data-bind="html: config().version"></td>
                                </tr>
                                <tr>
                                    <td>{{ \Language::getCom('system.lbl_description') }}</td>
                                    <td data-bind="html: config().description"></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <section data-bind="visible: is_install()">
                        <h3>{{ \Language::get('global.lbl_install') }}</h3>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                        <div class="well panel-log wrap-scroll" style="height: 200px;"></div>
                    </section>
                </div>
                <button class="btn btn-default" data-bind="disable: is_install() && !is_installed(), click: doDelPackage" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> {{ \Language::get('global.lbl_exit') }}</button>
                <button class="btn btn-primary" data-bind="disable: is_install(), click: doInstallPackage "><i class="glyphicon glyphicon-ok"></i></i> {{ \Language::get('global.lbl_install') }}</button>
            </div>
        </div>
    </div>
</div><!-- /cfmPackageInfo -->

<!--cfmExportPackage-->
<div class="modal" id="cfmExportPackage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmExportPackage" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-install">
            <div class="modal-body">
                <h3>{{ \Language::get('global.lbl_option') }}</h3>
                <p>
                    {{ \Language::getCom('system.lbl_export_option_db') }}:
                </p>
                <div class="radio">
                    <label>
                        <input type="radio" name="export_option_db" value="structure" checked>
                        {{ \Language::getCom('system.lbl_export_option_db_structure') }}
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="export_option_db" value="structure_and_data">
                        {{ \Language::getCom('system.lbl_export_option_db_structure_and_data') }}
                    </label>
                </div>
                <button class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> {{ \Language::get('global.lbl_cancel') }}</button>
                <button class="btn btn-primary" data-bind="click: doExportPackage"><i class="glyphicon glyphicon-export"></i></i> {{ \Language::get('global.lbl_export') }}</button>
            </div>
        </div>
    </div>
</div><!-- /cfmExportPackage -->

<!--cfmDel-->
<div class="modal" id="cfmDel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmDel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-delete">
            <div class="modal-body">
                <h3>{{ \Language::get('global.lbl_delete_question') }}</h3><br>
                <button class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> {{ \Language::get('global.lbl_cancel') }}</button>
                <button class="btn btn-danger" data-dismiss="modal" data-bind="click: doUnInstallPackage"><i class="glyphicon glyphicon-trash"></i> {{ \Language::get('global.lbl_delete') }}</button>
            </div>
        </div>
    </div>
</div>

@section('incAdd')

@endsection

@section('incUpd')

@endsection

@section('incFun')
    self.config = ko.observable();
    self.is_install = ko.observable(false);
    self.is_installed = ko.observable(true);
    self.doInstallPackage = function(){
        $('.panel-log').html('');
        self.is_install(true);
        self.is_installed(false);
        self.config()._token = '{{ csrf_token() }}';
        $.ajax({url: '{{ $uri }}/install-package', type: 'post', data: self.config(),
            error: errorConnect,
            success: function (data) {
                self.is_installed(true);
                if (data.status === 'success'){
                    $('.panel-log').append(data.message);
                } else toastr[data.status](data.message);
            }
        });
    };
    self.doUnInstallPackage = function(){
        $.ajax({url: '{{ $uri }}/uninstall-package', type: 'post', data: {_token: '{{ csrf_token() }}', ids: JSON.stringify(self.ids())},
            beforeSend: showAppLoader, error: errorConnect, complete: function () {
                hideAppLoader(), $('#cfmDel').modal('hide');
            },
            success: function (data) {
                toastr[data.status](data.message);
                if (data.status === 'success') window.location.reload();
            }
        });
    };
    self.exportPackage = function(){
        $('#cfmExportPackage').modal('show');
    };
    self.doExportPackage = function(){
        $url = "{{ $uri }}/export-package?id=" + self.current().id + "&db=";
        window.open($url + $('input[name="export_option_db"]:checked').val(), "_blank");
    };
    self.choosePackage = function(){
        $('#filePackage').click();
    };

    $('#filePackage').change(function(){
        var filePackage = document.getElementById('filePackage').files[0];
        $('#filePackageDisplay').val(filePackage == null ? '' : filePackage.name);
    });

    self.doUploadPakage = function(){
        var filePackage = document.getElementById('filePackage').files[0];
        if (!filePackage)
            return false;
        var data = new FormData();
        data.append('filePackage', filePackage);
        data.append('_token', '{{ csrf_token() }}');
        $('.app-loader .progress-bar').css('width', '0%');
        $.ajax({url: '{{ $uri }}/upload-package', type: 'post', data: data,
            cache: false, contentType: false, processData: false,
            beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
            xhr: function()
            {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt){
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        $('.app-loader .progress-bar').css('width', percentComplete*100 + '%')
                    }
                }, false);
                return xhr;
            },
            success: function (data) {
                if (data.status === 'success'){
                    self.config(data.message);
                    $('#cfmPackageInfo').modal('show');
                }else toastr[data.status](data.message);
            }
        });
    };
    self.doDelPackage = function(){
        self.is_install(false);
        $.post('{{ $uri }}/del-package', {_token: '{{ csrf_token() }}', package: self.config().package});
    };
    self.doPublic = function(val){
        $.ajax({url: '{{ $uri }}/public-package', type: 'post', data: {_token: '{{ csrf_token() }}', ids: JSON.stringify(self.ids()), public: val},
            beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
            success: function (data) {
                toastr[data.status](data.message);
                if (data.status === 'success'){
                    window.location.reload();
                }
            }
        });
    };
@endsection
@include(Path::viewAdmin('blocks.mainScript'))
