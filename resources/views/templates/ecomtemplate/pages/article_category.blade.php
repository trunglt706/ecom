@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo env('APP_SITE_NAME'); ?>
@endsection

@section('current-css')
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/category.css') }}" rel="stylesheet">
@endsection

@section('main')
  @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
  
  @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.footer'))
@endsection
