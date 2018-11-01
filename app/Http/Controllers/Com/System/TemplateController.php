<?php

namespace App\Http\Controllers\Com\System;

use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    private $model;

    public function __construct(\Template $model) {
        if(!\Permission::hasPerm('templates', 'CAN_ACCESS')) abort(404);
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.page'), ['M' => $this->model]);
    }

}
