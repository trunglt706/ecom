<div class="block-header">
    <h2>
        {{ \Language::getTemplate('ecomtemplate.lbl_product') }}
        <small>{{ \Language::getTemplate('ecomtemplate.lbl_product_manager') }}</small>
    </h2>
</div>

<!--<button class="btn btn-float btn-danger m-btn m-b-20" data-bind="click: addProduct, visible: productView() == 'lst'"><i class="zmdi zmdi-plus"></i></button>-->
<!--<button class="btn btn-float btn-default m-btn bgm-gray m-b-20" data-bind="click: cancelProduct, visible: productView() == 'frm'"><i class="zmdi zmdi-arrow-left"></i></button>-->

<div class="card">
    <div class="lv-header-alt clearfix m-b-5">
        <h2 class="lvh-label hidden-xs" data-bind="visible: productView() == 'lst'"><span data-bind="html: products().length"></span><span> {{ \Language::getTemplate('ecomtemplate.lbl_products') }}</span></h2>
        <div class="lvh-search">
            <input type="text" class="lvhs-input" id="botstrapTable-search" placeholder="{{ \Language::get('global.lbl_search') }}" data-bind="value: search, event: {'keyup': doSearch} ">
             <!-- <input type="text" placeholder="Start typing..." class="lvhs-input"> -->
             <i class="lvh-search-close" data-bind="click: noSearch">&times;</i>
        </div>
        <ul class="lv-actions actions">
            <li>
                 <a href="" class="lvh-search-trigger">
                     <i class="zmdi zmdi-search"></i>
                 </a>
            </li>
            <li data-bind="visible: productView() == 'lst', click: addProduct">
                <a href="">
                    <button class="btn btn-primary waves-effect" data-toggle="tooltip" data-title="{{ \Language::get('global.lbl_add') }}">
                            <i class="fa fa-plus"></i>
                                </button>

                </a>
            </li>
            <li data-bind="visible: productView() == 'frm', click: cancelProduct">
                <a href="">
                    <button class="btn btn-primary waves-effect" data-toggle="tooltip" data-title="{{ \Language::get('global.lbl_back') }}">
                            <i class="fa fa-arrow-left"></i>
                                </button>

                </a>
            </li>
            <li data-bind="visible: productView() == 'frm', click: saveProduct">
                <a href="">
                    <button class="btn btn-primary waves-effect" data-toggle="tooltip" data-title="{{ \Language::get('global.lbl_save') }}">
                            <i class="fa fa-floppy-o"></i>
                                </button>

                </a>
            </li>
        </ul>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id="productTablist" data-bind="visible: productView() == 'frm'">
            <li class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">{{ \Language::getCom('product.lbl_info') }}</a></li>
            <li><a href="#product_info" aria-controls="product_info" role="tab" data-toggle="tab">{{ \Language::getCom('product.lbl_product_info') }}</a></li>
            <!-- <li><a href="#media" aria-controls="media" role="tab" data-toggle="tab">{{ \Language::getCom('product.lbl_media') }}</a></li> -->
        </ul>
    </div>
    <div class="card-body card-padding" data-bind="visible: productView() == 'lst'">
        <div class="contacts clearfix row">
            <!--ko foreach: products-->
            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="c-item">
                    <div class="ci-avatar" data-bind="style: { backgroundImage: 'url(' + media + ')' }"></div>
                    <div class="c-info">
                        <strong data-bind="html: product_name"></strong>
                        <small data-bind="html: '{{ \Language::getCom('product.lbl_views') }}: ' + views"></small>
                        <small data-bind="html: lang"></small>
                    </div>
                    <div class="c-footer">
                        <button class="waves-effect btn btn-default" data-bind="click: $parent.editProduct.bind($data, $rawData)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button class="waves-effect btn btn-danger" data-bind="click: $parent.delProduct.bind($data, $rawData)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <!--/ko-->
        </div>
    </div>
    <div class="p-15" data-bind="visible: productView() == 'frm'">
        <form id="frmEdit">
            {{ csrf_field() }}
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="info">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="thumbnail product-avatar">
                                <div id="product_avatar" class="img-background" style="width: 100%; height: 100%;" data-bind="style: { backgroundImage: 'url(' + product().media + ')' }">
                                    <input id="product_avatar_hidden" class="hidden" data-bind="value: product().media">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ \Language::getCom('product.lbl_options') }}</label>
                            <div class="checkbox">
                                <label><input type="checkbox" name="public" id="public" data-bind="attr:{'checked': product().public == '1'}"><i class="input-helper"></i> {{ \Language::getcom('product.lbl_public') }}</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="stocking" id="stocking" data-bind="attr:{'checked': product().stocking == '1'}"><i class="input-helper"></i> {{ \Language::getCom('product.lbl_stocking') }}</label>
                            </div>
                            <div class="checkbox">
                                <label><input disabled type="checkbox" name="featured" id="featured"><i class="input-helper"></i> {{ \Language::getCom('product.lbl_featured') }}</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="new" id="new" data-bind="attr:{'checked': product().new == '1'}"><i class="input-helper"></i> {{ \Language::getCom('product.lbl_new') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_name" class="control-label">{{ \Language::getCom('product.lbl_product_name') }} <sup class="text-danger">(*)</sup></label>
                            <div class="fg-line"><input type="text" class="form-control fc-alt" name="product_name" id="product_name" data-bind="value: product().product_name" required></div>
                        </div>
                        <div class="form-group">
                            <label for="alias" class="control-label">{{ \Language::getCom('product.lbl_alias') }}</label>
                            <div class="fg-line"><input type="text" class="form-control fc-alt" name="alias" id="alias" data-bind="value: product().alias"></div>
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="control-label">{{ \Language::getCom('product.lbl_category_id_render') }} <sup class="text-danger">(*)</sup></label>
                            <select class="selectpicker" id="category_id" name="category_id" required>
                                <?php
                                $lang_cat = \DB::table('product_categories')->where('category_name', $data['page']->lang)->value('id');
                                ?>
                                @foreach (\DB::table('product_categories')->where('parent_category', $lang_cat)->select('id', 'category_name')->get() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="certs" class="control-label">{{ \Language::getCom('product.lbl_certs') }}</label>
                            <select class="selectpicker" id="certs" name="certs" multiple>
                                @foreach (\DB::table('member_certificate_types')->select('id', 'member_certificate_type_name')->get() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->member_certificate_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price" class="control-label">{{ \Language::getCom('product.lbl_price') }}</label>
                            <div class="fg-line"><input type="text" class="form-control fc-alt" name="price" id="price" data-bind="value: product().price"></div>
                        </div>
                        <div class="form-group">
                            <label for="unit" class="control-label">{{ \Language::getCom('product.lbl_unit') }}</label>
                            <div class="fg-line"><input type="text" class="form-control fc-alt" name="unit" id="unit" data-bind="value: product().unit"></div>
                        </div>
                        <div class="form-group">
                            <label for="sort" class="control-label">{{ \Language::getCom('product.lbl_sort') }}</label>
                            <input type="number" class="form-control fc-alt" name="sort" id="sort" data-bind="value: product().sort" min="0">
                        </div>
                        <div class="form-group">
                            <label for="lang" class="control-label">{{ \Language::getCom('product.lbl_lang') }} <sup class="text-danger">(*)</sup></label>
                            <select class="form-control fc-alt" id="lang" name="lang" data-bind="value: product().lang" required>
                                @foreach(Language::getLang() as $code=>$lang)
                                @if ($code == $data['page']->lang)
                                <option value="{{ $code }}">{{ $lang }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="desc" class="control-label">{{ \Language::getCom('product.lbl_desc') }}</label>
                            <textarea class="form-control fc-alt ckeditor" name="desc" id="desc" data-bind="value: product().desc"></textarea>
                        </div>
                        <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::getcom('product.message_form_input_required') }}</span></div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="product_info">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_custom_field" class="control-label">{{ \Language::getCom('product.lbl_product_custom_fields') }} <sup class="text-danger">(*)</sup></label>
                            <select class="selectpicker" id="product_custom_field" name="product_custom_field" required multiple data-live-search="true">
                                @foreach (\DB::table('product_custom_fields')->where('lang', $data['page']->lang)->select('id', 'field_name')->get() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->field_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4" id="product_custom_fields"></div>
                </div>
            </div>
            <!-- <div role="tabpanel" class="tab-pane" id="media">
                ko foreach: productMedias()
                <section class="media-panel">
                    <div id="header">
                        <div id="title">
                            <strong data-bind="html: text "></strong>
                            <small class="badge" data-bind="html: medias().length + ' {{ \Language::getCom("product.lbl_media") }}'"></small>
                        </div>
                    </div>
                    <div id="body">
                        ko foreach: medias()
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
                        /ko
                    </div>
                    <div id="footer">
                        <div class="form-inline">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="fg-line"><input type="text" readonly class="form-control fc-alt" placeholder="{{ \Language::get('global.lbl_choose') }}" data-bind="attr:{'id': 'mediaContent'+$index()} "></div>
                                    <span class="input-group-btn">
                                        <div class="btn btn-default" data-bind="click: $parent.chooseMedia.bind($data, 'mediaContent'+$index())">
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fg-line"><input type="text" class="form-control fc-alt" placeholder="{{ \Language::getCom('product.lbl_note') }}" data-bind="attr:{'id': 'mediaCaption'+$index()} "></div>
                            </div>
                            <div class="form-group">
                                <input type="number" min="0" class="form-control fc-alt" placeholder="{{ \Language::getCom('product.lbl_sort') }}" data-bind="attr:{'id': 'mediaSort'+$index()} ">
                            </div>
                            <div class="btn btn-default" data-bind="click: $parent.productAddMedia.bind($data, $index(), $rawData) ">
                                <span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_add') }}
                            </div>
                        </div>
                    </div>
                </section>
                /ko
            </div> -->
        </div>
        </form>
    </div>
</div>
