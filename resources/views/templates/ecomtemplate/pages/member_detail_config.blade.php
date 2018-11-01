<style>
    .dd-handle{
        height: auto;
        border-radius: 0px;
        padding: 0px;
        position: relative;
    }
    .dd-handle #lbl{
        position: absolute;
        right: 0;
        top: 0;
        background: #bbdefb;
        padding: 3px 5px;
        color: #4F7DA2;
        border-radius: 0px 0px 0px 5px;
    }
</style>

<section class="toolbar-config container" id="member_config">
    <div class="pull-right" style="margin-top: 10px;">
        @if ($data['request_gold'])
        <div class="btn btn-warning" data-toggle="modal" data-target="#goldModal"><i class="fa fa-unlock" aria-hidden="true"></i> {{ \Language::getTemplate('ecomtemplate.lbl_unlock_features') }}</div>
        @endif
        @if ($data['request_member'])
        <div class="btn btn-success" data-bind="click: btnMember"><i class="fa fa-unlock" aria-hidden="true"></i> {{ \Language::getTemplate('ecomtemplate.lbl_become_member') }}</div>
        @endif
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-edit"></span> {{ \Language::getTemplate('ecomtemplate.lbl_update_info') }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a data-bind="click: btnEdit">{{ \Language::getTemplate('ecomtemplate.lbl_enterprise_detail') }}</a></li>
                @if (count($data['other_lang']) != 0)
                <li><a data-bind="click: btnLang">{{ \Language::getTemplate('ecomtemplate.lbl_other_lang') }}</a></li>
                @endif
                <li><a data-toggle="modal" data-target="#infoModal" data-bind="click: btnAbout">{{ \Language::getTemplate('ecomtemplate.lbl_member_about') }}</a></li>
                <li><a data-toggle="modal" data-target="#infoModal" data-bind="click: btnContact">{{ \Language::getTemplate('ecomtemplate.lbl_contact_us') }}</a></li>
                <li><a data-toggle="modal" data-target="#infoModal" data-bind="click: btnBasic">{{ \Language::getTemplate('ecomtemplate.lbl_member_basic') }}</a></li>
                <li><a data-toggle="modal" data-target="#infoModal" data-bind="click: btnInfo">{{ \Language::getTemplate('ecomtemplate.lbl_enterprise_info') }}</a></li>
                <li><a data-toggle="modal" data-target="#infoModal" data-bind="click: btnFactory">{{ \Language::getTemplate('ecomtemplate.lbl_factory_info') }}</a></li>
                <li><a data-toggle="modal" data-target="#infoModal" data-bind="click: btnCommerce">{{ \Language::getTemplate('ecomtemplate.lbl_commerce_info') }}</a></li>
                <li><a href="{{ url($data['member']->url . '/dashboard') }}">{{ \Language::getTemplate('ecomtemplate.lbl_dashboard') }}</a></li>
            </ul>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-cog"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a data-toggle="modal" data-target="#layoutConfigModal">{{ \Language::getTemplate('ecomtemplate.lbl_layout') }}</a></li>
            </ul>
        </div>
    </div>

    <div class="modal" id="infoModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="modal-title" data-bind="html: title"></h2>
                    <div class="form-group">
                        <textarea class="ckeditor" name="info" id="info"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="background: #f5f5f5;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ Language::get('global.lbl_cancel') }}</button>
                    <button type="button" class="btn btn-primary" data-bind="click: save">{{ Language::get('global.lbl_save') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="goldModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="goldModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="start_at" class="control-label">{{ \Language::getCom('member.lbl_start_at') }} <sup class="text-danger">(*)</sup></label>
                        <div class="fg-line">
                            <input type="date" class="form-control fc-alt" name="start_at" id="start_at" data-bind="value: start" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ended_at" class="control-label">{{ \Language::getCom('member.lbl_ended_at') }} <sup class="text-danger">(*)</sup></label>
                        <div class="fg-line">
                            <input type="date" class="form-control fc-alt" name="ended_at" id="ended_at" data-bind="value: ended" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: #f5f5f5;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ Language::get('global.lbl_cancel') }}</button>
                    <button type="button" class="btn btn-primary" data-bind="click: btnGold">{{ Language::getTemplate('ecomtemplate.lbl_request') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="detailConfigModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="detailConfigModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="modal-title">{{ \Language::getCom('member.lbl_member_info_detail') }}</h2>
                    <form id="frmInfoConfig">
                        <div class="row m-t-20">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="member_name" class="control-label">{{ \Language::getCom('member.lbl_member_name') }} <sup class="text-danger">(*)</sup></label>
                                    <div class="fg-line">
                                         <!--ko if: !newlang()-->
                                        <input disabled type="text" class="form-control fc-alt" name="member_name" id="member_name" data-bind="value: member().member_name" required>
                                        <!--/ko-->
                                        <!--ko if: newlang-->
                                        <input type="text" class="form-control fc-alt" name="member_name" id="member_name" data-bind="value: member().member_name" required>
                                        <!--/ko-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_shortname" class="control-label">{{ \Language::getCom('member.lbl_member_shortname') }}</label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_shortname" id="member_shortname" data-bind="value: member().member_shortname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_othername" class="control-label">{{ \Language::getCom('member.lbl_member_othername')}}</label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_othername" id="member_othername" data-bind="value: member().member_othername">
                                    </div>
                                </div>
                                <!--ko if: newlang-->
                                <!-- <div class="form-group">
                                    <label for="member_tin" class="control-label">{{ \Language::getCom('member.lbl_member_tin') }} <sup class="text-danger">(*)</sup></label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_tin" id="member_tin" data-bind="value: member().member_tin" required>
                                    </div>
                                </div> -->
                                <!--/ko-->
                                <div class="form-group">
                                    <label for="member_address" class="control-label">{{ \Language::getCom('member.lbl_member_address') }} <sup class="text-danger">(*)</sup></label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_address" id="member_address" data-bind="value: member().member_address" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_phone" class="control-label">{{ \Language::getCom('member.lbl_member_phone') }} <sup class="text-danger">(*)</sup></label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_phone" id="member_phone" data-bind="value: member().member_phone" required
                                           onkeydown="return ( event.ctrlKey || event.altKey
                                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                        || (95<event.keyCode && event.keyCode<106)
                                        || (event.keyCode==8) || (event.keyCode==9)
                                        || (event.keyCode>34 && event.keyCode<40)
                                        || (event.keyCode==46) )"
                                    maxlength="20">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_fax" class="control-label">{{ \Language::getCom('member.lbl_member_fax') }}</label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_fax" id="member_fax" data-bind="value: member().member_fax"
                                            onkeydown="return ( event.ctrlKey || event.altKey
                                        || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                        || (95<event.keyCode && event.keyCode<106)
                                        || (event.keyCode==8) || (event.keyCode==9)
                                        || (event.keyCode>34 && event.keyCode<40)
                                        || (event.keyCode==46) )"
                                    maxlength="20">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_categories" class="control-label">{{ \Language::getCom('member.lbl_member_category') }}</label>
                                    <?php
                                        $member_categories = json_decode($data['member']->member_categories);
                                    ?>
                                    <select class="selectpicker fc-alt" id="member_categories" name="member_categories" multiple data-bind="value: member().member_categories">
                                        @foreach (DB::table('member_categories')->select('id', 'category_name')->get() as $member_category)
                                        <option value="{{ $member_category->id }}">{{ $member_category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="member_alias" class="control-label">{{ \Language::getCom('member.lbl_member_alias') }} </label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_alias" id="member_alias" data-bind="value: member().member_alias">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_email" class="control-label">{{ \Language::getCom('member.lbl_member_email') }} </label>
                                    <div class="fg-line">
                                        <input type="email" class="form-control fc-alt" name="member_email" id="member_email" data-bind="value: member().member_email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_website" class="control-label">{{ \Language::getCom('member.lbl_member_website') }}</label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_website" id="member_website" data-bind="value: member().member_website">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_facebook" class="control-label">{{ \Language::getCom('member.lbl_member_facebook') }}</label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_facebook" id="member_facebook" data-bind="value: member().member_facebook">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_twitter" class="control-label">{{ \Language::getCom('member.lbl_member_twitter') }}</label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_twitter" id="member_twitter" data-bind="value: member().member_twitter">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_google" class="control-label">{{ \Language::getCom('member.lbl_member_google') }}</label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_google" id="member_google" data-bind="value: member().member_google">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_youtube" class="control-label">{{ \Language::getCom('member.lbl_member_youtube') }}</label>
                                    <div class="fg-line">
                                        <input type="text" class="form-control fc-alt" name="member_youtube" id="member_youtube" data-bind="value: member().member_youtube">
                                    </div>
                                </div>
                                <!--ko if: newlang-->
                                <!-- <div class="form-group">
                                    <label for="lang" class="control-label">{{ \Language::getCom('member.lbl_lang') }}</label>
                                    <select class="selectpicker fc-alt" id="lang" name="lang" data-bind="value: member().lang">
                                        @foreach ($data['other_lang'] as $lang)
                                        <option value="{{ $lang->lang_code }}">{{ $lang->lang_code }}</option>
                                        @endforeach
                                    </select>
                                </div> -->
                                <!--/ko-->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="background: #f5f5f5;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ Language::get('global.lbl_cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="btnSaveInfo" data-bind="click: saveConfig">{{ Language::get('global.lbl_save') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal" id="layoutConfigModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="modal-title" id="myModalLabel">{{ \Language::getTemplate('ecomtemplate.lbl_layout_config') }}</h4>
                <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-1.jpg') }}">
                <div class="dd nestable">
                    <ol class="dd-list">
                        @foreach($data['layouts'] as $layout)
                            @if($layout->id == 'intro')
                            <li class="dd-item" data-id="intro">
                                <div class="dd-handle">
                                    <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-2.jpg') }}">
                                    <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_enterprise_info') }}</span>
                                </div>
                            </li>
                            @endif
                            @if($layout->id == 'product')
                            <li class="dd-item" data-id="product">
                                <div class="dd-handle">
                                    <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-3.jpg') }}">
                                    <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_product') }}</span>
                                </div>
                            </li>
                            @endif
                            @if($layout->id == 'certificate')
                            <li class="dd-item" data-id="certificate">
                                <div class="dd-handle">
                                    <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-4.jpg') }}">
                                    <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_certificate') }}</span>
                                </div>
                            </li>
                            @endif
                            @if($layout->id == 'news')
                            <li class="dd-item" data-id="news">
                                <div class="dd-handle">
                                    <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-5.jpg') }}">
                                    <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_content') }}</span>
                                </div>
                            </li>
                            @endif
                            @if($layout->id == 'contact')
                            <li class="dd-item" data-id="contact">
                                <div class="dd-handle">
                                    <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-6.jpg') }}">
                                    <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_contact') }}</span>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="modal-footer" style="background: #f5f5f5;">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ Language::get('global.lbl_cancel') }}</button>
                <button type="button" class="btn btn-primary" id="btn-save-config">{{ Language::get('global.lbl_save') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
    function open_popup(url, back_id, ajax_url){
        var w = 880;
        var h = 570;
        var l = Math.floor((screen.width-w)/2);
        var t = Math.floor((screen.height-h)/2);
        var win = window.open(url, '', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
        var tmp = $('#' + back_id).css('background-image');
        var current = tmp.substr(tmp.indexOf('{{ $data['member']->content }}')).replace('\"\)', '');
        win.onunload = function () {
            var tmp = $('#' + back_id).css('background-image');
            var newlogo = tmp.substr(tmp.indexOf('{{ $data['member']->content }}')).replace('\"\)', '');
            if (current != newlogo) {
                var new_tmp = $('#' + back_id).css('background-image');
                var logo = tmp.substr(tmp.indexOf('{{ config("data.UPLOAD_DIR") }}')).replace('\"\)', '');
                $.ajax({url: '{{ Path::urlSite('ecom') }}/' + ajax_url, type: 'post', data: { _token: '{{ csrf_token() }}', member_id: '{{ $data['member']->id }}', content: logo },
                    beforeSend: showAppLoader, complete: hideAppLoader,
                    success: function (data) {
                        toastr[data.status](data.message);
                         if (data.status == 'success') location.reload();
                    }
                });
            }
        }
    }
    $('#changeLogo').on('click', function() {
        javascript:open_popup('{{ Path::urlSite($filemanager_path) }}&backgroundID=logo_member', 'logo_member', 'change-logo');
    });
    $('#changeBanner').on('click', function() {
        javascript:open_popup('{{ Path::urlSite($filemanager_path) }}&backgroundID=member-detail', 'member-detail', 'change-banner');
    });
    $('#deleteBanner').on('click', function() {
        $.ajax({url: '{{ Path::urlSite('ecom') }}/change-banner', type: 'post', data: { _token: '{{ csrf_token() }}', member_id: '{{ $data['member']->id }}' },
            beforeSend: showAppLoader, complete: hideAppLoader,
            success: function (data) {
                toastr[data.status]('');
                 if (data.status == 'success') location.reload();
            }
        });
    });
    @if( file_exists(config('data.PATH_MODEL').'/CKEditor/') )
    $('.ckeditor').each(function(index, el) {
        @if( file_exists(config('data.PATH_MODEL').'/FileManager/') )
            <?php
                $akey = App\Com\FileManager\FileManager::getSecretKey();
                $filemanager_path = Path::urlSite('filemanager?akey='.$akey);
            ?>
            CKEDITOR.replace( this ,{
                filebrowserBrowseUrl : '{{ $filemanager_path }}',
                filebrowserUploadUrl : '{{ $filemanager_path }}',
                filebrowserImageBrowseUrl : '{{ $filemanager_path }}'
            });
        @else
            CKEDITOR.replace( this );
        @endif
    });
    @endif
    // validate form
    var validate = $('#frmInfoConfig').validate({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    function InfoModel() {
        var self = this;
        self.title = ko.observable('');
        self.start = ko.observable();
        self.ended = ko.observable();
        self.newlang = ko.observable(false);
        self.typeInfo = ko.observable('info');
        self.btnMember = function() {
            $.ajax({url: '{{ Path::urlSite('ecom/request-approve') }}', type: 'post', data: {
                _token: '{{ csrf_token() }}',
                member_id: {{ $data['member']->id }},
                member_tin: {{ $data['member']->member_tin }}
            }, beforeSend: showAppLoader, complete: hideAppLoader,
            success: function (data) {
                    toastr[data.status](data.message);
                    if (data.status == 'success') setTimeout('location.reload();', 1000);
                }
            });
        };
        self.btnGold = function() {
            $.ajax({url: '{{ Path::urlSite('ecom/request-approve') }}', type: 'post', data: {
                _token: '{{ csrf_token() }}',
                member_id: {{ $data['member']->id }},
                member_tin: {{ $data['member']->member_tin }},
                start_at: self.start(),
                ended_at: self.ended()
            }, beforeSend: showAppLoader, complete: hideAppLoader,
            success: function (data) {
                    toastr[data.status](data.message);
                    if (data.status == 'success') setTimeout('location.reload();', 1000);
                }
            });
        };
        self.btnAbout = function () {
            self.title('{{ \Language::getTemplate('ecomtemplate.lbl_member_about') }}');
            CKEDITOR.instances.info.setData(<?php echo json_encode($data['member']->info_about) ?>);
            self.typeInfo('info_about');
        };
        self.btnContact = function () {
            self.title('{{ \Language::getTemplate('ecomtemplate.lbl_contact_us') }}');
            CKEDITOR.instances.info.setData(<?php echo json_encode($data['member']->info_contact) ?>);
            self.typeInfo('info_contact');
        };
        self.btnBasic = function () {
            self.title('{{ \Language::getTemplate('ecomtemplate.lbl_member_basic') }}');
            CKEDITOR.instances.info.setData(<?php echo json_encode($data['member']->info_basic) ?>);
            self.typeInfo('info_basic');
        };
        self.btnInfo = function () {
            self.title('{{ \Language::getTemplate('ecomtemplate.lbl_enterprise_info') }}');
            CKEDITOR.instances.info.setData(<?php echo json_encode($data['member']->info) ?>);
            self.typeInfo('info');
        };
        self.btnFactory = function () {
            self.title('{{ \Language::getTemplate('ecomtemplate.lbl_factory_info') }}');
            CKEDITOR.instances.info.setData(<?php echo json_encode($data['member']->info_factory) ?>);
            self.typeInfo('info_factory');
        };
        self.btnCommerce = function () {
            self.title('{{ \Language::getTemplate('ecomtemplate.lbl_commerce_info') }}');
            CKEDITOR.instances.info.setData(<?php echo json_encode($data['member']->info_commerce) ?>);
            self.typeInfo('info_commerce');
        };
        self.save = function () {
            $.ajax({url: '{{ Path::urlSite('ecom/save-info') }}', type: 'post', data: {
                _token: '{{ csrf_token() }}',
                type: self.typeInfo(),
                info: CKEDITOR.instances.info.getData(),
                id: {{ $data['member']->id }}
            }, beforeSend: showAppLoader, complete: hideAppLoader,
            success: function (data) {
                    toastr[data.status](data.message);
                    setTimeout('location.reload();', 1000);
                }
            });
        };

        self.member = ko.observable({
            id: '{{ $data['member']->id }}',
            member_name: '{!! $data['member']->member_name !!}',
            member_shortname: '{!! $data['member']->member_shortname !!}',
            member_othername: '{!! $data['member']->member_othername !!}',
            member_address: '{!! $data['member']->member_address !!}',
            member_phone: '{!! $data['member']->member_phone !!}',
            member_fax: '{!! $data['member']->member_fax !!}',
            member_categories: '{!! $data['member']->member_categories !!}',
            member_alias: '{!! $data['member']->member_alias !!}',
            member_email: '{!! $data['member']->member_email !!}',
            member_website: '{!! $data['member']->member_website !!}',
            member_facebook: '{!! $data['member']->member_facebook !!}',
            member_twitter: '{!! $data['member']->member_twitter !!}',
            member_google: '{!! $data['member']->member_google !!}',
            member_youtube: '{!! $data['member']->member_youtube !!}',
            lang: '{!! $data['member']->lang !!}'
        });
        self.saveConfig = function () {
            var data = self.member();
            data['member_categories'] = JSON.stringify($('#member_categories').val());
            data['_token'] = '{{ csrf_token() }}';
            data['newlang'] = self.newlang();
            data['lang'] = '{!! $data['member']->lang !!}';
            data['member_tin'] = '{!! $data['member']->member_tin !!}';
            $.ajax({url: '{{ Path::urlSite('ecom/save-member') }}', type: 'post', data: data,
                beforeSend: showAppLoader, complete: hideAppLoader,
                success: function (data) {
                    toastr[data.status](data.message);
                    if (data.status == 'success') {
                        // $('#detailConfigModal').modal('hide');
                        setTimeout('location.reload();', 1000);
                    }
                }
            });
        };
        self.fetch = function () {
            $.ajax({url: '{{ Path::urlSite('ecom/current-member') }}', type: 'post', data: { _token: '{{ csrf_token() }}', current_member: '{{ $data['member']->id }}' },
                beforeSend: showAppLoader, complete: hideAppLoader,
                success: function (data) {
                    $('#member_categories').selectpicker('val', JSON.parse(data.member_categories));
                    if (self.newlang()) {
                        data.id = 0;
                        data.member_name = '';
                        data.member_shortname = '';
                        data.member_othername = '';
                        data.member_address = '';
                        data.member_alias = '';
                    }
                    self.member(data);
                    $('#detailConfigModal').modal('show');
                }
            });
        };
        self.btnEdit = function() {
            self.newlang(false);
            self.fetch();
        };
        @if (count($data['other_lang']) != 0)
        self.btnLang = function() {
            self.newlang(true);
            self.fetch();
        };
        @endif
    }
    var infoModel = new InfoModel();
    ko.applyBindings(infoModel, document.getElementById('member_config'));

    $('.selectpicker').selectpicker({width: '100%', style: 'btn-info'});
    // $('#lang').selectpicker({width: '100%', style: 'btn-info'});

    $(function(){
        $('.nestable').nestable({
            maxDepth: 1
        });

        $('#btn-save-config').on('click', function(){
            $('#btn-save-config').prop('disabled', true);
            $('#btn-save-config .zmdi-refresh').show();
            $.post("{{ Path::url(config('data.ROUTE_PREFIX_SITE').'/ecom/member-config-layout') }}", {
                id: '{{ $data['member']->id }}',
                settings: JSON.stringify($('.nestable').nestable('serialize')),
                _token: '{{ csrf_token() }}'
            }, function( data ) {
                if(data.status === 'success') {
                    toastr[data.status](data.message);
                    setTimeout('location.reload();', 1000);
                }else{
                    toastr[data.status](data.message);
                    $('#btn-save-config .zmdi-refresh').show();
                    $('#btn-save-config').prop('disabled', false);
                }
            });
        });
    });
</script>
