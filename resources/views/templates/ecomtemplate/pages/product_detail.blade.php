@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta property="og:title" content="{!! $data['product']->product_name !!}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ $data['product']->url }}" />
<meta property="og:image" content="{{ 'http://mekongfishmarket.com' . $data['product']->media }}" />
<meta property="og:image:width" content="375" />
<meta property="og:image:height" content="420" />
<meta property="og:description" content="{!! (isset($data['product']->desc) && $data['product']->desc != '') ? $data['product']->desc : System::getValue('system')->description !!}" />
<meta name="description" content="{!! (isset($data['product']->desc) && $data['product']->desc != '') ? $data['product']->desc : System::getValue('system')->description !!}"/>
@endsection
@section('title')
<?php echo $data['product']->product_name; ?>
@endsection

@section('current-css')
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/homepage.css') }}" rel="stylesheet">
<link href="{{ \Path::urlCurrentTemplate($data['page']->lang, 'css/product_detail.css') }}" rel="stylesheet">
@endsection

@section('main')
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.header'))
    <section id="product-detail" class="margin-top">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                <li><a href="{{ $data['menus']->category }}">{{ $data['menus']->category_name }}</a></li>
                <li class="active">{{ $data['product']->product_name }}</li>
            </ol>
            <h2 class="title text-uppercase">{{ $data['product']->product_name }}</h2>
            <div class="row product-detail">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <div class="img-background" style="width: 100%; height: 420px; background-image: url('{{ $data['product']->media }}')">
                            <!-- <span class="best-sell"></span> -->
                        </div>
                    </div>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect text-center" data-toggle="modal" data-target="#hinhanh_modal">
                        <i class="zmdi zmdi-collection-image f-20"></i><br>
                        {{ \Language::getTemplate('ecomtemplate.lbl_image') }}
                    </div>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect text-center" data-toggle="modal" data-target="#gioithieu_modal">
                        <i class="zmdi zmdi-comment-video f-20"></i><br>
                        {{ \Language::getTemplate('ecomtemplate.lbl_about') }}
                    </div>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect text-center" data-toggle="modal" data-target="#congthuc_modal">
                        <i class="zmdi zmdi-cutlery f-20"></i><br>
                        {{ \Language::getTemplate('ecomtemplate.lbl_recipe') }}
                    </div>
                    <div class="modal" id="hinhanh_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loader" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="text-muted">{{ \Language::getTemplate('ecomtemplate.lbl_image_about') }} {{ $data['product']->product_name }}</h4>
                                </div>
                                <div class="modal-body">
                                    
                                    <div class="lightbox clearfix">
                                        <div data-src="{{ $data['product']->media }}" class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 10px;">
                                            <div class="lightbox-item p-item">
                                                <img src="{{ $data['product']->media }}">
                                            </div>
                                        </div>
                                        @foreach ($data['product']->media_detail as $pmd)
                                        <div data-src="{{ isset($pmd->media) ? $pmd->media : '' }}" class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 10px;">
                                            <div class="lightbox-item p-item">
                                                <img src="{{ isset($pmd->media) ? $pmd->media : '' }}">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="gioithieu_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loader" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4>{{ \Language::getTemplate('ecomtemplate.lbl_about') }}</h4>
                                </div>
                                <div class="modal-body">
                                    @if (isset($data['product']->desc) && $data['product']->desc != '')
                                    <?php echo $data['product']->desc; ?>
                                    @else
                                    {{ \Language::getTemplate('ecomtemplate.lbl_update') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="congthuc_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loader" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @if (count($data['contents']) != 0)
                                    <h2 class="text-center">{{ $data['contents'][0]->title }}</h2>
                                    @endif
                                </div>
                                <!--<div class="close z-depth-2" data-dismiss="modal"><i class="zmdi zmdi-close"></i></div>-->
                                <div class="modal-body">
                                    @if (count($data['contents']) != 0)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {!! $data['contents'][0]->content !!}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
<!--                    <div class="clearfix">
                        <div class="pull-left">
                            <span class="price-lg text-danger">60.000<sup>VNĐ</sup></span><br>
                            <strong class="text-uppercase">Trọng lượng:</strong> 100g
                        </div>
                        <div class="pull-right text-right">
                            <span class="text-muted">Giá cũ</span><br>
                            <strong class="text-uppercase text-danger text-decoration price">75.000<sup>VNĐ</sup></strong>
                        </div>
                    </div>-->
                    <!-- <fieldset>
                        <legend><b class="text-uppercase text-muted">{{ \Language::getTemplate('ecomtemplate.lbl_promotion') }}</b></legend>
                        - Cập nhật những thông tin khuyến mãi sớm nhất.
                    </fieldset> -->
                    <a class="text-primary"><i class="zmdi zmdi-phone"></i> {{ \Language::getTemplate('ecomtemplate.lbl_call_order') }}:</a>
                    <ul>
                        <li><b>1800.1060</b> ({{ \Language::getTemplate('ecomtemplate.lbl_free') }})</li>
                        <li><b>08.38102102</b> (7:30 - 22:00)</li>
                    </ul>
                    <!--<a class="text-primary"><i class="zmdi zmdi-pin"></i> Tìm các điểm mua gần bạn</a>-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">{{ \Language::getTemplate('ecomtemplate.lbl_quantity') }}:</label>
                        <div class="col-md-4">
                            <input type="number" value="1" step="1" min="1" class="form-control fc-alt" id="car_quantity">
                        </div>
                    </div>
                    </br>
                    </br>
                    <div class="form-group">
                        <div class="btn bgm-orange waves-effect btn-block btn-lg btn-icon-text" id="add_to_cart">
                            <i class="zmdi zmdi-shopping-cart-plus"></i> {{ \Language::getTemplate('ecomtemplate.lbl_add_to_cart') }}
                        </div>
                        <!-- <a class="btn btn-primary waves-effect btn-block btn-lg btn-icon-text" href="{{ $data['menus']->sample }}">
                            <?php echo $data['page']->button ?>
                        </a> -->
                        <div class="btn btn-primary waves-effect btn-block btn-lg btn-icon-text" id="request_sample">
                            <?php echo $data['page']->button ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <strong class="text-muted text-uppercase" style=" margin-left: 10px;">{{ \Language::getTemplate('ecomtemplate.lbl_about_enterprise') }}</strong>
                    <div class="row">
                        <div class="col-md-12" style=" margin-left: 10px;">
                            <a href="{{ $data['product']->member_url }}" class="thumbnail text-middle">
                                <div class="col-xs-5">
                                    <img width="100%" src="{{ $data['product']->member_media }}" alt="">
                                </div>
                                <div class="col-xs-7 text-uppercase text-warning">
                                    <strong>{{ $data['product']->member_name }}</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 10px;">
                        @if($data['product']->info_basic == '')
                        <h4 style="text-align: center;">{{Language::getTemplate('ecomtemplate.lbl_info_basic') }}</h4>
                        @else
                        {!! $data['product']->info_basic !!}
                        @endif
                    </div>
                    <div class="row" style="margin-top: 30px; margin-left: 10px; margin-bottom: 20px;">
                        @if (count($data['contents']) != 0)
                    <strong class="text-muted text-uppercase" >{{ \Language::getTemplate('ecomtemplate.lbl_cooking_recipe') }}</strong>
                        @foreach ($data['contents'] as $content)
                        <div class="media">
                              <div class="pull-left">
                                    <a class="lv-item" href="{{ $content->url }}"><img class="media-object img-background" width="50px" height="50px" src="{{ config("data.PATH_ROOT").$content->image }}" alt=""></a>
                              </div>
                              <div class="media-body">
                                  <a class="lv-item" href="{{ $content->url }}">{{ $content->title }}</a>
                              </div>
                          </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="product-feature">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="text-uppercase text-warning">{{ \Language::getTemplate('ecomtemplate.lbl_product_detail') }}</h3>
                    <table class="table table-transparent">
                        <tbody>
                            <tr>
                                <td width="40%"><b>{{ \Language::getTemplate('ecomtemplate.lbl_product_name') }}</b></td>
                                <td>{{ $data['product']->product_name }}</td>
                            </tr>
                            @foreach ($data['product_fields'] as $field)
                            <tr>
                                <td><b>{{ $field->field_name }}</b></td>
                                <td>{{ $field->value . ' ' . $field->unit }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><b>{{ \Language::getTemplate('ecomtemplate.lbl_product_desc') }}</b></td>
                                <td>{{ $data['product']->desc }}</td>
                            </tr>
                        </tbody>
                    </table>
<!--                    <strong class="text-muted">Bảng giá trị dinh dưỡng:</strong><br>
                    <table class="table table-condensed table-bordered">
                        <tbody>
                            <tr style="background: #F5F5F5">
                                <td colspan="2">Bảng giá trị dinh dưỡng trên 100g</td>
                            </tr>
                            <tr>
                                <td width="40%">Năng lượng</td>
                                <td class="text-right"><b>2111 kJ</b></td>
                            </tr>
                            <tr>
                                <td>Chất béo</td>
                                <td class="text-right"><b>23g</b></td>
                            </tr>
                            <tr>
                                <td>Carbohydrates</td>
                                <td class="text-right"><b>67g</b></td>
                            </tr>
                            <tr>
                                <td>Protein</td>
                                <td class="text-right"><b>27g</b></td>
                            </tr>
                            <tr>
                                <td>Muối</td>
                                <td class="text-right"><b>5,5g</b></td>
                            </tr>
                            <tr>
                                <td>Vitamin A</td>
                                <td class="text-right"><b>10g</b></td>
                            </tr>
                            <tr>
                                <td>Vitamin B1</td>
                                <td class="text-right"><b>5g</b></td>
                            </tr>
                            <tr>
                                <td>Vitamin B2</td>
                                <td class="text-right"><b>50g</b></td>
                            </tr>
                            <tr>
                                <td>Vitamin C</td>
                                <td class="text-right"><b>17g</b></td>
                            </tr>
                            <tr>
                                <td>Vitamin D</td>
                                <td class="text-right"><b>23g</b></td>
                            </tr>
                            <tr>
                                <td>Kẽm</td>
                                <td class="text-right"><b>89g</b></td>
                            </tr>
                            <tr>
                                <td>Sắc</td>
                                <td class="text-right"><b>100g</b></td>
                            </tr>
                        </tbody>
                    </table>-->
                </div>
                <div class="col-md-4">
                    @if (isset($data['review_contents']))
                    <h3 class="text-uppercase text-warning">{{ \Language::getTemplate('ecomtemplate.lbl_reviews') }}</h3>
                        @foreach ($data['review_contents'] as $content)
                        <div class="media">
                              <div class="pull-left">
                                    <a class="lv-item" href="{{ $content->url }}"><img class="media-object img-background" width="60px" height="60px" src="{{ config("data.PATH_ROOT").$content->image }}" alt=""></a>
                              </div>
                              <div class="media-body">
                                  <a class="lv-item" href="{{ $content->url }}">{{ $content->title }}</a>
                              </div>
                          </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-4">
                    <h3 class="text-uppercase text-warning">{{ \Language::getTemplate('ecomtemplate.lbl_product_similar') }}</h3>
                    <div class="row">
                        <div class="panel-product" style="height: initial;">
                            @foreach ($data['product_similar'] as $ps)
                            <div class="product-item">
                                <div class="product-caption">
                                    <a class="member" href="{{ $ps->member_url }}" title="{{ $ps->member_name }}">{{ $ps->member_name }}</a>
                                    <hr>
                                    <ul>
                                        @foreach ($ps->info as $info)
                                        <li>{{ $info->field_name . ': ' . $info->value . ' ' . $info->unit }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="product-img" style="background-image: url('{{ $ps->media }}')">
                                    <?php echo $ps->new ? '<span class="new"></span>' : ''; ?>
                                    <div class="product-button">
                                        <div class="like-button" title="{{ \Language::getTemplate('ecomtemplate.lbl_add_to_favorite') }}" onclick='viewModelHeader.addToFavorite({{ $ps->product_id }}, "{{ $ps->product_name }}")'>
                                            <span class="fa-stack fa-lg">
                                                <i class="fa fa-circle fa-stack-2x"></i>
                                                <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </div>
                                        <div class="cart-button" title="{{ \Language::getTemplate('ecomtemplate.lbl_add_to_cart') }}" onclick='addToCart({
                                            id: "{{ $ps->product_id }}",
                                            product_id: "{{ $ps->product_id }}",
                                            product_name: "{{ $ps->product_name }}",
                                            product_alias: "{{ $ps->url }}",
                                            product_content: "{{ $ps->media }}",
                                            member_id: "{{ $ps->member_id }}",
                                            member_name: "{{ $ps->member_name }}",
                                            member_alias: "{{ $ps->member_url }}",
                                            quantity: 1})'>
                                            <span class="fa-stack fa-lg">
                                                <i class="fa fa-circle fa-stack-2x"></i>
                                                <i class="fa fa-cart-plus fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ $ps->url }}">
                                        <div class="product-title">{{ $ps->product_name }}</div>
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
<!--    <div class="wall-comment-list">
        <div class="container">
            <h3 class="text-muted"><i class="zmdi zmdi-comments"></i> Bình luận về {{ $data['page']->menu_name }}</h3>
             Comment Listing
            <div class="wcl-list">
                <div class="media">
                    <a href="" class="pull-left">
                        <img src="{{ \Path::urlCurrentTemplate($data['page']->lang, 'images/user3.jpg') }}" alt="" class="lv-img-sm">
                    </a>
                    <div class="media-body">
                        <a href="" class="a-title">Phước Long</a> <small class="c-gray m-l-10">3 phút trước...</small>
                        <p class="m-t-5 m-b-0">Quá hấp dẫn :v.</p>
                    </div>
                </div>

                <div class="media">
                    <a href="" class="pull-left">
                        <img src="{{ \Path::urlCurrentTemplate($data['page']->lang, 'images/user4.jpg') }}" alt="" class="lv-img-sm">
                    </a>

                    <div class="media-body">
                        <a href="" class="a-title">Chấn Nam</a> <small class="c-gray m-l-10">3 phút trước...</small>
                        <p class="m-t-5 m-b-0">:))))</p>
                    </div>
                </div>
            </div>

             Comment form
            <div class="wcl-form">
                <div class="wc-comment">
                    <form>
                    <div class="wcc-inner">
                        <textarea class="wcci-text" placeholder="Hãy chia sẽ cảm nhận của bạn về sản phẩm này!!!"></textarea>
                    </div>
                    <div class="m-t-15">
                        <div class="btn btn-primary btn-icon-text waves-effect"><i class="zmdi zmdi-mail-send"></i> Gửi</div>
                        <button class="btn btn-default btn-icon-text waves-effect" type="reset"><i class="zmdi zmdi-close"></i> Huỷ</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>-->
    <!--cfmCancel-->
    <div class="modal" id="cfmCancel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmCancel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-cancel">
                <div class="modal-body">
                    <h3>{{ \Language::getTemplate('ecomtemplate.msg_cancel_question') }}</h3><br>
                    <button class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> {{ \Language::get('global.lbl_exit') }}</button>
                    <button class="btn btn-primary" id="btnCancel"><?php echo $data['page']->button ?></button>
                </div>
            </div>
        </div>
    </div>
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.footer'))
    <script>
        $(function(){
            $('#request_sample').on('click', function() {
                @if ($data['page']->button_action == 1)
                location.href = '{{ $data['menus']->sample }}';
                @else
                $('#cfmCancel').modal('show');
                @endif
            });
            @if ($data['page']->button_action == 0)
            $('#btnCancel').on('click', function() {
                $.post("{{ Path::urlSite('ecom/cancel-sample') }}", {_token: '{{ csrf_token() }}', request: '{{ $data['request'] }}'}, function(data) {
                    toastr[data.status](data.message);
                    if (data.status == 'success') {
                        location.reload();
                    }
                });
            });
            @endif
            $('#add_to_cart').on('click', function() {
                if($('#car_quantity').val() != ''){
                    viewModelHeader.addToCart({
                        // id: "{{ $data['product']->product_id }}",
                        product_id: "{{ $data['product']->product_id }}",
                        product_name: "{{ $data['product']->product_name }}",
                        product_alias: "{{ $data['product']->url }}",
                        product_content: "{{ $data['product']->media }}",
                        member_id: "{{ $data['product']->member_id }}",
                        member_name: "{{ $data['product']->member_name }}",
                        member_alias: "{{ $data['product']->member_url }}",
                        quantity: $('#car_quantity').val()
                    });
                }
            });
        });
    </script>
@endsection
