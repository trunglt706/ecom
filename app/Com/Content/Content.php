<?php

namespace App\Com\Content;

use Illuminate\Database\Eloquent\Model;
use App\Com\Content\ContentCategory;
use App\Com\System\User;

class Content extends Model {

    protected $fillable = ['title', 'alias', 'image', 'content', 'tags', 'category_id', 'user_id', 'public', 'sort', 'featured', 'keywords', 'lang'];
    public static $rules = [
        'title'       => 'required',
        'alias'       => 'required|unique:contents',
        'image'       => '',
        'content'     => 'required',
        'tags'        => '',
        'category_id' => 'required',
        'user_id'     => 'required',
        'public'      => '',
        'sort'        => '',
        'featured'    => '',
        'keywords'    => '',
        'lang'        => ''
    ];
    public static function cols(){
            return [
            'title'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'category_id_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey' => 'category_id',
                    'col'  => 'category_name',
                    'tbl'  => 'content_categories'
                ],
                'group' => [
                    'key' => 'category_id',
                    'col' => 'category_name',
                    'tbl' => 'content_categories'
                ]
            ],
            'public_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey' => 'public',
                    'col'  => 'public',
                    'tbl'  => 'contents'
                ]
            ],
            'featured_render'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'fkey'   => [
                    'fkey' => 'featured',
                    'col'  => 'featured',
                    'tbl'  => 'contents'
                ]
            ],
            // 'user_id_render'   => [
            //     'filter' => ['srt', 'src'],
            //     'align'  => 'center',
            //     'fkey'   => [
            //         'fkey' => 'user_id',
            //         'col'  => 'fullname',
            //         'tbl'  => 'users'
            //     ],
            //     'group' => [
            //         'key' => 'user_id',
            //         'col' => 'fullname',
            //         'tbl' => 'users'
            //     ]
            // ],
            'sort'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
            ],
            'lang'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'center',
                'group' => [
                    'key' => 'lang',
                    'val' => 'lang_code',
                    'col' => 'title',
                    'tbl' => 'languages'
                ]
            ],
            'id'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'right',
            ]
        ];
    }

    public static function fetch() {
        $res = \CRUD::fetch(new self);
       foreach($res['rows'] as $row) {
           $row->category_id_render = ContentCategory::where('id', $row->category_id)->value('category_name');
           $row->user_id_render = \User::where('id', $row->user_id)->value('fullname');
           $row->public_render = $row->public == '1' ? \Language::get('global.var_public') : \Language::get('global.var_unpublic');
           $row->featured_render = $row->featured == '1' ? \Language::get('global.var_featured') : \Language::get('global.var_unfeatured');
           $row->image = config("data.PATH_ROOT").$row->image;
       }
        return $res;
    }

    public static function getInfo($content_id) {
        $content = self::find($content_id);
        $content->update(['views' => $content->views + 1]);
        $content->content = explode('<hr />', $content->content);
        $content->category_id_render = ContentCategory::where('id', $content->category_id)->value('category_name');
        $content->user_id_render = \User::where('id', $content->user_id)->value('fullname');
        $content->created_at_render = date('H:i d-m-Y', strtotime(str_replace("/","-", $content->created_at)));
        $content->tags = explode(',', $content->tags);

        $query = self::where('public', 1)->where('lang', $content->lang);
        $query->where(function($query) use ($content)
        {
            foreach ($content->tags as $tag){
                $query->orWhere( 'tags', 'like', '%'.$tag.'%');
            }
            $query->orWhere( 'title', 'like', '%'.$content->title.'%');
            $query->orWhere( 'user_id', '=', $content->user_id);
            $query->orWhere( 'category_id', '=', $content->category_id);
        });
        $query->orderBy('featured', 'desc');
        $query->orderBy('sort', 'desc');
        $query->orderBy('created_at', 'desc');
        $query->limit(10);

        $neighborhoods = [];
        foreach ($query->get() as $con) {
            $url = self::getUrl($content->lang, $con->id, $con->alias, $con->category_id);
            if( $url != ''){
                $con->url = $url;
                array_push($neighborhoods, $con);
            }
        }
        $content->neighborhoods = $neighborhoods;
        return $content;
    }

    public static function getList($category_id, $lang = 'vi', $page = 0, $limit = 5){
        $res = [];
        $query = self::where('lang', $lang)
                    ->where('public', 1)
                    ->where('category_id', $category_id)
                    ->orderBy('featured', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->orderBy('sort', 'desc');
        $res['total'] = $query->count();
        $query->skip($page * $limit)->take($limit);
        $res['rows'] = $query->get();
        return $res;
    }

    public static function getUrl($lang, $content_id, $content_alias, $category_id) {
        $menus = \App\Com\Menu\Menu::whereIn('content', ['article_category', 'article'])
                ->where('menu_type', 'layout')
                ->where('public', 1)
                ->where('lang', $lang)
                ->get();
        foreach($menus as $menu){
            $attribs = json_decode($menu->attribs);
            $allow_assignment = true;
            $assignment = json_decode($menu->assignment);
            switch ($assignment->mode){
                case 'and':
                    if( (!\Auth::check() && count($assignment->assignment) != 0) || (\Auth::check() && !in_array(\Auth::user()->user_group_id, $assignment->assignment) )) $allow_assignment = false;
                    break;
                case 'not':
                    if(\Auth::check() && in_array(\Auth::user()->user_group_id, $assignment->assignment)) $allow_assignment = false;
                    break;
            }
            if($allow_assignment){
                if($menu->content == 'article' && $attribs->content_id == $content_id) return \Path::url($lang.'/'.$menu->alias);
                if($menu->content == 'article_category' && $attribs->category_id == $category_id) return \Path::url($lang.'/'.$menu->alias.'/'.$content_alias);
            }
        }
        return '';
    }
    public static function split_word($str, $limit, $html = false){
        if(!$html) $str = strip_tags($str);
        $html = '';
        $strs =explode(' ', $str);
        for($i=0; $i<= $limit && $i<=count($strs); $i++){
            if(isset($strs[$i])) $html .= ' '.$strs[$i];
        }
        if(count($strs) > $limit) $html .= '...';
        return $html;
    }
}
