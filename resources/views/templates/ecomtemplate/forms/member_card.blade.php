<div class="block-header">
    <h2>{{ \Language::getTemplate('ecomtemplate.lbl_member_card') }}<small>{{ \Language::getTemplate('ecomtemplate.lbl_card_manager') }}</small></h2>
</div>

<!--<button class="btn btn-float btn-danger m-btn m-b-20" data-bind="click: addCard, visible: cardView() == 'lst'"><i class="zmdi zmdi-plus"></i></button>
<button class="btn btn-float btn-default m-btn bgm-gray m-b-20" data-bind="click: cancelCard, visible: cardView() == 'frm'"><i class="zmdi zmdi-arrow-left"></i></button>-->

<div class="card">
    <div class="lv-header-alt clearfix m-b-5">
        <h2 class="lvh-label hidden-xs" data-bind="visible: cardView() == 'lst'"><span data-bind="html: cards().length"></span><span> {{ \Language::getTemplate('ecomtemplate.lbl_member_card') }}</span></h2>
<!--        <div class="lvh-search">
            <input type="text" placeholder="Start typing..." class="lvhs-input">
            <i class="lvh-search-close">&times;</i>
        </div>-->
        <ul class="lv-actions actions">
<!--            <li>
                <a href="" class="lvh-search-trigger">
                    <i class="zmdi zmdi-search"></i>
                </a>
            </li>-->
            <li data-bind="visible: cardView() == 'lst', click: addCard">
                <a href="">
                    <i class="zmdi zmdi-plus"></i>
                </a>
            </li>
            <li data-bind="visible: cardView() == 'frm', click: cancelCard">
                <a href="">
                    <i class="zmdi zmdi-arrow-left"></i>
                </a>
            </li>
            <li data-bind="visible: cardView() == 'frm', click: saveCard">
                <a href="">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body card-padding" data-bind="visible: cardView() == 'lst'">
        <div class="contacts clearfix row">
            <!--ko foreach: cards-->
            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="c-item">
                    <div class="c-info">
                        <strong data-bind="html: fullname"></strong>
                        <small data-bind="html: position"></small>
                        <small data-bind="html: department"></small>
                        <small data-bind="html: email"></small>
                        <small data-bind="html: phone"></small>
                        <!-- ko if: current == 1-->
                        <i class="fa fa-check-circle c-green" aria-hidden="true"></i>
                        <!-- /ko -->
                        <!-- ko if: current != 1-->
                        <i class="fa fa-times-circle c-red" aria-hidden="true"></i>
                        <!-- /ko -->
                    </div>
                    <div class="c-footer">
                        <button class="waves-effect" data-bind="click: $parent.editCard.bind($data, $rawData)"><i class="zmdi zmdi-person-add"></i> Edit</button>
                        <!--<button class="waves-effect btn btn-danger"><i class="zmdi zmdi-person-add"></i> Delete</button>-->
                    </div>
                </div>
            </div>
            <!--/ko-->
<!--            <div class="load-more">
                <a href=""><i class="zmdi zmdi-refresh-alt"></i> Load More...</a>
            </div>-->
        </div>
    </div>
    <div class="p-15" data-bind="visible: cardView() == 'frm' ">
        <form id="frmEdit">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fullname" class="control-label">{{ \Language::getCom('system.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
                    <div class="fg-line">
                        <input type="text" class="form-control fc-alt" name="fullname" id="fullname" data-bind="value: card().fullname" maxlength="50" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="position" class="control-label">{{ \Language::getTemplate('ecomtemplate.lbl_position') }}</label>
                    <div class="fg-line">
                        <input type="text" class="form-control fc-alt" name="position" id="position" data-bind="value: card().position" maxlength="100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="department" class="control-label">{{ \Language::getTemplate('ecomtemplate.lbl_department') }}</label>
                    <div class="fg-line">
                        <input type="text" class="form-control fc-alt" name="department" id="department" data-bind="value: card().department" maxlength="100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">{{ \Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                    <div class="fg-line">
                        <input type="email" class="form-control fc-alt" name="email" id="email" data-bind="value: card().email" maxlength="50" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">{{ \Language::getCom('system.lbl_phone') }}</label>
                    <div class="fg-line">
                        <input type="text" class="form-control fc-alt" name="phone" id="phone" onkeydown="return ( event.ctrlKey || event.altKey
                            || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                            || (95<event.keyCode && event.keyCode<106)
                            || (event.keyCode==8) || (event.keyCode==9)
                            || (event.keyCode>34 && event.keyCode<40)
                            || (event.keyCode==46) )"
                        maxlength="11" data-bind="value: card().phone">
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" name="current" id="current"><i class="input-helper"></i> {{ \Language::getTemplate('ecomtemplate.lbl_default') }}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="note">{{ \Language::getCom('system.lbl_note') }}</label>
                    <div class="fg-line">
                        <textarea class="form-control fc-alt" name="note" id="note" rows="5" data-bind="value: card().note"></textarea>
                    </div>
                </div>
                <div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
            </div>
        </div>
        </form>
    </div>
</div>
