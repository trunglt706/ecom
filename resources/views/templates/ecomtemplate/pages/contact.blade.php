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
    <section id="contact">
        <div class="container main" style="min-height: 500px; margin-top: 100px;">
            <div class="block-header">
                <h3 class="text-uppercase text-primary">{{ Language::getTemplate('ecomtemplate.lbl_contact_us') }}</h3>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form id="frmContactUs">
                                <div class="form-group">
                                    <label for="fullname" class="control-label">{{ \Language::getCom('system.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control fc-alt" name="fullname" id="fullname" required data-bind="value: contact().fullname">
                                </div>
                                <div class="form-group">
                                    <label for="address" class="control-label">{{ \Language::getCom('system.lbl_address') }}</label>
                                    <input type="text" class="form-control fc-alt" name="address" id="address" data-bind="value: contact().address">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="control-label">{{ \Language::getCom('system.lbl_phone') }}</label>
                                    <input type="text" class="form-control fc-alt" name="phone" id="phone" onkeydown="return ( event.ctrlKey || event.altKey
                                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                        || (95<event.keyCode && event.keyCode<106)
                                        || (event.keyCode==8) || (event.keyCode==9)
                                        || (event.keyCode>34 && event.keyCode<40)
                                        || (event.keyCode==46) )"
                                    maxlength="11" data-bind="value: contact().phone">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">{{ \Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                                    <input type="email" class="form-control fc-alt" name="email" id="email" data-bind="value: contact().email" required>
                                </div>
                                <div class="form-group">
                                    <label for="note" class="control-label">{{ \Language::getCom('system.lbl_content') }} <sup class="text-danger">(*)</sup></label>
                                    <textarea class="form-control fc-alt" name="note" id="note" data-bind="value: contact().message" required></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <div class="btn btn-primary" data-bind="click: btnContact" id="btnContact">
                                            {{ Language::getTemplate('ecomtemplate.lbl_send') }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.788252058037!2d105.78287601421854!3d10.034324792827647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a062a10ad0cae9%3A0x5865cb6cbcd25738!2zUGjDsm5nIFRoxrDGoW5nIG3huqFpIHbDoCBjw7RuZyBuZ2hp4buHcCBWaeG7h3QgTmFtIGNoaSBuaMOhbmggdOG6oWkgQ-G6p24gVGjGoSAoIFZDQ0kgQ-G6p24gVGjGoSAp!5e0!3m2!1svi!2s!4v1469163644154" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <script>
        var validate = $('#frmContactUs').validate({
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
        function ContactModel() {
            var self = this;
            self.contact = ko.observable({});
            self.btnContact = function () {
                if (!$('#frmContactUs').valid()) {
                    toastr['error']('{{ \Language::getTemplate('ecomtemplate.message_register_input_error') }}');
                    return false;
                }
                var data = self.contact();
                data['_token'] = '{{ csrf_token() }}';
                $.ajax({url: '{{ Path::urlSite('ecom/contact-vpa') }}', type: 'post', data: data,
                    success: function (data) {
                        toastr[data.status](data.message);
                        if (data.status == 'success')
                            self.contact({});
                        // setTimeout('location.reload();', 1000);
                    }
                });
            };
        }
        var contactModel = new ContactModel();
        ko.applyBindings(contactModel, document.getElementById('frmContactUs'));
    </script>
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.footer'))
@endsection
