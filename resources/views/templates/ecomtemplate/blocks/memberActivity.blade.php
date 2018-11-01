<div id="activity" style="background: #ffffff; margin-top: 10px; padding-bottom: 10px;">
    <div class="container">
        <div class="block-header">
            <h3 class="text-uppercase text-primary">{{ Language::getTemplate('ecomtemplate.lbl_operation_enterprises') }}</h3>

        </div>
        <div class="row">
            <div class="col-md-7 col-sm-6 col-xs-12">
                @foreach ($data['contents'] as $content_activity)
                <div class="row">
                    <div class="col-sm-3">
                        <a class="thumbnail" href="{{ $content_activity->url }}"> <span class="img-background" style="width: 100%; height: 120px; background-image: url('{{config("data.PATH_ROOT").$content_activity->image}}')"></span> </a>
                    </div>
                    <div class="col-sm-9">
                        <div><span><b><a href="{{ $content_activity->url }}">{{$content_activity->title}}</a></b></span> <span style="font-style: italic;">({{ date("d/m/Y", strtotime($content_activity->created_at)) }})</span></div>
                        <div><?php echo \App\Com\Content\Content::split_word($content_activity->content, 30) ?></div>
                        <a style="font-style: italic; color: #007cbd;" href="{{ $content_activity->url }}">{{ Language::getTemplate('ecomtemplate.lbl_read_more') }}</a>
                        <!-- <div><?php echo \App\Com\Content\Content::split_word($content_activity->content, 30) ?>
                        <a style="font-style: italic; color: #007cbd;float: right;margin-right: 45px;" href="{{ $content_activity->url }}">{{ Language::getTemplate('ecomtemplate.lbl_read_more') }}</a> -->
                        <!-- </div> -->

                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12" style="padding-left: 20px;">
                <h4 class="text-uppercase" style="color: #666;">{{ Language::getTemplate('ecomtemplate.lbl_interest_content') }}</h4>
                <ul style="background-color: #e5e5e5; padding: 30px; border-radius: 10px;">

                    @foreach($data['contents'] as $content_activity)
                    <li style="font-size: 15px;"><a href="{{ $content_activity->url }}">{{$content_activity->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!--<div style="margin-top: 10px; padding-bottom: 10px;">
    <div class="container">
        <div class="block-header">
            <h3 class="text-uppercase" style="color: #007cbd;">HƯỚNG DẪN</h3>
        </div>

        <ul style="color: #007cbd">
            <li>
                Hướng dẫn mua online
            </li>
            <li>
                Hướng dẫn mua hàng
            </li>
            <li>
                Quyền và nghĩa vụ của doanh nghiệp
            </li>
            <li>
                Hướng dẫn đăng ký hội viên
            </li>
            <li>
                Điều khoản sử dụng
            </li>
            <li>
                Góp ý, báo lỗi
            </li>
            <li>
                Thanh toán
            </li>
        </ul>
    </div>
</div>-->
