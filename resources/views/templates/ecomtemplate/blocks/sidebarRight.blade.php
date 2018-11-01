<aside id="sidebar-right" class="sidebar c-overflow">
    <div class="sidebar-right-search">
        <div class="fg-line">
            <input type="text" id="btn-sidebar-right-search" class="form-control fc-alt" placeholder="{{ Language::getTemplate('emaptemplate.lbl_what_are_you_finding') }}">
        </div>
    </div>

    <div id="filter" class="col-md-12">
        <ul class="tab-nav tn-justified tn-icon" role="tablist">
            <li role="presentation" class="active">
                <a class="col-sx-4" href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">
                    <i class="zmdi zmdi-map"></i><br>
                    <small>{{ Language::getTemplate('emaptemplate.lbl_filter_area') }}</small>
                </a>
            </li>
            <li role="presentation">
                <a class="col-xs-4" href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">
                    <i class="zmdi zmdi-pin icon-tab"></i><br>
                    <small>{{ Language::getTemplate('emaptemplate.lbl_filter_pond') }}</small>
                </a>
            </li>
            <li role="presentation">
                <a class="col-xs-4" href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">
                    <i class="zmdi zmdi-label"></i><br>
                    <small>{{ Language::getTemplate('emaptemplate.lbl_filter_orther') }}</small>
                </a>
            </li>
        </ul>

        <div class="tab-content p-15">
            <div role="tabpanel" class="tab-pane animated fadeIn in active" id="tab-1">
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_filter_town') }}</label>
                    <select class="selectpicker" id="filter_town" data-style="btn-info" data-size="5" data-live-search="true">
                        <option value="all">{{ Language::getTemplate('emaptemplate.lbl_filter_all') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_filter_district') }}</label>
                    <select class="selectpicker" id="filter_district" data-style="btn-info" data-size="5" data-live-search="true">
                        <option value="all">{{ Language::getTemplate('emaptemplate.lbl_filter_all') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_filter_ward') }}</label>
                    <select class="selectpicker" id="filter_ward" data-style="btn-info" data-size="5" data-live-search="true">
                        <option value="all">{{ Language::getTemplate('emaptemplate.lbl_filter_all') }}</option>
                    </select>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane animated fadeIn" id="tab-2">
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_stocking_time') }}</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <div class="dtp-container fg-line">
                                    <input type='text' class="form-control date-picker" id="filter_stocking_time_from_date" placeholder="{{ Language::getTemplate('emaptemplate.lbl_from_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <div class="dtp-container fg-line">
                                    <input type='text' class="form-control date-picker" id="filter_stocking_time_to_date" placeholder="{{ Language::getTemplate('emaptemplate.lbl_to_date') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_harvest_time') }}</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <div class="dtp-container fg-line">
                                    <input type='text' class="form-control date-picker" id="filter_harvest_time_from_date" placeholder="{{ Language::getTemplate('emaptemplate.lbl_from_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <div class="dtp-container fg-line">
                                    <input type='text' class="form-control date-picker" id="filter_harvest_time_to_date" placeholder="{{ Language::getTemplate('emaptemplate.lbl_to_date') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_productivity') }}</label>
                    <input class="form-control fc-alt" id="filter_productivity" type="number" min="0" step="10">
                </div>
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_acreage') }}</label>
                    <input class="form-control fc-alt" id="filter_acreage" type="number" min="0" step="10">
                </div>
            </div>

            <div role="tabpanel" class="tab-pane animated fadeIn" id="tab-3">
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_certificate') }}</label>
                    <select class="selectpicker" id="filter_certificate" data-style="btn-info" multiple placeholder="dd">
                        @foreach (App\Com\Emap\Certificate::all() as $certificate)
                        <option value="{{ $certificate->id }}">{{ $certificate->certificate_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_member_type') }}</label>
                    <div class="checkbox m-b-15">
                        <label>
                            <input type="checkbox" id="filter_member_type_enterprise">
                            <i class="input-helper"></i>
                            {{ Language::getTemplate('emaptemplate.lbl_filter_member_type_enterprise') }}
                        </label>
                    </div>
                    <div class="checkbox m-b-15">
                        <label>
                            <input type="checkbox" id="filter_member_type_personal">
                            <i class="input-helper"></i>
                            {{ Language::getTemplate('emaptemplate.lbl_filter_member_type_personal') }}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ Language::getTemplate('emaptemplate.lbl_order') }}</label>
                    <div class="checkbox m-b-15">
                        <label>
                            <input type="checkbox" id="filter_order">
                            <i class="input-helper"></i>
                            {{ Language::getTemplate('emaptemplate.lbl_filter_order') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center" id="filter-toolbar">
            <div class="btn btn-primary btn-lg btn-icon-text waves-effect" onclick="doFilter()">
                <span class="glyphicon glyphicon-filter"></span> {{ language::getTemplate('emaptemplate.lbl_filter') }}
            </div>
            <div class="btn btn-default btn-lg btn-icon-text waves-effect" onclick="clearFilter()">
                <span class="glyphicon glyphicon-refresh"></span> {{ language::getTemplate('emaptemplate.lbl_unfilter') }}
            </div>
        </div>
    </div>

    <div class="list-group" id="search-results" style="display: none;">
        <i class="list-group-item" data-bind="visible: searchResults().length > 0">
            <span data-bind="html: searchResults().length"></span> {{ Language::getTemplate('emaptemplate.lbl_result_for') }}
            <span data-bind="html: '“'+search()+'”'"></span>
        </i>

        <!-- ko foreach: searchResults -->
        <a class="list-group-item" data-bind="click: $parent.viewDetailPond.bind($data, $rawData)">
            <i class="zmdi zmdi-pin"></i>
            <span data-bind="html: text"></span>
        </a>
        <!-- /ko -->
    </div>

</aside>
<script>
    $(document).ready(function(){
        if(!$('#introModal').length) $('#sidebar-right-trigger').click();
        selectpickerSetData('town', '#filter_town');

        $('#filter_town').on('hidden.bs.select', function (e) {
            selectpickerSetData('district', '#filter_district', $(this).selectpicker('val'));
            selectpickerReSetData('#filter_ward');
        });
        $('#filter_district').on('hidden.bs.select', function (e) {
            selectpickerSetData('ward', '#filter_ward', $(this).selectpicker('val'));
        });
        $("#filter_stocking_time_from_date").on("dp.change", function (e) {
            $('#filter_stocking_time_to_date').data("DateTimePicker").minDate(e.date);
        });
        $("#filter_stocking_time_to_date").on("dp.change", function (e) {
            $('#filter_stocking_time_from_date').data("DateTimePicker").maxDate(e.date);
        });
        $("#filter_harvest_time_from_date").on("dp.change", function (e) {
            $('#filter_harvest_time_to_date').data("DateTimePicker").minDate(e.date);
        });
        $("#filter_harvest_time_to_date").on("dp.change", function (e) {
            $('#filter_harvest_time_from_date').data("DateTimePicker").maxDate(e.date);
        });

        $('#btn-sidebar-right-search').on('focusin', function(){
            viewModel.searchResults([]);
            $('#filter').fadeOut();
            setTimeout(function(){
                $('#search-results').fadeIn();
            }, 300);
        });
        $('#btn-sidebar-right-search').on('focusout', function(){
            $('#search-results').fadeOut();
            $(this).val('');
            setTimeout(function(){
                $('#filter').fadeIn();
            }, 300);
        });
    });

    function selectpickerSetData(url, element, data){
        $.post('{{ Path::urlSite("site-emap") }}/'+url, {_token: '{{ csrf_token() }}', id: data}, function(data){
            var all = '<option value="all">{{ Language::getTemplate("emaptemplate.lbl_filter_all") }}</option>';
            var html = '';
            $.each(data, function(index, value){
                html += '<option value="'+value.id+'">'+value.text+'</option>';
            });
            $(element).html(all+html).selectpicker('refresh');
        });
    }
    function selectpickerReSetData(element){
        var all = '<option value="all">{{ Language::getTemplate("emaptemplate.lbl_filter_all") }}</option>';
        $(element).html(all).selectpicker('refresh');
    }
    function getFilter(){
        return {
            town_id: $('#filter_town').selectpicker('val'),
            district_id: $('#filter_district').selectpicker('val'),
            ward_id: $('#filter_ward').selectpicker('val'),
            acreage: $('#filter_acreage').val(),
            productivity: $('#filter_productivity').val(),
            stocking_time: {
                from: $('#filter_stocking_time_from_date').val(),
                to: $('#filter_stocking_time_to_date').val()
            },
            harvest_time: {
                from: $('#filter_harvest_time_from_date').val(),
                to: $('#filter_harvest_time_to_date').val()
            },
            certificates: $('#filter_certificate').selectpicker('val'),
            member_type: {
                enterprise: $('#filter_member_type_enterprise').is(':checked'),
                personal: $('#filter_member_type_personal').is(':checked')
            },
            order: $('#filter_order').is(':checked')
        };
    }
    function doFilter(){
        viewModel.fetch(getFilter());
    }
    function clearFilter(){
        selectpickerReSetData('#filter_ward');
        selectpickerReSetData('#filter_district');
        $('#filter_town').selectpicker('val', 'all');
        $('#filter_acreage').val(0);
        $('#filter_productivity').val(0);
        $('#filter_stocking_time_from_date').val('');
        $('#filter_stocking_time_to_date').val('');
        $('#filter_harvest_time_from_date').val('');
        $('#filter_harvest_time_to_date').val('');
        $('#filter_certificate').selectpicker('val', '');
        $('#filter_member_type_enterprise').prop('checked', false),
        $('#filter_member_type_personal').prop('checked', false),
        $('#filter_order').prop('checked', false),
        doFilter();
    }
</script>
