<?php

namespace App\Http\Controllers\Com\FileManager;

use App\Http\Controllers\Controller;
use App\Com\FileManager\FileManager;

class FileManagerController extends Controller
{
    private $model;
    private $alias = 'filemanager';

    public function __construct(FileManager $model) {
        if(!\Permission::hasPerm($this->alias, 'CAN_ACCESS')) \App::abort(404);
        $this->model = $model;
    }

    public function getIndex(){
        if( !FileManager::acceptSecretKey(\Input::get('akey', '')) ) \App::abort(404);
        return view(\Path::viewAdminCom('filemanager.dialog'), ['M' => $this->model]);
    }
    
    public function postIndex(){
        return FileManager::fetch();
    }
    
    public function postRename(){
        if(!\Permission::hasPerm($this->alias, 'CAN_UPDATE'))
            return ['status'=>'warning', 'message'=>\Language::get('global.message_auth_permission_update_denied')];
        return FileManager::rename();
    }
    
    public function postDelete(){
        if(!\Permission::hasPerm($this->alias, 'CAN_DELETE'))
            return ['status'=>'warning', 'message'=>\Language::get('global.message_auth_permission_delete_denied')];
        return FileManager::deleteFile();
    }
    
    public function postUpload(){
        if(!\Permission::hasPerm($this->alias, 'CAN_UPLOAD'))
            return ['idx'=>\Input::get('idx'),'status'=>'warning', 'message'=>\Language::get('global.message_auth_permission_upload_denied')];
        return FileManager::upload();
    }
    
    public function postCreateDir(){
        if(!\Permission::hasPerm($this->alias, 'CAN_CREATE'))
            return ['status'=>'warning', 'message'=>\Language::get('global.message_auth_permission_create_denied')];
        return FileManager::createDir();
    }
}
