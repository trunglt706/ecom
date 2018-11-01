<?php

namespace App\Http\Controllers\Com\Contact;

use App\Http\Controllers\Controller;
use App\Com\Contact\Contact;

class ContactController extends Controller
{
    private $model;

    public function __construct(Contact $model) {
        $this->model = $model;
    }

    public function getIndex(){
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }

    function postIndex() {
        return \CRUD::fetch($this->model);
    }

    function postAdd() {
        return \CRUD::insert($this->model);
    }

    function postUpdate() {
        return \CRUD::update($this->model);
    }

    function postDelete() {
        return \CRUD::delete($this->model);
    }

    function postSendMail(){
        $input = \Input::all();
        $tos = [];
        array_push($tos, ['address'=>$input['email']]);
        $mail_config = \System::getValue('mail');
        $mail = \Mailer::send(
            $input['content'],
            $tos,
            $input['subject'],
            \Path::viewTemplate('ecomtemplate.layouts.mailTemplate'),
            [], [], [], [], [
                'driver'    => $mail_config->mail_driver,
                'host'      => $mail_config->mail_host,
                'port'      => $mail_config->mail_port,
                'encryption'=> $mail_config->mail_encryption,
                'username'  => $mail_config->mail_username,
                'password'  => $mail_config->mail_password
            ]
        );
        return $mail;
        // return \Mailer::send($input['content'], [['name'=>$input['email'], 'address'=>$input['email']]], $input['subject']);
    }
}
