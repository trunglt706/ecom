<script src="{{ Path::url('js/knockout.js') }}"></script>
<script src="{{ Path::url('js/knockout.mapping.js') }}"></script>
<script src="{{ Path::url('js/jquery.validate.min.js') }}"></script>
<script src="{{ Path::url('js/jquery.validate.vi.min.js') }}"></script>
<script src="{{ Path::url('js/moment.min.js') }}"></script>
<script src="{{ Path::url('js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ Path::url('js/toastr.min.js') }}"></script>
<script src="{{ Path::url('js/select2.min.js') }}"></script>
<script src="{{ Path::url('js/vi.js') }}"></script>
<script src="{{ Path::url('js/jquery.nestable.js') }}"></script>

@if( file_exists(config('data.PATH_MODEL').'/CKEditor/') )
<script src="{{ Path::urlCom('ckeditor/ckeditor.js') }}"></script>
@endif

<script src="{{ Path::url('js/fn.js') }}"></script>

