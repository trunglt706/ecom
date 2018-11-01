<script>
    // validate form
    var validate = $('#edit-form').validate({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    function ViewModel() {
        var self = this;
        self.fcols = [];
        self.sizes = [10, 20, 50, 100, 200, 500];
        self.current = ko.observable({});
        self.view = ko.observable('table');
        self.method = ko.observable('');
        self.total = ko.observable(0);
        self.cols = ko.observableArray([]);
        self.rows = ko.observableArray([]);
        self.ids = ko.observableArray([]);
        self.pagenum = ko.observable(1);
        self.pagesize = ko.observable(10);
        self.search = ko.observable('');
        self.sortdatafield = ko.observable('');
        self.sortorder = ko.observable('asc');
        self.is_fetch = ko.observable(false);
        self.pagemax = ko.pureComputed(function () {
            return Math.max(Math.ceil(self.total() / self.pagesize()), 1);
        });
        self.setSize = function (data) {
            if (self.pagesize() !== data){
                self.pagenum(1);
                self.pagesize(data);
            }
        };
        self.start = ko.pureComputed(function () {
            return self.pagesize() * (self.pagenum() - 1) + 1;
        });
        self.end = ko.pureComputed(function () {
            return Math.min(self.pagesize() * self.pagenum(), self.total());
        });
        self.next = function () {
            self.pagenum(self.pagenum() + 1);
        };
        self.prev = function () {
            self.pagenum(self.pagenum() - 1);
        };
        self.add = function () {
            self.view('form');
            self.method('add');
            self.doResetForm();
            @yield('incAdd')
        };
        self.edit = function (e) {
            self.view('form');
            self.method('update');
            self.current(e);
            @yield('incUpd')
        };
        self.del = function () {
            $('#cfmDel').modal('show');
        };
        self.doDel = function () {
            $.ajax({url: '{{ Path::urlSite('ecom') }}/delete', type: 'post', data: {_token: '{{ csrf_token() }}', ids: JSON.stringify(self.ids()), uri: '{{ $data['uri'] }}'},
                beforeSend: showAppLoader, error: errorConnect, complete: function () {
                    hideAppLoader(), $('#cfmDel').modal('hide');
                },
                success: function (data) {
                    toastr[data.status](data.message);
                    if (data.status === 'success'){
                        self.ids([]);
                        self.fetch();
                    }
                }
            });
        };
        self.sort = function (column) {
            if(column != self.sortdatafield())
                self.sortdatafield(column);
            else
                switch (self.sortorder()) {
                    case "desc":
                        self.sortorder('asc');
                        break;
                    default:
                        self.sortorder('desc');
                        break;
                }
        };
        self.toogleAll = function () {
            if (self.ids().length === self.rows().length) {
                self.ids([]);
            } else {
                var t = [];
                ko.utils.arrayForEach(self.rows(), function (item) {
                    t.push(item.id);
                });
                self.ids(t);
            }
            return true;
        };
        self.ref = function () {
            self.fetch();
        };
        self.back = function () {
            self.view('table');
            self.fetch();
        };
        self.doResetForm = function(){
            self.current({});
            if($('#edit-form').length > 0){
                $('#edit-form')[0].reset();
                $('#edit-form .form-group').removeClass('has-error');
                validate.resetForm();
            }
        };
        self.doSave = function(){
            if (!$('#edit-form').valid())
                return false;
            @yield('incSave')
            self.current()._token = '{{ csrf_token() }}';
            self.current().uri = '{{ $data['uri'] }}';
            $.ajax({url: '{{ Path::urlSite('ecom') }}/' +  self.method(), type: 'post', data: self.current(),
                beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
                success: function (data) {
                    toastr[data.status](data.message);
                    if (data.status === 'success'){
                        self.fetch();
                        self.view('table');
                    }
                }
            });
        };
        function beforeFetch(){
            self.is_fetch(true);
            showAppLoader();
        };
        function completeFetch(){
            self.is_fetch(false);
            hideAppLoader();
        };
        self.doSearch = function(){
            if(!self.is_fetch()){
                self.search($('#botstrapTable-search').val());
            }
        };
        self.fetch = function (filters) {
            $.ajax({url: '{{ Path::urlSite('ecom') . '/' . $data['uri'] }}', type: 'post', data: { _token: '{{ csrf_token() }}', pagenum: self.pagenum, pagesize: self.pagesize, search: self.search, sort: self.sortdatafield, order: self.sortorder, filters: filters, auth_member: {{ $data['auth_member']->id }}},
                beforeSend: beforeFetch, error: errorConnect, complete: completeFetch,
                success: function (data) {
                    self.rows(data.rows);
                    self.total(data.total);
                    tableRefesh('#app-grid');
                }
            });
        };
        ko.computed(self.fetch);

        self.filter = function(){
            var filters = [];
            $('.btn-filter .data-filter').each(function(idx, data) {
                if($(this).is(':checked')){
                    filters.push({
                        key: $(this).attr('data-filter'),
                        value: $(this).val()
                    });
                }
            });
            self.fetch(filters);
        }

        $('.btn-filter .dropdown-toggle').on('click', function(){
            switch ($(this).attr('aria-expanded')) {
                case 'true':
                    $(this).attr('aria-expanded', 'false');
                    $(this).parent().removeClass('open');
                    break;
                default:
                    $(this).attr('aria-expanded', 'true');
                    $(this).parent().addClass('open');
                    break;
            }
        });
        $('.data-filter').on('click', function(idx, data) {
            self.filter();
        });
        $('.data-filter-clear').on('click', function(idx, data) {
            var data_filter = $(this).attr('data-filter');
            $('.data-filter').each(function(idx, data) {
                if($(this).attr('data-filter') == data_filter){
                    $(this).prop('checked', false);
                }
            });
            self.filter();
        });

        @yield('incFun')
    }
    var viewModel = new ViewModel();
    ko.applyBindings(viewModel, document.getElementById('member_model'));
</script>
