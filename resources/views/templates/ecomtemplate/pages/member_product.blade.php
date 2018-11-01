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
    <?php
        $akey = App\Com\FileManager\FileManager::getSecretKey();
        $filemanager_path = 'filemanager?akey='.$akey;
    ?>
    <section class="ec" id="member_product">
        <div class="container" style="margin-bottom: 50px; margin-top: 20px;">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                <li><a href="{{ $data['menus']->member }}">{{ $data['menus']->member_name }}</a></li>
                <li><a href="{{ $data['member']->url }}">{{ $data['member']->member_name }}</a></li>
                <li><a href="dashboard">{{ \Language::getTemplate('ecomtemplate.lbl_dashboard') }}</a></li>
                <li class="active">{{ \Language::getTemplate('ecomtemplate.lbl_product_manager') }}</li>
            </ol>
            @include(Path::viewCurrentTemplate($data['page']->lang, 'forms.member_product'))
        </div>

        <!--cfmDel-->
        <div class="modal" id="cfmDel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmDel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-delete">
                    <div class="modal-body">
                        <h3>{{ \Language::get('global.lbl_delete_question') }}</h3><br>
                        <button class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> {{ \Language::get('global.lbl_cancel') }}</button>
                        <button class="btn btn-danger" data-dismiss="modal" data-bind="click: doDel"><i class="glyphicon glyphicon-trash"></i> {{ \Language::get('global.lbl_delete') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function open_popup(url){
            var w = 880;
            var h = 570;
            var l = Math.floor((screen.width-w)/2);
            var t = Math.floor((screen.height-h)/2);
            var win = window.open(url, '', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
            var tmp = $('#product_avatar').css('background-image');
            var current = tmp.substr(tmp.indexOf($('#product_avatar_hidden').val())).replace('\"\)', '');
            win.onunload = function () {
                var tmp = $('#product_avatar').css('background-image');
                var newlogo = tmp.substr(tmp.indexOf($('#product_avatar_hidden').val())).replace('\"\)', '');
               if (current != newlogo) {
                   var new_tmp = $('#product_avatar').css('background-image');
                   var logo = tmp.substr(tmp.indexOf('{{ config("data.PATH_ROOT").config("data.UPLOAD_DIR") }}')).replace('\"\)', '');
                   $('#product_avatar_hidden').val(logo);
               }
            }
        }

        $('.selectpicker').selectpicker({width: '100%', style: 'btn-info'});

        $('#product_avatar').click(function () {
            open_popup('{{ Path::urlSite($filemanager_path) }}' + '&backgroundID=product_avatar');
        });

        function ProductModel() {
            var self = this;
            self.productView = ko.observable('lst');
            self.products = ko.observableArray([]);
            self.product = ko.observable({});
            self.search = ko.observable('');
            self.is_fetch = ko.observable(false);
            // self.prices = ko.observableArray([]);
            self.saveProduct = function () {
                if (!$('#frmEdit').valid() || $('#category_id').val() == null) {
                    toastr['error']('{{ \Language::getTemplate('ecomtemplate.message_register_input_error') }}');
                    return false;
                }
                self.product().public = $('#public').is(':checked') ? 1:0;
                self.product().stocking = $('#stocking').is(':checked') ? 1:0;
//                self.product().featured = $('#featured').is(':checked') ? 1:0;
                self.product().new = $('#new').is(':checked') ? 1:0;
                self.product().lang = '{{ $data['page']->lang }}';
                var bg = $('#product_avatar').css('background-image');
                self.product().media = bg.substr(bg.indexOf('{{ config("data.UPLOAD_DIR") }}')).replace('\"\)', '');
//                self.product().media = $('#product_avatar_hidden').val();
                self.product().category_id = $('#category_id').val();
                self.product().certs = JSON.stringify($('#certs').val());
                if ($('#product_custom_field').val() != null)
                    self.product().productInfo = viewModelProductInfo.getDataInfo();
                var data = self.product();
                data['_token'] = '{{ csrf_token() }}';
                data['member_id'] = '{{ $data['member']->id }}';
                $.ajax({url: '{{ Path::urlSite('ecom/save-products') }}', type: 'post', data: data,
                    success: function (data) {
                        self.fetch();
                        toastr[data.status](data.message);
                        if (data.status == 'success')
                            self.productView('lst');
                    }
                });
            };
            self.addProduct = function() {
                $('#productTablist a:first').tab('show');
                self.productView('frm');
                self.product({
                    product_name: '',
                    alias: '',
                    category_id: '',
                    sort: '',
                    lang: '{{ $data['page']->lang }}',
                    public: 0,
                    stocking: 0,
                    featured: 0,
                    new: 0,
                    price: '',
                    unit: '',
                    desc: '',
                    media: '',
                    certs: '[]',
                    custom_fields: ''
                });
                // $('#lang').selectpicker('val', JSON.parse(self.product().lang));
                $('#certs').selectpicker('val', JSON.parse(self.product().certs));
                $('#category_id').selectpicker('val', self.product().category_id);
                $('#public').prop('checked', self.product().public ? true : false);
                $('#stocking').prop('checked', self.product().stocking ? true : false);
                $('#featured').prop('checked', self.product().featured ? true : false);
                $('#new').prop('checked', self.product().new ? true : false);
                $('#product_custom_field').selectpicker('val', self.product().custom_fields);
                self.productInfo();
            };
            self.editProduct = function(item) {
                $('#productTablist a:first').tab('show');
                self.productView('frm');
                self.product(item);
                // $('#lang').selectpicker('val', JSON.parse(self.product().lang));
                $('#certs').selectpicker('val', JSON.parse(self.product().certs));
                $('#category_id').selectpicker('val', self.product().category_id);
                $('#public').prop('checked', self.product().public == 1 ? true : false);
                $('#stocking').prop('checked', self.product().stocking == 1 ? true : false);
                $('#featured').prop('checked', self.product().featured == 1 ? true : false);
                $('#new').prop('checked', self.product().new == 1 ? true : false);
                $('#product_custom_field').selectpicker('val', self.product().custom_fields);
                self.productInfo();
                // self.productMedia();
            };
            self.cancelProduct = function () {
                self.productView('lst');
                self.product({});
            };
            self.delProduct = function(item) {
                self.product(item);
                $('#cfmDel').modal('show');
            };
            self.doDel = function() {
                var data = self.product();
                data['_token'] = '{{ csrf_token() }}';
                data['member_id'] = '{{ $data['member']->id }}';
                $.ajax({url: '{{ Path::urlSite('ecom/del-product') }}', type: 'post', data: data,
                    success: function (data) {
                        self.fetch();
                        toastr[data.status](data.message);
                        if (data.status == 'success')
                            self.productView('lst');
                    }
                });
            };
            function beforeFetch(){
                self.is_fetch(true);
                showAppLoader();
            };
            function completeFetch(){
                self.is_fetch(false);
                hideAppLoader();
            };

            self.doSearch = function(){
                if(!self.is_fetch()){
                    self.search($('#botstrapTable-search').val());
                }
            };
            self.noSearch = function(){
                self.search('');
            };

            self.fetch = function () {
                $.ajax({url: '{{ Path::urlSite('ecom/member-products') }}', type: 'post', data: { _token: '{{ csrf_token() }}', member_id: '{{ $data['member']->id }}', lang: '{{ $data['page']->lang }}', search: self.search },
                    beforeSend: beforeFetch, complete: completeFetch,
                    success: function (data) {
                        self.products(data);
                    }
                });
            };
            ko.computed(self.fetch);
            // $('#lang').change(function(){
            //     $.ajax({url: '{{ Path::urlSite('ecom/product-custom-fields') }}', type: 'post', data: {_token: '{{ csrf_token() }}', lang: $('#lang').val() },
            //         success: function (data) {
            //             $('#product_custom_field').html(data).selectpicker('refresh');
            //             self.productInfo();
            //             // $('#product_custom_fields').html('');
            //             // $('#product_custom_field').selectpicker('val', JSON.parse(self.product().custom_fields));
            //         }
            //     });
            // });
            // $('#product_custom_field').change(function(){
            //     self.productInfo();
            // });
            // $('#product_custom_field').on('hidden.bs.select', function (e) {
            //     self.productInfo();
            // });
            // $('#product_custom_field').on('loaded.bs.select', function (e) {
            //     self.productInfo();
            // });
            $('#product_custom_field').on('changed.bs.select', function (e) {
                self.productInfo();
            });
            self.productInfo = function() {
                if ($('#product_custom_field').val() != '')
                $.ajax({url: '{{ Path::urlSite('ecom/product-info') }}', type: 'post', data: {_token: '{{ csrf_token() }}', product_custom_field: $('#product_custom_field').val(), product_id: self.product().id },
                    success: function (data) {
                        $('#product_custom_fields').html(data);
                    }
                });
                else $('#product_custom_fields').html('');
            };
            // self.productMedias = ko.mapping.fromJS([]);
            // self.productMedia = function(){
            //     $.ajax({url: '{{ Path::urlSite('ecom/product-media') }}', type: 'post', data: {_token: '{{ csrf_token() }}', product_id: self.product().id },
            //         success: function (data) {
            //             ko.mapping.fromJS(data, self.productMedias);
            //         }
            //     });
            // };
            // self.chooseMedia = function(element_id){
            //     open_popup('{{ Path::urlSite($filemanager_path) }}' + '&fieldID=' + element_id);
            // };
            // self.productAddMedia = function(idx, item){
            //     var sort = $('#mediaSort'+idx).val();
            //     item.medias.push({
            //         caption: ko.observable($('#mediaCaption'+idx).val()),
            //         content: ko.observable($('#mediaContent'+idx).val()),
            //         sort: ko.observable(sort == '' ? item.medias().length + 1 : sort)
            //     });
            //     item.medias.sort(function (left, right) {
            //         return left.sort() <= right.sort() ? 0 : 1;
            //     });
            //     $('#mediaCaption'+idx).val('');
            //     $('#mediaContent'+idx).val('');
            //     $('#mediaSort'+idx).val('');
            // };
            // self.productDelMedia = function(item, list) {
            //     list.medias.remove(item);
            // };
        }
        var productModel = new ProductModel();
        ko.applyBindings(productModel, document.getElementById('member_product'));
    </script>
@endsection
