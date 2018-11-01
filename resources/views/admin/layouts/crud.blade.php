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
    @include(Path::viewAdmin('tables.toolbar'))
    <div class="container-fluid" style="margin-bottom: 50px">
        <div data-bind="visible: view()==='table'">
            @include(Path::viewAdmin('tables.default'))
        </div>
        <div data-bind="visible: view()==='form'" style="display: none;">
            <form role="form" id="edit-form">
                @include( Path::viewAdminCom(strtolower($route->extension_name).'.forms.'.$route->name ))
            </form>
        </div>
    </div>
    @include(\Path::viewAdmin('blocks.cfmDel'))
    @include(Path::viewAdmin('blocks.footer'))
    @include(Path::viewAdmin('blocks.mainScript'))
@endsection
