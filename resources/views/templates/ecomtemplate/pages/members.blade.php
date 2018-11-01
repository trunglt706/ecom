@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo strip_tags($data['page']->menu_name); ?>
@endsection

@section('current-css')
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/homepage.css') }}" rel="stylesheet">
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/select2.min.css') }}" rel="stylesheet">
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/select2-bootstrap.css') }}" rel="stylesheet">
@endsection

@section('jsc')
<script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/select2.min.js') }}"></script>
@endsection

@section('main')
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.header'))
    <section id="members" class="margin-top no-banner">
        <div class="container">
            <div class="navbar-form navbar-left">
                <h2 class="title text-uppercase">{{ $data['page']->menu_name }} <small class="text-lowercase" data-bind="html: total() + ' {{ \Language::getTemplate('ecomtemplate.lbl_member') }}'"></small></h2>
            </div>
            <div class="navbar-form navbar-right">
                <input type="text" class="form-control fc-alt" id="botstrapTable-search" placeholder="{{ \Language::get('global.lbl_search') }}" data-bind="value: search, event: {'keyup': doSearch} ">
            </div>
        </div>
        <div class="container">
            <div class="row" style="min-height: 500px;">
            <!-- ko if: total() == 0 && rest() > 0-->
                <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
            <!--/ko-->
            <!--ko foreach: rows-->
                <div class="col-sm-2 col-xs-6">
                    <a class="thumbnail text-middle" style="height: 150px;" data-bind="attr: {href: url}">
                        <img style="max-height: 140px;" data-bind="attr: {src: logo}" />
                    </a>
                </div>
            <!--/ko-->
            <!-- ko if: rest() > 0 -->
                <div class="col-xs-12">
                    <center><div class="btn btn-primary btn-view-more" data-bind="click: more, html: '{{ \Language::getTemplate('ecomtemplate.lbl_view_more') }} ' + rest() + ' {{ \Language::getTemplate('ecomtemplate.lbl_member') }}'"></div></center>
                </div>
            <!--/ko-->
            </div>
        </div>
    </section>
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.footer'))
    <script>
        $('.select2').select2({width: '40%', language: '{{ \App::getLocale() }}', allowClear: true});
        var size = 18;
        function MembersModel() {
            var self = this;
            self.total = ko.observable(0);
            self.rest = ko.observable(0);
            self.cols = ko.observableArray([]);
            self.rows = ko.observableArray([]);
            self.pagenum = ko.observable(1);
            self.pagesize = ko.observable(size);
            self.search = ko.observable('');
            self.sortdatafield = ko.observable('');
            self.sortorder = ko.observable('asc');
            self.is_fetch = ko.observable(false);
            self.pagemax = ko.pureComputed(function () {
                return Math.max(Math.ceil(self.total() / self.pagesize()), 1);
            });
            self.more = function () {
                self.pagesize(self.pagesize() + size);
            };
            self.doSearch = function(){
                if(!self.is_fetch()){
                    self.search($('#botstrapTable-search').val());
                }
            };
            self.fetch = function (filters) {
                filters.push(
                    {
                        key: 'lang',
                        value: '{{ $data['page']->lang }}'
                    },
                    {
                        key: 'active',
                        value: 1
                    },
                    {
                        key: 'member_approve',
                        value: 1
                    }
                );
                $.ajax({url: '{{ Path::urlSite('ecom/fetch') }}', type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        uri: 'members',
                        pagenum: self.pagenum,
                        pagesize: self.pagesize,
                        search: self.search,
                        sort: 'member_level',
                        order: 'desc',
                        filters: filters,
                        lang: '{{ $data['page']->lang }}'
                    }, beforeSend: function() {
                        self.is_fetch(true);
                        showAppLoader();
                    }, complete: function() {
                        self.is_fetch(false);
                        hideAppLoader();
                    },
                    success: function (data) {
                        self.rows(data.rows);
                        self.total(data.total);
                        self.rest(self.total() - self.pagesize());
                    }
                });
            };
            self.filter = function() {
                var filters = [];
                self.fetch(filters);
            };
            ko.computed(self.filter);
        }
        var membersModel = new MembersModel();
        ko.applyBindings(membersModel, document.getElementById('members'));
    </script>
@endsection
