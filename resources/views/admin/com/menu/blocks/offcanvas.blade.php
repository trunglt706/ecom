@extends(Path::viewAdmin('blocks.blockConfig'))

@section('block-config')
<legend>{{ \Language::getCom('menu.lbl_menu_info') }}</legend>
<div class="form-group">
    <label for="parent_menu" class="control-label">{{ \Language::getCom('menu.lbl_menu') }} <sup class="text-danger">(*)</sup></label>
    <select class="select2" id="parent_menu" required>
        @foreach (\App\Com\Menu\Menu::fetch() as $menu)
            <option value="{{ $menu->id }}">{{ $menu->text }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="depth" class="control-label">{{ \Language::getCom('menu.lbl_depth') }} <sup class="text-danger">(*)</sup></label>
    <input type="number" class="form-control" name="depth" id="depth" data-bind="value: attribs().depth" required min="0">
</div>

@endsection

@section('attribs-init')
<?php
    $attribs = null;
    if(isset($block)) $attribs = json_decode($block->attribs);
    else $attribs = json_decode($module->attribs);
    echo "parent_menu: '".$attribs->parent_menu."',";
    echo "depth: '".$attribs->depth."'";
?>
@endsection

@section('attribs-save')
    self.attribs().parent_menu = $('#parent_menu').val();
@endsection

@section('block-config-function-include')
    $('#parent_menu').select2('val', '{{ $attribs->parent_menu }}');
@endsection
