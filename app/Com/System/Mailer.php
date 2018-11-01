<?php

namespace App\Com\System;

use Mail;
use Illuminate\Database\Eloquent\Model;

class Mailer extends Model {

    /*
    |--------------------------------------------------------------------------
    | Send mail
    |--------------------------------------------------------------------------
    |
    */
    public static function send($message, $to, $subject = null, $template = null, $attach = [], $cc = [], $bcc = [], $replyTo = [], $config = null){
       try {
            $subject = is_null($subject) ? env('APP_SITE_NAME') : $subject;
            $template = is_null($template) ? \Path::viewAdmin('layouts.mail') : $template;
            if(!is_null($config)){
                \Config::set('mail.driver', $config['driver']);
                \Config::set('mail.host', $config['host']);
                \Config::set('mail.port', $config['port']);
                \Config::set('mail.encryption', $config['encryption']);
                \Config::set('mail.username', $config['username']);
                \Config::set('mail.password', $config['password']);
            }
            Mail::send($template, ['mainContent' => $message], function ($m) use($to, $attach, $cc, $bcc, $replyTo, $subject) {
                $m->from(config('mail.username'), env('APP_SITE_NAME'));
                foreach ($to as $t) $m->to( $t['address'], isset($t['name']) ? $t['name']:$t['address'] );
                foreach ($attach as $att) $m->attach( $att );
                foreach ($cc as $c) $m->cc( $c['address'], isset($c['name']) ? $c['name']:$c['address'] );
                foreach ($bcc as $bc) $m->bcc( $bc['address'], isset($bc['name']) ? $bc['name']:$bc['address'] );
                foreach ($replyTo as $rep) $m->replyTo( $rep['address'], isset($rep['name']) ? $rep['name']:$rep['address'] );
                $m->subject($subject);
            });
            return ['status'=>'success', 'message'=> \Language::get('global.message_mail_send_success')];
       } catch (Exception $ex) {
           return ['status'=>'error', 'code'=>$e->getCode(), 'message'=>$e->getMessage()];
       }
   }
}
