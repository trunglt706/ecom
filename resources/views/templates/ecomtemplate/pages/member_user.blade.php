@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.member'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo $data['member']->member_name; ?>
@endsection

@section('section')
    <section class="ec" id="member_user">
        <div class="container" style="margin-bottom: 50px; margin-top: 20px;">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                <li><a href="{{ $data['menus']->member }}">{{ $data['menus']->member_name }}</a></li>
                <li><a href="{{ $data['member']->url }}">{{ $data['member']->member_name }}</a></li>
                <li><a href="dashboard">{{ \Language::getTemplate('ecomtemplate.lbl_dashboard') }}</a></li>
                <li class="active">{{ \Language::getTemplate('ecomtemplate.lbl_user_manager') }}</li>
            </ol>
            @include(Path::viewCurrentTemplate($data['page']->lang, 'forms.member_user'))
        </div>
    </section>
    <script>
        function UserModel() {
            var self = this;
            self.userView = ko.observable('lst');
            self.users = ko.observableArray([]);
            self.user = ko.observable({});
            self.saveUser = function () {
                if (!$('#frmEdit').valid()) {
                    toastr['error']('{{ \Language::getTemplate('ecomtemplate.message_register_input_error') }}');
                    return false;
                }
                self.user().active = $('#active').is(':checked') ? 1 : 0;
                var data = self.user();
                data['_token'] = '{{ csrf_token() }}';
                data['member_tin'] = '{{ $data['member']->member_tin }}';
                $.ajax({url: '{{ Path::urlSite('ecom/save-users') }}', type: 'post', data: data,
                    success: function (data) {
                        toastr[data.status](data.message);
                        self.userView('lst');
                        self.fetch();
                    }
                });
            };
            self.addUser = function() {
                @if ($data['is_gold'])
                self.userView('frm');
                self.user({
                    fullname: '',
                    address: '',
                    email: '',
                    phone: '',
                    username: '',
                    active: 1,
                    note: ''
                });
                $('#active').prop('checked', true);
                @else
                toastr['warning']('{{ \Language::getTemplate('ecomtemplate.msg_only_gold_member') }}');
                @endif
            };
            self.editUser = function(item) {
                self.userView('frm');
                self.user(item);
                $('#active').prop('checked', self.user().active == 1 ? true : false);
            };
            self.cancelUser = function () {
                self.userView('lst');
                self.user({});
            };
            self.delUser = function(item) {

            };
            self.fetch = function () {
                $.ajax({url: '{{ Path::urlSite('ecom/member-users') }}', type: 'post', data: { _token: '{{ csrf_token() }}', member_tin: '{{ $data['member']->member_tin }}', lang: '{{ $data['page']->lang }}' },
                    success: function (data) {
                        self.users(data);
                    }
                });
            };
            ko.computed(self.fetch);
        }
        var userModel = new UserModel();
        ko.applyBindings(userModel, document.getElementById('member_user'));
    </script>
@endsection
