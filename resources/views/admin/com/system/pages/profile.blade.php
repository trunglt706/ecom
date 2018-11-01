<!-- toolbar-->
<nav class="navbar navbar-default app-comm">
    <div class="container-fluid">
        <div class="navbar-form pull-right navbar-right">
            <button type="button" class="btn btn-primary" data-bind="click: doSave"><span class="glyphicon glyphicon-floppy-disk"></span> {{ Language::get('global.lbl_save') }}</button>
        </div>
    </div>
</nav><!-- /toolbar-->
<div class="container-fluid" style="margin-bottom: 50px;">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <form role="form" id="frm_profile">
                    <div class="col-md-4">
                        <legend>{{ Language::getCom('system.lbl_group_info_user') }}</legend>
                        <div class="form-group">
                            <label for="fullname" class="control-label">{{ Language::getCom('system.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
                            <input type="text" class="form-control" name="fullname" id="fullname" data-bind="value: current().fullname" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label">{{ Language::getCom('system.lbl_address') }}</label>
                            <input type="text" class="form-control" name="address" id="address" data-bind="value: current().address" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">{{ Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                            <input type="email" class="form-control" name="email" id="email" data-bind="value: current().email" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label">{{ Language::getCom('system.lbl_phone') }}</label>
                            <input type="text" class="form-control" name="phone" id="phone" onkeydown="return ( event.ctrlKey || event.altKey
                                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                    || (95<event.keyCode && event.keyCode<106)
                                    || (event.keyCode==8) || (event.keyCode==9)
                                    || (event.keyCode>34 && event.keyCode<40)
                                    || (event.keyCode==46) )"
                                maxlength="11" data-bind="value: current().phone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <legend>{{ Language::getCom('system.lbl_group_account') }}</legend>
                        <div class="form-group">
                            <label for="password" class="control-label">{{ Language::getCom('system.lbl_password') }}</label>
                            <input type="password" class="form-control" name="password" id="password" data-bind="value: current().password" placeholder="{{ Language::getCom('system.lbl_new_input_for_change') }}">
                        </div>
                        <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
                    </div>
                    <div class="col-md-4">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // validate form
    var validate = $('#frm_profile').validate({
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
        self.current = ko.observable({
            fullname: '{{ Auth::user()->fullname }}',
            address: '{{ Auth::user()->address }}',
            email: '{{ Auth::user()->email }}',
            phone: '{{ Auth::user()->phone }}',
            password: ''
        });

        self.doSave = function(){
            if (!$('#frm_profile').valid())
                return false;
            self.current()._token = '{{ csrf_token() }}';
            $.ajax({url: '{{ $uri }}', type: 'post', data: self.current(),
                beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
                success: function (data) {
                    toastr[data.status](data.message);
                    if (data.status === 'success'){
                        window.location.reload();
                    }
                }
            });
        };
    }
    var viewModel = new ViewModel();
    ko.applyBindings(viewModel);
</script>
