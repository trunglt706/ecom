@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo System::getValue('system')->keywords; ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo System::getValue('system')->description; ?>"/>
@endsection
@section('title')
<?php echo \System::getValue($data['page']->lang); ?>
@endsection

@section('current-css')
<!-- <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/homepage.css') }}" rel="stylesheet"> -->
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    {!! Block::render($data['blocks'], 'slider', 'slideshow') !!}
    <div class="product-feature">
        <div class="container">
            {!! Block::render($data['blocks'], 'product_option', 'top-a') !!}
        </div>
    </div>
    <div class="ad-top ad-top-a">
        <div class="container">
            <div class="ad-title">{{ \Language::getTemplate('ecomtemplate.lbl_ads') }}</div>
            {!! Block::render($data['blocks'], 'customhtml', 'top-a') !!}
        </div>
    </div>
    <div class="product-category product-category-top-b">
        <div class="container">
            {!! Block::render($data['blocks'], 'product_category', 'top-b') !!}
        </div>
    </div>
    <div class="ad-top ad-top-b">
        <div class="container">
            <div class="ad-title">{{ \Language::getTemplate('ecomtemplate.lbl_ads') }}</div>
            {!! Block::render($data['blocks'], 'customhtml', 'top-b') !!}
        </div>
    </div>
    <div class="product-category product-category-top-c">
        <div class="container">
            {!! Block::render($data['blocks'], 'product_category', 'top-c') !!}
        </div>
    </div>
    <div class="ad-top ad-top-c">
        <div class="container">
            <div class="ad-title">{{ \Language::getTemplate('ecomtemplate.lbl_ads') }}</div>
            {!! Block::render($data['blocks'], 'customhtml', 'top-c') !!}
        </div>
    </div>
    <div class="product-category product-category-top-d">
        <div class="container">
            {!! Block::render($data['blocks'], 'product_category', 'top-d') !!}
        </div>
    </div>
    <div class="ad-top ad-top-d">
        <div class="container">
            <div class="ad-title">{{ \Language::getTemplate('ecomtemplate.lbl_ads') }}</div>
            {!! Block::render($data['blocks'], 'customhtml', 'top-d') !!}
        </div>
    </div>
    <div class="product-category product-category-bottom-a">
        <div class="container">
            {!! Block::render($data['blocks'], 'product_category', 'bottom-a') !!}
        </div>
    </div>
    <div class="ad-top ad-bottom-a">
        <div class="container">
            <div class="ad-title">{{ \Language::getTemplate('ecomtemplate.lbl_ads') }}</div>
            {!! Block::render($data['blocks'], 'customhtml', 'bottom-a') !!}
        </div>
    </div>
    {!! Block::render($data['blocks'], 'product_category', 'bottom-b') !!}
    {!! Block::render($data['blocks'], 'customhtml', 'bottom-b') !!}
    {!! Block::render($data['blocks'], 'product_category', 'bottom-c') !!}
    {!! Block::render($data['blocks'], 'customhtml', 'bottom-c') !!}
    {!! Block::render($data['blocks'], 'member_option', 'bottom-d') !!}
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.footer'))
@endsection
