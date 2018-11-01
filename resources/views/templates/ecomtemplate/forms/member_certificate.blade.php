<?php
    $akey = App\Com\FileManager\FileManager::getSecretKey();
    $filemanager_path = 'filemanager?akey='.$akey;
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="member_certificate_type_id" class="control-label">{{ \Language::getCom('member.lbl_member_certificate_type_id_render') }} <sup class="text-danger">(*)</sup></label>
                    <select class="selectpicker" id="member_certificate_type_id" name="member_certificate_type_id" required>
                        @foreach (\DB::table('member_certificate_types')->select('id', 'member_certificate_type_name')->get() as $cert)
                        <option value="{{ $cert->id }}">{{ $cert->member_certificate_type_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="member_certificate_name">{{ Language::getCom('member.lbl_member_certificate_name') }} <sup class="text-danger">(*)</sup></label>
                    <input id="member_certificate_name" name="member_certificate_name" type="text" data-bind="value: current().member_certificate_name " placeholder="{{ Language::getCom('member.lbl_member_certificate_name') }}" class="form-control fc-alt" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="member_certificate_certified_by">{{ Language::getCom('member.lbl_member_certificate_certified_by') }}</label>
                    <input id="member_certificate_certified_by" name="member_certificate_certified_by" type="text" data-bind="value: current().member_certificate_certified_by " placeholder="{{ Language::getCom('member.lbl_member_certificate_certified_by') }}" class="form-control fc-alt">
                </div>
                <div class="form-group">
                    <label class="control-label" for="member_certificate_certified_at">{{ Language::getCom('member.lbl_member_certificate_certified_at') }}</label>
                    <input id="member_certificate_certified_at" name="member_certificate_certified_at" type="text" data-bind="value: current().member_certificate_certified_at " placeholder="{{ Language::getCom('member.lbl_member_certificate_certified_at') }}" class="form-control fc-alt">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="member_certificate_content">{{ Language::getCom('member.lbl_member_certificate_content') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="member_certificate_content" name="member_certificate_content" readonly data-bind="value: current().content">
                        <span class="input-group-addon btn btn-default">
                            <div onclick="javascript:open_popup('{{ Path::urlSite($filemanager_path).'&fieldID=member_certificate_content' }}')" >
                                {{ \Language::get('global.lbl_choose') }}
                            </div>
                        </span>
                        <div class="input-group-addon btn btn-default" onclick="$('#member_certificate_content').val('')">
                            <i class="glyphicon glyphicon-remove"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
@if( file_exists(config('data.PATH_MODEL').'/CKEditor/') )
$('#content').each(function(index, el) {
    @if( file_exists(config('data.PATH_MODEL').'/FileManager/') )
        <?php
            $akey = App\Com\FileManager\FileManager::getSecretKey();
            $filemanager_path = Path::urlSite('filemanager?akey='.$akey);
        ?>
        CKEDITOR.replace( this ,{
            filebrowserBrowseUrl : '{{ $filemanager_path }}',
            filebrowserUploadUrl : '{{ $filemanager_path }}',
            filebrowserImageBrowseUrl : '{{ $filemanager_path }}'
        });
    @else
        CKEDITOR.replace( this );
    @endif
});
@endif
</script>

@section('incAdd')
    self.current().member_id = {{ $data['member']->id }};
@endsection

@section('incUpd')
    $('#member_certificate_type_id').selectpicker('val', self.current().member_certificate_type_id);
@endsection

@section('incSave')
    self.current().content = $('#member_certificate_content').val();
    self.current().lang = '{{ $data['page']->lang }}';
    self.current().member_certificate_type_id = $('#member_certificate_type_id').val();
@endsection

@section('incFun')

@endsection
