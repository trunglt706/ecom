@extends(Path::viewAdmin('blocks.blockConfig'))

@section('block-config')
<legend>{{ \Language::getCom('product.lbl_product_category') }}</legend>
<div class="form-group">
    <label for="type" class="control-label">{{ \Language::get('global.lbl_option') }} <sup class="text-danger">(*)</sup></label>
    <select class="form-control" data-bind="value: attribs().category_id">
        @foreach(App\Com\Product\ProductCategory::fetch() as $category)
        <option value="{{ $category->id }}">{{ $category->text }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="type" class="control-label">{{ \Language::getCom('product.lbl_product_media_category') }} <sup class="text-danger">(*)</sup></label>
    <select class="form-control" data-bind="value: attribs().media_category_id">
        @foreach(App\Com\Product\ProductMediaCategory::fetch() as $category)
        <option value="{{ $category->id }}">{{ $category->text }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="limit" class="control-label">{{ \Language::getCom('product.lbl_quantity') }} <sup class="text-danger">(*)</sup></label>
    <input class="form-control" data-bind="value: attribs().limit" type="number" min="1">
</div>
@endsection

@section('attribs-init')
<?php
    $attribs = null;
    if(isset($block)) $attribs = json_decode($block->attribs);
    else $attribs = json_decode($module->attribs);
    echo "category_id: '".$attribs->category_id."',";
    echo "media_category_id: '".$attribs->media_category_id."',";
    echo "limit: '".$attribs->limit."'";
?>
@endsection
