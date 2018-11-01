<?php

namespace App\Com\System;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['name','type', 'location', 'author', 'creation_date', 'copyright', 'license', 'author_email', 'author_url', 'version', 'description', 'public', 'attribs'];
    public static $rules = [
        'name'          => 'required|unique:extensions,name',
        'type'          => 'required',
        'location'      => '',
        'author'        => 'required',
        'creation_date' => 'required',
        'copyright'     => '',
        'license'       => '',
        'author_email'  => '',
        'author_url'    => '',
        'version'       => '',
        'description'   => '',
        'public'        => 'required',
        'attribs'       => 'required',

    ];

    public static function cols() {
        return [
            'name'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'type'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'location'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'author'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'author_email'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'author_url'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'version'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'public_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'=> 'id',
                    'tbl' => 'blocks',
                    'col' => 'public',
                ]
            ],
            'id'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'right',
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    |
    */

    /*
    * fetch and render
    */
    public static function fetch(){
        $res = \CRUD::fetch(new self);
        foreach($res['rows'] as $row) {
            $row->public_render = $row->public == 1 ? \Language::get('global.var_public') : \Language::get('global.var_unpublic');
            $overview = $row->type == 'Template' ? config('data.PATH_LIB_TEMPLATE').'/'.strtolower($row->name).'/images/overview.png' : config('data.PATH_LIB').'/'.strtolower($row->name).'/images/overview.png';
            if(file_exists($overview)){
                $row->overview =  $row->type == 'Template' ? \Path::urlTemplate(strtolower($row->name).'/images/overview.png') : \Path::urlCom(strtolower($row->name).'/images/overview.png');
            }else $row->overview =  \Path::url('images/overview.png');
        }
        return $res;
    }

    /*
    * Extract zip file and read config (config.json)
    */
    public static function readConfig($package_path){
        $zip = new \ZipArchive;
        if ($zip->open($package_path) === true) {
            $package_folder_name = time();
            $zip->extractTo(config('data.PATH_EXTRACT').'/'.$package_folder_name);
            $zip->close();

            $path_config_file = config('data.PATH_EXTRACT').'/'.$package_folder_name.'/config.json';
            if(!file_exists($path_config_file)) return ['status' => 'error', 'message' => \Language::get('com/system.message_package_install_not_found_config')];
            
            if($config = json_decode(file_get_contents($path_config_file))){
                $config->package = $package_folder_name;
                return ['status' => 'success', 'message' => $config];
            }
            return ['status' => 'warning', 'message' => \Language::getCom('system.message_package_install_can_not_read_config')];
        }
        return ['status' => 'error', 'message' => \Language::get('global.message_file_open_error')];
    }

    /*
    * Install package
    */
    public static function installPackage($package_path){
        if(!is_dir($package_path)) return ['status' => 'error', 'message' => \Language::get('com/system.message_package_install_not_found')];
        $path_config_file = $package_path.'/config.json';
        if(!file_exists($path_config_file)) return ['status' => 'error', 'message' => \Language::get('com/system.message_package_install_not_found_config')];
        $config = json_decode(file_get_contents($path_config_file));
        $config->name = str_replace( " ", "", $config->name );

        $logs = '============ Begin Install Package ============<br>';
        /*
        * Copy files
        */
        try{
            // save file config.json
            if(!is_dir(config('data.PATH_MODEL').'/'.$config->name)) mkdir(config('data.PATH_MODEL').'/'.$config->name, 0777, true);
            copy($package_path.'/config.json', config('data.PATH_MODEL').'/'.$config->name.'/config.json');

            // copy files system
            switch ($config->type){
                case 'Template':
                    $paths = [
                        'db'    => config('data.PATH_MODEL').'/'.$config->name.'/db',
                        'lib'   => config('data.PATH_LIB_TEMPLATE').'/'.strtolower($config->name),      // change
                        'site'  => config('data.PATH_VIEW_TEMPLATE').'/'.strtolower($config->name),     // change
                        'admin/view'  => config('data.PATH_VIEW_ADMIN').'/'.strtolower($config->name),
                        'admin/model'  => config('data.PATH_MODEL').'/'.$config->name,
                        'admin/ctrl'  => config('data.PATH_CONTROLLER').'/'.$config->name,
                    ];
                    
                    foreach ($paths as $key=>$val) {
                        if(file_exists($package_path.'/'.$key)){
                            if(!is_dir($val)) mkdir($val, 0777, true);
                            \FileSystem::copydir($package_path.'/'.$key, $val);
                        }
                    }
                    
                    if(isset($config->lang)){
                        foreach ($config->lang as $lang) {
                            if(file_exists($package_path.'/lang/'.$lang)){
                                $lang_template = base_path('resources/lang/'.$lang.'/templates');
                                if(!is_dir($lang_template)) mkdir($lang_template, 0777, true);
                                \FileSystem::copydir($package_path.'/lang/'.$lang, $lang_template );
                            }
                        }
                    }
                    break;
                default :
                    // Component
                    $paths = [
                        'db'    => config('data.PATH_MODEL').'/'.$config->name.'/db',
                        'lib'   => config('data.PATH_LIB').'/'.strtolower($config->name),
                        'site'  => config('data.PATH_VIEW_SITE').'/'.strtolower($config->name),
                        'admin/view'  => config('data.PATH_VIEW_ADMIN').'/'.strtolower($config->name),
                        'admin/model'  => config('data.PATH_MODEL').'/'.$config->name,
                        'admin/ctrl'  => config('data.PATH_CONTROLLER').'/'.$config->name,
                    ];
                    
                    foreach ($paths as $key=>$val) {
                        if(file_exists($package_path.'/'.$key)){
                            if(!is_dir($val)) mkdir($val, 0777, true);
                            \FileSystem::copydir($package_path.'/'.$key, $val);
                        }
                    }
                    
                    if(isset($config->lang)){
                        foreach ($config->lang as $lang) {
                            if(file_exists($package_path.'/lang/'.$lang)){
                                \FileSystem::copydir($package_path.'/lang/'.$lang, base_path('resources/lang/'.$lang.'/com') );
                            }
                        }
                    }
                    break;
            }
            
            $logs .= '[Copy files]: Success<br>';
        } catch (Exception $e){
            $logs .= '[Copy files]: Error<br>Error: '.$e->getMessage().'<br>';
        }
        /*
        * Create databases
        */
        $sql_install_path = $package_path.'/db/install.sql';
        if(file_exists($sql_install_path)){
            $sql_install = file_get_contents($sql_install_path);
            try{
                \DB::unprepared($sql_install);
                $logs .= '[Create databases]: Success<br>';
            }catch(\Illuminate\Database\QueryException $e){
                $logs .= '[Create databases]: Error<br>SQL Error: '. $e->getMessage() . '<br>';
            }
        }
        /*
        * Create data
        */

        $config->attribs = json_encode($config);
        $config->public = 1;
        $extension = \CRUD::insert(new self, get_object_vars($config));
        
        if($extension['status'] == 'success'){
            if(isset($config->route)){
                foreach ($config->route as $route){
                    $route->extension_id = $extension['model']->id;
                    $perm = [];
                    $usrg = \UserGroup::lists('id');
                    foreach ($route->perm as $perm_code){
                        array_push($perm, $usrg);
                    }
                    $route->perm = json_encode(array_combine($route->perm, $perm));
                    \CRUD::insert(new \App\Com\System\Route, get_object_vars($route));
                }
            }
            if(isset($config->module)){
                foreach ($config->module as $module){
                    $module->extension_id = $extension['model']->id;
                    $module->attribs = json_encode($module->attribs);
                    \CRUD::insert(new \Module, get_object_vars($module));
                }
            }
            if(isset($config->layout)){
                $template = [
                    'extension_id'  => $extension['model']->id,
                    'layout'        => json_encode($config->layout)
                ];
                \CRUD::insert(new \Template, $template);
            }
        }
        $logs .= '[Create data]: Success<br>';
        $logs .= '============ End Install ============<br>';
        \FileSystem::rrmdir($package_path);
        return ['status' => 'success', 'message' => $logs];
    }

    /*
    * Export package
    */
    public static function exportPackage($id, $db_op){
        $extension = \Extension::find($id);
        if(is_null($extension)) return view('errors.404');
        $config = json_decode($extension->attribs);
        $tmp_dir = 'tmp_'.time();
        $tmp_dir_path = config('data.PATH_DOWNLOAD').'/'.$tmp_dir;
        mkdir($tmp_dir_path, 0777, true);
        
        switch ($config->type){
            case 'Template':
                $paths = [
                    'lib'   => config('data.PATH_LIB_TEMPLATE').'/'.strtolower($config->name),
                    'site'  => config('data.PATH_VIEW_TEMPLATE').'/'.strtolower($config->name),
                    'admin/view'  => config('data.PATH_VIEW_ADMIN').'/'.strtolower($config->name),
                    'admin/model'  => config('data.PATH_MODEL').'/'.$config->name,
                    'admin/ctrl'  => config('data.PATH_CONTROLLER').'/'.$config->name,
                ];
                foreach ($paths as $key=>$val){
                    if(file_exists($val)){
                        mkdir($tmp_dir_path.'/'.$key, 0777, true);
                        \FileSystem::copydir($val, $tmp_dir_path.'/'.$key);
                    }
                }
                /*
                * Backup lang
                */
                if(isset($config->lang)){
                    mkdir($tmp_dir_path.'/lang', 0777, true);
                    foreach ($config->lang as $lang){
                        if(file_exists(base_path('resources/lang').'/'.$lang.'/templates/'.  strtolower($config->name).'.php')){
                            mkdir($tmp_dir_path.'/lang/'.$lang, 0777, true);
                            copy(base_path('resources/lang').'/'.$lang.'/templates/'.  strtolower($config->name).'.php', $tmp_dir_path.'/lang/'.$lang.'/'.strtolower($config->name).'.php');
                        }
                    }
                }
                break;
            default:
                $paths = [
                    'lib'   => config('data.PATH_LIB').'/'.strtolower($config->name),
                    'site'  => config('data.PATH_VIEW_SITE').'/'.strtolower($config->name),
                    'admin/view'  => config('data.PATH_VIEW_ADMIN').'/'.strtolower($config->name),
                    'admin/model'  => config('data.PATH_MODEL').'/'.$config->name,
                    'admin/ctrl'  => config('data.PATH_CONTROLLER').'/'.$config->name,
                ];
                foreach ($paths as $key=>$val){
                    if(file_exists($val)){
                        mkdir($tmp_dir_path.'/'.$key, 0777, true);
                        \FileSystem::copydir($val, $tmp_dir_path.'/'.$key);
                    }
                }

                /*
                * Backup lang
                */
                if(isset($config->lang)){
                    mkdir($tmp_dir_path.'/lang', 0777, true);
                    foreach ($config->lang as $lang){
                        if(file_exists(base_path('resources/lang').'/'.$lang.'/com/'.  strtolower($config->name).'.php')){
                            mkdir($tmp_dir_path.'/lang/'.$lang, 0777, true);
                            copy(base_path('resources/lang').'/'.$lang.'/com/'.  strtolower($config->name).'.php', $tmp_dir_path.'/lang/'.$lang.'/'.strtolower($config->name).'.php');
                        }
                    }
                }
                break;
        }
        

        /*
        * Backup databases
        */
        $db = config('data.PATH_MODEL').'/'.$config->name.'/db';
        if( file_exists($db) ){
            mkdir($tmp_dir_path.'/db', 0777, true);
            \FileSystem::copydir($db, $tmp_dir_path.'/db');
            \FileSystem::rrmdir($tmp_dir_path.'/admin/model/db/');
        }
        /*
        * Backup config.json
        */
        if(file_exists(config('data.PATH_MODEL').'/'.$config->name.'/config.json')){
            copy(config('data.PATH_MODEL').'/'.$config->name.'/config.json', $tmp_dir_path.'/config.json');
            \FileSystem::unlink($tmp_dir_path.'/admin/model/config.json');
            if( count(glob($tmp_dir_path.'/admin/model/*')) == 0 ){
                \FileSystem::rrmdir($tmp_dir_path.'/admin/model');
            }
            if( count(glob($tmp_dir_path.'/admin/*')) == 0 ){
                \FileSystem::rrmdir($tmp_dir_path.'/admin');
            }
        }
        /*
        * Create zip file
        */
        $zip = config('data.PATH_DOWNLOAD').'/zip_'.time().'.zip';
        \FileSystem::createZipArchive($tmp_dir_path, $zip);
        $filename = 'Package_'.$config->name.'_'.time().'.zip';
        header('Content-disposition: attachment; filename='.$filename);
        header('Content-type: application/zip');
        readfile($zip);
        unlink($zip);
        \FileSystem::rrmdir($tmp_dir_path);
    }

    /*
    * Uninstall package
    */
    public static function uninstallPackage($ids){
        try {
            $ids = json_decode($ids);
            $numDel = 0;
            foreach($ids as $id){
                $extension = self::find($id);
                if(!is_null($extension) && $extension->protected == 0){
                    $config = json_decode($extension->attribs);
                    // Delete database
                    self::destroy($id);
                    $uninstall_sql = config('data.PATH_MODEL').'/'.$config->name.'/db/uninstall.sql';
                    if(file_exists($uninstall_sql)){
                        \DB::unprepared(file_get_contents($uninstall_sql) );
                    }
                    /*
                    * Delete files system
                    */
                   switch ($config->type){
                       case 'Template';
                           $paths = [
                                'lib'   => config('data.PATH_LIB_TEMPLATE').'/'.strtolower($config->name),
                                'site'  => config('data.PATH_VIEW_TEMPLATE').'/'.strtolower($config->name),
                                'admin/view'  => config('data.PATH_VIEW_ADMIN').'/'.strtolower($config->name),
                                'admin/model'  => config('data.PATH_MODEL').'/'.$config->name,
                                'admin/ctrl'  => config('data.PATH_CONTROLLER').'/'.$config->name,
                            ];
                            foreach ($paths as $key=>$val){
                                if(file_exists($val)){
                                    \FileSystem::rrmdir($val);
                                }
                            }
                            // Delete lang
                            if(isset($config->lang)){
                                foreach( $config->lang as $lang ){
                                    \FileSystem::unlink( base_path('resources/lang/'.$lang.'/templates/'.  strtolower($config->name)).'.php' );
                                }
                            }
                            $numDel++;
                           break;
                       default:
                           $paths = [
                                'lib'   => config('data.PATH_LIB').'/'.strtolower($config->name),
                                'site'  => config('data.PATH_VIEW_SITE').'/'.strtolower($config->name),
                                'admin/view'  => config('data.PATH_VIEW_ADMIN').'/'.strtolower($config->name),
                                'admin/model'  => config('data.PATH_MODEL').'/'.$config->name,
                                'admin/ctrl'  => config('data.PATH_CONTROLLER').'/'.$config->name,
                            ];
                            foreach ($paths as $key=>$val){
                                if(file_exists($val)){
                                    \FileSystem::rrmdir($val);
                                }
                            }
                            // Delete lang
                            if(isset($config->lang)){
                                foreach( $config->lang as $lang ){
                                    \FileSystem::unlink( base_path('resources/lang/'.$lang.'/com/'.  strtolower($config->name)).'.php' );
                                }
                            }
                            $numDel++;
                           break;
                   }
                }
            }
        } catch(Exception $e) {
            return [ 'status' => 'error',
                     'message' =>  \Language::get('global.message_crud_delete_error'),
                     'info' => $e->getMessage()];
        }
        return ['status' => 'success', 'message' => \Language::get('global.message_crud_delete_success', ["delNum"=>$numDel])];
    }

    /*
    * Change status extensions
    */
    public static function publicPackage($ids, $public){
        self::Where('type', '!=', 'System')->whereIn('id', json_decode($ids))->update(['public'=>$public]);
        return ['status'=>'success', 'message'=> \Language::get('global.message_crud_update_success')];
    }
}
