<section id="product-info-form">
    @foreach($fields as $field)
    <div class="form-group">
        <label for="field_{{ $field->id }}" class="control-label">{{ $field->field_name }} <?php echo $field->not_null==1? '<sup class="text-danger">(*)</sup>':''; ?></label>
        <?php
            switch($field->input_type){
                case 'input':
                    if($field->unit != '') {
                        echo '<div class="input-group">';
                        echo '<div class="fg-line"><input type="'.$field->data_type.'" '.($field->data_type=='number'?'min="0"':'').' class="form-control fc-alt" data-bind="value: proInfo().field_'.$field->id.'" '.($field->not_null == 1 ? 'required':'').'></div>';
                        echo '<span class="input-group-addon">'.$field->unit.'</span>';
                        echo '</div>';
                    }else{
                        echo '<div class="fg-line"><input type="'.$field->data_type.'" '.($field->data_type=='number'?'min="0"':'').' class="form-control fc-alt" data-bind="value: proInfo().field_'.$field->id.'" '.($field->not_null == 1 ? 'required':'').'></div>';
                    }
                    break;
                case 'textarea':
                    echo '<textarea class="form-control fc-alt" data-bind="value: proInfo().field_'.$field->id.'" '.($field->not_null == 1 ? 'required':'').'></textarea>';
                    break;
            }
        ?>
    </div>
    @endforeach
</section>
<script>
    function ViewModelProductInfo() {
        var self = this;
        self.proInfo = ko.observable({
            <?php
                foreach($fields as $field) {
                    if(isset($field->value) && $field->value != '') echo 'field_'.$field->id.': '.($field->data_type == 'number' ? $field->value.',' : '"'.$field->value.'",');
                }
            ?>
        });
        self.getDataInfo = function(){
            return self.proInfo();
        };
    }
    var viewModelProductInfo = new ViewModelProductInfo();
    ko.applyBindings(viewModelProductInfo, document.getElementById('product-info-form'));
</script>
