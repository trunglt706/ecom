<?php

namespace App\Http\Controllers\Com\Member;

use App\Http\Controllers\Controller;
use App\Com\Member\Member;
use App\Com\Member\MemberMediaCategory;
use App\Com\Member\MemberMedia;
use App\Com\Member\MemberCertificate;
use App\Com\Member\MemberCertificateType;

class MemberCertificateController extends Controller
{
    private $model;

    public function __construct(MemberCertificate $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }
    
    public function postIndex(){
        
        return \CRUD::fetch($this->model);
    }
    
    public function postAdd(){
        return \CRUD::insert($this->model);
    }

    public function postUpdate(){
        return \CRUD::update($this->model);
    }
    
    public function postDelete(){
        return \CRUD::delete($this->model);
    }
    
    public function postMemberMedia(){
        $res = MemberMediaCategory::fetch();
        foreach ($res as $cat) {
            $cat->medias = \Input::has('member_id') ? MemberMedia::fetch(\Input::get('member_id'), $cat->id) : [];
        }
        return $res;
    }
    
    public function postLevel(){
        $res = \DB::table('member_levels')->select('id', 'level AS text')->get();
        foreach($res as $lv){
            $lv->text = $lv->text == 1 ? \Language::getCom('member.lbl_member') :  \Language::getCom('member.lbl_member_gold');
        }
        return $res;
    }
    
    function postMembers(){
        return \DB::table('members')->select('id', 'member_name AS text')->get();
    }
    
    function postCertificates(){
        return \DB::table('member_certificate_types')->select('id', 'member_certificate_type_name AS text')->get();
    }
}
