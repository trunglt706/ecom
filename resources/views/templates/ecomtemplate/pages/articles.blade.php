@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo System::getValue('system')->keywords; ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo System::getValue('system')->description; ?>"/>
@endsection
@section('title')
<?php echo strip_tags($data['page']->menu_name); ?>
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
            <li class="active">{{ strip_tags($data['page']->menu_name) }}</li>
        </ol>
        <div class="row">
            <div class="col-md-8">
                @foreach ($data['contents'] as $content_mem)
                <div class="media">
                    <div class="pull-left">
                        <a class="lv-item" href="{{ $content_mem->url }}"><img class="media-object img-background" width="110px" height="80px" src="{{ $content_mem->image!= '' ? config("data.PATH_ROOT").$content_mem->image : \Path::urlCurrentTemplate($data['page']->lang, 'images/product_bg.jpg') }}" alt=""></a>
                    </div>
                    <div class="media-body">
                        <div style="font-size:20px;"><a class="lv-item" href="{{ $content_mem->url }}">{{ $content_mem->title }}</a></div>
                        <small><i class="glyphicon glyphicon-time"></i>{{$content_mem->created_at}}</small>
                        <section style="margin:0px; color:#000;">
                            <?php echo \App\Com\Content\Content::split_word($content_mem->content, 40) ?>
                        </section>
                    </div>
                    <div class="pull-right"><a class="btn btn-link btn-sm btn-xs waves-effect" style="color:#21A3F6;" href="{{ $content_mem->url }}">{{ Language::getTemplate('ecomtemplate.lbl_read_more') }}<span class="glyphicon glyphicon-chevron-right"></span></a></div>
                </div>
                <hr>
                @endforeach
            </div>
            <div class="col-md-4">
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
                                            id:"{{ $product->product_id }}",
                                                        product_id:"{{ $product->product_id }}",
                                                                    product_name:"{{ $product->product_name }}",
                                                                                product_alias:"{{ $product->url }}",
                                                                                            product_content:"{{ $product->media }}",
                                                                                                        member_id:"{{ $product->member_id }}",
                                                                                                                    member_name:"{{ $product->member_name }}",
                                                                                                                                member_alias:"{{ $product->member_url }}",
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
