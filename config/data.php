<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return [

    'PATH_ROOT'                 => env('PATH_ROOT', '/'),
    /*
    |--------------------------------------------------------------------------
    | Application structure
    |--------------------------------------------------------------------------
    | lang: using default config
    |
    */
    'PATH_UPLOAD'              => public_path('storage/upload'),
    'PATH_DOWNLOAD'            => storage_path('download'),
    'PATH_EXTRACT'             => storage_path('extract'),
    
    'PATH_MODEL'               => app_path('Com'),
    'PATH_LIB'                 => public_path('com'),
    'PATH_LIB_TEMPLATE'        => public_path('templates'),
    'PATH_VIEW_SITE'           => base_path('resources/views/com'),
    'PATH_VIEW_ADMIN'          => base_path('resources/views/admin/com'),
    'PATH_VIEW_TEMPLATE'       => base_path('resources/views/templates'),
    'PATH_LANG'                => base_path('resources/lang'),
    'PATH_CONTROLLER'          => app_path('Http/Controllers/Com'),
    
    /*
    |--------------------------------------------------------------------------
    | Routes system
    |--------------------------------------------------------------------------
    |
    |
    */
    'ROUTE_PREFIX_ADMIN'      => 'admin',
    'ROUTE_PREFIX_SITE'       => 'site',
    
    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    |
    |
    */
    'languages'               => ['vi'=>'Vietnamese', 'en'=>'English'],
    
    /*
    |--------------------------------------------------------------------------
    | File Manager config
    |--------------------------------------------------------------------------
    |
    */
    'USER_GROUP_UPLOAD_DIR'   => env('USER_GROUP_UPLOAD_DIR', 'USER_GROUP'),
    'MEMBER_UPLOAD_DIR'       => env('MEMBER_UPLOAD_DIR', 'MEMBER'),
    'UPLOAD_DIR'              => env('UPLOAD_DIR', 'public/storage/upload'),
    'UPLOAD_ALLOWED'          => [
        'bmp', 'cod', 'gif', 'ief', 'jpg', 'jfif', 'tif', 'ras', 'cmx', 'ico', 'pnm', 'pbm', 'pgm', 'ppm', 'rgb', 'xbm', 'xpm', 'xwd', 'png', 'jps', 'fh',
        '7z', 'gz', 'rar', 'tar', 'zip',
        'ac3', 'aiff', 'm4a', 'mid', 'mp3', 'ogg', 'wav',
        'accdb', 'ade', 'adp', 'mdb', 
        'avi', 'mov', 'mp4', 'mpeg', 'mpg', 'webm', 'wma', 
        'csv', 'xls', 'xlsx',
        'doc', 'docx', 'odb', 'odf', 'odg', 'odp', 'ods', 'odt', 'otg', 'rtf', 'txt',
        'pdf', 
        'ppt', 'pptx',
        'css', 'html', 'js', 'php', 'sql'
    ],
];

