@extends(Path::viewAdmin('layouts.base'))

<?php
    $uri = '/'.Route::current()->getUri();
    $prefix = Route::current()->getPrefix().'/';
    $alias = explode($prefix, $uri)[1];
    $route = App\Com\System\Route::get('admin', $alias);
?>
@section('css')
    <link href="{{ Path::url('css/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('jsc')
    <script src="{{ Path::url('js/knockout.js') }}"></script>
    <script src="{{ Path::url('js/knockout.mapping.js') }}"></script>
    <script src="{{ Path::url('js/toastr.min.js') }}"></script>
@endsection
@section('main')
    @include(Path::viewAdminCom('member.blocks.member_product'))
@endsection