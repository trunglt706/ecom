<?php

namespace App\Com\System;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['name','description', 'extension_id', 'attribs'];
    public static $rules = [
        'name'          => 'required',
        'description'   => 'required',
        'extension_id'  => 'required',
        'attribs'       => '',
    ];
    
    public static function fetch($id = null){
        $query = \DB::table('modules')
                    ->join('extensions', 'modules.extension_id', '=', 'extensions.id')
                    ->where('extensions.public', 1)
                    ->select('modules.id', 'modules.name', 'modules.description', 'modules.extension_id', 'modules.attribs', 'extensions.name as extension_name');
        return is_null($id) ? $query->get() : $query->where('modules.id', $id)->first();
    }
}
