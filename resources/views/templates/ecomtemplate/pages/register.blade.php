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
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/register.css') }}" rel="stylesheet">
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    <section id="register" class="margin-top">
        <div class="container main">
            <div class="row">
                <div class="title">
                    <h1 class="f-300 text-center">{{ \Language::getTemplate('ecomtemplate.lbl_register_user') }}</h1>
                </div>
                <div class="col-sm-7">
                    <div class="info-title w-100">
                        <h3 class="f-300 text-center">{{ \Language::getTemplate('ecomtemplate.lbl_register_rules') }}</h3>
                    </div>
                    <ul style="background: #e5e5e5; border-radius: 10px; padding: 10px 10px 10px 40px; margin: 10px 0;height: 965px;overflow: auto;">
                    @if (isset($data['contents']))
                        @foreach ($data['contents'] as $register)
                        <?php echo $register->content;?>
                        @endforeach
                    @endif
                    </ul>
                </div>
                <div class="col-sm-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form id="frmRegister" method="post">
                                <div class="form-title">
                                    <h2 class="f-300 text-center">{{ \Language::getTemplate('ecomtemplate.lbl_group_member') }}</h2>
                                </div>
                                <div class="form-group">
                                    <label for="member_name" class="control-label">{{ \Language::getCom('member.lbl_member_name') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" name="member_name" id="member_name" value="{{ is_null($data['member']) ? '' : $data['member']->member_name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="member_tin" class="control-label">{{ \Language::getCom('member.lbl_member_tin') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" name="member_tin" id="member_tin" value="{{ is_null($data['member']) ? '' : $data['member']->member_tin }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="member_address" class="control-label">{{ \Language::getCom('member.lbl_member_address') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" name="member_address" id="member_address" value="{{ is_null($data['member']) ? '' : $data['member']->member_address }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="member_phone" class="control-label">{{ \Language::getCom('member.lbl_member_phone') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" name="member_phone" id="member_phone" onkeydown="return ( event.ctrlKey || event.altKey
                                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                        || (95<event.keyCode && event.keyCode<106)
                                        || (event.keyCode==8) || (event.keyCode==9)
                                        || (event.keyCode>34 && event.keyCode<40)
                                        || (event.keyCode==46) )"
                                    required value="{{ is_null($data['member']) ? '' : $data['member']->member_phone }}" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ \Language::getCom('member.lbl_member_types') }} <sup class="text-danger">{{ \Language::getTemplate('ecomtemplate.lbl_register_chose_one') }}</sup></label>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="supplier" id="supplier" {{ is_null($data['member']) ? '' : ($data['member']->supplier ? 'checked="true"' : '') }}><i class="input-helper"></i> {{ \Language::getCom('member.lbl_member_supplier') }}</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="customer" id="customer" {{ is_null($data['member']) ? '' : ($data['member']->customer ? 'checked="true"' : '') }}><i class="input-helper"></i> {{ \Language::getCom('member.lbl_member_customer') }}</label>
                                    </div>
                                </div>
<!--                                <hr>
                                <div class="form-title">
                                    <h2 class="f-300 text-center">{{ \Language::getTemplate('ecomtemplate.lbl_group_account') }}</h2>
                                </div>-->
                                <div class="form-group">
                                    <label for="fullname" class="control-label">{{ \Language::getCom('system.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" name="fullname" id="fullname" value="{{ is_null($data['user']) ? '' : $data['user']->fullname }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="control-label">{{ \Language::getCom('system.lbl_address') }}</label>
                                    <input type="text" class="form-control fc-alt" name="address" id="address" value="{{ is_null($data['user']) ? '' : $data['user']->address }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="control-label">{{ \Language::getCom('system.lbl_phone') }}</label>
                                    <input type="text" class="form-control fc-alt" name="phone" id="phone" onkeydown="return ( event.ctrlKey || event.altKey
                                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                        || (95<event.keyCode && event.keyCode<106)
                                        || (event.keyCode==8) || (event.keyCode==9)
                                        || (event.keyCode>34 && event.keyCode<40)
                                        || (event.keyCode==46) )"
                                    maxlength="11" value="{{ is_null($data['user']) ? '' : $data['user']->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">{{ \Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="email" class="form-control fc-alt" name="email" id="email" value="{{ is_null($data['user']) ? '' : $data['user']->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="newusername" class="control-label">{{ \Language::get('global.lbl_auth_username') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" name="newusername" id="newusername" value="{{ is_null($data['user']) ? '' : $data['user']->username }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword" class="control-label">{{ \Language::get('global.lbl_auth_password') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="password" class="form-control fc-alt" name="newpassword" id="newpassword" required>
                                </div>
                                <div class="form-group">
                                    <label for="repassword" class="control-label">{{ \Language::get('global.lbl_auth_retype_password') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="password" class="form-control fc-alt" name="repassword" id="repassword" required equalto="#newpassword">
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <div class="btn btn-primary" id="btnSubmit">
                                            {{ \Language::getTemplate('ecomtemplate.lbl_register') }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
    $(document).ready(function() {
        $('#btnSubmit').on('click', function() {
            if (!$('#frmRegister').valid() || !($('#supplier').is(':checked') || $('#customer').is(':checked'))) {
                toastr['error']('{{ \Language::getTemplate('ecomtemplate.message_register_input_error') }}');
                return false;
            }
            $.ajax({url: '{{ Path::urlSite('ecom/register') }}', type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    member_name: $('#member_name').val(),
                    member_tin: $('#member_tin').val(),
                    member_address: $('#member_address').val(),
                    member_phone: $('#member_phone').val(),
                    supplier: $('#supplier').is(':checked') ? 1 : 0,
                    customer: $('#customer').is(':checked') ? 1 : 0,
                    fullname: $('#fullname').val(),
                    address: $('#address').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    username: $('#newusername').val(),
                    password: $('#newpassword').val(),
                    repassword: $('#repassword').val(),
                    lang: '{{ $data['page']->lang }}',
                    @if(!is_null($data['member']))
                    m: {{ $data['member']->id }},
                    u: {{ $data['user']->id }}
                    @endif
                }, beforeSend: showAppLoader, complete: hideAppLoader,
                success: function (data) {
                    if (data.status === 'success') {
                        toastr[data.status](data.message);
                        setTimeout(function() { location.href='{{ Path::url($data['page']->lang."/") }}'; }, 2000);
                    }
                    else {
                        toastr[data.status](data.message);
                    }
                }
            });
            // $.post("{{ Path::url(config('data.ROUTE_PREFIX_SITE').'/ecom/register') }}", {
            //     _token: '{{ csrf_token() }}',
            //     member_name: $('#member_name').val(),
            //     member_tin: $('#member_tin').val(),
            //     member_address: $('#member_address').val(),
            //     member_phone: $('#member_phone').val(),
            //     supplier: $('#supplier').is(':checked') ? 1 : 0,
            //     customer: $('#customer').is(':checked') ? 1 : 0,
            //     fullname: $('#fullname').val(),
            //     address: $('#address').val(),
            //     phone: $('#phone').val(),
            //     email: $('#email').val(),
            //     username: $('#newusername').val(),
            //     password: $('#newpassword').val(),
            //     repassword: $('#repassword').val(),
            //     lang: '{{ $data['page']->lang }}',
            //     @if(!is_null($data['member']))
            //     m: {{ $data['member']->id }},
            //     u: {{ $data['user']->id }}
            //     @endif
            // }, function( data ) {
            //     if (data.status === 'success') {
            //         toastr[data.status](data.message);
            //         setTimeout(function() { location.href='{{ Path::url($data['page']->lang."/") }}'; }, 2000);
            //     }
            //     else {
            //         toastr[data.status](data.message);
            //     }
            // });
        });
    });
    </script>
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.footer'))
@endsection
