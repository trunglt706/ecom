@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo $data['page']->menu_name; ?>
@endsection

@section('current-css')
<!-- <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/homepage.css') }}" rel="stylesheet"> -->
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/select2.min.css') }}" rel="stylesheet">
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/select2-bootstrap.css') }}" rel="stylesheet">
@endsection

@section('jsc')
<script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/select2.min.js') }}"></script>
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    <section id="products" class="margin-top no-banner">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                @if (isset($data['member']))
                <li><a href="{{ \Path::url($data['page']->lang . '/' . $data['page']->alias) }}">{{ $data['page']->menu_name }}</a></li>
                <li class="active"><a href="{{ $data['menus']->member . '/' . $data['member']->member_alias }}">{{ $data['member']->member_name }}</a></li>
                @else
                <li class="active">{{ $data['page']->menu_name }}</li>
                @endif
            </ol>
            <div class="navbar-form navbar-left">
                <h2 class="title text-uppercase">{{ $data['page']->menu_name }} <small class="text-lowercase" data-bind="html: total() + ' {{ \Language::getTemplate('ecomtemplate.lbl_products') }}'"></small></h2>
            </div>
            <div class="navbar-form navbar-right pull-right">
                <input type="text" class="form-control fc-alt" id="botstrapTable-search" placeholder="{{ \Language::get('global.lbl_search') }}" data-bind="value: search, event: {'keyup': doSearch} ">
            </div>
            <!-- <h2 class="title text-uppercase">{{ $data['page']->menu_name }} <small class="text-lowercase" data-bind="html: total() + ' {{ \Language::getTemplate('ecomtemplate.lbl_product') }}'"></small></h2> -->
        </div>
        <div class="container filter">
            @if (!isset($data['product_category']))
            <div class="col-sm-4 col-xs-12">
                <select class="select2" id="category_id" name="category_id" multiple data-placeholder="{{ \Language::getTemplate('ecomtemplate.lbl_product_category') }}">
                    @foreach ($data['product_categories'] as $product_category)
                    <option value="{{ $product_category->id }}">{{ $product_category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            @if (!isset($data['member']))
            <div class="col-sm-4 col-xs-12">
                <select class="select2" id="members" name="members" multiple data-placeholder="{{ \Language::getTemplate('ecomtemplate.lbl_members') }}">
                    @foreach ($data['members'] as $member)
                    <option value="{{ $member->id }}">{{ $member->member_name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>
        <div class="container">
            <div class="row" style="min-height: 500px;">
                <div class="panel-product">
                    <!-- ko if: total() == 0 && rest() > 0 -->
                    <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
                    <!--/ko-->
                    <!--ko foreach: rows-->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="product-item">
                            <div class="product-caption">
                                <a class="member" data-bind="attr: {href: member_url, title: member_name}, html: member_name"></a>
                                <hr>
                                <ul>
                                    <!--ko foreach: info-->
                                    <li data-bind="html: field_name + ': ' + value + ' ' + unit"></li>
                                    <!--/ko-->
                                </ul>
                            </div>
                            <div class="product-img" data-bind="style: { backgroundImage: 'url(' + media + ')' }">
                                <div class="product-button">
                                    @if ($data['favorite'])
                                    <div class="like-button" title="{{ \Language::getTemplate('ecomtemplate.lbl_remove_favorite') }}" data-bind="click: $root.removeFavorite.bind($data, $rawData)">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-thumbs-down fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    @else
                                    <div class="like-button" title="{{ \Language::getTemplate('ecomtemplate.lbl_add_to_favorite') }}" data-bind="click: $root.addToFavorite.bind($data, $rawData)">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    @endif
                                    <div class="cart-button" title="{{ \Language::getTemplate('ecomtemplate.lbl_add_to_cart') }}" data-bind="click: $root.addToCart.bind($data, $rawData)">
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-cart-plus fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                </div>
                                <a data-bind="attr: {href: url}">
                                    <div class="product-title" data-bind="html: product_name"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--/ko-->
                </div>
            </div>
            <!-- ko if: rest() > 0 -->
                <div class="col-xs-12">
                    <center><div class="btn btn-primary btn-view-more" data-bind="click: more, html: '{{ \Language::getTemplate('ecomtemplate.lbl_view_more') }} ' + rest() + ' {{ \Language::getTemplate('ecomtemplate.lbl_product') }}'"></div></center>
                </div>
            <!--/ko-->
        </div>
    </section>
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.footer'))
    <script>
    $('.app-loading').removeClass('open');
    $('.select2').select2({
        width: '100%', language: '{{ \App::getLocale() }}', allowClear: true
    });
    var size = 12;
    function ProductsModel() {
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
                    key: 'public',
                    value: 1
                }
            );
            @if (isset($data['member']))
            var members = [{{ $data['member']->id }}];
            @else
            var members = $('#members').val();
            @endif
            @if (isset($data['product_category']))
            filters.push(
                {
                    key: 'category_id',
                    value: {{ $data['product_category']->id }}
                }
            );
            @else
            var category_id = $('#category_id').val() || [];
            $.each(category_id, function(key, value) {
                filters.push(
                    {
                        key: 'category_id',
                        value: value
                    }
                );
            });
            @endif
            $.ajax({url: '{{ Path::urlSite('ecom/fetch') }}', type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    members: members,
                    uri: 'products',
                    pagenum: self.pagenum,
                    pagesize: self.pagesize,
                    search: self.search,
                    sort: 'created_at',
                    order: 'desc',
                    filters: filters,
                    favorite: {{ $data['favorite'] }},
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
        $('#category_id').on('change', function () {
            self.filter();
        });
        $('#members').on('change', function () {
            self.filter();
        });
        self.addToCart = function(product) {
            addToCart({
                id: product.id,
                product_id: product.id,
                product_name: product.product_name,
                product_alias: product.url,
                product_content: product.media,
                member_id: product.member_id,
                member_name: product.member_name,
                member_alias: product.member_alias,
                quantity: 1
            });
        };
        self.addToFavorite = function(product) {
            viewModelHeader.addToFavorite(product.id, product.product_name);
        };
        self.removeFavorite = function(product) {
            $.post("{{ Path::urlSite('ecom/remove-favorite') }}", {
                    _token: '{{ csrf_token() }}',
                    product_id: product.id,
                    product_name: product.product_name
                },
                function(data) {
                    toastr[data.status](data.message);
                    if (data.status == 'success') self.filter();
                }
            );
        };
    }
    var productsModel = new ProductsModel();
    ko.applyBindings(productsModel, document.getElementById('products'));
    </script>
@endsection
