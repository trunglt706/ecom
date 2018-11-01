@extends(Path::viewCurrentTemplate( $data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo $data['menus']->sample_name; ?>
@endsection

@section('current-css')
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/homepage.css') }}" rel="stylesheet">
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/font-awesome.min.css') }}" rel="stylesheet">
@endsection

@section('jsc')
<script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/knockout.mapping.js') }}"></script>
@if( file_exists(config('data.PATH_MODEL').'/CKEditor/') )
<script src="{{ Path::urlCom('ckeditor/ckeditor.js') }}"></script>
@endif
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    <section id="sample">
        <div class="container main" style="min-height: 500px; margin-top: 50px;">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                <li><a href="{{ $data['product']->url }}">{{ $data['product']->product_name }}</a></li>
                <li>{{ $data['menus']->sample_name }}</li>
            </ol>
            <div class="row" data-bind="visible: viewSample() == 'reg'">
                <div>
                    <div class="btn btn-default" data-bind="click: backProduct">
                        <i class="zmdi zmdi-long-arrow-left"></i>
                    </div>
                    <!-- ko if: card().fullname != '' -->
                    <!-- <div class="btn btn-primary pull-right" data-bind="click: nextCard">
                        <span class="glyphicon glyphicon-send"></span> {{ Language::getTemplate('ecomtemplate.lbl_request_sample') }}
                    </div> -->
                    <!-- /ko -->
                </div>
                <div class="col-sm-5 col-sm-offset-1">
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
                </div>
                <div class="col-sm-5 col-sm-offset-1">
                <h3>{{ Language::getTemplate('ecomtemplate.lbl_customer') }}</h3>
                <div class="btn btn-primary" data-bind="click: nextCard">
                    <span class="glyphicon glyphicon-send"></span> {{ Language::getTemplate('ecomtemplate.lbl_request_sample') }}
                </div>
                    <!-- <h3>{{ Language::getTemplate('ecomtemplate.lbl_member_new') }}</h3>
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
                    </div> -->
                </div>
            </div>
            <div class="row" data-bind="visible: viewSample() == 'cad'">
                <div>
                    @if ($data['auth_member'] == '')
                    <div class="btn btn-default" data-bind="click: backReg">
                        <i class="zmdi zmdi-long-arrow-left"></i>
                    </div>
                    @else
                    <div class="btn btn-default" data-bind="click: backProduct">
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
                                            {{ Language::getTemplate('ecomtemplate.lbl_request_sample') }}
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
        function ViewModelSample() {
            var self = this;
            @if (\Auth::check() && \Auth::user()->login_frontend && $data['auth_member']->customer)
            self.viewSample = ko.observable('cad');
            @else
            self.viewSample = ko.observable('reg');
            @endif
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
            self.order = ko.observable({
                product_id: '<?php echo $data['product']->product_id ?>',
                product_name: '<?php echo $data['product']->product_name ?>',
                product_content: '<?php echo $data['product']->media ?>',
                member_id: '<?php echo $data['product']->member_id ?>',
                member_name: '<?php echo $data['product']->member_name ?>'
            });
            self.cards = ko.observableArray([]);
            self.card = ko.observable({});
            self.backProduct = function() {
                location.href = '{{ $data['product']->url }}';
            }
            self.backReg = function() {
                self.viewSample('reg');
            }
            self.nextCard = function() {
                self.viewSample('cad');
            }
            self.backCard = function() {
                self.viewSample('cad');
            }
            self.nextOrder = function() {
                self.viewSample('odr');
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
                        self.viewSample('odr');
                        self.card({
                            fullname: self.register().fullname,
                            position: '',
                            department: '',
                            address: self.register().address,
                            phone: self.register().phone,
                            email: self.register().email,
                            note: '',
                            current: 0
                        });
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
                $.ajax({url: '{{ Path::urlSite('ecom/request-sample') }}', type: 'post',
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
                            location.href = '{{ $data['product']->url }}';
                        }
                        else toastr[data.status](data.message);
                    }
                });
                // $.post("{{ Path::urlSite('ecom/request-sample') }}", {_token: '{{ csrf_token() }}', order, card, member_id: {{ isset($data['auth_member']->id) ? $data['auth_member']->id : 0 }}}, function(data) {
                //     if (data.status == 'success') {
                // //         self.orders.splice(self.iOrder(), 1);
                // //         $.each(order, function(index, sample) {
                // //             viewModelHeader.samples.remove(function (item) { return item.product_id == sample.product_id(); });
                // //         });
                // //         self.viewSample('tbl');
                //         location.href = '{{ $data['product']->url }}';
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
                self.viewSample('tbl');
            }
        }
        viewModelSample = new ViewModelSample();
        ko.applyBindings(viewModelSample, document.getElementById('sample'));
    </script>
@endsection
