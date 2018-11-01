@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo strip_tags($data['page']->menu_name); ?>
@endsection

@section('current-css')
<!--<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/register.css') }}" rel="stylesheet">-->
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    <section id="active" class="margin-top">
        <div class="container main" style="height: 500px; padding-top: 150px;">
            <div class="m-t-30 f-300 text-center" style="font-size: 30px;">{{ $data['response'] }}</div>
        </div>
    </section>
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.footer'))
@endsection

@section('jsc')
<script type="text/javascript">
    // validate form
    $(document).ready(function() {
        setTimeout(function(){ window.location.href = "{{ \Path::url('/') }}";}, 2000);
    });
</script>
@endsection
