<?php
    $akey = App\Com\FileManager\FileManager::getSecretKey();
    $filemanager_path = 'filemanager?akey='.$akey;
?>

<link href="{{ Path::urlCom('member/css/admin.member.css') }}" rel="stylesheet">
<div>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            <div class="row">
                <div class="col-md-4">
                    <legend>{{ \Language::getCom('system.lbl_group_info_member_certificate_type') }}</legend>
                    <div class="form-group">
                        <label for="member_certificate_type_name" class="control-label">{{ \Language::getCom('member.lbl_member_certificate_type_name') }} <sup class="text-danger">(*)</sup></label>
                        <input type="text" class="form-control" name="member_certificate_type_name" id="member_certificate_type_name" data-bind="value: current().member_certificate_type_name" required>
                    </div>
                    <div class="form-group">
                        <label for="member_certificate_type_note" class="control-label">{{ \Language::getCom('member.lbl_member_certificate_type_note') }} </label>
                        <input type="text" class="form-control" name="member_certificate_type_note" id="member_certificate_type_note" data-bind="value: current().member_certificate_type_note">
                    </div>
                    <div class="form-group">
                        <label for="logo" class="control-label">{{ \Language::getCom('member.lbl_member_certificate_type_logo') }}</label>
                        <a class="thumbnail thumbnail-img" style="width:150px; height: 150px;" onclick="javascript:open_popup('{{ $filemanager_path.'&backgroundID=logo' }}')">
                            <div class="thumbnail-img" id="logo" data-bind="attr:{'style':current().logo!=null? 'background-image: url('+current().logo+');' : 'background-image:none;'}"></div>
                        </a>
                    </div>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="required" value="1" data-bind="attr:{'checked': current().required == '1'} "> {{ \Language::getCom('system.lbl_default_render') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
        </div>
    </div>
</div>

@section('incUpd')
    $('#logo').css('background-logo', 'url('+self.current().logo+')');
@endsection

@section('incSave')
    var bg = $('#logo').css('background-image');
    self.current().logo = bg.substr(bg.indexOf('{{ config("data.UPLOAD_DIR") }}')).replace('\"\)', '');
    self.current().required = $('input[name="required"]:checked').val() != null ? $('input[name="required"]:checked').val() : 0;
@endsection
