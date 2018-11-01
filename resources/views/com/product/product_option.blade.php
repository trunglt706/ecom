@if (count($block['products']) > 0)
<h3 class="text-uppercase">{{ $block['block']->title }} <small class="text-lowercase">{{ $block['count'] . ' ' . \Language::getTemplate('ecomtemplate.lbl_product') }}</small></h3>
<div class="row">
    <div class="panel-product panel-product-feature">
        @foreach($block['products'] as $product)
        <div class="col-md-3 col-sm-6 col-xs-12">
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
                        <div class="product-title" title="{{ $product->product_name }}">{{ $product->product_name }}</div>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<div></div>
@endif
