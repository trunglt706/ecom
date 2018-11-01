@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo System::getValue('system')->keywords; ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo System::getValue('system')->description; ?>"/>
@endsection
@section('title')
<?php echo $data['content']->title; ?>
@endsection

@section('current-css')
<!-- <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/homepage.css') }}" rel="stylesheet"> -->
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/article.css') }}" rel="stylesheet">
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    <section id="article-detail" class="margin-top">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                @if (isset($data['cat_menu']->url))
                <li><a href="{{ $data['cat_menu']->url }}">{{ $data['cat_menu']->menu_name }}</a></li>
                @endif
                <li class="active">{{ $data['content']->title }}</li>
            </ol>
            <div class="row">
                <h3 class="title" style="margin-left: 17px; color: blue;">{{ $data['content']->title }}</h3>
                <div class="col-md-8">
                    <div style="padding-right: 3em; text-align: justify;">
                        <?php echo $data['content']->content;?>
                    </div>
                </div>
                <div class="col-md-4">
                    @if (count($data['contents']) != 0)
                    <strong class="text-muted text-uppercase title">{{ \Language::getTemplate('ecomtemplate.lbl_interest_content') }}</strong>
                    <ul style="background: #e5e5e5; border-radius: 10px; padding: 10px 10px 10px 40px; margin: 10px 0;">
                        @foreach ($data['contents'] as $r)
                            <li><a href="{{ $r->url }}">{{ $r->title }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                    <h3 class="text-uppercase text-warning">{{ \Language::getTemplate('ecomtemplate.lbl_featured_products') }}</h3>
                    <div class="row">
                        <div class="panel-product" style="height: initial;">
                            @foreach ($data['product'] as $product)
                            <div class="product-item product-item-feature">
                                <div class="product-caption product-caption-feature">
                                    <a class="member" href="{{ $product->member_url }}" title="{{ $product->member_name }}">{{ $product->member_name }}</a>
                                    <hr>
                                    <ul>
                                        @foreach ($product->info as $info)
                                        <li>{{ $info->field_name . ': ' . $info->value . ' ' . $info->unit }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="product-img product-img-feature" style="background-image: url('{{ $product->media }}')">
                                    <?php echo $product->new ? '<span class="new"></span>' : ''; ?>
                                    <div class="product-button">
                                        <div class="like-button" title="{{ \Language::getTemplate('ecomtemplate.lbl_add_to_favorite') }}" onclick='viewModelHeader.addToFavorite({{ $product->product_id }}, "{{ $product->product_name }}")'>
                                            <span class="fa-stack fa-lg">
                                                <i class="fa fa-circle fa-stack-2x"></i>
                                                <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </div>
                                        <div class="cart-button" title="{{ \Language::getTemplate('ecomtemplate.lbl_add_to_cart') }}" onclick='addToCart({
                                            id: "{{ $product->product_id }}",
                                            product_id: "{{ $product->product_id }}",
                                            product_name: "{{ $product->product_name }}",
                                            product_alias: "{{ $product->url }}",
                                            product_content: "{{ $product->media }}",
                                            member_id: "{{ $product->member_id }}",
                                            member_name: "{{ $product->member_name }}",
                                            member_alias: "{{ $product->member_url }}",
                                            quantity: 1})'>
                                            <span class="fa-stack fa-lg">
                                                <i class="fa fa-circle fa-stack-2x"></i>
                                                <i class="fa fa-cart-plus fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ $product->url }}">
                                        <div class="product-title" title="{{ $product->product_name }}">{{ $product->product_name }}</div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.footer'))
@endsection
