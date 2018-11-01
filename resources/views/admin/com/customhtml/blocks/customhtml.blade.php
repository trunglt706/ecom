@extends(Path::viewAdmin('blocks.blockConfig'))

@section('block-config')
<script src="{{ Path::urlCom('ckeditor/ckeditor.js') }}"></script>

<legend>{{ \Language::getCom('customhtml.lbl_customhtml') }}</legend>
<div class="form-group">
    <label for="content" class="control-label">{{ \Language::getCom('customhtml.lbl_content') }} <sup class="text-danger">(*)</sup></label>
    <textarea class="ckeditor" id="content">
        {{ isset($block) ? $block->content : "" }}
    </textarea>
</div>

@endsection

@section('attribs-save')
    self.current().content = CKEDITOR.instances.content.getData();
@endsection

@section('block-config-function-include')
    $('.ckeditor').each(function(index, el) {
        @if( file_exists(config('data.PATH_MODEL').'/FileManager/') )
            <?php
                $akey = App\Com\FileManager\FileManager::getSecretKey();
                $filemanager_path = Path::url( config('data.ROUTE_PREFIX_ADMIN').'/filemanager?akey='.$akey);
            ?>
            CKEDITOR.replace( this ,{
                filebrowserBrowseUrl : '{{ $filemanager_path }}',
                filebrowserUploadUrl : '{{ $filemanager_path }}',
                filebrowserImageBrowseUrl : '{{ $filemanager_path }}'
            });
        @else
            CKEDITOR.replace( this );
        @endif
    });
@endsection
