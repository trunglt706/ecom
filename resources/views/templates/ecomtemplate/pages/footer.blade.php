<div class="container">
    <hr>
    <div class="row">
        <div class="col-md-8">
            <span>{{ \Language::getTemplate('ecomtemplate.FOOTER_SUBSCRIBE_TITLE') }}:</span>
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control fc-alt" id="fullnameSubcriber" placeholder="{{ \Language::getTemplate('ecomtemplate.FOOTER_SUBSCRIBE_FULLNAME') }}">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control fc-alt" id="emailSubcriber" placeholder="Email">
                </div>
                <div id="btnSubcriber" class="btn btn-danger waves-effect text-uppercase">{{ \Language::getTemplate('ecomtemplate.FOOTER_SUBSCRIBE_BUTTON') }}</div>
            </form>
        </div>
<!--        <div class="col-md-4">
            <i class="text-muted">{{ \Language::getTemplate('ecomtemplate.FOOTER_CERTIFICATE') }}</i><br>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/dmca.jpg') }}"></a>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/bocongthuong.jpg') }}"></a>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/sanphamdichvu.jpg') }}"></a>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/thuonghieuvietnam.jpg') }}"></a>
        </div>-->
    </div>
<!--    <hr>
    <div class="row">
        <div class="col-md-8">
            <i class="text-muted">Hỗ trợ thanh toán</i><br>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/mastercard.jpg') }}"></a>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/visa.jpg') }}"></a>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/baokim.jpg') }}"></a>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/tienmat.jpg') }}"></a>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/chuyenkhoan.jpg') }}"></a>
            <a><img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/icon/noidia.jpg') }}"></a>
        </div>
        <div class="col-md-4">
            <img src="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/hotline.jpg') }}">
        </div>
    </div>-->
</div>
@if(env('FIREBASE'))
    @if(Auth::check() && count(\DB::table('chat_users')->where('user_id', Auth::user()->id)->get() ) )
        @include(\Path::viewCom('chat.user_dialog'));
    @else
        @include(\Path::viewCom('chat.customer_dialog'));
    @endif
@endif
<!-- Hướng dẫn sử dụng -->
<a target="_blank" href="http://mekongfishmarket.com/files/huong-dan-su-dung-trang-tmdt.pdf" class="btn btn-primary" title="Hướng dẫn sử dụng" style="position: fixed; top: 215px; z-index: 10000; font-size: 2em; right: 0px; border-radius: 4px; width: 60px; background: #007CBD;">
    <span class="fa fa-question-circle-o"></span>
</a>
<!-- Kết thúc Hướng dẫn sử dụng -->
<footer>
    <div class="container info">
        <div class="row">
            <div class="col-md-8">
                <section class="footer-left">
                    <?php echo Block::render($data['blocks'], 'customhtml', 'footer-left') ?>
                </section>
            </div>
            <div class="col-md-4">
                <section class="footer-right">
                    <?php echo Block::render($data['blocks'], 'customhtml', 'footer-right') ?>
                </section>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="pull-left">
                <span>{{ \Language::getTemplate('ecomtemplate.FOOTER_COPYRIGHT') }} </span> <a>{{ \Language::getTemplate('ecomtemplate.FOOTER_VPA') }}</a>
            </div>
            <div class="pull-right">
                @foreach($data['page']->langs as $lang)
                <a href="{{ Path::url($lang->alias) }}">
                    <img src="{{ Path::url('images/languages/'.$lang->lang_code.'.gif') }}" alt="{{ $lang->lang_code }}">
                </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>
<script>
    $('#btnSubcriber').on('click', function () {
        $.ajax({url: '{{ Path::urlSite('ecom/subcriber') }}', type: 'post', data: {_token: '{{ csrf_token() }}', fullname: $('#fullnameSubcriber').val(), email: $('#emailSubcriber').val()},
            success: function (data) {
                toastr[data.status](data.message);
                if (data.status == 'success') {
                    $('#fullnameSubcriber').val('');
                    $('#emailSubcriber').val('');
                }
            }
        });
    });
</script>
