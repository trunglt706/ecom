<?php

namespace App\Com\FileManager;

use Illuminate\Database\Eloquent\Model;

class FileManager extends Model {

    public static function fetch(){
        try{
            $path = \Input::get('path', '/');
            $dirs = explode("/", $path);
            $paths = [];
            $path_tmp = '';
            foreach ($dirs as $p){
                if($p != ''){
                    $path_tmp .= '/'.$p.'/';
                    array_push($paths, [
                        'dir' => $p,
                        'path'=> $path_tmp
                    ]);
                }
            }
            $path = self::getCurrentRootFolder().$path;

            //search
            $scandir = \FileSystem::scandir($path);
            $files = [];
            $search = \Input::get('search', '');
            if($search != ''){
            foreach ($scandir as $file){
                if(stripos($file['name'], $search) !== false) array_push($files, $file);
            }
            }else $files = $scandir;
            return ['status'=>'success', 'paths'=>$paths, 'files'=>$files, 'path'=>$path];
        } catch (Exception $e) {
            return ['status'=>'error', 'code'=>$e->getCode(), 'message'=>$e->getMessage()];
        }
    }

    public static function rename(){
        $file = \Input::get('file');
        return \FileSystem::rename($file['filename'], base_path( $file['path'] ));
    }

    public static function deleteFile(){
        $inp = \Input::all();
        try {
            $delNum = 0;
            $path = base_path( self::getCurrentRootFolder() . $inp['path'] );
            foreach ($inp['files'] as $file){
                switch (filetype($path.$file)){
                    case 'dir':
                        \FileSystem::rrmdir($path.$file);
                        $delNum++;
                        break;
                    case 'file':
                        \FileSystem::unlink($path.$file);
                        $delNum++;
                        break;
                }
            }
            return ['status'=>'success', 'message'=>\Language::get('global.message_crud_delete_success', ['delNum'=>$delNum])];
        } catch (Exception $exc) {
            return ['status'=>'error', 'code'=>$e->getCode(), 'message'=>$e->getMessage()];
        }
    }

    public static function upload(){
        try{
            $file = \Input::file('file');
            $path = base_path( self::getCurrentRootFolder() . \Input::get('path') );
            $allowed = config('data.UPLOAD_ALLOWED');
            $res = \FileSystem::upload($file, $allowed, $path);
            $res['idx'] = \Input::get('idx');
            return $res;
        }  catch (Exception $e){
            return ['status'=>'error', 'code'=>$e->getCode(), 'message'=>$e->getMessage()];
        }
    }

    public static function createDir(){
        try{
            $path = \Input::get('name');
            $path = str_replace( ".", "_", $path );
            $path = base_path( self::getCurrentRootFolder() . \Input::get('path') .'/'. $path );
            if(!file_exists($path)) mkdir($path, 0777, true);
            return ['status'=>'success', 'message'=>\Language::get('global.message_crud_insert_success') ];
        }  catch (Exception $e){
            return ['status'=>'error', 'code'=>$e->getCode(), 'message'=>$e->getMessage()];
        }
    }

    // generate key
    public static function getSecretKey() {
        $str = \Auth::user()->id.config('app.key');
        return \Hash::make($str);
    }
    // key key
    public static function acceptSecretKey($key) {
        $str = \Auth::user()->id.config('app.key');
        return \Hash::check($str, $key);
    }

//    public static function getCurrentRootFolder() {
//        return config('data.UPLOAD_DIR').'/'.(\FileSystem::getFolderNameOfUserGroup(\Auth::user()->user_group_id));
//    }

    public static function getCurrentRootFolder() {
        if (\UserGroup::where('id', \Auth::user()->user_group_id)->first()->group_code == "MEMBER") {
            $member_tin = \App\Com\Member\MemberUser::where('user_id', \Auth::user()->id)->first()->member_tin;
            return config('data.UPLOAD_DIR').'/'.(\FileSystem::getFolderNameOfUserGroup(\Auth::user()->user_group_id).'/'.\App\Com\Member\MemberMedia::getMemberFolder($member_tin));
        }
        if (\UserGroup::where('id', \Auth::user()->user_group_id)->first()->group_code == "SUPERUSER")
            return config('data.UPLOAD_DIR').'/'.(\FileSystem::getFolderNameOfUserGroup(\Auth::user()->user_group_id));
        return config('data.UPLOAD_DIR');
    }
}
