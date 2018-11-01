<?php

namespace App\Http\Controllers\Com\Contact;

use App\Http\Controllers\Controller;
use App\Com\Contact\Contact;

class SiteContactController extends Controller
{
    private $model;

    public function __construct(Contact $model) {
        $this->model = $model;
    }
    
    function postAdd(){
        $res = \CRUD::insert($this->model);
        if($res['status'] == 'success'){
            // try send
            $inp = \Input::all();
            $block = \Block::find($inp['block_id']);
            $attribs = json_decode($block->attribs);
            $to = [['address'=>$attribs->email]];
            if(isset($inp['send_me'])) array_push ($to, ['address'=>$inp['email']]);
            \Mailer::send($inp['message'], $to, "Contact");
        }
        return '<div class="alert alert-'.$res['status'].'" role="alert">'.$res['message'].'</div>';
    }
    
    function postSubscribe() {
        $lang = \Input::get('lang');
        \App::setLocale($lang);
        $chk = \DB::table('contacts')
                ->where('email', \Input::get('email'))
                ->where('message', 'Subscribe')
                ->count();
        $msg = \Language::getCom('contact.lbl_subscribe');
        if(!$chk){
            $id = \DB::table('contacts')->insertGetId([
                    'email'     => \Input::get('email'), 
                    'message'   => 'Subscribe'
                ]);
            $msg_email = $msg . \Language::getCom('contact.lbl_unsubscribe', ['Unsubscribe'=>\Path::urlSite("site-contact/unsubscribe?id=".$id.'&lang='.$lang)]);
            \Mailer::send($msg_email, [['address'=>\Input::get('email')]], "Subscribe");
        }
        return '<div class="alert alert-success" role="alert">'.$msg.'</div>';
    }
    
    public function getUnsubscribe() {
        $chk = \DB::table('contacts')->where('id', '=', \Input::get('id'))->first();
        if(!is_null($chk)){
            $lang = \Input::get('lang');
            \App::setLocale($lang);
            \DB::table('contacts')->where('id', '=', \Input::get('id'))->delete();
            \Mailer::send(\Language::getCom('contact.lbl_unsubscribe_success'), [['address' => $chk->email ]], "Subscribe");
        }
        return redirect('/');
    }
}
