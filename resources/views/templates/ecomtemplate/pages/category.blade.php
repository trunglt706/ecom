@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo $data['page']->menu_name; ?>
@endsection

@section('current-css')
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/homepage.css') }}" rel="stylesheet">
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/select2.min.css') }}" rel="stylesheet">
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/select2-bootstrap.css') }}" rel="stylesheet">
@endsection

@section('jsc')
<script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/select2.min.js') }}"></script>
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    <section id="product_category" class="margin-top no-banner">
        <div class="container main">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                @if ($data['members'] != '')
                <li class="active">{{ $data['page']->menu_name }}</li>
                <li>
                    <select class="select2" id="members" name="members">
                        @foreach ($data['members'] as $member)
                        <option value="{{ $member->member_alias }}">{{ $member->member_name }}</option>
                        @endforeach
                    </select>
                </li>
                <script>
                    $('.select2').select2({width: '80%', language: '{{ \App::getLocale() }}', placeholder: ""});
                    $(document).ready(function () {
                        $('#members').on("select2:select", function () {
                            if ($('#members').val() != '')
                                location.href = '{{ $data['page']->alias }}/' + $(this).val();
                        });
                    });
                </script>
                @else
                <li><a href="{{ \Path::url($data['page']->lang . '/' . $data['page']->alias) }}">{{ $data['page']->menu_name }}</a></li>
                <li class="active">{{ $data['member'] }}</li>
                @endif
            </ol>
            <h2 class="title text-uppercase">{{ $data['page']->menu_name }} <small class="text-lowercase">{{ $data['count'] . ' ' . \Language::getTemplate('ecomtemplate.lbl_product') }}</small></h2>
            @foreach($data['products'] as $product)
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="thumbnail">
                    <div class="img-background" style="width: 100%; height: 150px; background-image: url('{{ $product->media }}')">
                        <?php echo $product->new ? '<span class="new"></span>' : ''; ?>
                        <a href="{{ $product->url }}"></a>
                        <div class="toolbar">
                            <div onclick='addToCart({
                                id: "{{ $product->product_id }}",
                                product_id: "{{ $product->product_id }}",
                                product_name: "{{ $product->product_name }}",
                                product_alias: "{{ $product->url }}",
                                product_content: "{{ $product->media }}",
                                member_id: "{{ $product->member_id }}",
                                member_name: "{{ $product->member_name }}",
                                member_alias: "{{ $product->member_alias }}",
                                quantity: 1})'><i class="zmdi zmdi-shopping-cart"></i></div>
                            <!--<div href="{{ $product->url }}"><i class="zmdi zmdi-search"></i></div>-->
                        </div>
                    </div>
                    <div class="caption">
                        <a href="{{ $product->url }}" title="{{ $product->product_name }}">{{ $product->product_name }}</a>
                        <a class="member" href="{{ $product->member_url }}" title="{{ $product->member_name }}">{{ $product->member_name }}</a>
                        <!--<span class="price"><small class="pull-right text-right">Hơn 2,5k lượt mua<br>tuần qua</small></span>-->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.footer'))
@endsection
