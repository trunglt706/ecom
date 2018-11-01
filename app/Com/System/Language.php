<?php

namespace App\Com\System;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['lang_code', 'title', 'alias', 'template_id', 'default', 'public', 'perm', 'attribs'];
    public static $rules = [
        'lang_code'     => 'required',
        'title'         => 'required',
        'alias'         => 'required|unique:languages,alias',
        'template_id'   => 'required',
        'default'       => '',
        'public'        => '',
        'perm'          => '',
        'attribs'       => '',
        
    ];
    
    public static function cols() {
        return [
            'title'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'alias'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'lang_code_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey' => 'lang_code',
                    'tbl'  => 'languages',
                    'col'  => 'lang_code'
                ]
            ],
            'template_id_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'=> 'template_id',
                    'tbl' => 'templates',
                    'col' => 'id',
                ]
            ],
            'default_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'=> 'id',
                    'tbl' => 'languages',
                    'col' => 'default',
                ]
            ],
            'public_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey'=> 'id',
                    'tbl' => 'languages',
                    'col' => 'public',
                ]
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
            $row->default_render = $row->default == 1 ? \Language::get('global.var_featured') : \Language::get('global.var_unfeatured');
            $row->lang_code_render = '<img src="'.(\Path::url('images/languages/'.$row->lang_code.'.gif')).'"> '.config('data.languages')[$row->lang_code];
            $row->template_id_render = \DB::table('templates')->join('extensions', 'templates.extension_id', '=', 'extensions.id')->where('templates.id', $row->template_id)->pluck('extensions.name');
            $row->default_render = $row->default == '1' ? \Language::get('global.var_home'):'';
            $row->public_render = $row->public == 1 ? \Language::get('global.var_public') : \Language::get('global.var_unpublic');
        }
        return $res;
    }
    /*
    |--------------------------------------------------------------------------
    | overwrite lang
    | trans()
    |--------------------------------------------------------------------------
    |
    */
    
    public static function get($trans, $param = []){
        if(\Lang::has($trans)) return \Lang::get($trans, $param);
        return \Lang::get($trans, $param, config('app.locale'));
    }
    // without folder name
    public static function getCom($trans, $param = []){
        return self::get('com/'.$trans, $param);
    }
    public static function getTemplate($trans, $param = []){
        return self::get('templates/'.$trans, $param);
    }
    
    public static function getLang(){
        return config('data.languages');
    }
    
    /*
    |--------------------------------------------------------------------------
    | Site
    |--------------------------------------------------------------------------
    |
    */
}
