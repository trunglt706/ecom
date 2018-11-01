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

@section('section')
    <section id="member_dashboard" class="margin-top">
        <div class="container dashboard" style="margin-bottom: 50px; margin-top: 20px;">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                <li><a href="{{ $data['menus']->member }}">{{ $data['menus']->member_name }}</a></li>
                @if ($data['is_supplier'])
                <li><a href="{{ $data['member']->url }}">{{ $data['member']->member_name }}</a></li>
                @endif
                <li class="active">{{ \Language::getTemplate('ecomtemplate.lbl_dashboard') }}</li>
            </ol>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="text-center">
                        <h2 class="text-uppercase" style="font-family: 'Arial'"><strong>{{\Language::getTemplate('ecomtemplate.lbl_my_enterprise_manager')}}</strong> <sup><small>©</small></sup></h2>
                        @if ($data['is_supplier'])
                        <a class="btn btn-default btn-large" href="{{ $data['member']->url }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_enterprise_page') }}</div>
                        </a>
                        @if (!$data['request_member'])
                        <a class="btn btn-default btn-large" href="quote">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_quote_manager') }}</div>
                        </a>
                        <a class="btn btn-default btn-large" href="sample">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_sample_manager') }}</div>
                        </a>
                        @endif
                        <a class="btn btn-default btn-large" href="contact">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_contact_manager') }}</div>
                        </a>
                        <a class="btn btn-default btn-large" href="products">
                            <i class="fa fa-cubes" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_product_manager') }}</div>
                        </a>
                        <a class="btn btn-default btn-large" href="certificates">
                            <i class="fa fa-certificate" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_certificate_manager') }}</div>
                        </a>
                        @endif
                        @if ($data['is_customer'])
                         <a class="btn btn-default btn-large" href="request">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_request_manager') }}</div>
                        </a>
                        @endif
                        <a class="btn btn-default btn-large" href="card">
                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_card_manager') }}</div>
                        </a>
                        <a class="btn btn-default btn-large" href="users">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_user_manager') }}</div>
                        </a>
<!--                        <a class="btn btn-default btn-large" href="ads">
                            <i class="fa fa-flag" aria-hidden="true"></i>
                            <div>{{ \Language::getTemplate('ecomtemplate.lbl_ads_manager') }}</div>
                        </a>-->
                    </div>
                </div>
                <div class="col-sm-12">

                </div>
            </div>
        </div>
    </section>

@endsection
