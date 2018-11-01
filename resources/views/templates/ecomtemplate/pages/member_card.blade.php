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
    <section class="ec" id="member_card">
        <div class="container" style="margin-bottom: 50px; margin-top: 20px;">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                <li><a href="{{ $data['menus']->member }}">{{ $data['menus']->member_name }}</a></li>
                <li><a href="{{ $data['member']->url }}">{{ $data['member']->member_name }}</a></li>
                <li><a href="dashboard">{{ \Language::getTemplate('ecomtemplate.lbl_dashboard') }}</a></li>
                <li class="active">{{ \Language::getTemplate('ecomtemplate.lbl_card_manager') }}</li>
            </ol>
            @include(Path::viewCurrentTemplate($data['page']->lang, 'forms.member_card'))
        </div>
    </section>
    <script type="text/javascript">
        function CardModel() {
            var self = this;
            self.cardView = ko.observable('lst');
            self.cards = ko.observableArray([]);
            self.card = ko.observable({});
            self.saveCard = function () {
                if (!$('#frmEdit').valid()) {
                    toastr['error']('{{ \Language::getTemplate('ecomtemplate.message_register_input_error') }}');
                    return false;
                }
                self.card().current = $('#current').is(':checked') ? 1 : 0;
                var data = self.card();
                data['_token'] = '{{ csrf_token() }}';
                data['member_id'] = '{{ $data['member']->id }}';
                $.ajax({url: '{{ Path::urlSite('ecom/save-card') }}', type: 'post', data: data,
                    success: function (data) {
                        toastr[data.status](data.message);
                        self.cardView('lst');
                        self.fetch();
                    }
                });
            };
            self.addCard = function() {
                self.cardView('frm');
                self.card({
                    fullname: '',
                    position: '',
                    department: '',
                    email: '',
                    phone: '',
                    note: '',
                    current: 0
                });
                $('#current').prop('checked', self.card().current == 1 ? true : false);
            };
            self.editCard = function(item) {
                self.cardView('frm');
                self.card(item);
                $('#current').prop('checked', self.card().current == 1 ? true : false);
            };
            self.cancelCard = function () {
                self.cardView('lst');
                self.card({});
            };
            self.delCard = function(item) {

            };
            self.fetch = function () {
                $.ajax({url: '{{ Path::urlSite('ecom/member-cards') }}', type: 'post', data: { _token: '{{ csrf_token() }}', member_id: '{{ $data['member']->id }}' },
                    success: function (data) {
                        self.cards(data);
                    }
                });
            };
            ko.computed(self.fetch);
        }
        var cardModel = new CardModel();
        ko.applyBindings(cardModel, document.getElementById('member_card'));
    </script>
@endsection
