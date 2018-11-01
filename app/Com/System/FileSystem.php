<?php

namespace App\Com\System;

use Illuminate\Database\Eloquent\Model;

class FileSystem extends Model {

    /*
    |--------------------------------------------------------------------------
    | Upload fie to dir
    |--------------------------------------------------------------------------
    | Param:
    |   $file   : name of input file request to server
    |   $allowed: limited extensions
    |       null    : accept all extensions
    |       ['zip'] : accept zip file only
    |   $dir    : upload to dir (default: storage/upload)
    |   $file_name : file name on server (default: time())
    |
    | Output: 'error' or file path
    */
    public static function upload($file, $allowed = null, $dir = null, $file_name = null) {
        $data_dir = ($dir == null ? config('data.PATH_UPLOAD') : $dir);
        $extension = $file->getClientOriginalExtension();
        if ( ($allowed != null) && (!in_array(strtolower($extension), $allowed)) ) {
            return ['status'=>'warning', 'message'=>\Language::get('global.message_file_extension_not_allowed')];
        }
        $filename = $file_name == null ? $file->getClientOriginalName() : $file_name.'.'.$extension;
        $path = $file->move($data_dir, $filename);
        return ['status'=>'success', 'message'=>\Language::get('global.message_file_upload_success'), 'path'=>$path];
    }

    /*
    |--------------------------------------------------------------------------
    | Remove dir
    |--------------------------------------------------------------------------
    | allow dir not empty
    */
    public static function rrmdir($dir){
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    if (filetype($dir."/".$file) == "dir") self::rrmdir($dir."/".$file);
                    else self::unlink($dir."/".$file);
                }
            }
            reset($files);
            rmdir($dir);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Custom unlink function
    |--------------------------------------------------------------------------
    |
    */
    public static function unlink($file_path){
        if(is_file("$file_path")) {
            return unlink("$file_path");
        }
        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Copy dir
    |--------------------------------------------------------------------------
    |
    */
    public static function copydir($from_dir, $to_dir){
        if(is_dir($from_dir)){
            if ($handle = opendir($from_dir)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (!is_dir($from_dir.'/'.$file)){
                            copy($from_dir.'/'.$file, $to_dir.'/'.$file);
                        }else {
                            if(!file_exists($to_dir.'/'.$file)) mkdir($to_dir.'/'.$file, 0777, true);
                            self::copydir($from_dir.'/'.$file, $to_dir.'/'.$file);
                        }
                    }
                }
                closedir($handle);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Create file
    |--------------------------------------------------------------------------
    |
    */
    public static function createFile($fileName, $content) {
        $newFile = fopen($fileName, "w") or die("Unable to open file!");
        fwrite($newFile, $content);
        fclose($newFile);
    }

    /*
    |--------------------------------------------------------------------------
    | Rename file
    |--------------------------------------------------------------------------
    | $filename without extension
    */
    public static function rename($fileName, $path) {
        try{
            if(file_exists($path)){
                $path_parts = pathinfo($path);
                if(filetype($path) == 'file') $fileName .= '.'.$path_parts['extension'];
                rename($path, $path_parts['dirname'].'/'.$fileName);
                return ['status'=>'success', 'message'=> \Language::get('global.message_crud_update_success')];
            }
            return ['status'=>'warning', 'message'=> \Language::get('global.message_file_not_found')];
        }catch(Exception $e){
            return ['status'=>'error', 'code'=>$e->getCode(), 'message'=>$e->getMessage()];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Create zip
    |--------------------------------------------------------------------------
    |
    */
    public static function createZipArchive($dir_path, $file_path){
        $zip = new \ZipArchive();
        if ($zip->open($file_path, \ZipArchive::CREATE) == TRUE){
            $zip = self::zipAddFile($zip, $dir_path);
            $zip->close();
        }
    }
    // add all files from dir to zip
    public static function zipAddFile($zip, $dir, $root_path = ''){
        if(is_dir($dir)){
            if ($handle = opendir($dir)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (!is_dir($dir.'/'.$file)){
                            if($root_path == '') $zip->addFromString($file, file_get_contents($dir.'/'.$file) );
                            else $zip->addFromString($root_path.'/'.$file, file_get_contents($dir.'/'.$file) );
                        }else {
                            if($root_path == ''){
                                $zip->addEmptyDir($file);
                                $zip = self::zipAddFile($zip, $dir.'/'.$file, $file);
                            }else{
                                $zip->addEmptyDir($root_path.'/'.$file);
                                $zip = self::zipAddFile($zip, $dir.'/'.$file, $root_path.'/'.$file);
                            }
                        }
                    }
                }
                closedir($handle);
            }
        }
        return $zip;
    }

    /*
    |--------------------------------------------------------------------------
    | scan dir
    |--------------------------------------------------------------------------
    | scan current dir only
    */
    public static function scandir($dir){
        $dist_path = base_path($dir);
        $ico_path = \Path::urlCom('filemanager/images/ico/').'/';

        $arr = [];
        if (is_dir($dist_path)) {
            $files = scandir($dist_path);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    $path_parts = pathinfo($dist_path.$file);
                    $thumb = $ico_path."unknown.png";
                    $is_image = false;
                    if(is_dir($dist_path.$file)) $thumb = $ico_path."folder.png";
                    else{
                        $extension = $path_parts['extension'];
                        $image_extension = ["bmp", "cod", "gif", "ief", "jpg", "jfif", "tif", "ras", "cmx", "ico", "pnm", "pbm", "pgm", "ppm", "rgb", "xbm", "xpm", "xwd", "png", "jps", "fh"];
                        if(in_array($extension, $image_extension)) {
                            $thumb = config('data.PATH_ROOT').$dir.$file;
                            $is_image = true;
                        }
                        else{
                            $ico = config('data.PATH_LIB'). '/filemanager/images/ico/'.$extension.'.png';
                            if(file_exists($ico)) $thumb = $ico_path.$extension.'.png';
                        }
                    }
                    array_push($arr, [
                        "type"      => filetype($dist_path.$file),
                        "size"      => filesize($dist_path.$file),
                        "name"      => $path_parts['basename'],
                        "filename"  => $path_parts['filename'],
                        "extension" => is_file($dist_path.$file) ? strtolower( $path_parts['extension'] ) : '',
                        "path"      => $dir.$file,
                        "thumb"     => $thumb,
                        "is_image"  => $is_image,
                        "path_root" => config('data.PATH_ROOT').config('data.UPLOAD_DIR').'/'.$dist_path
                    ]);
                }
            }
            reset($files);
        }
        return $arr;
    }

    /*
    |--------------------------------------------------------------------------
    | Image to base64
    |--------------------------------------------------------------------------
    |
    */
    public static function imageToBase64($path){
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }


    /*
    |--------------------------------------------------------------------------
    | Files or dir perm
    |--------------------------------------------------------------------------
    |
    */
    // Find the owner of a file or dir
    public static function ownership($file){
        $stat = stat($file);
        if($stat){
            $group = \posix_getgrgid($stat[5]);
            $user = \posix_getpwuid($stat[4]);
            return compact('user', 'group');
        }
        else return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Filemanager <= user group
    |--------------------------------------------------------------------------
    |
    */
    public static function getFolderNameOfUserGroup($user_group_id){
        return md5(config('app.key').'_'.config('data.USER_GROUP_UPLOAD_DIR').'_'.$user_group_id);
    }
    public static function createFolderNameOfUserGroup($user_group_id){
        $dir = self::getFolderNameOfUserGroup($user_group_id);
        $dir = base_path(config('data.UPLOAD_DIR').'/'.$dir);
        if(!is_dir($dir)) mkdir($dir, 0777, true);
    }
    public static function removeFolderNameOfUserGroup($user_group_ids){
        foreach ($user_group_ids as $user_group_id) {
            $dir = self::getFolderNameOfUserGroup($user_group_id);
            $dir = base_path(config('data.UPLOAD_DIR').'/'.$dir);
            self::rrmdir($dir);
        }
    }

}
