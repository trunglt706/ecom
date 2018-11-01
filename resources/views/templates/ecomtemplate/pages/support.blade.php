@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo strip_tags($data['page']->menu_name); ?>
@endsection

@section('current-css')
<!--<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/register.css') }}" rel="stylesheet">-->
@endsection

@section('main')
    @include(Path::viewCurrentTemplate($data['page']->lang, 'pages.header'))
    <section id="support" class="margin-top">
        <div class="container">

        <div class="card">
                    <div class="card-header">
                        <h1>Hướng dẫn sử dụng</h1>
                    </div>

                    <div class="card-body card-padding">
                        <div class="form-wizard-basic fw-container">
                            <ul class="tab-nav text-center fw-nav">
                                <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">First</a></li>
                                <li><a href="#tab2" data-toggle="tab">Second</a></li>
                                <li><a href="#tab3" data-toggle="tab">Third</a></li>
                                <li><a href="#tab4" data-toggle="tab">Forth</a></li>
                                <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                                <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tab1">
                                    Hướng Dẫn Đặt Hàng
                                    Quý khách hàng có thể đặt hàng sản phẩm của hiệp hội thông qua các bước cơ bản sau :
                                    1.	Tìm kiếm sản phẩm
                                    Qúy khách có thể tìm sản phẩm theo các cách:
                                    - Gõ tên sản phẩm vào thanh tìm kiếm
                                    - Tìm sản phẩm theo tên doanh nghiệp
                                    - Tìm theo doanh mục các sản phẩm mới nhất, bán chạy hoặc sản phẩm nỗi bật

                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <p>Duis eu eros vitae risus sollicitudin blandit in non nisi. Phasellus rhoncus ullamcorper pretium. Etiam et viverra neque, aliquam imperdiet velit. Nam a scelerisque justo, id tristique diam. Aenean ut vestibulum velit, vel ornare augue. Nullam eu est malesuada, vehicula ex in, maximus massa. Sed sit amet massa venenatis, tristique orci sed, eleifend arcu.</p>
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    <p>Duis eu eros vitae risus sollicitudin blandit in non nisi. Phasellus rhoncus ullamcorper pretium. Etiam et viverra neque, aliquam imperdiet velit. Nam a scelerisque justo, id tristique diam. Aenean ut vestibulum velit, vel ornare augue. Nullam eu est malesuada, vehicula ex in, maximus massa. Sed sit amet massa venenatis, tristique orci sed, eleifend arcu.</p>
                                    <p>Aliquam tempus rutrum neque, a blandit dui. Proin quis elit non est scelerisque pharetra nec id libero. Quisque id tincidunt elit. Maecenas non mauris malesuada, interdum justo et, ullamcorper magna. Nulla libero risus, vestibulum pharetra eleifend in, aliquam ac odio. Sed ligula orci, rhoncus sit amet ipsum vel, vehicula interdum ligula. </p>
                                </div>
                                <div class="tab-pane fade" id="tab4">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus purus sapien, cursus et egestas at, volutpat sed dolor. Aliquam sollicitudin dui ac euismod hendrerit. Phasellus quis lobortis dolor. Sed massa massa, sagittis nec fermentum eu, volutpat non lectus. Nullam vitae tristique nunc. Aenean vel placerat augue. Aliquam pharetra mauris neque, sit amet egestas risus semper non. Proin egestas egestas ex sed gravida. Suspendisse commodo nisl sit amet risus volutpat volutpat. Phasellus vitae turpis a elit tincidunt ornare. Praesent non libero quis libero scelerisque eleifend. Ut eleifend laoreet vulputate.</p>
                                </div>
                                <div class="tab-pane fade" id="tab5">
                                    <p>Cras mattis vulputate lacus sed aliquet. Pellentesque ultricies lectus ut augue tincidunt volutpat. Quisque lorem lectus, vulputate et feugiat ac, tincidunt eu neque. Suspendisse et dignissim ex. Praesent finibus vestibulum faucibus. Vestibulum scelerisque aliquam eros, id tincidunt lacus interdum eu. Praesent molestie leo sed varius tempus. Etiam quis turpis eget diam aliquet congue ut non risus. In sed sapien placerat, fermentum odio id, sagittis magna. Donec sollicitudin ipsum eget pretium tincidunt. Mauris venenatis metus a turpis eleifend, vitae tincidunt nunc tristique. Nulla facilisi. In hac habitasse platea dictumst. Curabitur auctor nibh eget mauris iaculis, id tempor ex egestas. Proin nisl diam, malesuada quis ipsum vitae, tincidunt efficitur neque. Nam suscipit magna ac nisl ornare lobortis.</p>
                                </div>
                                <div class="tab-pane fade" id="tab6">
                                    <p>Nunc gravida hendrerit turpis a iaculis. Aenean tempus bibendum augue at tempor. Vestibulum nec ligula elementum nisi viverra mattis ac in nibh. Cras eu elementum massa. Integer cursus quam maximus, ornare ex at, bibendum dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus quis eleifend turpis, eget luctus felis.</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.footer'))
@endsection
