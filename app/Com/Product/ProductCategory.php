<?php

namespace App\Com\Product;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $fillable = ['category_name', 'parent_category', 'sort', 'product_custom_fields'];
    public static $rules = [
        'category_name'     => 'required',
        'parent_category'   => '',
        'sort'              => '',
        'product_custom_fields' => '',
    ];
    public static function cols() {
        return [
            'category_name'   => [
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
    public static function fetch($parent_category = 0, $depth = ''){
        $cat = self::select('id', 'category_name as text')->where('parent_category', $parent_category)->orderBy('sort', 'asc')->get();
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
        $par = self::where('parent_category', $id)->orderBy('sort', 'asc')->get();
        $html = '';
        if(count($par)){
            $html .= '<ol class="dd-list">';
            foreach ($par as $chi) {
                $treeHtmlChi = self::treeHtml($chi->id);
                $html .= '<li class="dd-item dd3-item" data-id="'.$chi->id.'">'
                        .($treeHtmlChi == '' ? '':'<button data-action="collapse" type="button" style="display: block;">Collapse</button><button data-action="expand" type="button" style="display: none;">Expand</button>')
                        .'<div class="dd-handle dd3-handle">Drag</div>'
                        .'<div data-bind="attr:{\'class\': active()==\''.$chi->id.'\' ? \'dd3-content active\': \'dd3-content\'}">'
                            .($chi->category_name)
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
            self::where('id', $self->id)->update(['parent_category'=>$parent, 'sort'=> $idx]);
            if(isset($self->children)) self::sort($self->id, $self->children);
            $idx++;
        }
    }

    public static function del($id){
        self::destroy($id);
        $ids = self::where('parent_category', $id)->lists('id');
        foreach ($ids as $chi) {
            self::del($chi);
        }
        return count($ids) + 1;
    }
}
