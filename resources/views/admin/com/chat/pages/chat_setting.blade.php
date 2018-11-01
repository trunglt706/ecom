<?php
    $akey = App\Com\FileManager\FileManager::getSecretKey();
    $filemanager_path = 'filemanager?akey='.$akey;
?>

<!-- toolbar-->
<nav class="navbar navbar-default app-comm">
    <div class="container-fluid">
        <div class="navbar-form pull-right navbar-right">
            <button type="button" class="btn btn-primary" data-bind="click: doSave"><span class="glyphicon glyphicon-floppy-disk"></span> {{ Language::get('global.lbl_save') }}</button>
        </div>
    </div>
</nav><!-- /toolbar-->
<div class="container-fluid" style="margin-bottom: 50px;">
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <legend>{{ Language::getCom('chat.lbl_chat_time') }}</legend>
                        <div class="form-group">
                            <label for="start_time" class="control-label">{{ Language::getCom('chat.lbl_start_time') }} <sup class="text-danger">(*)</sup></label>
                            <input type="time" class="form-control" name="start_time" id="start_time" data-bind="value: chat().start_time">
                        </div>
                        <div class="form-group">
                            <label for="end_time" class="control-label">{{ Language::getCom('chat.lbl_end_time') }} <sup class="text-danger">(*)</sup></label>
                            <input type="time" class="form-control" name="end_time" id="end_time" data-bind="value: chat().end_time">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <legend>{{ Language::getCom('chat.lbl_chat_sound') }}</legend>
                        <div class="form-group">
                            <label for="sound_user_online" class="control-label">{{ Language::getCom('chat.lbl_sound_user_online') }} <sup class="text-danger">(*)</sup></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sound_user_online" name="sound_user_online" readonly data-bind="value: chat().sound_user_online">
                                <div class="input-group-addon btn btn-default" onclick="javascript:delImg('sound_user_online')">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </div>
                                <span class="input-group-addon btn btn-default">
                                    <div onclick="javascript:open_popup('{{ $filemanager_path.'&fieldID=sound_user_online' }}')" >
                                        {{ \Language::get('global.lbl_choose') }}
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sound_new_message" class="control-label">{{ Language::getCom('chat.lbl_sound_new_message') }} <sup class="text-danger">(*)</sup></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sound_new_message" name="sound_new_message" readonly data-bind="value: chat().sound_new_message">
                                <div class="input-group-addon btn btn-default" onclick="javascript:delImg('sound_new_message')">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </div>
                                <span class="input-group-addon btn btn-default">
                                    <div onclick="javascript:open_popup('{{ $filemanager_path.'&fieldID=sound_new_message' }}')" >
                                        {{ \Language::get('global.lbl_choose') }}
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sound_send_message" class="control-label">{{ Language::getCom('chat.lbl_sound_send_message') }} <sup class="text-danger">(*)</sup></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sound_send_message" name="sound_send_message" readonly data-bind="value: chat().sound_send_message">
                                <div class="input-group-addon btn btn-default" onclick="javascript:delImg('sound_send_message')">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </div>
                                <span class="input-group-addon btn btn-default">
                                    <div onclick="javascript:open_popup('{{ $filemanager_path.'&fieldID=sound_send_message' }}')" >
                                        {{ \Language::get('global.lbl_choose') }}
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ Path::urlCom('chat/images/chat-icon.png') }}" width="70%">
                    </div>

                </div>
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
            </div>
        </div>
    </div>
</div>

<script>
    function ViewModel() {
        var self = this;
        self.chat = ko.observable(
            JSON.parse('<?php echo json_encode(\System::getValue("chat")); ?>')
        );

        self.doSave = function(){
            self.chat().sound_user_online = $('#sound_user_online').val();
            self.chat().sound_new_message = $('#sound_new_message').val();
            self.chat().sound_send_message = $('#sound_send_message').val();
            $.ajax({url: '{{ $uri }}/update', type: 'post', data: {
                    _token: '{{ csrf_token() }}',
                    chat: JSON.stringify(self.chat())
                },
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
