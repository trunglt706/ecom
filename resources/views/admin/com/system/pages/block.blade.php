<!-- toolbar-->
<nav class="navbar navbar-default app-comm">
    <div class="container-fluid">
        <div data-bind="visible: view()==='table'">
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: add "><span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_add') }}</button>
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
            <div class="navbar-form pull-right navbar-right" data-bind="visible: viewConfig()">
                <button type="button" class="btn btn-primary" data-bind="click: doSave"><span class="glyphicon glyphicon-floppy-disk"></span> {{ Language::get('global.lbl_save') }}</button>
            </div>
        </div>
    </div>
</nav><!-- /toolbar-->

<div class="container-fluid" style="margin-bottom: 50px">
    <div data-bind="visible: view()==='table'">
        @include(Path::viewAdmin('tables.default'))
    </div>
    <div data-bind="visible: view()==='form'" style="display: none;">
        <div class="list-group" data-bind="visible: !viewConfig() ">
            <?php $modules = \Module::fetch(); ?>
            @if(count($modules))
                @foreach ($modules as $module)
                <a href="#" class="list-group-item" data-bind="click: setModule.bind($data, {{ $module->id }}, null)"><h4 class="no-margin"><span class="text-uppercase">{{ $module->name }}</span> <small>{{ $module->description }}</small></h4></a>
                @endforeach
            @else
                <div class="alert alert-info" role="alert">{{ Language::get('global.message_component_not_found') }}</div>
            @endif
        </div>
        <div data-bind="visible: viewConfig() ">
            <div id="module-config-form"></div>
            <form role="form" id="edit-form"></form>
        </div>
    </div>
</div>
@include(\Path::viewAdmin('blocks.cfmDel'))

@section('incAdd')
    self.viewConfig(false);
@endsection

@section('incUpd')
    self.setModule(self.current().module_id, self.current().id);
@endsection

@section('incSave')
    if (!$('#frm-block-config').valid())
        return false;
    self.current(viewModelBlockConfig.doSave());
@endsection

@section('incFun')
    self.viewConfig = ko.observable(false);

    self.setModule = function(module_id, block_id){
        $.ajax({url: '{{ $uri }}/config', type: 'post', data: {_token: '{{ csrf_token() }}', module_id: module_id, block_id: block_id},
            beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
            success: function (data) {
                if (data.status === 'success'){
                    $('#module-config-form').html(data.data);
                    self.viewConfig(true);
                }else toastr[data.status](data.message);
            }
        });
    }
@endsection
@include(Path::viewAdmin('blocks.mainScript'))
