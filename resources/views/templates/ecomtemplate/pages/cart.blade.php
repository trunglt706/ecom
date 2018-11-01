@extends(Path::viewCurrentTemplate( $data['page']->lang, 'layouts.base'))

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
@endsection

@section('jsc')
<script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/knockout.mapping.js') }}"></script>
@if( file_exists(config('data.PATH_MODEL').'/CKEditor/') )
<script src="{{ Path::urlCom('ckeditor/ckeditor.js') }}"></script>
@endif
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    <section id="cart">
        <div class="container main" style="min-height: 500px; margin-top: 100px;">
            <div class="row" data-bind="visible: viewCart() == 'tbl'">
                <h3>{{ Language::getTemplate('ecomtemplate.lbl_cart') }}</h3>
                @if($data['carts']=='' || count($data['carts'])==0)
                <div id="cart-empty">
                    <span id="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </span>
                    <h4>{{ Language::getTemplate('ecomtemplate.lbl_cart_empty') }}</h4>
                </div>
                @else
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%;"></th>
                            <th style="width: 20%;">{{ Language::getTemplate('ecomtemplate.lbl_cart_product') }}</th>
                            <th style="width: 50%;">{{ Language::getTemplate('ecomtemplate.lbl_cart_product_name') }}</th>
                            <th style="width: 15%;">{{ Language::getTemplate('ecomtemplate.lbl_quantity') }}</th>
                            <th style="width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ko foreach: orders() -->
                        <tr>
                            <td colspan="5" class="text-uppercase f-700 f-15">
                                <a data-bind="html: $rawData[0].member_name, attr: {'href': $rawData[0].member_alias}"></a>
                                <div class="btn btn-primary pull-right" data-bind="click: $parent.sendRequest.bind($data, $index(), $rawData)">
                                    <span class="glyphicon glyphicon-send"></span> {{ Language::getTemplate('ecomtemplate.lbl_request_quote') }}
                                </div>
                            </td>
                        </tr>
                        <!-- ko foreach: $rawData -->
                        <tr>
                            <td class="text-center" data-bind="html: $index() + 1"></td>
                            <td class="text-center">
                                <img width="50px;" data-bind="attr: {'src': product_content}">
                            </td>
                            <td data-bind="html: product_name"></td>
                            <td>
                                <input type="number" class="form-control"  data-bind="value: quantity">
                            </td>
                            <td></td>
                        </tr>
                        <!-- /ko -->
                        <!-- /ko -->
                    </tbody>
                </table>
                @endif
            </div>
            <div class="row" data-bind="visible: viewCart() == 'reg'">
                <div>
                    <div class="btn btn-default" data-bind="click: backTable">
                        <i class="zmdi zmdi-long-arrow-left"></i>
                    </div>
                    <!-- ko if: card().fullname != '' -->
                    <!-- <div class="btn btn-primary pull-right" data-bind="click: nextCard">
                        <span class="glyphicon glyphicon-send"></span> {{ Language::getTemplate('ecomtemplate.lbl_request_quote') }}
                    </div> -->
                    <!-- /ko -->
                </div>
                <div class="col-sm-5 col-sm-offset-1">
                    @if (!\Auth::check())
                    <h3>{{ Language::getTemplate('ecomtemplate.lbl_member_vpa') }}</h3>
                    <div class="panel panel-login">
                        <div class="panel-body">
                            <form id="frmLogin" method="post">
                                <h3 class="text-center" style="margin-bottom: 5px;">{{ \Language::get('global.lbl_auth_login') }}</h3>
                                <div class="form-group">
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" id="username" data-bind="value: login().username" required placeholder="{{ Language::get('global.lbl_auth_username') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fg-line">
                                        <input type="password" class="form-control fc-alt" id="password" data-bind="value: login().password" required placeholder="{{ Language::get('global.lbl_auth_password') }}">
                                    </div>
                                </div>
                                <center id="toolbar">
                                    <div class="btn btn-icon-text btn-primary waves-effect" data-bind="click: btnLogin">{{ Language::get('global.lbl_auth_login') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></div>
                                </center>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-sm-5 col-sm-offset-1">
                <h3>{{ Language::getTemplate('ecomtemplate.lbl_customer') }}</h3>
                <div class="btn btn-primary" data-bind="click: nextCard">
                    <span class="glyphicon glyphicon-send"></span> {{ Language::getTemplate('ecomtemplate.lbl_request_quote') }}
                </div>
                </div>
                @if (!\Auth::check())
                <!-- <div class="col-sm-5 col-sm-offset-1">
                    <h3>{{ Language::getTemplate('ecomtemplate.lbl_member_new') }}</h3>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form id="frmRegister" method="post">
                                <div class="form-title">
                                    <h2 class="f-300 text-center">{{ \Language::getTemplate('ecomtemplate.lbl_group_member') }}</h2>
                                </div>
                                <div class="form-group">
                                    <label for="member_name" class="control-label">{{ \Language::getCom('member.lbl_member_name') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" id="member_name" data-bind="value: register().member_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="member_tin" class="control-label">{{ \Language::getCom('member.lbl_member_tin') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" id="member_tin" data-bind="value: register().member_tin" required>
                                </div>
                                <div class="form-group">
                                    <label for="member_address" class="control-label">{{ \Language::getCom('member.lbl_member_address') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" id="member_address" data-bind="value: register().member_address" required>
                                </div>
                                <div class="form-group">
                                    <label for="member_phone" class="control-label">{{ \Language::getCom('member.lbl_member_phone') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" id="member_phone" onkeydown="return ( event.ctrlKey || event.altKey
                                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                        || (95<event.keyCode && event.keyCode<106)
                                        || (event.keyCode==8) || (event.keyCode==9)
                                        || (event.keyCode>34 && event.keyCode<40)
                                        || (event.keyCode==46) )"
                                    required maxlength="11" data-bind="value: register().member_phone">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ \Language::getCom('member.lbl_member_types') }} <sup class="text-danger">{{ \Language::getTemplate('ecomtemplate.lbl_register_chose_one') }}</sup></label>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="supplier" id="supplier"><i class="input-helper"></i> {{ \Language::getCom('member.lbl_member_supplier') }}</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="customer" id="customer" checked="true"><i class="input-helper"></i> {{ \Language::getCom('member.lbl_member_customer') }}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fullname" class="control-label">{{ \Language::getCom('system.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" id="fullname" required data-bind="value: register().fullname">
                                </div>
                                <div class="form-group">
                                    <label for="address" class="control-label">{{ \Language::getCom('system.lbl_address') }}</label>
                                    <input type="text" class="form-control fc-alt" id="address" data-bind="value: register().address">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="control-label">{{ \Language::getCom('system.lbl_phone') }}</label>
                                    <input type="text" class="form-control fc-alt" id="phone" onkeydown="return ( event.ctrlKey || event.altKey
                                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                        || (95<event.keyCode && event.keyCode<106)
                                        || (event.keyCode==8) || (event.keyCode==9)
                                        || (event.keyCode>34 && event.keyCode<40)
                                        || (event.keyCode==46) )"
                                    maxlength="11" data-bind="value: register().phone">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">{{ \Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="email" class="form-control fc-alt" id="email" data-bind="value: register().email" required>
                                </div>
                                <div class="form-group">
                                    <label for="newusername" class="control-label">{{ \Language::get('global.lbl_auth_username') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" id="newusername" data-bind="value: register().username" required>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword" class="control-label">{{ \Language::get('global.lbl_auth_password') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="password" class="form-control fc-alt" id="newpassword" data-bind="register().password" required>
                                </div>
                                <div class="form-group">
                                    <label for="repassword" class="control-label">{{ \Language::get('global.lbl_auth_retype_password') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="password" class="form-control fc-alt" id="repassword" data-bind="value: register().repassword" required equalTo="#newpassword">
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <div class="btn btn-primary" data-bind="click: btnRegister">
                                            {{ \Language::getTemplate('ecomtemplate.lbl_register') }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
                @endif
            </div>
            <div class="row" data-bind="visible: viewCart() == 'cad'">
                <div>
                    @if ($data['auth_member'] == '')
                    <div class="btn btn-default" data-bind="click: backReg">
                        <i class="zmdi zmdi-long-arrow-left"></i>
                    </div>
                    @else
                    <div class="btn btn-default" data-bind="click: backTable">
                        <i class="zmdi zmdi-long-arrow-left"></i>
                    </div>
                    @endif
                </div>
                <div>
                    @if ($data['auth_member'] != '')
                    <div class="card-body card-padding m-t-10">
                        <div class="contacts clearfix row">
                            <!--ko foreach: cards-->
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="c-item">
                                    <div class="c-info">
                                        <strong data-bind="html: fullname"></strong>
                                        <small data-bind="html: position"></small>
                                        <small data-bind="html: department"></small>
                                        <small data-bind="html: email"></small>
                                        <small data-bind="html: phone"></small>
                                        <!-- ko if: current == 1-->
                                        <i class="fa fa-check-circle c-green" aria-hidden="true"></i>
                                        <!-- /ko -->
                                        <!-- ko if: current != 1-->
                                        <i class="fa fa-times-circle c-red" aria-hidden="true"></i>
                                        <!-- /ko -->
                                    </div>
                                    <div class="c-footer">
                                        <button class="waves-effect" data-bind="click: $parent.selectCard.bind($data, $rawData)"><i class="zmdi zmdi-person-add"></i> Select</button>
                                        <!--<button class="waves-effect btn btn-danger"><i class="zmdi zmdi-person-add"></i> Delete</button>-->
                                    </div>
                                </div>
                            </div>
                            <!-- /ko -->
                        </div>
                    </div>
                    @endif
                    <h3>{{ Language::getTemplate('ecomtemplate.lbl_contact_info') }}</h3>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form id="frmCard" method="post">
                                <div class="form-group">
                                    <label for="fullname" class="control-label">{{ \Language::getCom('system.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" id="fullname" required data-bind="value: card().fullname, enable: cards().length == 0">
                                </div>
                                <div class="form-group">
                                    <label for="address" class="control-label">{{ \Language::getCom('system.lbl_address') }}</label>
                                    <input type="text" class="form-control fc-alt" id="address" data-bind="value: card().address, enable: cards().length == 0">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="control-label">{{ \Language::getCom('system.lbl_phone') }}</label>
                                    <input type="text" class="form-control fc-alt" id="phone" onkeydown="return ( event.ctrlKey || event.altKey
                                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                        || (95<event.keyCode && event.keyCode<106)
                                        || (event.keyCode==8) || (event.keyCode==9)
                                        || (event.keyCode>34 && event.keyCode<40)
                                        || (event.keyCode==46) )"
                                    maxlength="11" data-bind="value: card().phone, enable: cards().length == 0">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">{{ \Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="email" class="form-control fc-alt" id="email" data-bind="value: card().email, enable: cards().length == 0" required>
                                </div>
                                <div class="form-group">
                                    <label for="note" class="control-label">{{ \Language::getCom('member.lbl_note') }} <sup class="text-danger">(*)</sup></label>
                                    <textarea class="ckeditor" name="note" id="note" data-bind="value: card().note" required></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <div class="btn btn-primary" data-bind="click: btnCard">
                                            {{ Language::getTemplate('ecomtemplate.lbl_request_quote') }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <!-- </div>
                <div class="col-sm-7"> -->
                </div>
            </div>
            <div class="row" data-bind="visible: viewCart() == 'odr'">
                <div>
                    <div class="btn btn-default" data-bind="click: backCard">
                        <i class="zmdi zmdi-long-arrow-left"></i>
                    </div>
                    <div class="btn btn-primary pull-right" data-bind="click: btnOrder">
                        <span class="glyphicon glyphicon-send"></span> {{ Language::getTemplate('ecomtemplate.lbl_request_quote') }}
                    </div>
                </div>
                <!-- ko if: order().length != 0 -->
                <h3 data-bind="html: order()[0].member_name"></h3>
                <!-- /ko -->
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10%;"></th>
                            <th style="width: 20%;">{{ Language::getTemplate('ecomtemplate.lbl_cart_product') }}</th>
                            <th style="width: 55%;">{{ Language::getTemplate('ecomtemplate.lbl_cart_product_name') }}</th>
                            <th style="width: 15%;">{{ Language::getTemplate('ecomtemplate.lbl_quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ko foreach: order() -->
                        <tr>
                            <td class="text-center" data-bind="html: $index() + 1"></td>
                            <td class="text-center">
                                <img width="50px;" data-bind="attr: {'src': product_content}">
                            </td>
                            <td data-bind="html: product_name"></td>
                            <td class="text-right" data-bind="html: quantity"></td>
                        </tr>
                        <!-- /ko -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script type="text/javascript">
    // validate form
    var validate = $('#frmRegister').validate({
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
    var validate = $('#frmCard').validate({
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
    </script>
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.footer'))
    <script>
        @if( file_exists(config('data.PATH_MODEL').'/CKEditor/') )
        $('.ckeditor').each(function(index, el) {
            CKEDITOR.replace( this );
        });
        @endif
        // $('#btnRequest').on('click', function () {
        //     @if (\Auth::check() && \Auth::user()->login_frontend && $data['auth_member']->customer)
        //     $.post("{{ Path::urlSite('ecom/request-quote') }}", {_token: '{{ csrf_token() }}', customer_id: {{ $data['auth_member']->id }}}, function(data) {
        //         toastr[data.status](data.message);
        //         if (data.status == 'success') {
        //             location.href = '{{ $data['menus']->index }}';
        //         }
        //     });
        //     @else
        //     location.href = '{{ $data['menus']->register }}';
        //     @endif
        // });
        function ViewModelCart() {
            var self = this;
            self.viewCart = ko.observable('tbl');
            self.login = ko.observable({
                username: '',
                password: ''
            });
            self.register = ko.observable({
                member_name: '',
                member_tin: '',
                member_address: '',
                member_phone: '',
                supplier: '',
                customer: '',
                fullname: '',
                address: '',
                phone: '',
                email: '',
                newusername: '',
                newpassword: '',
                repassword: ''
            });
            self.cards = ko.observableArray([]);
            self.card = ko.observable({});
            self.orders = ko.mapping.fromJS(JSON.parse('<?php echo json_encode($data['order']); ?>'));
            self.order = ko.observableArray([]);
            self.iOrder = ko.observable(0);
            self.sendRequest = function(iOrder, order) {
                self.order(order);
                self.iOrder(iOrder);
                @if (\Auth::check() && \Auth::user()->login_frontend)
                self.viewCart('cad');
                @else
                self.viewCart('reg');
                @endif
            }
            self.backTable = function() {
                self.viewCart('tbl');
            }
            self.backReg = function() {
                self.viewCart('reg');
            }
            self.nextCard = function() {
                self.viewCart('cad');
            }
            self.backCard = function() {
                self.viewCart('cad');
            }
            self.nextOrder = function() {
                self.viewCart('odr');
            }
            self.btnLogin = function () {
                var data = self.login();
                data['_token'] = '{{ csrf_token() }}';
                $.post("{{ Path::urlSite('ecom/login') }}", data, function( data ) {
                    toastr[data.status](data.message);
                    if (data.status === 'success')
                        setTimeout('location.reload();', 500);
                });
            }
            self.btnRegister = function () {
                if (!$('#frmRegister').valid() || !$('#customer').is(':checked')) {
                    toastr['error']('{{ \Language::getTemplate('ecomtemplate.message_register_input_error') }}');
                    return false;
                }
                var data = self.register();
                data['_token'] = '{{ csrf_token() }}';
                data['supplier'] = $('#supplier').is(':checked') ? 1 : 0;
                data['customer'] = $('#customer').is(':checked') ? 1 : 0;
                data['lang'] = '{{ $data['page']->lang }}';
                $.post("{{ Path::urlSite('ecom/register') }}", data, function( data ) {
                    toastr[data.status](data.message);
                    if (data.status === 'success') {
                        self.viewCart('odr');
                        self.card({
                            // member_name: self.register().member_name,
                            // member_address: self.register().member_address,
                            // member_phone: self.register().member_phone,
                            fullname: self.register().fullname,
                            position: '',
                            department: '',
                            address: self.register().address,
                            phone: self.register().phone,
                            email: self.register().email,
                            note: '',
                            current: 0
                        });
                        // self.card().member_name = self.register().member_name;
                        // self.card().member_address = self.register().member_address;
                        // self.card().member_phone = self.register().member_phone;
                        // self.card().fullname = self.register().fullname;
                        // self.card().address = self.register().address;
                        // self.card().phone = self.register().phone;
                        // self.card().email = self.register().email;
                    }
                });
            }
            self.btnCard = function () {
                if (!$('#frmCard').valid()) {
                    toastr['error']('{{ \Language::getTemplate('ecomtemplate.message_register_input_error') }}');
                    return false;
                }
                var order = self.order();
                var card = self.card();
                $.ajax({url: '{{ Path::urlSite('ecom/request-quote') }}', type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        note: CKEDITOR.instances.note.getData(),
                        order: order,
                        card: card,
                        member_id: {{ isset($data['auth_member']->id) ? $data['auth_member']->id : 0 }}
                    },
                    beforeSend: showAppLoader, complete: hideAppLoader,
                    success: function (data) {
                        if(data.status == 'success') {
                            self.orders.splice(self.iOrder(), 1);
                            $.each(order, function(index, cart) {
                                viewModelHeader.carts.remove(function (item) { return item.product_id == cart.product_id(); });
                            });
                            self.viewCart('tbl');
                        }
                        else toastr[data.status](data.message);
                    }
                });
                // $.post("{{ Path::urlSite('ecom/request-quote') }}", {_token: '{{ csrf_token() }}', note: CKEDITOR.instances.note.getData(), order, card, member_id: {{ isset($data['auth_member']->id) ? $data['auth_member']->id : 0 }}}, function(data) {
                //     if(data.status == 'success') {
                //         self.orders.splice(self.iOrder(), 1);
                //         $.each(order, function(index, cart) {
                //             viewModelHeader.carts.remove(function (item) { return item.product_id == cart.product_id(); });
                //         });
                //         self.viewCart('tbl');
                //     }
                //     else toastr[data.status](data.message);
                // });
            }
            @if (\Auth::check() && \Auth::user()->login_frontend && $data['auth_member']->customer)
            self.fetchCard = function () {
                $.ajax({url: '{{ Path::urlSite('ecom/member-cards') }}', type: 'post', data: { _token: '{{ csrf_token() }}', member_id: '{{ $data['auth_member']->id }}' },
                    success: function (data) {
                        self.cards(data);
                        $.each(data, function(index, card) {
                            if (card.current == 1) {
                                self.card(card);
                                return false;
                            }
                        });
                    }
                });
            };
            self.selectCard = function (card) {
                self.card(card);
            }
            ko.computed(self.fetchCard);
            @endif
            self.btnOrder = function() {
                self.viewCart('tbl');
                // $.post("{{ Path::urlSite('ecom/send-order') }}", {_token: '{{ csrf_token() }}', order}, function(data) {
                //     if(data.status == 'success') {
                //         console.log(data);
                //         // location.reload();
                //     } else toastr[data.status](data.message);
                // });
            }
        }
        viewModelCart = new ViewModelCart();
        ko.applyBindings(viewModelCart, document.getElementById('cart'));
    </script>
@endsection
