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

@section('css')
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/table.css') }}" rel="stylesheet">
@endsection

@section('jsc')
<script>
    var errorConnect = function () {
        toastr['error']('{{ \Language::get("global.message_crud_error_connect") }}');
    };
</script>
@if( file_exists(config('data.PATH_MODEL').'/CKEditor/') )
<script src="{{ Path::urlCom('ckeditor/ckeditor.js') }}"></script>
@endif
@endsection

@section('section')
    <section id="member_contacts" class="margin-top">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                <li><a href="{{ $data['menus']->member }}">{{ $data['menus']->member_name }}</a></li>
                <li><a href="{{ $data['member']->url }}">{{ $data['member']->member_name }}</a></li>
                <li><a href="dashboard">Dashboard</a></li>
                <li class="active">{{ \Language::getTemplate('ecomtemplate.lbl_contact_manager') }}</li>
            </ol>
            <h2 class="text-uppercase" style="font-family: 'Arial'"><i class="fa fa-envelope" aria-hidden="true"></i> <strong>{{ \Language::getTemplate('ecomtemplate.lbl_contact_manager') }}</strong></h2>
            <section id="member_model">
                @include(Path::viewCurrentTemplate($data['page']->lang, 'forms.toolbar'))
                @include(Path::viewCurrentTemplate($data['page']->lang, 'forms.member_model'))
                <div data-bind="visible: view()==='form'" style="display: none;">
                    <form role="form" id="edit-form">
                        @include(Path::viewCurrentTemplate($data['page']->lang, 'forms.member_contact'))
                    </form>
                </div>
            </section>
            @include(Path::viewCurrentTemplate($data['page']->lang, 'forms.mainScript'))
        </div>
    </section>
@endsection
