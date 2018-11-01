<div class="row">
    <div class="col-md-4">
        <legend>{{ \Language::getCom('member.lbl_member_info_detail') }}</legend>
        <div class="form-group">
            <label for="member_name" class="control-label">{{ \Language::getCom('member.lbl_member_name') }} <sup class="text-danger">(*)</sup></label>
            <input type="text" class="form-control" name="member_name" id="member_name" data-bind="value: current().member_name" required>
        </div>
        <div class="form-group">
            <label for="member_shortname" class="control-label">{{ \Language::getCom('member.lbl_member_shortname') }}</label>
            <input type="text" class="form-control" name="member_shortname" id="member_shortname" data-bind="value: current().member_shortname">
        </div>
        <div class="form-group">
            <label for="member_othername" class="control-label">{{ \Language::getCom('member.lbl_member_othername')}}</label>
            <input type="text" class="form-control" name="member_othername" id="member_othername" data-bind="value: current().member_othername">
        </div>
        <div class="form-group">
            <label for="member_tin" class="control-label">{{ \Language::getCom('member.lbl_member_tin')}}</label>
            <input type="text" class="form-control" name="member_tin" id="member_tin" data-bind="value: current().member_tin">
        </div>
        <div class="form-group">
            <label for="member_address" class="control-label">{{ \Language::getCom('member.lbl_member_address') }} <sup class="text-danger">(*)</sup></label>
            <input type="text" class="form-control" name="member_address" id="member_address" data-bind="value: current().member_address" required>
        </div>
        <div class="form-group">
            <label for="member_phone" class="control-label">{{ \Language::getCom('member.lbl_member_phone') }} <sup class="text-danger">(*)</sup></label>
            <input type="text" class="form-control" name="member_phone" id="member_phone" data-bind="value: current().member_phone" required
                   onkeydown="return ( event.ctrlKey || event.altKey
                || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                || (95<event.keyCode && event.keyCode<106)
                || (event.keyCode==8) || (event.keyCode==9)
                || (event.keyCode>34 && event.keyCode<40)
                || (event.keyCode==46) )"
            maxlength="20">
        </div>
        <div class="form-group">
            <label for="member_fax" class="control-label">{{ \Language::getCom('member.lbl_member_fax') }}</label>
            <input type="text" class="form-control" name="member_fax" id="member_fax" data-bind="value: current().member_fax"
                    onkeydown="return ( event.ctrlKey || event.altKey
                || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                || (95<event.keyCode && event.keyCode<106)
                || (event.keyCode==8) || (event.keyCode==9)
                || (event.keyCode>34 && event.keyCode<40)
                || (event.keyCode==46) )"
            maxlength="20">
        </div>
    </div>
    <div class="col-md-4">
        <legend>{{ \Language::getCom('member.lbl_member_info_link') }}</legend>
        <div class="form-group">
            <label for="member_alias" class="control-label">{{ \Language::getCom('member.lbl_member_alias') }} </label>
            <input type="text" class="form-control" name="member_alias" id="member_alias" data-bind="value: current().member_alias">
        </div>
        <div class="form-group">
            <label for="member_email" class="control-label">{{ \Language::getCom('member.lbl_member_email') }} </label>
            <input type="email" class="form-control" name="member_email" id="member_email" data-bind="value: current().member_email">
        </div>
        <div class="form-group">
            <label for="member_website" class="control-label">{{ \Language::getCom('member.lbl_member_website') }}</label>
            <input type="text" class="form-control" name="member_website" id="member_website" data-bind="value: current().member_website">
        </div>
        <div class="form-group">
            <label for="member_facebook" class="control-label">{{ \Language::getCom('member.lbl_member_facebook') }}</label>
            <input type="text" class="form-control" name="member_facebook" id="member_facebook" data-bind="value: current().member_facebook">
        </div>
        <div class="form-group">
            <label for="member_twitter" class="control-label">{{ \Language::getCom('member.lbl_member_twitter') }}</label>
            <input type="text" class="form-control" name="member_twitter" id="member_twitter" data-bind="value: current().member_twitter">
        </div>
        <div class="form-group">
            <label for="member_google" class="control-label">{{ \Language::getCom('member.lbl_member_google') }}</label>
            <input type="text" class="form-control" name="member_google" id="member_google" data-bind="value: current().member_google">
        </div>
        <div class="form-group">
            <label for="member_youtube" class="control-label">{{ \Language::getCom('member.lbl_member_youtube') }}</label>
            <input type="text" class="form-control" name="member_youtube" id="member_youtube" data-bind="value: current().member_youtube">
        </div>
    </div>
    <div class="col-md-4">
        <legend>{{ \Language::getCom('member.lbl_member_info_vpa') }}</legend>
        <div class="form-group">
            <label for="sort" class="control-label">{{ \Language::getCom('member.lbl_sort') }}</label>
            <input type="number" class="form-control" name="sort" id="sort" data-bind="value: current().sort" min="0">
        </div>
        <div class="form-group">
            <label for="member_types" class="control-label">{{ \Language::getCom('member.lbl_member_types') }}</label>
            <select class="select2" id="member_types" name="member_types" multiple>
                <option value="supplier">{{ \Language::getCom('member.lbl_member_supplier') }}</option>
                <option value="customer">{{ \Language::getCom('member.lbl_member_customer') }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="member_categories" class="control-label">{{ \Language::getCom('member.lbl_member_category') }}</label>
            <select class="select2" id="member_categories" name="member_categories" multiple>
                @foreach (DB::table('member_categories')->select('id', 'category_name')->get() as $member_category)
                <option value="{{ $member_category->id }}">{{ $member_category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="lang" class="control-label">{{ \Language::getCom('system.lbl_language') }} <sup class="text-danger">(*)</sup></label>
            <select class="form-control" id="lang" name="lang" data-bind="value: current().lang" required>
                @foreach(Language::getLang() as $code=>$lang)
                <option value="{{ $code }}">{{ $lang }}</option>
                @endforeach
            </select>
        </div>
        <!--ko if: current().member_approve == -1-->
        <div class="btn-group">
            <label class="btn btn-default" data-bind="css: { 'active': approve() == -1 }">
                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                <input type="radio" name="options" id="option1" value="-1" data-bind="checked: approve, checkedValue: -1"> Chờ duyệt
            </label>
            <label class="btn btn-danger" data-bind="css: { 'active': approve() == 0 }">
                <i class="fa fa-times" aria-hidden="true"></i>
                <input type="radio" name="options" id="option2" value="0" data-bind="checked: approve, checkedValue: 0"> Không duyệt
            </label>
            <!--ko if: current().member_level == 0-->
            <label class="btn btn-success" data-bind="css: { 'active': approve() == 1 }">
                <i class="fa fa-check" aria-hidden="true"></i>
                <input type="radio" name="options" id="option3" value="1" data-bind="checked: approve, checkedValue: 1"> Chính thức
            </label>
            <!--/ko-->
            <!--ko if: current().member_level == 1-->
            <label class="btn btn-warning" data-bind="css: { 'active': approve() == 1 }">
                <i class="fa fa-check" aria-hidden="true"></i>
                <input type="radio" name="options" id="option3" value="1" data-bind="checked: approve, checkedValue: 1"> Thăng hạng
            </label>
            <!--/ko-->
        </div>
        <!--/ko-->
        <!--ko if: method() != 'add'-->
        <!--ko if: current().member_approve == -1 && current().member_level == 1-->
        <div class="form-group">
            <label for="start_at" class="control-label">{{ \Language::getCom('member.lbl_start_at') }}</label>
            <input type="date" class="form-control" name="start_at" id="start_at" data-bind="value: current().start_at" readonly>
        </div>
        <div class="form-group">
            <label for="ended_at" class="control-label">{{ \Language::getCom('member.lbl_ended_at') }}</label>
            <input type="date" class="form-control" name="ended_at" id="ended_at" data-bind="value: current().ended_at" readonly>
        </div>
        <!--/ko-->
        <!--ko if: current().member_approve != -1-->
        <div class="form-group">
            <label for="member_level" class="control-label">{{ \Language::getCom('member.lbl_member_level_render') }}</label>
            <div class="btn-group">
                <!--ko if: current().member_level != 2-->
                <label class="btn btn-default" data-bind="css: { 'active': level() == 0 }">
                    <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                    <input type="radio" name="options" id="option1" value="-1" data-bind="checked: level, checkedValue: 0"> Hủy duyệt
                </label>
                <!--/ko-->
                <label class="btn btn-success" data-bind="css: { 'active': level() == 1 }">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    <input type="radio" name="options" id="option2" value="0" data-bind="checked: level, checkedValue: 1"> Chính thức
                </label>
                <label class="btn btn-warning" data-bind="css: { 'active': level() == 2 }">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <input type="radio" name="options" id="option2" value="0" data-bind="checked: level, checkedValue: 2"> Hạng vàng
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="active" id="active"> {{ \Language::getCom('member.lbl_member_block') }}</label>
            </div>
        </div>
        <!--/ko-->
        <!--/ko-->
        <div class="form-group" data-bind="visible: (approve() == 0 || level() != current().member_level) && method() != 'add'">
            <label for="note" class="control-label">{{ \Language::getCom('member.lbl_note') }} <sup class="text-danger">(*)</sup></label>
            <textarea class="form-control" name="note" id="note" data-bind="value: current().note" required></textarea>
        </div>
    </div>
</div>
<div class="form-note"><sup class="text-danger">(*)</sup> <span class="text-muted">{{ Language::get('global.message_form_input_required') }}</span></div>
