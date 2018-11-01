<!--changePass-->
<div class="modal fade bs-example-modal-sm" id="change-pass" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <h1> {{ Language::getCom('system.lbl_change_password') }}</h1>
                <div class="form-group">
                    <label class="control-label" for="pass">{{ Language::getCom('system.lbl_password') }}</label>
                    <input id="pass" name="pass" type="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="npass">{{ Language::getCom('system.lbl_new_password') }}</label>
                    <input id="npass" name="npass" type="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="re-npass">{{ Language::getCom('system.lbl_re_new_password') }}</label>
                    <input id="re-npass" name="re-npass" type="password" class="form-control" required>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>{{ Language::get('global.lbl_cancel') }}</button>
                    <button type="button" class="btn btn-primary" onclick="changepass()"><span class="glyphicon glyphicon-send"></span>{{ Language::get('global.lbl_continue') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function changepass() {
        $.ajax({url: 'changepass' , type: 'post', data: {_token:'{{ csrf_token() }}', password:$('#pass').val(), newpass:$('#npass').val(), renewpass:$('#re-npass').val()},
            beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
            success: function (data) {
                toastr[data.status](data.message);
            }
        });
    }
</script>

