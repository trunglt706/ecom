<style>
    .btn-close-corner{
        position: absolute;
        background-color: #ddd;
        padding: 1px 9px;
        border-radius: 0px 0px 15px 0px;
        width: 30px;
        height: 30px;
        font-size: 1.5em;
        box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.42);
        margin: -4px;
        display: none;
    }
    .thumbnail{
        cursor: pointer;
    }
    .thumbnail:hover .btn-close-corner{
        display: block;
    }
</style>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <legend>{{ \Language::getCom('chat.lbl_chat_group_info') }}</legend>
                <div class="form-group">
                    <label for="group_name" class="control-label">{{ Language::getCom('chat.lbl_group_name') }} <sup class="text-danger">(*)</sup></label>
                    <input type="text" class="form-control" name="group_name" id="group_name" data-bind="value: current().group_name" required maxlength="50">
                </div>
                <div class="form-group">
                    <label for="note" class="control-label">{{ Language::getCom('chat.lbl_note') }}</label>
                    <textarea type="text" class="form-control" name="note" id="note" rows="5" data-bind="value: current().note" ></textarea>
                </div>
                <legend>{{ \Language::get('global.lbl_option') }}</legend>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="active" value="1" data-bind="attr:{'checked': current().active == '1'} "> {{ \Language::getCom('system.lbl_active') }}
                    </label>
                </div>
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
            </div>
            <div class="col-md-8">
                <legend>{{ \Language::getCom('chat.lbl_chat_list_user') }}</legend>
                <div class="form-group">
                    <label class="control-label">{{ \Language::getCom('chat.lbl_add_chat_user') }}</label>
                    <select class="select2" id="add_chat_user">
                        @foreach( App\Com\Chat\ChatGroup::get_all_user() as $user)
                        <option value="{{ $user->id }}" data-fullname="{{ $user->fullname }}" data-group="{{ $user->group_name }}"><?php echo $user->fullname .' ('. $user->group_name. ')'; ?></option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="loading-container wrap-scroll" style="height: 600px;">
                        <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
                        <div class="row">
                            <!--ko foreach: users-->
                            <div class="col-xs-2">
                                <div class="thumbnail">
                                    <div class="btn-close-corner" data-bind="click: $parent.delUser.bind($data, $rawData)"><span aria-hidden="true">&times;</span></div>
                                    <img src="{{ Path::urlCom('chat/images/user.jpg') }}">
                                    <div class="caption text-center">
                                        <b><small data-bind="html: fullname"></small></b><br>
                                        <small data-bind="html: group_name"></small>
                                    </div>
                                </div>
                            </div>
                            <!-- /ko -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var users = ko.observableArray([]);
    function fetchUser(id){
        $.ajax({url: '{{ $uri }}/user', type: 'post', data: {_token: '{{ csrf_token() }}', id: id},
            beforeSend: showLoading , error: errorConnect, complete: hideLoading ,
            success: function (data) {
                users(data);
            }
        });
    }
    $('#add_chat_user').on('change', function(){
        var id = $(this).val();
        var user = {
            id: null,
            user_id: id,
            fullname: $('#add_chat_user option[value="'+id+'"]').attr('data-fullname'),
            group_name: $('#add_chat_user option[value="'+id+'"]').attr('data-group')
        };
        users.remove(function(item) {
            return item.user_id == id;
        });
        users.push(user);
    });
</script>

@section('incAdd')
    fetchUser();
@endsection

@section('incUpd')
    fetchUser(self.current().id);
@endsection

@section('incSave')
    self.current().active = $('input[name="active"]:checked').val();
    self.current().users = JSON.stringify(users());
@endsection

@section('incFun')
    self.delUser = function(user){
        users.remove(user);
    };
@endsection
