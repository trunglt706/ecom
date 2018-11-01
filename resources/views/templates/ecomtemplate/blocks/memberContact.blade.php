<section id="block-member-contact-form">
    <form class="form-horizontal" id="frm-member-contact">
        <div class="form-group">
            <label class="col-md-3 control-label" for="fullname">{{ Language::getCom('emap.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
            <div class="col-md-6">
                <input id="fullname" name="fullname" type="text" required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="address">{{ Language::getCom('emap.lbl_address') }} <sup class="text-danger">(*)</sup></label>
            <div class="col-md-6">
                <textarea id="address" name="address" required rows="3" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="phone">{{ Language::getCom('emap.lbl_phone') }} <sup class="text-danger">(*)</sup></label>
            <div class="col-md-6">
                <input id="phone" name="phone" type="tel" required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="fax">{{ Language::getCom('emap.lbl_fax') }}</label>
            <div class="col-md-6">
                <input id="fax" name="fax" type="tel" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="email">{{ Language::getCom('emap.lbl_email') }} <sup class="text-danger">(*)</sup></label>
            <div class="col-md-6">
                <input id="enail" name="email" type="email" required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="message">{{ Language::getCom('emap.lbl_message') }} <sup class="text-danger">(*)</sup></label>
            <div class="col-md-6">
                <textarea id="message" name="message"  required rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary btn-icon-text waves-effect" type="submit"><i class="zmdi zmdi-check"></i> {{ language::getTemplate('emaptemplate.lbl_send') }}</button>
            <button class="btn btn-default btn-icon-text waves-effect" type="reset"><i class="zmdi zmdi-refresh-alt"></i> {{ Language::getTemplate('emaptemplate.lbl_refresh') }}</button>
        </div>
        <script>
            $('#frm-member-contact').on('submit', function(){
                $.ajax({url: '{{ Path::urlSite("site-emap/member-contact") }}', type: 'post', data:
                    $(this).serialize() + '&_token={{ csrf_token() }}&lang={{ $lang }}&member_id={{ $member_id }}',
                    beforeSend: function(){
                        $('#frm-member-contact button[type="submit"]').prop('disabled', true);
                        $('#frm-member-contact button[type="submit"] i').attr('class', 'zmdi zmdi-hc-spin zmdi-spinner');
                    },complete: function () {
                        $('#frm-member-contact button[type="submit"]').prop('disabled', false);
                        $('#frm-member-contact button[type="submit"] i').attr('class', 'zmdi zmdi-check');
                    },
                    success: function (data) {
                        if(data.status == 'success') $('#frm-member-contact').html(data.message);
                        else toastr[data.status](data.message);
                    }
                });
                return false;
            });
        </script>
    </form>
</section>
