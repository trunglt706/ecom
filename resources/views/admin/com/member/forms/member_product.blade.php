<?php
    $akey = App\Com\FileManager\FileManager::getSecretKey();
    $filemanager_path = 'filemanager?akey='.$akey;
    $product_path = 'product?id=';
?>

<link href="{{ Path::urlCom('member/css/admin.member.css') }}" rel="stylesheet">
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="productTablist">
        <li class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">{{ \Language::getCom('product.lbl_info') }}</a></li>
<!--        <li><a href="#product_info" aria-controls="product_info" role="tab" data-toggle="tab">{{ \Language::getCom('product.lbl_product_info') }}</a></li>
        <li><a href="#media" aria-controls="media" role="tab" data-toggle="tab">{{ \Language::getCom('product.lbl_media') }}</a></li>
        <li><a href="#promotion" aria-controls="promotion" role="tab" data-toggle="tab">{{ \Language::getCom('product.lbl_promotion') }}</a></li>-->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            <div class="row">
                <div class="col-md-8">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image" class="control-label">{{ \Language::getCom('content.lbl_image') }}</label>
                            <a class="thumbnail" style="width:150px; height: 150px;" onclick="javascript:open_popup('{{ $filemanager_path.'&backgroundID=image' }}')">
                                <div class="thumbnail-img" id="image" data-bind="attr:{'style':current().image!=null? 'background-image: url('+current().image+');' : 'background-image:none;'}"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="product_name" class="control-label">{{ \Language::getCom('product.lbl_product_name') }} <sup class="text-danger">(*)</sup></label>
                            <input type="text" class="form-control" name="product_name" id="product_name" data-bind="value: current().product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="alias" class="control-label">{{ \Language::getCom('product.lbl_alias') }} <sup class="text-danger">(*)</sup></label>
                            <input type="text" class="form-control" name="alias" id="alias" data-bind="value: current().alias">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc" class="control-label">{{ \Language::getCom('product.lbl_desc') }} <sup class="text-danger">(*)</sup></label>
                            <textarea class="form-control ckeditor" name="desc" id="desc" data-bind="value: current().desc" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
<!--                    <div class="form-group">
                        <label for="member_id" class="control-label">{{ \Language::getCom('member.lbl_member_id_render') }}</label>
                        <select class="select2" id="member_id" name="member_id" data-url="{{ $uri }}/member"></select>
                    </div>-->
                    <div class="form-group">
                        <label for="category_id" class="control-label">{{ \Language::getCom('product.lbl_category_id_render') }} <sup class="text-danger">(*)</sup></label>
                        <select class="select2" id="category_id" name="category_id" required data-url="{{ $uri }}/categories"></select>
                    </div>
                    <div class="form-group">
                        <label for="sort" class="control-label">{{ \Language::getCom('product.lbl_sort') }}</label>
                        <input type="number" class="form-control" name="sort" id="sort" data-bind="value: current().sort" min="0">
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ \Language::getCom('product.lbl_options') }}</label>
                        <div class="checkbox">
                            <label><input type="checkbox" name="public" id="public" data-bind="attr:{'checked': current().public == 1}"> {{ \Language::get('global.lbl_public') }}</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="stocking" id="stocking" data-bind="attr:{'checked': current().stocking == 1}"> {{ \Language::getCom('product.lbl_stocking') }}</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="featured" id="featured" data-bind="attr:{'checked': current().featured == 1}"> {{ \Language::getCom('product.lbl_featured') }}</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="new" id="new" data-bind="attr:{'checked': current().new == 1}"> {{ \Language::getCom('product.lbl_new') }}</label>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
        </div>
        <div role="tabpanel" class="tab-pane" id="product_info">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">{{ \Language::getCom('product.lbl_price') }} <sup class="text-danger">(*)</sup></label>
                    <section class="table-header-fixed-top" id="table-prices">
                        <table class="table table-header">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ Language::getCom('product.lbl_price') }}</th>
                                    <th>{{ Language::getCom('product.lbl_note') }}</th>
                                    <th class="text-right actions">
                                        <div class="btn btn-default" data-bind="click: productPrice ">
                                            <span class="glyphicon glyphicon-refresh"></span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="grid-container loading-container wrap-scroll" style="min-height: 200px; height: 200px;">
                            <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
                            <table class="table table-content thead-hide">
                                <thead>
                                    <tr>
                                        <th width="50px"></th>
                                        <th>{{ Language::getCom('product.lbl_price') }}</th>
                                        <th>{{ Language::getCom('product.lbl_note') }}</th>
                                        <th class="text-right actions">
                                            <div class="btn btn-default" data-bind="click: productPrice ">
                                                <span class="glyphicon glyphicon-refresh"></span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--ko foreach: prices()-->
                                    <tr>
                                        <td class="text-center">
                                            <span data-bind="html: $index() + 1 "></span>
                                        </td>
                                        <td>
                                            <span data-bind="html: price, attr:{'title': price} "></span>
                                        </td>
                                        <td>
                                            <span data-bind="html: note, attr:{'title': note} "></span>
                                        </td>
                                        <td class="text-right actions">
                                            <div class="btn" data-bind="click: $parent.productDelPrice.bind($data, $rawData) ">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--/ko-->
                                    <tr data-bind="visible: prices().length==0 " style="display: none;">
                                        <td colspan="4" class="text-center active">{{ \Language::get('global.message_table_empty') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-bottom-toolbar">
                            <div class="form-inline">
                                <div class="form-group">
                                    <input type="text" data-bind="value: price().price " class="form-control" placeholder="{{ \Language::getCom('product.lbl_price') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" data-bind="value: price().note " class="form-control" placeholder="{{ \Language::getCom('product.lbl_note') }}">
                                </div>
                                <div class="btn btn-default" data-bind="click: productAddPrice "><span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_add') }}</div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-4" id="product_custom_fields"></div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="media">
            <!--ko foreach: productMedias()-->
            <section class="media-panel">
                <div id="header">
                    <div id="title">
                        <strong data-bind="html: text "></strong>
                        <small class="badge" data-bind="html: medias().length + ' {{ \Language::getCom("product.lbl_media") }}'"></small>
                    </div>
                </div>
                <div id="body">
                    <!--ko foreach: medias()-->
                    <div id="img" data-bind="style: { backgroundImage: 'url(' + content() + ')' }, attr: { 'title': caption }">
                        <div id="caption">
                            <div id="btn-bottom">
                                <div class="btn-group" role="group">
                                    <div type="button" class="btn btn-default" data-bind="click: $root.productDelMedia.bind($data, $rawData, $parent)">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ko-->
                </div>
                <div id="footer">
                    <div class="form-inline">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" readonly class="form-control" placeholder="{{ \Language::get('global.lbl_choose') }}" data-bind="attr:{'id': 'mediaContent'+$index()} ">
                                <span class="input-group-btn">
                                    <div class="btn btn-default" data-bind="click: $parent.chooseMedia.bind($data, 'mediaContent'+$index())">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ \Language::getCom('product.lbl_note') }}" data-bind="attr:{'id': 'mediaCaption'+$index()} ">
                        </div>
                        <div class="form-group">
                            <input type="number" min="0" class="form-control" placeholder="{{ \Language::getCom('product.lbl_sort') }}" data-bind="attr:{'id': 'mediaSort'+$index()} ">
                        </div>
                        <div class="btn btn-default" data-bind="click: $parent.productAddMedia.bind($data, $index(), $rawData) ">
                            <span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_add') }}
                        </div>
                    </div>
                </div>
            </section>
            <!--/ko-->
        </div>
        <div role="tabpanel" class="tab-pane" id="promotion">Đang cập nhật</div>
    </div>

<!--     Tab panes
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="panInfo">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category" class="control-label">{{ \Language::getCom('member.lbl_category_render') }}</label>
                        <select class="select2" id="category" name="category" data-url="{{ $uri }}/category"></select>
                    </div>
                    <div class="form-group">
                        <label for="product_id" class="control-label">{{ \Language::getCom('member.lbl_product_id_render') }}</label>
                        <select class="select2" id="product_id" name="product_id"></select>
                    </div>
                </div>
            </div>
            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
        </div>
    </div>-->
</div>

@section('incAdd')
    //$('#member_id').select2('val', '');

    CKEDITOR.instances.desc.setData('');
    $('#category_id').select2('val', '');
    $('#productTablist a:first').tab('show');
    self.productMedia();
        self.productInfo();
@endsection

@section('incUpd')
    //$('#member_id').select2('val', self.current().member_id);
    $('#public').prop('checked', self.current().public == 1 ? true : false);
    $('#stocking').prop('checked', self.current().stocking == 1 ? true : false);
    $('#featured').prop('checked', self.current().featured == 1 ? true : false);
    $('#new').prop('checked', self.current().new == 1 ? true : false);

    CKEDITOR.instances.desc.setData(self.current().content);
    $('#category_id').select2('val', self.current().category_id);
    $('#productTablist a:first').tab('show');
    self.productPrice();
    self.productMedia();
    self.productInfo();
    $('#image').css('background-image', 'url('+self.current().avatar+')');
@endsection

@section('incSave')
    //self.current().member_id = $('#member_id').val();

    self.current().desc = CKEDITOR.instances.desc.getData();
    self.current().category_id = $('#category_id').val();
    self.current().public = $('#public').is(':checked') ? 1:0;
    self.current().stocking = $('#stocking').is(':checked') ? 1:0;
    self.current().featured = $('#featured').is(':checked') ? 1:0;
    self.current().new = $('#new').is(':checked') ? 1:0;
    var bg = $('#image').css('background-image');
    self.current().image = bg.substr(bg.indexOf('{{ config("data.UPLOAD_DIR") }}')).replace('\"\)', '');
    //self.current().productInfo = viewModelProductInfo.getDataInfo();
    //self.current().productPrices = self.prices();
    //self.current().productMedias = ko.mapping.toJS(self.productMedias);
@endsection

@section('incFun')
    //$('#category_id').change(function(){
    //   self.productInfo();
    //});
    self.productInfo = function(){
        $.ajax({url: '{{ $uri }}/product-info', type: 'post', data: {_token: '{{ csrf_token() }}', category_id: $('#category_id').val(), product_id: self.current().id },
            beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
            success: function (data) {
                $('#product_custom_fields').html(data);
            }
        });
    };

    self.price = ko.observable({price: '', note: ''});
    self.prices = ko.observableArray([]);
    self.productPrice = function(){
        $.ajax({url: '{{ $uri }}/product-price', type: 'post', data: {_token: '{{ csrf_token() }}', product_id: self.current().product_id },
            beforeSend: showLoading, error: errorConnect, complete: hideLoading,
            success: function (data) {
                self.prices(data);
                tableRefesh('#table-prices');
            }
        });
    };
    self.productAddPrice = function(){
        if(self.price().price !== ''){
            self.prices.push(self.price());
            self.price({price: '', note: ''});
        }
    };
    self.productDelPrice = function(item){
        self.prices.remove(item);
    };

    self.productMedias = ko.mapping.fromJS([]);
    self.productMedia = function(){
        $.ajax({url: '{{ $uri }}/product-media', type: 'post', data: {_token: '{{ csrf_token() }}', product_id: self.current().id },
            error: errorConnect,
            success: function (data) {
                ko.mapping.fromJS(data, self.productMedias);
            }
        });
    };
    self.chooseMedia = function(element_id){
        open_popup('{{ $filemanager_path }}' + '&fieldID=' + element_id);
    };
    self.productAddMedia = function(idx, item){
        var sort = $('#mediaSort'+idx).val();
        item.medias.push({
            caption: ko.observable($('#mediaCaption'+idx).val()),
            content: ko.observable($('#mediaContent'+idx).val()),
            sort: ko.observable(sort == '' ? item.medias().length + 1 : sort)
        });
        item.medias.sort(function (left, right) {
            return left.sort() <= right.sort() ? 0 : 1;
        });
        $('#mediaCaption'+idx).val('');
        $('#mediaContent'+idx).val('');
        $('#mediaSort'+idx).val('');
    };
    self.productDelMedia = function(item, list) {
        list.medias.remove(item);
    };
@endsection
