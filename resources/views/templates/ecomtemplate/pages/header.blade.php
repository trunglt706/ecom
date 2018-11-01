<section id="header-wrap">
    <header id="header" class="clearfix hidden-sm hidden-xs" data-current-skin="blue">
        <div class="container">
            <ul class="header-inner">
                <li class="logo">
                    <a class="navbar-brand text-middle" href="{{ Path::url($data['page']->lang) }}">
                        <img width="100%" src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/logo.png') }}">
                    </a>
                </li>
                <li class="pull-right">
                    <ul class="top-menu">
                        <?php echo Block::render($data['blocks'], 'menu', '') ?>
                        <li class="dropdown">
                            <a href="#quick-search" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="tm-label">
                                    <i class="fa fa-search"></i>
                                    {{ Language::getTemplate('ecomtemplate.lbl_menu_search') }}
                                </span>
                            </a>
                            <ul class="dropdown-menu search-menu">
                                <li class="quick-search search-wrap">
                                    <input type="text" class="form-control fc-alt" placeholder="{{ language::getTemplate('ecomtemplate.lbl_search') }}">
                                    <i id="search-clear" class="fa fa-times" aria-hidden="true" data-toggle="false"></i>
                                    <div class="list-group z-depth-4" id="search-results" style="display: none;" data-bind="visible: search().length > 0">
                                        <div class="list-group-item z-depth-1-bottom">
                                            <span data-bind="html: searchResults().length"></span> {{ Language::getTemplate('ecomtemplate.lbl_result_for') }}
                                            <span data-bind="html: '“'+search()+'”'"></span>
                                        </div>
                                        <div class="list-group">
                                            <!-- ko foreach: searchResults -->
                                            <a class="list-group-item">
                                                <div data-bind="html: text"></div>
                                            </a>
                                            <!-- /ko -->
                                        </div>
                                    </div>
                                    <!-- <input class="form-control quick-search-input" type="text" placeholder="{{ language::getTemplate('ecomtemplate.lbl_search') }}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </span> -->
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a id="ddCart" data-toggle="dropdown">
                                <i class="countCart tmn-counts" data-bind="visible: carts().length > 0, html: carts().length" style="display: none;"></i>
                                <span class="tm-label">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    {{ Language::getTemplate('ecomtemplate.lbl_cart') }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg pull-right cart">
                                <div class="listview lv-cart">
                                    <div class="lv-header">
                                        {{ Language::getTemplate('ecomtemplate.lbl_cart') }}
                                    </div>
                                    <div class="lvCart lv-body c-overflow">
                                        <div data-bind="visible: carts().length > 0"  style="display: none;">
                                            <!-- ko foreach: carts -->
                                            <a class="lv-item">
                                                <div class="media">
                                                    <div class="pull-left">
                                                        <div class="img-background" data-bind="attr: {'style': 'width: 50px; height: 50px; background-image: url('+product_content+')'}"></div>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="lv-title" data-bind="html: product_name"></div>
                                                        <div class="text-overflow" data-bind="html: member_name"></div>
                                                        <div><span class="lv-small text-danger" data-bind="html: '{{ Language::getTemplate('ecomtemplate.lbl_quantity') }}: ' + quantity"></span></div>
                                                        <span class="btn-close" data-bind="click: $parent.delCart.bind($data, $rawData)"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- /ko -->
                                        </div>
                                        <div data-bind="visible: carts().length == 0">
                                            <div id="cart-empty" class="text-center" style="margin-top:100px;">
                                                <span><i class="fa fa-shopping-cart text-muted" aria-hidden="true"></i>{{ Language::getTemplate('ecomtemplate.lbl_cart_empty') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ $data['page']->cart_menu }}" class="lv-footer">{{ Language::getTemplate('ecomtemplate.lbl_view_detail') }}</a>
                                </div>
                            </div>
                        </li>
                        @if(Auth::check() && (Auth::user()->login_frontend == 1))
                        <li class="dropdown" id="menu_manager">
                            <a data-toggle="dropdown" id="lbl-usr">
                                <!--{{ str_split(Auth::user()->fullname)[0] }}-->
                                <span class="tm-label">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    {{ Language::getTemplate('ecomtemplate.lbl_manager') }}
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="lv-header">
                                    {{ Auth::user()->fullname }}
                                </li>
                                @if(Auth::user()->login_backend == 0)
                                <li>
                                    <a href="{{ $data['menus']->favorite }}">{{ $data['menus']->favorite_name }}</a>
                                </li>
                                @if($data['auth_member']->supplier)
                                <li>
                                    <a href="{{ $data['auth_member']->url }}">{{ \Language::getTemplate('ecomtemplate.lbl_my_enterprise') }}</a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{ $data['auth_member']->url . '/dashboard' }}">{{ \Language::getTemplate('ecomtemplate.lbl_my_enterprise_manager') }}</a>
                                </li>
                                @endif
                                <li>
                                    <a onclick="signout()"><i class="fa fa-sign-out" aria-hidden="true"></i> {{ Language::get('global.lbl_auth_logout') }}</a>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li data-toggle="modal" data-target="#signinModal">
                            <a><span class="tm-label"><i class="fa fa-user-secret" aria-hidden="true"></i> {{ Language::get('global.lbl_auth_login') }}</span></a>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <header id="m-header" class="clearfix visible-sm visible-xs" data-current-skin="blue">
        <ul class="header-inner">
            <li class="visible-sm visible-xs" id="menu-trigger" data-trigger="#sidebar">
                <div class="line-wrap">
                    <div class="line top"></div>
                    <div class="line center"></div>
                    <div class="line bottom"></div>
                </div>
            </li>

            <li class="logo">
                <a class="navbar-brand" href="{{ Path::url($data['page']->lang) }}">
                    <img src="{{ Path::urlTemplate('ecomtemplate/images/m-logo.png') }}">
                </a>
            </li>

            <li class="pull-right">
                <ul class="top-menu">
                    <!-- <li id="top-cart">
                        <a href="">
                            <i class="countCart tmn-counts" data-bind="visible: carts().length > 0, html: carts().length" style="display: none;"></i>
                            <i class="tm-icon fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                    </li> -->
                    <li id="top-search">
                        <a href=""><i class="tm-icon fa fa-search"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            <i class="countCart tmn-counts" data-bind="visible: carts().length > 0, html: carts().length" style="display: none;"></i>
                            <i class="tm-icon fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg pull-right cart">
                            <div class="listview lv-cart">
                                <div class="lv-header">
                                    {{ Language::getTemplate('ecomtemplate.lbl_cart') }}
                                </div>
                                <div class="lvCart lv-body c-overflow">
                                    <div data-bind="visible: carts().length > 0"  style="display: none;">
                                        <!-- ko foreach: carts -->
                                        <a class="lv-item">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <div class="img-background" data-bind="attr: {'style': 'width: 50px; height: 50px; background-image: url('+product_content+')'}"></div>
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title" data-bind="html: product_name"></div>
                                                    <div class="text-overflow" data-bind="html: member_name"></div>
                                                    <div><span class="lv-small text-danger" data-bind="html: '{{ Language::getTemplate('ecomtemplate.lbl_quantity') }}: ' + quantity"></span></div>
                                                    <span class="btn-close" data-bind="click: $parent.delCart.bind($data, $rawData)"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- /ko -->
                                    </div>
                                    <div data-bind="visible: carts().length == 0">
                                        <div id="cart-empty" class="text-center" style="margin-top:100px;">
                                            <span><i class="fa fa-shopping-cart text-muted" aria-hidden="true"></i>{{ Language::getTemplate('ecomtemplate.lbl_cart_empty') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ $data['page']->cart_menu }}" class="lv-footer">{{ Language::getTemplate('ecomtemplate.lbl_view_detail') }}</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Top Cart Content -->

        <!-- Top Search Content -->
        <div id="top-search-wrap">
            <div class="tsw-inner">
                <i id="top-search-close" class="fa fa-arrow-left" aria-hidden="true"></i>
                <input type="text">
                <i id="top-search-clear" class="fa fa-times" aria-hidden="true" data-toggle="false"></i>
                <div class="list-group z-depth-4" id="search-results" style="display: none;" data-bind="visible: search().length > 0">
                    <div class="list-group-item z-depth-1-bottom">
                        <span data-bind="html: searchResults().length"></span> {{ Language::getTemplate('ecomtemplate.lbl_result_for') }}
                        <span data-bind="html: '“'+search()+'”'"></span>
                    </div>
                    <div class="list-group">
                        <!-- ko foreach: searchResults -->
                        <a class="list-group-item">
                            <div data-bind="html: text"></div>
                        </a>
                        <!-- /ko -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <aside id="sidebar" class="sidebar c-overflow visible-sm visible-xs">
        @if(Auth::check())
        <div class="profile-menu">
            <a>
                <div class="profile-text">
                    <span>{{ str_split(Auth::user()->fullname)[0] }}</span>
                </div>
                <div class="profile-info">
                    {{ Auth::user()->fullname }}
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                </div>
            </a>

            <ul class="main-menu">
                @if(Auth::user()->login_backend == 0)
                <li>
                    <a href="{{ $data['menus']->favorite }}">{{ $data['menus']->favorite_name }}</a>
                </li>
                @if($data['auth_member']->supplier)
                <li>
                    <a href="{{ $data['auth_member']->url }}">{{ \Language::getTemplate('ecomtemplate.lbl_my_enterprise') }}</a>
                </li>
                @endif
                <li>
                    <a href="{{ $data['auth_member']->url . '/dashboard' }}">{{ \Language::getTemplate('ecomtemplate.lbl_my_enterprise_manager') }}</a>
                </li>
                @endif
                <li>
                    <a onclick="signout()"><i class="fa fa-sign-out" aria-hidden="true"></i> {{ Language::get('global.lbl_auth_logout') }}</a>
                </li>
            </ul>
        </div>
        @endif

        <ul class="main-menu">
            <?php echo Block::render($data['blocks'], 'offcanvas', '') ?>
            @if(!Auth::check())
            <li data-toggle="modal" data-target="#signinModal">
                <a><i class="tm-icon fa fa-user" aria-hidden="true"></i> {{ Language::get('global.lbl_auth_login') }}</a>
            </li>
            @endif
        </ul>
    </aside>
</section>
@include(Path::viewCurrentTemplate($data['page']->lang, 'pages.login'))
@include(Path::viewCurrentTemplate($data['page']->lang, 'pages.forget'))

<script>
    var addCart = true;

    function addToCart(cart) {
        if (!addCart) return false;
        addCart = false;
        viewModelHeader.addToCart(cart, function() {addCart = true;});
    }

    var viewModelHeader = null;
    $(function(){
        function ViewModelHeader() {
            var self = this;
            self.carts = ko.observableArray(<?php echo json_encode($data['carts']) ?>);
            self.searchResults = ko.observableArray([]);
            self.search = ko.observable('');
            self.isSearch = ko.observable(false);

            self.doSearch = function(search){
                self.search(search);
                if(!self.isSearch() && self.search().length > 3) {
                    $.ajax({url: '{{ Path::urlSite("ecom/search") }}', type: 'post', data: {
                        _token: '{{ csrf_token() }}', search: self.search(), lang: '{{ $data['page']->lang }}'},
                        beforeSend: function(){
                            self.isSearch(true)
                        },complete: function () {
                            self.isSearch(false)
                        },
                        success: function (data) {
                            self.searchResults(data);
                            $("#search-results .list-group").highlight(self.search());
                        }
                    });
                }

                if(self.search().length <= 3) {
                    self.searchResults([]);
                }
            };

            self.addToCart = function(product, callback) {
                product._token = '{{ csrf_token() }}';
                $.post("{{ Path::urlSite('ecom/add-to-cart') }}", product, function(data) {
                    switch(data.status) {
                        case 'add':
                            self.carts.push(product);
                            toastr['success'](data.message);
                            break;
                        case 'update':
                            var carts = [];
                            $.each(self.carts(), function(idx, val){
                                var quantity = parseInt(val.quantity);
                                if(val.product_id == product.product_id){
                                    quantity += parseInt(product.quantity);
                                };
                                carts.push({
                                    product_id: val.product_id,
                                    product_name: val.product_name,
                                    // product_alias: val.product_alias,
                                    product_content: val.product_content,
                                    member_id: val.member_id,
                                    member_name: val.member_name,
                                    // member_alias: val.member_alias,
                                    quantity: quantity
                                });
                            });
                            self.carts(carts);
                            toastr['success'](data.message);
                            break;
                        case 'error':
                            toastr['error'](data.message);
                            break;
                    }
                });
                callback();
                // toastr['warning']('{{ Language::getTemplate('ecomtemplate.message_not_customer') }}');
            };

            self.addToFavorite = function(product_id, product_name, callback) {
                $.post("{{ Path::urlSite('ecom/add-to-favorite') }}", {
                        _token: '{{ csrf_token() }}',
                        product_id: product_id,
                        product_name: product_name
                    },
                    function(data) {
                        toastr[data.status](data.message);
                    }
                );
            };

            self.delCart = function(product){
                product._token = '{{ csrf_token() }}';
                $.post("{{ Path::urlSite('ecom/del-cart') }}", product, function(data) {
                    if(data.status == 'success'){
                        self.carts.remove(product);
                        // self.carts.remove(function (item) { return item.product_id == product.product_id(); });
                    }else toastr[data.status](data.message);
                });
            };

            self.requestSample = function() {
                toastr['success']('Đã gởi yêu cầu đến nhà cung cấp.');
                // toastr['warning']('{{ Language::getTemplate('ecomtemplate.message_not_customer') }}');
            };
        }
        viewModelHeader = new ViewModelHeader();
        ko.applyBindings(viewModelHeader, document.getElementById('header-wrap'));

        $(window).click(function() {
            viewModelHeader.search('');
        });
        $('.search-wrap input').on('keyup', function(){
            if($(this).val().length > 0)
                $('.search-wrap  #search-clear').attr('data-toggle', 'true');
            else $('.search-wrap #search-clear').attr('data-toggle', 'false');
            viewModelHeader.doSearch($(this).val());
        });
        // $('.search-wrap').click(function() {
        //     event.stopPropagation();
        // });
        $('.search-wrap  #search-clear').on('click', function(){
            $('.search-wrap input').val('');
            $('.search-wrap #search-clear').attr('data-toggle', 'false');
            viewModelHeader.doSearch('');
        });
        $('#top-search-wrap input').on('keyup', function(){
            if($(this).val().length > 0)
                $('#top-search-wrap  #top-search-clear').attr('data-toggle', 'true');
            else $('#top-search-wrap #top-search-clear').attr('data-toggle', 'false');
            viewModelHeader.doSearch($(this).val());
        });
        // $('#top-search-wrap').click(function() {
        //     event.stopPropagation();
        // });
        $('#top-search-wrap  #top-search-clear').on('click', function(){
            $('#top-search-wrap input').val('');
            $('#top-search-wrap #top-search-clear').attr('data-toggle', 'false');
            viewModelHeader.doSearch('');
        });
    });
</script>
