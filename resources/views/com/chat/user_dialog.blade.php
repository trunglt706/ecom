<?php
    $chat = \Cookie::get('chat');
    $chat_group_id = \DB::table('chat_users')->where('user_id', \Auth::user()->id)->value('chat_group_id');
?>
<link href="{{ config("data.PATH_ROOT").'public/com/chat/css/chat.css' }}" rel="stylesheet">
<script src="{{ config("data.PATH_ROOT").'public/com/chat/js/emojify.js' }}"></script>
<script src="{{ config("data.PATH_ROOT").'public/com/chat/js/firebase.js' }}"></script>
<section class="chat-dialog clearfix {{ isset($chat['dialog'])&& $chat['dialog']=='close' ? 'close-dialog':'' }}" id="chat-dialog">
    <div class="card m-b-0" id="messages-main">
        <div class="ms-body">
            <div class="listview lv-message" data-bind="visible: chat_view() == 'list'" style="display: none;">
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
                        <span>{{ \Language::getCom('chat.lbl_chat_list_customer') }}</span>
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
                        <a class="lv-item" data-bind="click: $root.join_chat_room.bind($data, $rawData)">
                            <div class="media">
                                <div class="pull-left">
                                    <img class="lv-img-sm" src="{{ Path::urlCom('chat/images/customer.jpg') }}" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="lv-title" data-bind="html: fullname"></div>
                                    <small class="text-success" data-bind="if: online === 1"><i class="zmdi zmdi-circle"></i> {{ Language::getCom('chat.lbl_online') }}</small>
                                    <small class="text-danger" data-bind="if: online === 0"><i class="zmdi zmdi-circle"></i> {{ Language::getCom('chat.lbl_offline') }}</small>
                                </div>
                            </div>
                        </a>
                    <!-- /ko -->
                </div>
            </div>
            <div class="listview lv-message" data-bind="visible: chat_view() !== 'list'" style="display: none;">
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
                        <!-- ko if: uid != '{{ Auth::user()->id }}' -->
                        <div class="lv-item media p-5">
                        	<div class="lv-avatar pull-left">
                        		<img style="width: 30px; height: 30px;" src="{{ Path::urlCom('chat/images/customer.jpg') }}">
                        	</div>
                        	<div class="media-body">
                        		<div class="ms-item" data-bind="html: message"></div>
                        	</div>
                        </div>
                        <!-- /ko -->
                        <!-- ko if: uid == '{{ Auth::user()->id }}' -->
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
                    uid: '{{ Auth::user()->id }}' + '_' + item.uid,
                    user_id: item.uid,
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
                        uid: '{{ Auth::user()->id }}' + '_' + item.uid,
                        user_id: item.uid,
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
            customersRef = rootRef.child("chat/customer_online");
        rootRef.authAnonymously();
        rootRef.onAuth(function(authData) {
          if (authData) {
              rootRef.child("chat/groups/{{ md5($chat_group_id) }}/users/{{ md5(\Auth::user()->id) }}").set({
                  fullname: '{{ Auth::user()->fullname }}',
                  user_id: '{{ Auth::user()->id }}',
                  timestamp: Firebase.ServerValue.TIMESTAMP
              });
          } else {
              rootRef.child("chat/groups/{{ md5($chat_group_id) }}/users/{{ md5(\Auth::user()->id) }}").onDisconnect().remove();
          }
        });
        // =================================================================
        $('#chat-message').keypress(function(e){
            if (chatMode.chat_room().uid != null && e.keyCode == 13 && !e.shiftKey && $('#chat-message').val()!='' ){
                sound_send_message.play();
               rootRef.child("chat/rooms/" + chatMode.chat_room().uid+'/messages').push({
                   uid: '{{ Auth::user()->id }}',
                   message: $('#chat-message').val(),
                   fullname: '{{ Auth::user()->fullname }}',
                   timestamp: Firebase.ServerValue.TIMESTAMP
               });
               $('#chat-message').val("");
           }
       });
        customersRef.on('value', function(snap){
            rootRef.child('chat/customers').orderByValue().once('value', function(snap_cus){
                snap_cus.forEach(function(cus){
                    var customer = cus.val();
                    rootRef.child('chat/rooms/{{ Auth::user()->id }}_' + customer.uid).once('value', function(chk_room){
                        if(chk_room.exists()){
                            customer.room_id = '{{ Auth::user()->id }}_' + customer.uid;
                            customer.online = 0;
                            rootRef.child('chat/customer_online/'+customer.uid).once('value', function(online){
                                if(online.exists()){
                                    customer.online = 1;
                                }
                            });
                            chatMode.chat_lists.push(customer);
                        }
                    });
                });
            });
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

        rootRef.child("chat/groups/{{ md5($chat_group_id) }}/users/{{ md5(\Auth::user()->id) }}").onDisconnect().remove();
    });
</script>
