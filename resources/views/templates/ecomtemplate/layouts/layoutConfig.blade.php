<div class="container-fluid">
    <section id="default-layout-config">
        <h4 class="text-muted">{{ Language::getTemplate('ecomtemplate.lbl_ecom_template') }}</h4>
        <div data-bind="visible: layout()==='' ">
            <ul class="ul-grid">
                <li data-bind="click: configLayout.bind($data, 'index')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/homepage.jpg') }}')">
                    <div class="caption">Index</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'article_category')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/article_category.jpg') }}')">
                    <div class="caption">Article Category</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'member_category')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/member_category.jpg') }}')">
                    <div class="caption">Member Category</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'product_category')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/product_category.jpg') }}')">
                    <div class="caption">Product Category</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'article')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/article.jpg') }}')">
                    <div class="caption">Article</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'member')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/member.jpg') }}')">
                    <div class="caption">Member</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'product')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/product.jpg') }}')">
                    <div class="caption">Product</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'register')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/register.jpg') }}')">
                    <div class="caption">Register</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'active')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/active.jpg') }}')">
                    <div class="caption">Active</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'cart')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/cart.jpg') }}')">
                    <div class="caption">Cart</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'request_sample')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/request_sample.jpg') }}')">
                    <div class="caption">Request sample</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'password')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/password.jpg') }}')">
                    <div class="caption">Password</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'members')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/members.jpg') }}')">
                    <div class="caption">Members</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'products')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/products.jpg') }}')">
                    <div class="caption">Products</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'search')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/search.jpg') }}')">
                    <div class="caption">Search</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'contact')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/contact.jpg') }}')">
                    <div class="caption">Contact</div>
                </li>
                <li data-bind="click: configLayout.bind($data, 'support')" style="background-image: url('{{ Path::urlTemplate(strtolower($template->extension_name).'/images/layouts/support.jpg') }}')">
                    <div class="caption">Support</div>
                </li>
            </ul>
        </div>
        <div data-bind="visible: layout()!=='' ">
            <nav class="nav">
                <div class="btn btn-default" data-bind="click: back">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </div>
                <div class="navbar-form pull-right navbar-right">
                    <div class="btn btn-primary" data-bind="click: dosave"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> {{ Language::get('global.lbl_save') }}</div>
                </div>
            </nav>
            <div class="panel">
                <div class="panel-body">
                    <form role="form" id="layout-config-form">
                        <div data-bind="visible: layout()=='index' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_homepage_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='article_category' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_article_category_layout') }}</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="content_category_id">{{ Language::getCom('product.lbl_article_category_id_render') }} <sup class="text-danger">(*)</sup></label>
                                        <select class="select2" id="content_category_id">
                                            @foreach ( App\Com\Content\ContentCategory::fetch() as $category )
                                            <option value="{{ $category->id }}">{{ $category->text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
                        </div>
                        <div data-bind="visible: layout()=='member_category' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_member_category_layout') }}</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="member_category_id">{{ Language::getCom('member.lbl_member_category_id_render') }} <sup class="text-danger">(*)</sup></label>
                                        <select class="select2" id="member_category_id">
                                            @foreach ( App\Com\Member\MemberCategory::fetch() as $category )
                                            <option value="{{ $category->id }}">{{ $category->text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
                        </div>
                        <div data-bind="visible: layout()=='product_category' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_product_category_layout') }}</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="product_category_id">{{ Language::getCom('product.lbl_product_category_id_render') }} <sup class="text-danger">(*)</sup></label>
                                        <select class="select2" id="product_category_id">
                                            @foreach ( App\Com\Product\ProductCategory::fetch() as $category )
                                            <option value="{{ $category->id }}">{{ $category->text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
                        </div>
                        <div data-bind="visible: layout()=='article' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_article_layout') }}</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="content_id">{{ Language::getCom('content.lbl_content') }} <sup class="text-danger">(*)</sup></label>
                                        <select class="select2" id="content_id">
                                            @foreach ( App\Com\Content\ContentCategory::fetch() as $category )
                                            <?php
                                                $contents = App\Com\Content\Content::where('category_id', $category->id)->where('public', 1)->get();
                                            ?>
                                                @if(count($contents))
                                                <optgroup label="{{ $category->category_name }}">
                                                    @foreach ($contents as $content)
                                                    <option value="{{ $content->id }}">{{ $content->title }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
                        </div>
                        <div data-bind="visible: layout()=='member' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_member_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='product' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_product_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='register' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_register_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='active' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_active_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='cart' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_cart_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='request_sample' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_request_sample_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='password' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_password_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='members' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_members_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='products' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_products_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='search' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_search_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='contact' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_contact_layout') }}</legend>
                        </div>
                        <div data-bind="visible: layout()=='support' ">
                            <legend>{{ Language::getTemplate('ecomtemplate.lbl_support_layout') }}</legend>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $('.select2').select2({width: '100%', language: '{{ \App::getLocale() }}'});
    function ViewModelDefaultLayoutConfig() {
        var self = this;
        self.attribs = ko.observable(JSON.parse('<?php echo ($attribs!='' ? $attribs : "{}"); ?>'));
        self.layout = ko.observable('{{ isset($layout) ? $layout:"" }}');

        self.back = function(){
            self.layout('');
        };
        self.configLayout = function(layout){
            self.layout(layout);
        };
        self.dosave = function(){
            switch(self.layout()){
                case "product_category":
                    viewMode.setTemplateLayout(self.layout(), JSON.stringify({
                        category_id: $('#product_category_id').val()
                    }));
                    break;
                case "article":
                    viewMode.setTemplateLayout(self.layout(), JSON.stringify({
                        content_id: $('#content_id').val()
                    }));
                    break;
                case "article_category":
                    viewMode.setTemplateLayout(self.layout(), JSON.stringify({
                        category_id: $('#content_category_id').val()
                    }));
                    break;
                default:
                    viewMode.setTemplateLayout(self.layout(), '{}')
                    break;
            }
        };
        $('#content_category_id').select2('val', self.attribs().category_id);
        $('#product_category_id').select2('val', self.attribs().category_id);
        $('#content_id').select2('val', self.attribs().content_id);
    }
    ko.applyBindings(ViewModelDefaultLayoutConfig, document.getElementById('default-layout-config'));
</script>
