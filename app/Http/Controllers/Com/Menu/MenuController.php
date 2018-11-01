<?php

namespace App\Http\Controllers\Com\Menu;

use App\Http\Controllers\Controller;
use App\Com\Menu\Menu;
use App\Com\System\UserGroup;

class MenuController extends Controller
{
    private $model;

    public function __construct(Menu $model) {
        $this->model = $model;
    }

    public function getIndex(){
        if(!\Permission::hasPerm('menu', 'CAN_ACCESS')) abort(404);
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }

    function postIndex() {
        if(\Input::has('id')) return Menu::find(\Input::get('id'));
        return Menu::fetch();
    }

    function postAdd() {
        return \Permission::is_allowed('menu', 'CAN_INSERT', function(){
            $alias = \Input::has('alias') ? \Input::get('alias') : \Input::get('menu_name');
            \Input::merge(["alias"=>\_Route::urlencode($alias)]);
            return \CRUD::insert($this->model);
        });
    }

    function postUpdate() {
        return \Permission::is_allowed('menu', 'CAN_UPDATE', function(){
            $alias = \Input::has('alias') ? \Input::get('alias') : \Input::get('menu_name');
            \Input::merge(["alias"=>\_Route::urlencode($alias)]);
            $rules = Menu::$rules;
            $rules['alias'] .=','.\Input::get('id');
            return \CRUD::update($this->model, $rules);
        });
    }

    function postDelete() {
        return \Permission::is_allowed('menu', 'CAN_DELETE', function(){
            $num = Menu::del(\Input::get('id', -1));
            return ['status'=>'success', 'message' => \Language::get('global.message_crud_delete_success', ["delNum"=>$num])];
        });
    }

    function postMenu(){
        return Menu::all();
    }

    function postTree(){
        if(\Input::has('ids')){
            // sort tree
            Menu::sort(0, json_decode(\Input::get('ids')));
        }
        return Menu::treeHtml(0);
    }

    function postLang(){
        $langs = \Language::Where('public', 1)->get();
        $res = [];
        foreach ($langs as $lang){
            array_push($res, [
                'id' => $lang->alias,
                'text' => $lang->alias . ' ('. $lang->lang_code .')'
            ]);
        }
        return $res;
    }

    function postLayoutConfig(){
        $lang = \Input::get('lang', '');
        if($lang == '') return ['status'=>'warning', 'message'=> \Language::getCom('menu.message_lang_not_found')];
        $template = \Template::current($lang);
        if(is_null($template)) abort(404);
        return [
            'status'=>'success',
            'data'=> view( \Path::viewCurrentTemplate($lang, 'layouts.layoutConfig') )
                ->with('template', $template)
                ->with('lang', $lang)
                ->with('layout', \Input::get('layout', null))
                ->with('attribs', \Input::get('attribs', null))
                ->render()
        ];
    }

    function postUserGroup() {
        $res = UserGroup::select('id', 'group_name')->get();
        $rows = [];
        foreach ($res as $row) {
            if(!($row->anonymous == 1 && \Auth::user()->user_group_id != $row->id)) {
                array_push($rows, $row);
            }
        }
        return $rows;
    }

    function menu($page, $block) {
        $attribs = json_decode($block->attribs);
        $menus = Menu::getMenu($attribs->parent_menu);
        foreach ($menus as $menu)
            $menu->submenus = Menu::getMenu($menu->id);
        return $menus;
    }

    function offcanvas($page, $block) {
        $attribs = json_decode($block->attribs);
        $menus = Menu::getMenu($attribs->parent_menu);
        foreach ($menus as $menu)
            $menu->submenus = Menu::getMenu($menu->id);
        return $menus;
    }
}
