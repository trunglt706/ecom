<?php
    $chat = \Cookie::get('chat');
    if(!isset($chat['dialog'])) $chat['dialog'] = 'close';
?>
<link href="{{ config("data.PATH_ROOT").'public/com/chat/css/chat.css' }}" rel="stylesheet">
<script src="{{ config("data.PATH_ROOT").'public/com/chat/js/emojify.js' }}"></script>
<script src="{{ config("data.PATH_ROOT").'public/com/chat/js/firebase.js' }}"></script>
<section class="chat-dialog clearfix close-dialog {{ isset($chat['dialog'])&& $chat['dialog']=='close' ? 'close-dialog':'' }}" id="chat-dialog">
    <div class="card m-b-0" id="messages-main">
        <div class="ms-body" data-bind="visible: auth().uid == null">
            <div class="lv-header-alt clearfix p-0">
                <div class="btn-toggle-dialog">
                    <span class="zmdi zmdi-comments"></span>
                </div>
                <div class="lvh-label p-t-5">
                    <span>{{ \Language::getCom('chat.lbl_help') }}</span>
                </div>
                <ul class="lv-actions actions">
                    <li class="btn-close-dialog">
                        <a>
                            <i class="zmdi zmdi-close"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <form class="p-15 text-center" id="frm-chat-login">
                <img style="width: 100px" class="img-circle mCS_img_loaded m-b-10" src="{{ Path::urlCom('chat/images/user.jpg') }}">
                <div>{{ Language::getCom('chat.lbl_help_desc') }}</div>
                <div class="form-group m-b-5">
                    <div class="fg-line">
                        <input type="text" class="form-control fc-alt" id="chat-fullname" required placeholder="{{ Language::getCom('system.lbl_fullname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="fg-line">
                        <input type="email" class="form-control fc-alt" id="chat-email" required placeholder="{{ Language::getCom('system.lbl_email') }}">
                    </div>
                </div>
                <button class="btn btn-primary waves-effect" type="submit" id="btn-chat-login">{{ Language::getCom('chat.lbl_quick_start') }}</button>
            </form>
        </div>
        <div class="ms-body" data-bind="visible: auth().uid != null" style="display: none;">
            <div class="listview lv-message" data-bind="if: chat_view() == 'list'">
                <div class="lv-header-alt clearfix p-0">
                    <div class="btn-toggle-dialog">
                        <span class="zmdi zmdi-comments"></span>

                    </div>
                    <div id="ms-menu-trigger" style="display: block; position: relative;" data-bind="attr: {'class': chat_view() == 'list' ? 'open':''}, click: change_view">
                        <div class="line-wrap">
                            <div class="line top"></div>
                            <div class="line center"></div>
                            <div class="line bottom"></div>
                        </div>
                    </div>
                    <div class="lvh-label p-t-5">
                        <span>{{ \Language::getCom('chat.lbl_chat_list_user') }}</span>
                    </div>

                    <ul class="lv-actions actions">
                        <li class="btn-close-dialog">
                            <a>
                                <i class="zmdi zmdi-close"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="listview" style="min-height: 332px;overflow: auto;">
                    <!-- ko foreach: chat_lists -->
                    <!-- ko if: users.length > 0 -->
                    <b class="lv-item" data-bind="html: group_name"></b>
                    <!-- /ko -->
                    <!-- ko foreach: users -->
                        <a class="lv-item" data-bind="click: $root.join_chat_room.bind($data, $rawData)">
                            <div class="media">
                                <div class="pull-left">
                                    <img class="lv-img-sm" src="{{ Path::urlCom('chat/images/user.jpg') }}" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="lv-title" data-bind="html: fullname"></div>
                                    <small class="text-success"><i class="zmdi zmdi-circle"></i> {{ Language::getCom('chat.lbl_online') }}</small>
                                </div>
                            </div>
                        </a>
                    <!-- /ko -->
                    <!-- /ko -->
                </div>
            </div>
            <div class="listview lv-message" data-bind="visible: chat_view() != 'list'">
                <div class="lv-header-alt clearfix p-0">
                    <div class="btn-toggle-dialog">
                        <span class="zmdi zmdi-comments"></span>

                    </div>
                    <div id="ms-menu-trigger" style="display: block; position: relative;" data-bind="attr: {'class': chat_view() == 'list' ? 'open':''}, click: change_view">
                        <div class="line-wrap">
                            <div class="line top"></div>
                            <div class="line center"></div>
                            <div class="line bottom"></div>
                        </div>
                    </div>
                    <div class="lvh-label p-t-5">
                        <span data-bind="html: chat_room().fullname"></span>
                    </div>

                    <ul class="lv-actions actions">
                        <li class="btn-close-dialog">
                            <a>
                                <i class="zmdi zmdi-close"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="lv-body">
                    <!-- ko foreach: chat_messages -->
                        <!-- ko if: uid != '{{ csrf_token() }}' -->
                        <div class="lv-item media p-5">
                        	<div class="lv-avatar pull-left">
                        		<img style="width: 30px; height: 30px;" src="{{ Path::urlCom('chat/images/user.jpg') }}">
                        	</div>
                        	<div class="media-body">
                        		<div class="ms-item" data-bind="html: message"></div>
                        	</div>
                        </div>
                        <!-- /ko -->
                        <!-- ko if: uid == '{{ csrf_token() }}' -->
                        <div class="lv-item media right p-5">
                        	<div class="media-body">
                        		<div class="ms-item" data-bind="html: message"></div>
                        	</div>
                        </div>
                        <!-- /ko -->
                    <!-- /ko -->
                </div>
                <div class="lv-footer ms-reply">
                    <textarea id="chat-message"></textarea>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        emojify.setConfig({img_dir: '{{ Path::urlCom("chat/images/emoji") }}'});
        var is_send = false;
        var sound_send_message = document.createElement('audio');
        sound_send_message.setAttribute('src', '{{ config("data.PATH_ROOT").System::getValue("chat")->sound_send_message }}');
        var sound_new_message = document.createElement('audio');
        sound_new_message.setAttribute('src', '{{ config("data.PATH_ROOT").System::getValue("chat")->sound_new_message }}');
        var sound_user_online = document.createElement('audio');
        sound_user_online.setAttribute('src', '{{ config("data.PATH_ROOT").System::getValue("chat")->sound_user_online }}');


        $('.btn-toggle-dialog').on('click', function(){
            $('.chat-dialog').removeClass('close-dialog');
            dialog_toggle('open');
        });
        $('.btn-close-dialog').on('click', function(){
            $('.chat-dialog').addClass('close-dialog');
            dialog_toggle('close');
        });
        function dialog_toggle(toggle){
            $.ajax({url: "{{ Path::urlSite('chat/dialog-toggle') }}", type: 'post', data: {
                    dialog: toggle,
                    _token: '{{ csrf_token() }}'
                }
            });
        }
    //
        function ChatModel() {
            var self = this;
            self.auth = ko.observable({});
            self.chat_view = ko.observable('{{ isset($chat["room"]) ? "chat":"list" }}');
            self.chat_lists = ko.observableArray([]);
            self.chat_room = ko.observable(JSON.parse('<?php echo isset($chat["room"]) ? json_encode($chat["room"]):"{}" ?>'));
            self.chat_messages = ko.observableArray([]);

            self.change_view = function(){
                if(self.chat_view() == 'list') self.chat_view('chat');
                else self.chat_view('list');
            };

            self.join_chat_room = function(item){
                var room = {
                    uid: item.user_id + '_' + self.auth().uid,
                    user_id: item.user_id,
                    fullname: item.fullname
                };
                self.chat_room(room);
                self.chat_view('chat');
                rootRef.child("chat/rooms").once('value', function(snap) {
                    if(snap.child(self.chat_room().uid+'/messages').exists()){
                        var messages = [];
                        snap.child(self.chat_room().uid+'/messages').forEach(function(message) {
                            messages.push(message.val());
                        });
                        self.chat_messages(messages);
                        emojify.run(document.getElementById('chat-dialog'));
                        $('.chat-dialog .lv-body').scrollTop($('.chat-dialog .lv-body')[0].scrollHeight);
                    }
                });
                $.post("{{ Path::urlSite('chat/join-chat-room') }}", {
                    room: {
                        uid: item.user_id + '_' + self.auth().uid,
                        user_id: item.user_id,
                        fullname: item.fullname
                    },
                    _token: '{{ csrf_token() }}'
                });
            };
        }
        var chatMode = new ChatModel();
        ko.applyBindings(chatMode, document.getElementById('chat-dialog'));
        // =================================================================
        // realtime notify
        var rootRef = new Firebase("{{ env('FIREBASE_APP') }}"),
            notifyRef = rootRef.child("chat/notify/global"),
            cusRef = rootRef.child('chat/customer_online/{{ csrf_token() }}'),
            groupRef = rootRef.child("chat/groups");
        rootRef.authAnonymously();

        // =================================================================
        $('#frm-chat-login').on('submit', function() {
            chatMode.auth({
                uid: '{{ csrf_token() }}',
                fullname: $('#chat-fullname').val(),
                email: $('#chat-email').val(),
                timestamp: Firebase.ServerValue.TIMESTAMP
            });
            cusRef.set(chatMode.auth());
            rootRef.child('chat/customers/{{ csrf_token() }}').set(chatMode.auth());
            return false;
        });
        $('#chat-message').keypress(function(e){
            if (chatMode.chat_room().uid != null && e.keyCode == 13 && !e.shiftKey && $('#chat-message').val()!='' ){
                sound_send_message.play();
               rootRef.child("chat/rooms/" + chatMode.chat_room().uid+'/messages').push({
                   uid: chatMode.auth().uid,
                   message: $('#chat-message').val(),
                   fullname: chatMode.auth().fullname,
                   timestamp: Firebase.ServerValue.TIMESTAMP
               });
               rootRef.child('chat/customer_online/{{ csrf_token() }}').update({
                   timestamp: Firebase.ServerValue.TIMESTAMP
               });
               $('#chat-message').val("");
           }
       });
        rootRef.child('chat/customers/{{ csrf_token() }}').once('value', function(snap) {
            if(snap.exists()){
                chatMode.auth(snap.val());
                cusRef.set(chatMode.auth());
            }
        });
        groupRef.on('value', function(snap){
            var groups = [];
            snap.forEach(function(chi) {
                var users = [];
                if(chi.child('users').exists()){
                    chi.child('users').forEach(function(usr) {
                        users.push(usr.val());
                    });
                }
                var grp = chi.val();
                grp.users = users;
                groups.push(grp);
            });
            chatMode.chat_lists(groups);
        });
        rootRef.child("chat/rooms").on('value', function(snap) {
            if(snap.child(chatMode.chat_room().uid+'/messages').exists()){
                var messages = [];
                snap.child(chatMode.chat_room().uid+'/messages').forEach(function(message) {
                    messages.push(message.val());
                });
                chatMode.chat_messages(messages);
                emojify.run(document.getElementById('chat-dialog'));
                $('.chat-dialog .lv-body').scrollTop($('.chat-dialog .lv-body')[0].scrollHeight);
            }
        });
        cusRef.onDisconnect().remove();
    });
</script>
