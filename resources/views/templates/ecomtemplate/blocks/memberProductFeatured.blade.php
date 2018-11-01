<section id="member_product_featured">
    <div class="container">
        <div class="block-header">
            <?php
                $products = \DB::table('products')->get();
                $cat_id = DB::table('product_media_categories')->where('category_name', 'Đại diện')->first()->id;
            ?>
            <h3 class="text-uppercase text-primary">SẢN PHẨM NỔI BẬT <small class="text-lowercase">60 sản phẩm</small></h3>
            <ul class="actions hidden-xs">
                <li>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect">Xem đầy đủ</div>
                </li>
            </ul>
        </div>
        <div class="row">
            <?php
            $content = DB::table('product_medias')->where('media_category_id', $cat_id)->where('product_id', $products[0]->id)->first();
            $product_custom_fields_id = json_decode(DB::table('product_categories')->where('id', $products[0]->category_id)->value('product_custom_fields'));
            $product_custom_fields = DB::table('product_custom_fields')->whereIn('id', $product_custom_fields_id)->get();
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="{{ Path::url($lang.'/san-pham/'.$products[0]->alias) }}" class="thumbnail">
                    <div class="img-background" style="width: 100%; height: 456px; background-image: url({{ isset($content->content) ? $content->content : '' }})">
                        <span class="best-sell"></span>
                        <span class="left-title">{{ $products[0]->product_name }}</span>
                    </div>
                </a>
            </div>
            @for ($i = 1; $i < 7; $i++)
            <?php
            $content = DB::table('product_medias')->where('media_category_id', $cat_id)->where('product_id', $products[$i]->id)->first();
            $product_custom_fields_id = json_decode(DB::table('product_categories')->where('id', $products[$i]->category_id)->value('product_custom_fields'));
            $product_custom_fields = DB::table('product_custom_fields')->whereIn('id', $product_custom_fields_id)->get();
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="thumbnail">
                    <div class="img-background" style="width: 100%; height: 150px; background-image: url({{ isset($content->content) ? $content->content : '' }})">
                        <?php echo $products[$i]->new ? '<span class="new"></span>':''; ?>
                        <div class="toolbar">
                            <a><i class="zmdi zmdi-shopping-cart"></i></a>
                            <a href="{{ Path::url($lang.'/san-pham/'.$products[$i]->alias) }}"><i class="zmdi zmdi-search"></i></a>
                        </div>
                    </div>
                    <div class="caption">
                        <h4 class="text-muted">
                            <a href="{{ Path::url($lang.'/san-pham/'.$products[$i]->alias) }}" title="{{ $products[$i]->product_name }}">{{ $products[$i]->product_name }}</a>
                        </h4>
                        <span class="price">60.000<sup>VNĐ</sup>/100g</span>
                        <small class="pull-right text-right">Hơn 2,5k lượt mua<br>tuần qua</small>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
<section class="block-product-featured block-product-featured-{{ $block->id }}">
    <div class="container">
        <div class="block-header">
            <?php
//            ->take(json_decode($block->attribs)->limit)
                $product_category_id = json_decode($block->attribs)->category_id;
                $product_category = \DB::table('product_categories')->where('id', $product_category_id)->first();
                $products = \DB::table('products')->where('category_id', $product_category_id)->get();
                $cat_id = DB::table('product_media_categories')->where('category_name', 'Đại diện')->first()->id;
            ?>
            <h3 class="text-uppercase text-primary">{{ isset($product_category->category_name) ? $product_category->category_name : '' }} <small class="text-lowercase">{{ count($products) }} sản phẩm</small></h3>
            <ul class="actions hidden-xs">
                <li>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect">Phillet</div>
                </li>
                <li>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect">Cá tra</div>
                </li>
                <li>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect"><a href="{{ Path::url($lang.'/san-pham') }}">Xem tất cả <span class="glyphicon glyphicon-chevron-right"></span></a></div>
                </li>
            </ul>
        </div>
        <div class="row">
            <?php
            $content = DB::table('product_medias')->where('media_category_id', $cat_id)->where('product_id', $products[0]->id)->first();
            $product_custom_fields_id = json_decode(DB::table('product_categories')->where('id', $products[0]->category_id)->value('product_custom_fields'));
            $product_custom_fields = DB::table('product_custom_fields')->whereIn('id', $product_custom_fields_id)->get();
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="{{ Path::url($lang.'/san-pham/'.$products[0]->alias) }}" class="thumbnail">
                    <div class="img-background" style="width: 100%; height: 456px; background-image: url({{ isset($content->content) ? $content->content : '' }})">
                        <span class="best-sell"></span>
                        <span class="left-title">{{ $products[0]->product_name }}</span>
                    </div>
                </a>
            </div>
            @for ($i = 1; $i < 7; $i++)
            <?php
            $content = DB::table('product_medias')->where('media_category_id', $cat_id)->where('product_id', $products[$i]->id)->first();
            $product_custom_fields_id = json_decode(DB::table('product_categories')->where('id', $products[$i]->category_id)->value('product_custom_fields'));
            $product_custom_fields = DB::table('product_custom_fields')->whereIn('id', $product_custom_fields_id)->get();
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="thumbnail">
                    <div class="img-background" style="width: 100%; height: 150px; background-image: url({{ isset($content->content) ? $content->content : '' }})">
                        <?php echo $products[$i]->new ? '<span class="new"></span>':''; ?>
                        <div class="toolbar">
                            <a><i class="zmdi zmdi-shopping-cart"></i></a>
                            <a href="{{ Path::url($lang.'/san-pham/'.$products[$i]->alias) }}"><i class="zmdi zmdi-search"></i></a>
                        </div>
                    </div>
                    <div class="caption">
                        <h4 class="text-muted">
                            <a href="{{ Path::url($lang.'/san-pham/'.$products[$i]->alias) }}" title="{{ $products[$i]->product_name }}">{{ $products[$i]->product_name }}</a>
                        </h4>
                        <span class="price">60.000<sup>VNĐ</sup>/100g</span>
                        <small class="pull-right text-right">Hơn 2,5k lượt mua<br>tuần qua</small>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
