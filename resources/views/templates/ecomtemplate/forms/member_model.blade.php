<div data-bind="visible: view() == 'table'">
    <section class="table-header-fixed-top" id="app-grid">
        <table class="table table-header">
            <thead>
                <tr>
                    <th><input type="checkbox" data-bind="click: toogleAll, checked: ids().length===rows().length"/></th>
                    @foreach($M::cols() as $key=>$val)
                        @if(in_array('srt', $val['filter']))
                            <th class="text-{{ $val['align'] }} sortdatafield" data-bind="click: sort.bind(this,'{{ $key }}')">{{ \Language::getTemplate('ecomtemplate.lbl_'.$key) }} <span style="width:14px" data-bind="attr: {'class': sortdatafield() != '{{ $key }}' ? 'fa fa-sort' : sortorder()=='asc' ? 'fa fa-sort-amount-asc' : 'fa fa-sort-amount-desc'}"></span></th>
                        @else
                            <th class="text-{{ $val['align'] }}">{{ \Language::getTemplate('ecomtemplate.lbl_'.$key) }}</th>
                        @endif
                    @endforeach
                    <th></th>
                </tr>
             </thead>
        </table>
        <div class="grid-container loading-container wrap-scroll" style="height: 200px;">
            <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
            <table class="table table-hover table-content thead-hide">
                <thead>
                    <tr>
                        <th width="30px"><input type="checkbox" data-bind="click: toogleAll,checked: ids().length===rows().length"/></th>
                        @foreach($M::cols() as $key=>$val)
                            @if(in_array('srt', $val['filter']))
                                <th class="text-{{ $val['align'] }} sortdatafield" data-bind="click: sort.bind(this,'{{ $key }}')">{{ \Language::getTemplate('ecomtemplate.lbl_'.$key) }} <span style="width:14px" data-bind="attr: {'class': sortdatafield() != '{{ $key }}' ? 'fa fa-sort' : sortorder()=='asc' ? 'fa fa-sort-amount-asc' : 'fa fa-sort-amount-desc'}"></span></th>
                            @else
                                <th class="text-{{ $val['align'] }}">{{ \Language::getTemplate('ecomtemplate.lbl_'.$key) }}</th>
                            @endif
                        @endforeach
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!--ko foreach: rows-->
                    <tr>
                        <td><input type="checkbox" data-bind="checkedValue: id,checked: $parent.ids"/></td>
                       @foreach($M::cols() as $key=>$val)
                       <td class="text-{{ $val['align'] }}" data-bind="html: {{ $key }}"></td>
                       @endforeach
                       <td class="text-right actions">
                           <button class="btn btn-default" data-bind="click: $parent.edit"><span class="glyphicon glyphicon-edit"></span></button>
                       </td>
                    </tr>
                    <!--/ko-->
                    <tr data-bind="visible: rows().length==0 " style="display: none;">
                        <td colspan="{{ count($M::cols())+2 }}" class="text-center active">{{ \Language::get('global.message_table_empty') }}</td>
                    </tr>
                </tbody>
           </table>
        </div>
    </section>
</div>
