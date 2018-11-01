<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class ExtensionController extends Controller
{
    private $model;

    public function __construct(\Extension $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }

    function postIndex() {
        return \Extension::fetch();
    }

    function postUploadPackage() {
        $package_path = \FileSystem::upload(\Input::file('filePackage'), ['zip'], null, time());
        if($package_path['status'] == 'success'){
            $config = \Extension::readConfig($package_path['path']);
            \FileSystem::unlink($package_path['path']);
            return $config;
        }
        return ['status' => 'error', 'message' => \Language::get('global.message_file_upload_error')];
    }

    function postDelPackage() {
        \FileSystem::rrmdir(config('data.PATH_EXTRACT').'/'. \Input::get('package'));
    }

    function postInstallPackage() {
        return \Extension::installPackage(config('data.PATH_EXTRACT').'/'. \Input::get('package'));
    }

    function getExportPackage() {
        if(\Input::has('id')){
            return \Extension::exportPackage(\Input::get('id'), \Input::get('db'));
        }
        return view('errors.404');
    }

    function postUninstallPackage() {
        return \Extension::uninstallPackage( \Input::get('ids') );
    }

    function postPublicPackage() {
        return \Extension::publicPackage( \Input::get('ids') , \Input::get('public'));
    }
}
