@extends(Path::viewAdmin('blocks.blockConfig'))

@section('block-config')
<div class="row">
    <div class="col-md-6 text-center">
        <img src="{{ Path::urlCom('slider/images/slider.gif') }}" alt="slider"/>
    </div>
    <div class="col-md-6">
        <legend>{{ \Language::getCom('slider.lbl_option') }}</legend>
        <div class="form-group">
            <label for="slider_id" class="control-label">{{ \Language::getCom('slider.lbl_slider') }} <sup class="text-danger">(*)</sup></label>
            <select class="select2" id="slider_id" required>
                @foreach (\App\Com\Slider\Slider::get() as $slider)
                    <option value="{{ $slider->id }}">{{ $slider->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="items" class="control-label">{{ \Language::getCom('slider.lbl_items') }} <sup class="text-danger">(*)</sup></label>
            <input type="number" class="form-control" name="items" id="items" data-bind="value: attribs().items" required min="0">
        </div>
        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" id="show_control" value="1" data-bind="attr:{'checked': attribs().show_control == '1'} "> {{ Language::getCom('slider.lbl_show_control') }}
            </label>
        </div>
        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" id="show_indicator" value="1" data-bind="attr:{'checked': attribs().show_indicator == '1'} "> {{ Language::getCom('slider.lbl_show_indicator') }}
            </label>
        </div>
        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" id="show_title" value="1" data-bind="attr:{'checked': attribs().show_title == '1'} "> {{ Language::getCom('slider.lbl_show_title') }}
            </label>
        </div>
        <div class="form-group">
            <label for="advance_class" class="control-label">{{ \Language::getCom('slider.lbl_advance_class') }}</label>
            <input type="text" class="form-control" name="advance_class" id="advance_class" data-bind="value: attribs().advance_class">
        </div>
    </div>
</div>
@endsection

@section('attribs-init')
<?php
    $attribs = null;
    if(isset($block)) $attribs = json_decode($block->attribs);
    else $attribs = json_decode($module->attribs);
    echo "slider_id:    '".$attribs->slider_id."',";
    echo "items:        '".$attribs->items."',";
    echo "show_control: '".$attribs->show_control."',";
    echo "show_indicator: '".$attribs->show_indicator."',";
    echo "show_title:   '".$attribs->show_title."',";
    echo "advance_class: '".$attribs->advance_class."'";
?>
@endsection

@section('attribs-save')
    self.attribs().slider_id = $('#slider_id').val();
    self.attribs().show_control = $('#show_control').is(':checked') ? 1:0;
    self.attribs().show_indicator = $('#show_indicator').is(':checked') ? 1:0;
    self.attribs().show_title = $('#show_title').is(':checked') ? 1:0;
@endsection

@section('block-config-function-include')
    $('#slider_id').select2('val', '{{ $attribs->slider_id }}');
@endsection
