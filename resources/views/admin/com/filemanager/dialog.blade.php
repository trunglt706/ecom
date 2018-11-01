@extends(Path::viewAdmin('layouts.base'))

<?php
    $uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
    $prefix = Route::current()->getPrefix().'/';
    $alias = explode($prefix, $uri)[1];
    $route = App\Com\System\Route::get('admin', $alias);
?>
@section('css')
    <link href="{{ Path::url('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ Path::urlCom('filemanager/css/filemanager.css') }}" rel="stylesheet">
@endsection
@section('jsc')
    <script src="{{ Path::url('js/knockout.js') }}"></script>
    <script src="{{ Path::url('js/knockout.mapping.js') }}"></script>
    <script src="{{ Path::url('js/toastr.min.js') }}"></script>
    <script src="{{ Path::urlCom('filemanager/js/filemanager.js') }}"></script>
@endsection
@section('main')
    @include(Path::viewAdminCom('filemanager.blocks.filemanager'))
@endsection
