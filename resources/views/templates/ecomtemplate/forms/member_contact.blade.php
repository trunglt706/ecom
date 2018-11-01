<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="fullname">{{ Language::getCom('contact.lbl_fullname') }}</label>
                    <input id="fullname" name="fullname" type="text" data-bind="value: current().fullname " placeholder="{{ Language::getCom('contact.lbl_fullname') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label" for="address">{{ Language::getCom('contact.lbl_address') }}</label>
                    <textarea id="address" name="address" data-bind="value: current().address " placeholder="{{ Language::getCom('contact.lbl_address') }}" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label" for="phone">{{ Language::getCom('contact.lbl_phone') }}</label>
                    <input id="phone" name="phone" type="tel" data-bind="value: current().phone " placeholder="{{ Language::getCom('contact.lbl_phone') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label" for="email">{{ Language::getCom('contact.lbl_email') }}</label>
                    <input id="email" name="email" type="email" data-bind="value: current().email " placeholder="{{ Language::getCom('contact.lbl_email') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label" for="message">{{ Language::getCom('contact.lbl_message') }}</label>
                    <textarea id="message" name="message" data-bind="value: current().note " placeholder="{{ Language::getCom('contact.lbl_message') }}" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Large modal -->
                <div class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-envelope"></span> {{ Language::get('global.lbl_feedback') }}</div>

                <div id="modFeedback" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h1>{{ Language::get('global.lbl_feedback') }}</h1>
                            <div class="form-group">
                                <label class="control-label" for="email">{{ Language::get('global.lbl_to') }}</label>
                                <input id="email" name="email" type="email" data-bind="value: current().email" placeholder="{{ Language::getCom('contact.lbl_email') }}" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="subject">{{ Language::get('global.lbl_subject') }}</label>
                                <input id="subject" name="subject" type="subject" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="content">{{ Language::get('global.lbl_content') }}</label>
                                <textarea id="content" name="content" placeholder="{{ Language::getCom('contact.lbl_message') }}" required rows="7" class="ckeditor"></textarea>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> {{ Language::get('global.lbl_cancel') }}</button>
                                <button type="button" class="btn btn-primary" data-bind="click: send"><span class="glyphicon glyphicon-send"></span> {{ Language::get('global.lbl_send') }}</button>
                            </div>
                        </div>
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

@section('incSave')
    toastr['warning']('{{ \Language::getTemplate('ecomtemplate.message_not_permission') }}');
    return false;
@endsection
@section('incFun')
    self.send = function() {
        $.ajax({url: '{{ Path::urlSite('ecom') }}/send-mail' , type: 'post', data: {
                _token: '{{ csrf_token() }}',
                to: $('#email').val(),
                subject: $('#subject').val(),
                message: CKEDITOR.instances.content.getData(),
                id: self.current().id
            }, beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
            success: function (data) {
                toastr[data.status](data.message);
                if (data.status == 'success') {
                    $('#modFeedback').modal('hide');
                }
            }
        });
    };
@endsection
