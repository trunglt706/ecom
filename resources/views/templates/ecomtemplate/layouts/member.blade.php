@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('current-css')
<!-- <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/homepage.css') }}" rel="stylesheet"> -->
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/member.css') }}" rel="stylesheet">
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    @yield('section')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.footer'))
    <!-- <script type="text/javascript">
        var validate = $('#frmEdit').validate({
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
    </script> -->
@endsection
