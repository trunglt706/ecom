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

@section('css')
<!-- <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/member_detail.css') }}" rel="stylesheet"> -->
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/jquery.nestable.css') }}" rel="stylesheet">
@endsection

@section('jsc')
<script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/jquery.nestable.js') }}"></script>
@if( file_exists(config('data.PATH_MODEL').'/CKEditor/') )
<script src="{{ Path::urlCom('ckeditor/ckeditor.js') }}"></script>
@endif
@endsection

@section('section')
    <?php
        if (\Auth::check() && \Auth::user()->login_frontend) {
            $akey = App\Com\FileManager\FileManager::getSecretKey();
            $filemanager_path = 'filemanager?akey='.$akey;
        }
    ?>
    <section id="member-detail" style="{{ $data['style'] }}" class="margin-top {{ $data['class'] }} {{ $data['is_gold'] ? 'gold-member' : '' }}">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                <li><a href="{{ $data['menus']->member }}">{{ $data['menus']->member_name }}</a></li>
                <li class="active">{{ $data['member']->member_name }}</li>
            </ol>
            @if($data['is_own'])
            <div class="member_banner">
                <div>
                    <div class="btn btn-default waves-effect" id="changeBanner"><i class="fa fa-camera" aria-hidden="true"></i></div>
                    @if ($data['class'] == 'banner')
                    <div class="btn btn-danger waves-effect" id="deleteBanner"><i class="fa fa-times" aria-hidden="true"></i></div>
                    @endif
                </div>
            </div>
            @endif
            <div class="col-md-3">
                <div class="thumbnail member_logo">
                    <div id="logo_member" class="img-background" style="width: 100%; height: 100%; background-image: url({{ $data['member']->media }})">
                        @if($data['is_own'])
                        <div class="toolbar" id="changeLogo">
                            <div><i class="fa fa-camera" aria-hidden="true"></i></div>
                        </div>
<!--                        <div class="toolbar" id="deleteLogo">
                            <div><i class="fa fa-trash" aria-hidden="true"></i></div>
                        </div>-->
                        @endif
                        @if ($data['is_gold'])
                        <div class="gold-logo" style="background-image: url({{ \Path::urlCurrentTemplate($data['page']->lang, 'images/gold_mem_' . $data['page']->lang . '.png') }})"></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="text-uppercase">{{ $data['member']->member_name }}</h2>
                <div class="member-info">
                    {{ $data['member']->member_address }}<br>
                    {{ \Language::getCom('member.lbl_member_tin') }}: {{ isset($data['member']->member_tin) ? $data['member']->member_tin : '' }}<br>
                    {{ \Language::getCom('member.lbl_member_phone') }}: {{ isset($data['member']->member_phone) ? $data['member']->member_phone : '' }}{{ isset($data['member']->member_fax) && $data['member']->member_fax != '' ?  ' Fax: ' . $data['member']->member_fax : '' }}
                </div>
                <div class="member-social">
                    @if (isset($data['member']->member_website) && $data['member']->member_website != '')
                    <a href="http://{{ $data['member']->member_website }}"><i class="fa fa-globe" aria-hidden="true"></i></a>
                    @else
                    <a class="disabled"><i class="fa fa-globe" aria-hidden="true"></i></a>
                    @endif
                    @if (isset($data['member']->member_facebook) && $data['member']->member_facebook != '')
                    <a href="http://{{ $data['member']->member_facebook }}"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                    @else
                    <a class="disabled"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                    @endif
                    @if (isset($data['member']->member_twitter) && $data['member']->member_twitter != '')
                    <a href="http://{{ $data['member']->member_twitter }}"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                    @else
                    <a class="disabled"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                    @endif
                    @if (isset($data['member']->member_google) && $data['member']->member_google != '')
                    <a href="http://{{ $data['member']->member_google }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    @else
                    <a class="disabled"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    @endif
                    @if (isset($data['member']->member_youtube) && $data['member']->member_youtube != '')
                    <a href="http://{{ $data['member']->member_youtube }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                    @else
                    <a class="disabled"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @if($data['is_own'])
        @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.member_detail_config'))
    @endif
    @foreach($data['layouts'] as $layout)
        @if($layout->id == 'intro')
            <section id="member_about">
                <div class="container">
                    <div class="row">
                        <div class="panel-heading {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">
                        <h3 class="text-uppercase {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">{{ \Language::getTemplate('ecomtemplate.lbl_member_about') }}</h3>
                        </div>

                        <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                        <div class="panel-body">
                        @if($data['member']->info_about == '')
                        <h5 style="text-align: center;">{{Language::getTemplate('ecomtemplate.lbl_info_about') }}</h5>
                        @else
                        <?php echo $data['member']->info_about ?>
                        @endif
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        @endif
        @if($layout->id == 'product')
            <section id="member_product_featured">
                <div class="container">
                    <div class="row">
                    <div class="panel-heading {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">
                        <h3 class="text-uppercase {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">{{ Language::getTemplate('ecomtemplate.lbl_product') }} <small class="text-lowercase">{{ $data['count'] . ' ' . Language::getTemplate('ecomtemplate.lbl_product') }}</small></h3>
                        <ul class="filters hidden-xs">
                            <li class="{{ $data['is_gold'] ? 'gold-member' : '' }}">
                                <a class="{{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}" href="{{ $data['all_product'] }}">{{ \Language::getTemplate('ecomtemplate.lbl_view_all') }} <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </li>
                        </ul>
                    </div>
                        <div class="panel-product">

                            @foreach($data['product'] as $product)

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="product-item">
                                    <div class="product-caption">
                                        <a class="member" href="{{ $product->member_url }}" title="{{ $product->member_name }}">{{ $product->member_name }}</a>
                                        <hr>
                                        <ul>
                                            @foreach ($product->info as $info)
                                            <li>{{ $info->field_name . ': ' . $info->value . ' ' . $info->unit }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="product-img" style="background-image: url('{{ $product->media }}')">
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
                                            <div class="product-title">{{ $product->product_name }}</div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                        </div>

                    </div>
                </div>
            </section>
        @endif
        @if($layout->id == 'certificate')
            <section id="member_certificate">
                <div class="container">
                    <div class="row">
                    <div class="panel-heading {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">
                        <h3 class="text-uppercase {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">{{ Language::getTemplate('ecomtemplate.lbl_certificate') }}</h3>
                    </div>
                    <div id="member-slideshow" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @if (count($data['certs']) != 0)
                            @foreach ($data['certs'] as $key=>$certs)
                            <div class="item {{ $key == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($certs as $cert)
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <a href="{{ config("data.PATH_ROOT").$cert->content }}">
                                            <div class="member-cover">
                                                <div class="member-image" style="background-image: url('{{ config("data.PATH_ROOT").$cert->logo }}')"></div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="item active">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <a>
                                            <div class="member-cover">
                                                <div class="member-image" style="background-image: url('{{ config("data.PATH_ROOT").'public/storage/upload/69dfd3c1cf3581a6c395590689227deb/LogoDKKD.png' }}')"></div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <a>
                                            <div class="member-cover">
                                                <div class="member-image" style="background-image: url('{{ config("data.PATH_ROOT").'public/storage/upload/69dfd3c1cf3581a6c395590689227deb/LogoGlobalGAP.png' }}')"></div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <a>
                                            <div class="member-cover">
                                                <div class="member-image" style="background-image: url('{{ config("data.PATH_ROOT").'public/storage/upload/69dfd3c1cf3581a6c395590689227deb/LogoVietGAP.png' }}')"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#member-slideshow" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#member-slideshow" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                </div>
            </section>
        @endif
        @if($layout->id == 'news')
            <section id="member_content">
                <div class="container">
                    <div class="row">
                    <div class="panel-heading {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">
                        <h3 class="text-uppercase {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">{{ Language::getTemplate('ecomtemplate.lbl_news') }}</h3>
                    </div>


                    <div class="card-body" style="margin-top: 10px;">
                    <div class="listview">
                    @foreach ($data['contents'] as $content_mem)
                          <div class="media">
                              <div class="pull-left">
                                  <a class="lv-item" href="{{ $content_mem->url }}" style="padding: 0;"><img class="media-object img-background" width="100px" height="60px" src="{{ config("data.PATH_ROOT").$content_mem->image }}" alt=""></a>
                              </div>
                              <div class="media-body">
                                  <a class="lv-item {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}" href="{{ $content_mem->url }}" style="padding: 0; font-size:20px;">{{ $content_mem->title }}</a>
                                  <small><i class="glyphicon glyphicon-time"></i>{{$content_mem->created_at}}</small>
                                      <section style="margin:0px; color:#000;">
                                          <?php echo \App\Com\Content\Content::split_word($content_mem->content, 60) ?>
                                      </section>
                              </div>
                              <div class="pull-right"><a class="btn btn-link btn-sm btn-xs waves-effect {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}" href="{{ $content_mem->url }}">{{ Language::getTemplate('ecomtemplate.lbl_read_more') }}<span class="glyphicon glyphicon-chevron-right"></span></a></div>
                          </div>

                        @endforeach
                  </div>
                </div>
              </div>
              </div>

            </section>
        @endif
        @if($layout->id == 'contact')
            <section id="member_contact">
                <div class="container">
                    <div class="row">
                    <div class="panel-heading {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">
                        <h3 class="text-uppercase {{ $data['is_gold'] ? 'gold-member' : 'text-primary' }}">{{ Language::getTemplate('ecomtemplate.lbl_contact_us') }}</h3>
                    </div>

                        <div class="col-sm-6" style="margin-top: 15px;">
                            <div class="panel panel-default">
                                <div class="panel-body" style="padding: 0">
                                    <form id="frmContactUs">
                                        <div class="form-group">
                                            <label for="fullname" class="control-label">{{ \Language::getCom('system.lbl_fullname') }} <sup class="text-danger">(*)</sup></label>
                                            <input type="text" class="form-control fc-alt" name="fullname" id="fullname" required data-bind="value: contact().fullname">
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="control-label">{{ \Language::getCom('system.lbl_address') }}</label>
                                            <input type="text" class="form-control fc-alt" name="address" id="address" data-bind="value: contact().address">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="control-label">{{ \Language::getCom('system.lbl_phone') }}</label>
                                            <input type="text" class="form-control fc-alt" name="phone" id="phone" onkeydown="return ( event.ctrlKey || event.altKey
                                                || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                                                || (95<event.keyCode && event.keyCode<106)
                                                || (event.keyCode==8) || (event.keyCode==9)
                                                || (event.keyCode>34 && event.keyCode<40)
                                                || (event.keyCode==46) )"
                                            maxlength="11" data-bind="value: contact().phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label">{{ \Language::getCom('system.lbl_email') }} <sup class="text-danger">(*)</sup></label>
                                            <input type="email" class="form-control fc-alt" name="email" id="email" data-bind="value: contact().email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="control-label">{{ \Language::getCom('system.lbl_content') }} <sup class="text-danger">(*)</sup></label>
                                            <textarea class="form-control fc-alt" name="note" id="note" data-bind="value: contact().note" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <div class="btn btn-primary" data-bind="click: btnContact">
                                                    {{ Language::getTemplate('ecomtemplate.lbl_send') }}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="margin-top: 30px;">
                        @if($data['member']->info_contact == '')
                        <h5 style="text-align: center;">{{Language::getTemplate('ecomtemplate.lbl_info_update') }}</h5>
                        @else
                        <?php echo $data['member']->info_contact ?>
                        @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach
    <script>
        var validate = $('#frmContactUs').validate({
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
        function ContactModel() {
            var self = this;
            self.contact = ko.observable({});
            self.btnContact = function () {
                if (!$('#frmContactUs').valid()) {
                    toastr['error']('{{ \Language::getTemplate('ecomtemplate.message_register_input_error') }}');
                    return false;
                }
                var data = self.contact();
                data['_token'] = '{{ csrf_token() }}';
                data['member_id'] = {{ $data['member']->id }};
                $.ajax({url: '{{ Path::urlSite('ecom/send-contact') }}', type: 'post', data: data,
                    success: function (data) {
                        toastr[data.status](data.message);
                        self.contact({});
                        // setTimeout('location.reload();', 1000);
                    }
                });
            };
        }
        var contactModel = new ContactModel();
        ko.applyBindings(contactModel, document.getElementById('member_contact'));
    </script>
@endsection
