<?php

namespace App\Com\System;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['extension_id', 'layout', 'attribs'];
    public static $rules = [
        'extension_id'  => 'required',
        'layout'        => 'required',
        'attribs'       => '',

    ];

    public static function current($lang){
        return \DB::table('languages')
                ->join('templates', 'languages.template_id', '=', 'templates.id')
                ->join('extensions', 'templates.extension_id', '=', 'extensions.id')
                ->where('languages.alias', $lang)
                ->where('languages.public', 1)
                ->select('extensions.name as extension_name', 'extensions.type', 'templates.layout', 'languages.lang_code', 'languages.title', 'languages.alias', 'templates.id', 'languages.default')
                ->first();
    }

    public static function get($id = null){
        $res = \DB::table('templates')
                ->join('extensions', 'templates.extension_id', '=', 'extensions.id')
                ->where('extensions.public', '=', 1);
        if(!is_null($id)) $res->where('templates.id', $id);
        return $res->select('extensions.name as extension_name', 'extensions.type', 'templates.layout')
                    ->get();
    }
}
