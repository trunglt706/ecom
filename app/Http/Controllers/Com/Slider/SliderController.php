<?php

namespace App\Http\Controllers\Com\Slider;

use App\Http\Controllers\Controller;
use App\Com\Slider\Slider;

class SliderController extends Controller
{
    private $model;

    public function __construct(Slider $model) {
        //if(!\Permission::hasPerm('slider', 'CAN_ACCESS')) abort(404);
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }

    function postIndex() {
        return \CRUD::fetch($this->model);
    }

    function postAdd() {
        return \Permission::is_allowed('slider', 'CAN_INSERT', function(){
            return \CRUD::insert($this->model);
        });
    }

    function postUpdate() {
        return \Permission::is_allowed('slider', 'CAN_UPDATE', function(){
            return \CRUD::update($this->model);
        });
    }

    function postDelete() {
        return \Permission::is_allowed('slider', 'CAN_DELETE', function(){
            return \CRUD::delete($this->model);
        });
    }

    function slider($page, $block) {
        $res = [];
        $res['block'] = $block;
        $res['page'] = $page;
        return $block;
    }
}
