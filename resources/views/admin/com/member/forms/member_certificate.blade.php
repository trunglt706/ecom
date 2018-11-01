<?php
    $akey = App\Com\FileManager\FileManager::getSecretKey();
    $filemanager_path = 'filemanager?akey='.$akey; 
?>

<link href="{{ Path::urlCom('member/css/admin.member.css') }}" rel="stylesheet">
<div>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            <div class=""row>
                <div class="row-md-12">
                    <legend>{{ \Language::getCom('system.lbl_group_member_certificate') }}</legend>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="member_certificate_name" class="control-label">{{ \Language::getCom('member.lbl_member_certificate_name') }} <sup class="text-danger">(*)</sup></label>
                        <input type="text" class="form-control" name="member_certificate_name" id="member_certificate_name" data-bind="value: current().member_certificate_name" required>
                    </div>
                    <div class="form-group">
                        <label for="member_certificate_type_id" class="control-label">{{ \Language::getCom('member.lbl_member_certificate_type_id_render') }} <sup class="text-danger">(*)</sup></label>
                        <select class="select2" id="member_certificate_type_id" name="member_certificate_type_id" required data-url="{{ url($uri) }}/certificates"></select>
                    </div>
                    <div class="form-group">
                        <label for="content" class="control-label">{{ Language::getCom('member.lbl_certifiate_content') }} <sup class="text-danger">(*)</sup></label>
                        <div class="input-group">
                            <div class="input-group-addon btn btn-default" onclick="javascript:open_popup($('#content').val())">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </div>
                            <input type="text" class="form-control" id="content" name="content" readonly data-bind="value: current().content">
                            <div class="input-group-addon btn btn-default" onclick="javascript:delImg('content')">
                                <i class="glyphicon glyphicon-remove"></i>
                            </div>
                            <span class="input-group-addon btn btn-default">
                                <div onclick="javascript:open_popup('{{ $filemanager_path.'&fieldID=content' }}')" >
                                    {{ \Language::get('global.lbl_choose') }}
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="member_certificate_certified_by" class="control-label">{{ \Language::getCom('member.lbl_member_certificate_certified_by') }}</label>
                        <input type="text" class="form-control" name="member_certificate_certified_by" id="member_certificate_certified_by" data-bind="value: current().member_certificate_certified_by">
                    </div>
                    <div class="form-group">
                        <label for="member_certificate_certified_at" class="control-label">{{ \Language::getCom('member.lbl_member_certificate_certified_at') }}</label>
                        <div class='input-group date' id='certified_at'>
                            <input type='text' class="form-control" id='member_certificate_certified_at' name="member_certificate_certified_at"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar">
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="member_id" class="control-label">{{ \Language::getCom('member.lbl_member_id_render') }} <sup class="text-danger">(*)</sup></label>
                        <select class="select2" id="member_id" name="member_id" required data-url="{{ url($uri) }}/members"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label for="note" class="control-label">{{ \Language::getCom('member.lbl_note') }} </label>
                        <textarea class="ckeditor" name="note" id="note" rows="10" cols="80"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#certified_at').datetimepicker({
            viewMode: 'years',
            format: 'YYYY/MM/DD'
        });
    });
</script>

@section('incAdd')
    $('#member_id').select2('val', '');
    $('#member_certificate_type_id').select2('val', '');
    $('#member_certificate_certified_at').val('');
    CKEDITOR.instances.note.setData('');
@endsection

@section('incUpd')
    $('#member_id').select2('val', self.current().member_id);
    $('#member_certificate_type_id').select2('val', self.current().member_certificate_type_id);
    $('#member_certificate_certified_at').val(self.current().member_certificate_certified_at);
    CKEDITOR.instances.note.setData(self.current().note);
@endsection

@section('incSave')
    self.current().note = CKEDITOR.instances.note.getData();
    self.current().member_id = $('#member_id').val();
    self.current().member_certificate_type_id = $('#member_certificate_type_id').val();
    self.current().member_certificate_certified_at = $('#member_certificate_certified_at').val();
    self.current().content = $('#content').val();
@endsection

@section('incFun')
    
@endsection