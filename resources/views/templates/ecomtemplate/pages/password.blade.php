@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo \System::getValue($data['page']->lang); ?>
@endsection

@section('current-css')
<!--<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/register.css') }}" rel="stylesheet">-->
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    <section id="active">
        <div class="container" style="height: 300px; padding-top: 100px;">
            <div class="col-sm-4 col-sm-offset-4">
                <form id="frmChange">
                    <h3 class="text-center" style="margin-bottom: 5px;">{{ \Language::getTemplate('ecomtemplate.lbl_change_pass') }}</h3>
                    <div class="form-group">
                        <div class="fg-line">
                            <input type="password" class="form-control fc-alt" id="change" required placeholder="{{ Language::getTemplate('ecomtemplate.lbl_new_password') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fg-line">
                            <input type="password" class="form-control fc-alt" id="rechange" required placeholder="{{ Language::getTemplate('ecomtemplate.lbl_re_new_password') }}">
                        </div>
                    </div>
                    <div id="btnChange" class="btn btn-primary waves-effect">{{ Language::getTemplate('ecomtemplate.lbl_change_pass') }}</div>
                </form>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $('#btnChange').on('click', function () {
            $.post("{{ Path::urlSite('ecom/change') }}", {
                password: $('#change').val(),
                repassword: $('#rechange').val(),
                _token: '{{ csrf_token() }}',
                user: {{ $data['user']->id }}
            }, function( data ) {
                toastr[data.status](data.message);
                if (data.status === 'success')
                    location.href = '{{ $data['menus']->index }}';
            });
        });
    </script>
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.footer'))
@endsection

@section('jsc')
<script type="text/javascript">
    // $(document).ready(function() {
    //     setTimeout(function(){ window.location.href = "{{ \Path::url('/') }}";}, 2000);
    // });
</script>
@endsection
