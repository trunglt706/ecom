<?php
$akey                = App\Com\FileManager\FileManager::getSecretKey();
$filemanager_path    = 'filemanager?akey=' . $akey;
$member_product_path = 'member?product_id=';
?>

<link href="{{ Path::urlCom('member/css/admin.member.css') }}" rel="stylesheet">
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="memberTablist">
        <li class="active"><a href="#panDetail" aria-controls="panDetail" role="tab" data-toggle="tab">{{ \Language::getCom('member.lbl_general_info') }}</a></li>
        <li><a href="#panUser" aria-controls="panUser" role="tab" data-toggle="tab">{{ \Language::getCom('member.lbl_member_user') }}</a></li>
        <li><a href="#panInfo" aria-controls="panInfo" role="tab" data-toggle="tab">{{ \Language::getCom('member.lbl_info') }}</a></li>
        <!--ko if: current().member_approve !== -1-->
        <li><a class="hidden" href="#panApprove" aria-controls="panApprove" role="tab" data-toggle="tab">{{ \Language::getCom('member.lbl_approve_history') }}</a></li>
        <li><a href="#panMedia" aria-controls="panMedia" role="tab" data-toggle="tab">{{ \Language::getCom('member.lbl_media') }}</a></li>
        <!--<li><a href="#panCertificate" aria-controls="panCertificate" role="tab" data-toggle="tab">{{ \Language::getCom('member.lbl_certificate') }}</a></li>-->
        <li><a href="#panProduct" aria-controls="panProduct" role="tab" data-toggle="tab">{{ \Language::getCom('member.lbl_product') }}</a></li>
        <!--/ko-->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="panDetail">
            @include(Path::viewAdminCom('member.pages.member'))
        </div>
        <div role="tabpanel" class="tab-pane" id="panUser">
            @include(Path::viewAdminCom('member.pages.member_user'))
        </div>
        <div role="tabpanel" class="tab-pane" id="panInfo">
            @include(Path::viewAdminCom('member.pages.member_info'))
        </div>
        <!--ko if: current().member_approve !== -1-->
        <div role="tabpanel" class="tab-pane hidden" id="panApprove">
            @include(Path::viewAdminCom('member.pages.member_level_approve'))
        </div>
        <div role="tabpanel" class="tab-pane" id="panMedia">
            @include(Path::viewAdminCom('member.pages.member_media'))
        </div>
        <!--        <div role="tabpanel" class="tab-pane" id="panCertificate">
                    Đang cập nhật
                </div>-->
        <div role="tabpanel" class="tab-pane" id="panProduct">
            @include(Path::viewAdminCom('member.pages.member_product'))
        </div>
        <!--/ko-->
    </div>
</div>

@section('incAdd')
$('#memberTablist a:first').tab('show');
$('#member_types').select2('val', '');
$('#member_categories').select2('val', '');
$('#active').prop('checked', false);
self.approve(1);
self.level(0);
@endsection

@section('incUpd')
$('#memberTablist a:first').tab('show');
$('#member_types').select2('val', JSON.parse(self.current().member_types));
$('#member_categories').select2('val', JSON.parse(self.current().member_categories));
$('#active').prop('checked', !self.current().active);
self.approve(self.current().member_approve);
self.level(self.current().member_level);

CKEDITOR.instances.info_about.setData(self.current().info_about);
CKEDITOR.instances.info_contact.setData(self.current().info_contact);
CKEDITOR.instances.info_basic.setData(self.current().info_basic);
CKEDITOR.instances.info.setData(self.current().info);
CKEDITOR.instances.info_factory.setData(self.current().info_factory);
CKEDITOR.instances.info_commerce.setData(self.current().info_commerce);
self.memberMedia();
self.memberProduct();

self.fetchUser();
self.userView('tbl');
@endsection

@section('incSave')
self.current().member_types = JSON.stringify($('#member_types').val());
self.current().member_categories = JSON.stringify($('#member_categories').val());

self.current().info_about = CKEDITOR.instances.info_about.getData();
self.current().info_contact = CKEDITOR.instances.info_contact.getData();
self.current().info_basic = CKEDITOR.instances.info_basic.getData();
self.current().info = CKEDITOR.instances.info.getData();
self.current().info_factory = CKEDITOR.instances.info_factory.getData();
self.current().info_commerce = CKEDITOR.instances.info_commerce.getData();

if (self.current().member_approve == -1) {
self.current().approve = self.approve();
}
else {
self.current().level = self.level();
self.current().active = $('#active').prop('checked') ? 0 : 1;
self.current().memberMedias = ko.mapping.toJS(self.memberMedias);
var bg = $('#image0').css('background-image');
self.current().memberMedias[0]['medias'][0]['content'] = bg.substr(bg.indexOf('{{ config("data.UPLOAD_DIR") }}')).replace('\"\)', '');
console.log(self.current().memberMedias[0]['medias']);
self.current().memberProducts = ko.mapping.toJS(self.memberProducts);
self.current().member_user = JSON.stringify(self.users());
}
@endsection

@section('incFun')
self.sortorder('asc');
self.sortdatafield('member_approve');
self.approve = ko.observable(-1);
self.level = ko.observable(0);
self.memberMedias = ko.mapping.fromJS([]);
self.memberMedia = function() {
$.ajax({url: '{{ $uri }}/member-media', type: 'post', data: {_token: '{{ csrf_token() }}', member_id: self.current().id },
beforeSend: showAppLoader,
error: errorConnect,
complete: function () {
hideAppLoader();
},
success: function (data) {
ko.mapping.fromJS(data, self.memberMedias);
}
});
};
self.chooseMedia = function(element_id) {
open_popup('{{ $filemanager_path }}' + '&fieldID=' + element_id);
};
self.chooseImage = function(element_id) {
open_popup('{{ $filemanager_path }}' + '&backgroundID=' + element_id);
};
self.memberAddMedia = function(idx, item) {
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
self.memberDelMedia = function(item, list) {
list.medias.remove(item);
};

self.userView = ko.observable('tbl');
self.users = ko.observableArray([]);
self.user = ko.observable({});
self.fetchUser = function() {
$.ajax({url: '{{ $uri }}/user', type: 'post', data: {_token: '{{ csrf_token() }}', member_tin: self.current().member_tin},
beforeSend: showLoading , error: errorConnect, complete: hideLoading,
success: function (data) {
self.users(data);
tableRefesh('#table-user');
}
});
};
self.addUser = function() {
self.userView('frm');
self.user({
idx: self.users().length,
fullname: '',
address: '',
email: '',
phone: 0,
note: '',
username: '',
user_group_id: 1,
active: 1,
ic: '',
ic_certified_by: ''
});
};
self.cancelUser = function() {
self.userView('tbl');
self.user({});
};
self.editUser = function(row) {
self.userView('frm');
self.user(row);
$('#user_group_id').select2('val', self.user().user_group_id);
};
self.saveUser = function() {
self.users.remove(function (item) { return item.idx == self.user().idx; });
self.users.push(self.user());
self.user({});
self.userView('tbl');
tableRefesh('#table-user');
};
self.delUser = function(){
$('.tblUserCheckbox').each(function(index){
var idx = $(this).val();
if($(this).is(':checked')) self.users.remove(function (item) { return item.idx == idx; });
});
};

self.memberProducts = ko.mapping.fromJS([]);
self.memberProduct = function() {
$.ajax({url: '{{ $uri }}/member-product', type: 'post', data: {_token: '{{ csrf_token() }}', member_id: self.current().id },
beforeSend: showAppLoader,
error: errorConnect,
complete: function () {
hideAppLoader();
},
success: function (data) {
ko.mapping.fromJS(data, self.memberProducts);
}
});
};
self.chooseProduct = function(element_id) {
open_popup('{{ $filemanager_path }}' + '&fieldID=' + element_id);
};
self.checkProduct = function(item) {
item.approved(!item.approved());
};
@endsection
