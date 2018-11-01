<section class="block-product-featured block-product-featured-{{ $block->id }}">
    <div class="container">
        <div class="block-header">
            <h3 class="text-uppercase text-primary">{{ $block->title }} <small class="text-lowercase">12345 sản phẩm</small></h3>
            <ul class="actions hidden-xs">
                <li>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect">Phillet</div>
                </li>
                <li>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect">Cá tra</div>
                </li>
            </ul>
        </div>
        <div class="row">
            <?php
                $products = \DB::table('products')->take(json_decode($block->attribs)->limit)->get();
                $cat_id = DB::table('product_media_categories')->where('category_name', 'Đại diện')->first()->id;
            ?>
            @foreach($products as $product)
            <?php
            $content = DB::table('product_medias')->where('media_category_id', $cat_id)->where('product_id', $product->id)->first();
            $product_custom_fields_id = json_decode(DB::table('product_categories')->where('id', $product->category_id)->value('product_custom_fields'));
            $product_custom_fields = DB::table('product_custom_fields')->whereIn('id', $product_custom_fields_id)->get();
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="thumbnail">
                    <div class="img-background" style="width: 100%; height: 150px; background-image: url({{ isset($content->content) ? $content->content : '' }})">
                        <?php echo $product->new ? '<span class="new"></span>':''; ?>
                        <div class="toolbar">
                            <a><i class="zmdi zmdi-shopping-cart"></i></a>
                            <a href="{{ Path::url($lang.'/san-pham/'.$product->alias) }}"><i class="zmdi zmdi-search"></i></a>
                        </div>
                    </div>
                    <div class="caption">
                        <h4 class="text-muted">
                            <a href="{{ Path::url($lang.'/san-pham/'.$product->alias) }}" title="{{ $product->product_name }}">{{ $product->product_name }}</a>
                        </h4>
                        <span class="price">60.000<sup>VNĐ</sup>/100g</span>
                        <small class="pull-right text-right">Hơn 2,5k lượt mua<br>tuần qua</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
