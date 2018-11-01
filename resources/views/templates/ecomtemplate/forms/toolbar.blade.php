<nav class="navbar navbar-default app-comm">
    <div class="container-fluid">
        <div data-bind="visible: view()==='table'">
            @if ($data['uri'] == 'certificates')
            <button type="button" class="btn btn-primary navbar-btn" data-bind="click: add "><span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_add') }}</button>
            @endif
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: ref " data-toggle="tooltip" title="{{ \Language::get('global.lbl_refresh') }}"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
            <button type="button" class="btn btn-danger navbar-btn" data-bind="click: del, enable: ids().length>0 " data-toggle="tooltip" title="{{ \Language::get('global.lbl_delete') }}"><span class="glyphicon glyphicon-trash"></span></button>
            <div class="btn-group" >
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
            @foreach($M::cols() as $key=>$val)
                @if(isset($val['group']))
                    <?php
                        $grp = $val['group'];
                    ?>
                    <div class="btn-group btn-filter" role="group">
                        <div class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                            {{ \Language::getCom(strtolower($route->extension_name).'.lbl_'.$key) }} <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu">
                            <li class="data-filter-clear" data-filter="{{ $grp['key'] }}">
                                <div class="checkbox">
                                    <span class="glyphicon glyphicon-remove"></span> {{ Language::getCom('system.lbl_clear_filter') }}
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            @foreach(\DB::table($grp['tbl'])->get() as $row)
                            <li>
                                <div class="checkbox">
                                    <label>
                                        <input class="data-filter" type="checkbox" value="{{ $row->id }}" data-filter="{{ $grp['key'] }}"> {{ $row->$grp['col'] }}
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
            <div class="navbar-form pull-right navbar-right">
                <span data-bind="visible: total() > 0"><b data-bind="text: start"></b>-<b data-bind="text: end"></b> {{ \Language::get('global.lbl_pagination_of_total') }} <b data-bind="text: total"></b></span>
                <div class="btn-group" role="group" style="margin-right: 10px;">
                    <button type="button" class="btn btn-default" data-bind="click: prev, enable: pagenum()>1"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></button>
                    <button type="button" class="btn btn-default" data-bind="click: next,enable: pagenum()<pagemax()"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
                </div>
                <input type="text" class="form-control" id="botstrapTable-search" placeholder="{{ \Language::get('global.lbl_search') }}" data-bind="value: search, event: {'keyup': doSearch} ">
            </div>

        </div>
        <div data-bind="visible: view()==='form'" style="display: none;">
            <button type="button" class="btn btn-default navbar-btn" data-bind="click: back"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> {{ \Language::get('global.lbl_back') }}</button>
            <div class="navbar-form pull-right navbar-right">
                <button type="button" class="btn btn-default" data-bind="visible: method()=='add', click: doResetForm"><i class="glyphicon glyphicon-refresh"></i> {{ \Language::get('global.lbl_reset') }}</button>
                <button type="button" class="btn btn-primary" data-bind="click: doSave"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> {{ \Language::get('global.lbl_save') }}</button>
            </div>
        </div>
    </div>
</nav>
<!--cfmDel-->
<div class="modal" id="cfmDel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmDel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-delete">
            <div class="modal-body">
                <h3>{{ \Language::get('global.lbl_delete_question') }}</h3><br>
                <button class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> {{ \Language::get('global.lbl_cancel') }}</button>
                <button class="btn btn-danger" data-dismiss="modal" data-bind="click: doDel"><i class="glyphicon glyphicon-trash"></i> {{ \Language::get('global.lbl_delete') }}</button>
            </div>
        </div>
    </div>
</div>
