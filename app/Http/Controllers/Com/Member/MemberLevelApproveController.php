<?php

namespace App\Http\Controllers\Com\Member;

use App\Http\Controllers\Controller;
use App\Com\Member\Member;
use App\Com\Member\MemberMediaCategory;
use App\Com\Member\MemberMedia;
use App\Com\Member\MemberLevelApprove;

class MemberLevelApproveController extends Controller
{
    private $model;

    public function __construct(MemberLevelApprove $model) {
        $this->model = $model;
    }

    public function getIndex() {
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }
    
    public function postIndex() {
        return MemberLevelApprove::fetch();
    }
    
    public function postAdd() {
        return \CRUD::insert($this->model);
    }

    public function postUpdate() {
        return \CRUD::update($this->model);
    }
    
    public function postDelete() {
        return \CRUD::delete($this->model);
    }
}
