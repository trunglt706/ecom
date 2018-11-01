<?php

namespace App\Com\Menu;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['menu_name', 'alias','parent_menu','menu_type', 'content', 'public', 'featured', 'note', 'advance _class', 'icon', 'sort', 'attribs', 'assignment', 'lang', 'rights'];
    public static $rules = [
        'menu_name'     => 'required',
        'alias'         => 'required|unique:menus,alias',
        'parent_menu'   => '',
        'menu_type'     => 'required',
        'content'           => 'required',
        'public'        => '',
        'featured'      => '',
        'note'          => '',
        'advance_class' => '',
        'icon'          => '',
        'sort'          => '',
        'attribs'       => '',
        'assignment'    => '',
        'lang'          => '',
        'rights'        => '',
    ];
    public static function cols() {
        return [
            'id'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ]
        ];
    }
    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    |
    */
    // for select
    public static function fetch($parent_menu = 0, $depth = ''){
        $cat = self::select('id', 'menu_name as text')->where('parent_menu', $parent_menu)->orderBy('sort', 'asc')->get();
        $res = [];
        foreach ($cat as $obj) {
            $obj->text = $depth.' '.$obj->text;
            array_push($res, $obj);
            $chdrs = self::fetch($obj->id, $depth.'-');
            foreach ($chdrs as $chdr) {
                array_push($res, $chdr);
            }
        }
        return $res;
    }

    public static function treeHtml($id){
        $par = self::where('parent_menu', $id)->orderBy('sort', 'asc')->get();
        $html = '';
        if(count($par)){
            $html .= '<ol class="dd-list">';
            foreach ($par as $chi) {
                $treeHtmlChi = self::treeHtml($chi->id);
                $html .= '<li class="dd-item dd3-item" data-id="'.$chi->id.'">'
                        .($treeHtmlChi == '' ? '':'<button data-action="collapse" type="button" style="display: block;">Collapse</button><button data-action="expand" type="button" style="display: none;">Expand</button>')
                        .'<div class="dd-handle dd3-handle"></div>'
                        .'<div data-bind="attr:{\'class\': active()==\''.$chi->id.'\' ? \'dd3-content active\': \'dd3-content\'}">'
                            .( '['.$chi->lang.'] '.$chi->menu_name)
                            .' '.($chi->public == '1' ? \Language::get('global.var_public') : \Language::get('global.var_unpublic'))
                            .'<div class="pull-right">'
                                .'<div class="btn-group btn-group-xs" role="group">'
                                    .'<div class="btn btn-default" data-bind="click: function(){edit('.$chi->id.');}"><span class="glyphicon glyphicon-edit"></span></div>'
                                    .'<div class="btn btn-default" data-bind="click: function(){del('.$chi->id.');}"><span class="glyphicon glyphicon-trash"></span></div>'
                                .'</div>'
                            .'</div>'
                        .'</div>'
                        .$treeHtmlChi
                        .'</li>';
            }
            $html .= '</ol>';
        }
        return $html;
    }

    public static function sort($parent, $children){
        $idx = 0;
        foreach ($children as $self) {
            self::where('id', $self->id)->update(['parent_menu'=>$parent, 'sort'=> $idx]);
            if(isset($self->children)) self::sort($self->id, $self->children);
            $idx++;
        }
    }

    public static function del($id){
        self::destroy($id);
        $ids = self::where('parent_menu', $id)->lists('id');
        foreach ($ids as $chi) {
            self::del($chi);
        }
        return count($ids) + 1;
    }

    // modules
    public static function getMenu($parent_menu = 0){
        return self::Where('parent_menu', $parent_menu)->where('public', 1)->orderBy('sort', 'asc')->get();
    }

    public static function can_access($menu){
        $assignment = json_decode($menu->assignment);
        switch ($assignment->mode){
            case 'and':
                if( (!\Auth::check() && count($assignment->assignment) != 0) || (\Auth::check() && !in_array(\Auth::user()->user_group_id, $assignment->assignment) )) return false;
                break;
            case 'not':
                if(\Auth::check() && in_array(\Auth::user()->user_group_id, $assignment->assignment)) return false;
                break;
        }
        return true;
    }

}
