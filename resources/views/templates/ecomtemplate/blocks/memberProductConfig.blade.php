<section class="toolbar-config container">
    <div class="pull-right">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-edit"></span> {{ \Language::getTemplate('ecomtemplate.lbl_update_info') }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a data-toggle="modal" data-target="#infoConfigModal">{{ \Language::getTemplate('ecomtemplate.lbl_enterprise_info') }}</a></li>
                <li><a data-toggle="modal" data-target="#certConfigModal">{{ \Language::getTemplate('ecomtemplate.lbl_certificate_manager') }}</a></li>
                <li><a data-toggle="modal" data-target="#productConfigModal">{{ \Language::getTemplate('ecomtemplate.lbl_product_manager') }}</a></li>
            </ul>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-user"></span> {{ \Language::getTemplate('ecomtemplate.lbl_member') }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a>{{ \Language::getTemplate('ecomtemplate.lbl_member_acc') }}</a></li>
                <li><a>{{ \Language::getTemplate('ecomtemplate.lbl_contact_info') }}</a></li>
            </ul>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-cog"></span> {{ \Language::getTemplate('ecomtemplate.lbl_setup') }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a data-toggle="modal" data-target="#layoutConfigModal">{{ \Language::getTemplate('ecomtemplate.lbl_layout') }}</a></li>
            </ul>
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
                        <li class="dd-item" data-id="intro">
                            <div class="dd-handle">
                                <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-2.jpg') }}">
                                <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_enterprise_info') }}</span>
                            </div>
                        </li>
                        <li class="dd-item" data-id="product">
                            <div class="dd-handle">
                                <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-3.jpg') }}">
                                <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_product') }}</span>
                            </div>
                        </li>
                        <li class="dd-item" data-id="certificate">
                            <div class="dd-handle">
                                <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-4.jpg') }}">
                                <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_certificate') }}</span>
                            </div>
                        </li>
                        <li class="dd-item" data-id="news">
                            <div class="dd-handle">
                                <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-5.jpg') }}">
                                <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_content') }}</span>
                            </div>
                        </li>
                        <li class="dd-item" data-id="contact">
                            <div class="dd-handle">
                                <img width="100%" src="{{ Path::urlTemplate('ecomtemplate/images/member-layout-6.jpg') }}">
                                <span id="lbl">{{ \Language::getTemplate('ecomtemplate.lbl_layout_contact') }}</span>
                            </div>
                        </li>
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

<div class="modal" id="infoConfigModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="infoConfigModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="modal-title" id="infoConfigModalLabel">{{ \Language::getCom('member.lbl_member_info_detail') }}</h2>
                <form id="frmInfoConfig">
                    <div class="row m-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="member_name" class="control-label">{{ \Language::getCom('member.lbl_member_name') }} <sup class="text-danger">(*)</sup></label>
                                <div class="fg-line">
                                    <input type="text" class="form-control fc-alt" name="member_name" id="member_name" data-bind="value: member().member_name" required>
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
                                    $member_categories = json_decode($member->member_categories);
                                ?>
                                <select class="selectpicker fc-alt" id="member_categories" name="member_categories" multiple data-bind="value: member().member_categories">
                                    @foreach (DB::table('member_categories')->select('id', 'category_name')->get() as $member_category)
                                    <option value="{{ $member_category->id }}">{{ $member_category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background: #f5f5f5;">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-bind="click: cancelConfig">{{ Language::get('global.lbl_cancel') }}</button>
                <button type="button" class="btn btn-primary" id="btn-save-config" data-bind="click: saveConfig">{{ Language::get('global.lbl_save') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="certConfigModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="certConfigModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="modal-title" id="certConfigModalLabel">{{ \Language::getCom('member.lbl_member_info_detail') }}</h2>
                <form id="frmCertConfig">
                    
                </form>
            </div>
            <div class="modal-footer" style="background: #f5f5f5;">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-bind="click: cancelConfig">{{ Language::get('global.lbl_cancel') }}</button>
                <button type="button" class="btn btn-primary" id="btn-save-config" data-bind="click: saveConfig">{{ Language::get('global.lbl_save') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="productConfigModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="productConfigModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="modal-title" id="productConfigModalLabel">{{ \Language::getCom('member.lbl_member_info_detail') }}</h2>
                <table class="table table-header">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>{{ Language::getCom('member.lbl_fullname') }}</th>
                            <th>{{ Language::getCom('member.lbl_email') }}</th>
                            <th>{{ Language::getCom('member.lbl_username') }}</th>
                            <th>{{ Language::getCom('member.lbl_active_render') }}</th>
                            <th>{{ Language::getCom('member.lbl_note') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
                <div class="grid-container loading-container wrap-scroll" style="height: 200px;">
                    <div class="loading"><i class="fa fa-refresh fa-spin"></i></div>
                    <table class="table table-user table-content thead-hide">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>{{ Language::getCom('member.lbl_fullname') }}</th>
                                <th>{{ Language::getCom('member.lbl_email') }}</th>
                                <th>{{ Language::getCom('member.lbl_username') }}</th>
                                <th>{{ Language::getCom('member.lbl_active_render') }}</th>
                                <th>{{ Language::getCom('member.lbl_note') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--ko foreach: products()-->
                            <tr>
                                <td width="30px"><input type="checkbox" class="tblProductCheckbox" data-bind="attr:{'value': idx} "/></td>
                                <td>
                                    <span data-bind="html: $index()+1 "></span>
                                </td>
                                <td>
                                    <span data-bind="html: fullname, attr:{'title': fullname} "></span>
                                </td>
                                <td>
                                    <span data-bind="html: email, attr:{'title': email} "></span>
                                </td>
                                <td>
                                    <span data-bind="html: username, attr:{'title': username} "></span>
                                </td>
                                <td class="text-center">
                                    <span data-bind="attr:{'class': active == 1 ? 'glyphicon glyphicon-ok-sign text-success' : 'glyphicon glyphicon-ok-sign text-danger'} "></span>
                                </td>
                                <td>
                                    <span data-bind="html: note, attr:{'title': note} "></span>
                                </td>
                                <td class="text-right actions">
                                    <div class="btn btn-default" data-bind="click: $parent.editProduct.bind($data, $rawData)"><span class="glyphicon glyphicon-edit"></span></div>
                                </td>
                            </tr>
                            <!--/ko-->
                            <tr data-bind="visible: users().length==0 " style="display: none;">
                                <td colspan="8" class="text-center active">{{ \Language::get('global.message_table_empty') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <span class="text-muted">{{ Language::getCom('member.lbl_total_user') }}:</span> <b data-bind="html: users().length "></b>
            </div>
            <div class="modal-footer" style="background: #f5f5f5;">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-bind="click: cancelConfig">{{ Language::get('global.lbl_cancel') }}</button>
                <button type="button" class="btn btn-primary" id="btn-save-config" data-bind="click: saveConfig">{{ Language::get('global.lbl_save') }} <i class="zmdi zmdi-refresh zmdi-hc-spin" style="display: none;"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
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
    $('.selectpicker').selectpicker({width: '100%', style: 'btn-info'});
    $(function(){
        $('.nestable').nestable({
            maxDepth: 1
        });

        $('#btn-save-config').on('click', function(){
            $('#btn-save-config').prop('disabled', true);
            $('#btn-save-config .zmdi-refresh').show();
            $.post("{{ Path::url(config('data.ROUTE_PREFIX_SITE').'/ecom/member-config-layout') }}", {
                id: '{{ $member->id }}',
                attribs: JSON.stringify($('.nestable').nestable('serialize')),
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
