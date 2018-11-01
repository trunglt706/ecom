@extends(Path::viewAdmin('layouts.base'))

<?php
    $uri = $_SERVER['REQUEST_URI'];
    $prefix = Route::current()->getPrefix().'/';
    $alias = explode($prefix, $uri)[1];
    $route = App\Com\System\Route::get('admin', $alias);
?>

@section('css')
    @include(Path::viewAdmin('blocks.style'))
@endsection
@section('jsc')
    @include(Path::viewAdmin('blocks.script'))
@endsection
@section('main')
    @include(Path::viewAdmin('blocks.header'))
    @include(Path::viewAdmin('blocks.overview'))
    @include( Path::viewAdminCom(strtolower($route->extension_name).'.pages.'.$route->name ))
    @include(Path::viewAdmin('blocks.footer'))
@endsection
