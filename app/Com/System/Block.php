<?php

namespace App\Com\System;

use Illuminate\Database\Eloquent\Model;

class Block extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['title','content', 'position', 'module_id', 'public', 'sort', 'assignment', 'layout', 'attribs'];
    public static $rules = [
        'title'     => 'required',
        'content'   => '',
        'position'  => '',
        'module_id' => 'required',
        'public'    => '',
        'sort'      => '',
        'assignment'=> '',
        'layout'    => '',
        'attribs'   => 'required',
    ];

    public static function cols() {
        return [
            'title'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'module_id_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
                'fkey'   => [
                    'fkey' => 'module_id',
                    'tbl'  => 'modules',
                    'col'  => 'name',
                ]
            ],
            'position'   => [
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
            ]
        ];
    }

    /*
    * fetch and render
    */
    public static function fetch(){
        $res = \CRUD::fetch(new self);
        foreach($res['rows'] as $row) {
            $row->public_render = $row->public == 1 ? \Language::get('global.var_public') : \Language::get('global.var_unpublic');
        }
        return $res;
    }

    /*
    |--------------------------------------------------------------------------
    | Render block on site
    |--------------------------------------------------------------------------
    | render custom block if exists else using default
    */
//    public static function render($blocks){
//        if(!isset($blocks)) return '';
//        $html = '';
//        foreach ($blocks as $block) {
//            $html .= $block;
//        }
//        return $html;
//    }
    public static function render($blocks, $pos, $sort) {
        if(!isset($blocks) || !isset($blocks[$pos][$sort])) return '';
        $html = '';
        foreach ($blocks[$pos][$sort] as $block) {
            $html .= $block;
        }
        return $html;
    }

    public static function renders($page){
        $res = [];
        $blocks = \DB::table('blocks')
                    ->join('modules', 'blocks.module_id', '=', 'modules.id')
                    ->join('extensions', 'modules.extension_id', '=', 'extensions.id')
                    ->where('extensions.public', 1)
                    ->where('blocks.public', 1)
                    ->orderBy('blocks.sort', 'asc')
                    ->select('blocks.id', 'blocks.title', 'blocks.content', 'blocks.module_id', 'blocks.position', 'blocks.assignment', 'blocks.attribs', 'modules.name as module_name', 'extensions.id as extension_id', 'extensions.name as extension_name')
                    ->get();
        foreach ($blocks as $block){
            $assignment = json_decode($block->assignment);
            $block_view = \Path::viewCom( strtolower($block->extension_name).'.'.$block->module_name );
            $extension_controller = 'App\Http\Controllers\Com\\' . $block->extension_name . '\\' . $block->extension_name . 'Controller';
            $block_content = '';
            switch ($assignment->mode){
                case 'and':
                    if(in_array($page->id, $assignment->assignment)){
                        $block_content = view($block_view)
                            ->with('block', \App::make($extension_controller)->{$block->module_name}($page, $block))
                            ->render();
                    }
                    break;
                case 'not':
                    if(!in_array($page->id, $assignment->assignment)){
                        $block_content = view($block_view)
                            ->with('block', \App::make($extension_controller)->{$block->module_name}($page, $block))
                            ->render();
                    }
                    break;
            }
            if($block_content != ''){
                if(!isset($res[$block->module_name][$block->position])) $res[$block->module_name][$block->position] = [];
                array_push($res[$block->module_name][$block->position], $block_content);
            }
        }
        return $res;
    }
}
