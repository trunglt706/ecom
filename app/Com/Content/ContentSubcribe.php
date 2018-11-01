<?php

namespace App\Com\Content;

use Illuminate\Database\Eloquent\Model;

use App\Com\Menu\Menu;

class ContentSubcribe extends Model {

    protected $fillable = ['fullname', 'address', 'phone', 'email', 'note', 'active', 'attribs', 'lang', 'rights'];
    public static $rules = [
        'fullname'    => 'required',
        'address'     => '',
        'phone'       => '',
        'email'       => 'required',
        'note'        => '',
        'active'      => '',
        'attribs'     => '',
        'lang'        => '',
        'rights'      => '',
    ];
    public static function cols() {
        return [
            'fullname'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'address'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'phone'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
            'email'   => [
                'filter' => ['srt', 'src'],
                'align'  => 'left',
            ],
//            'active_render'   => [
//                'filter' => ['srt', 'src'],
//                'align'  => 'left',
//                'fkey'   => [
//                    'fkey' => 'id',
//                    'tbl'  => 'register_latest_news',
//                    'col'  => 'active'
//                ],
//            ],
//            'lang_render' => [
//                'filter' => ['srt', 'src'],
//                'align'  => 'center',
//                'fkey'   => [
//                    'fkey' => 'id',
//                    'tbl'  => 'module',
//                    'col'  => 'lang'
//                ],
//            ]
        ];
    }

    public static function fetch() {
        $res = \CRUD::fetch(new self);
        foreach($res['rows'] as $row) {
//            $row->active_render = $row->active == '1' ? trans('administrator/global.var.active') : trans('administrator/global.var.disabled');
//            $row->lang_render = '<img src="'.asset('dist/com/com_languages/images/'.$row->lang.'.gif').'" alt="'.$row->lang.'" /> ('.$row->lang.')';
        }
        return $res;
    }
    
    public static function sendToUserSubcribe($content) {
        $menu_articles = Menu::where('lang', $content->lang)->where('content', 'articles')->where('public', 1)->value('alias');
        if($menu_articles != '' && $content->public == 1) {
            $registers = self::where('active', 1)->value('email');
            if(count($registers)){
                $intro_text = explode("<hr />", $content->content, 2);

                $content_info = '<table border="0" style="border-collapse: collapse; border-spacing: 0px;">
                                <tbody>
                                    <tr>
                                        <td style="padding: 10px;"><img src='.(isset($content->image) ? \Path::url(config("data.PATH_ROOT").$content->image) : '').' style="width: 150px; height: 150px;"></td>
                                        <td><h4><a href='.\Path::url($content->lang.'/'.$menu_articles.'/'.$content->alias).'>'.($content->title).'</a></h4>'.($intro_text[0]).'</td>
                                    </tr>
                                </tbody>
                            </table>';
//                            <br>
//                            <a href="'.
//                        '">'.\Language::getTemplate('ecomtemplate.lbl_unsubscribe').
//                        '</a>';
                $tos = [];
                foreach (explode(',', $registers) as $to) {
                    array_push($tos, ['address'=>$to]);
                }
                $mail_config = \System::getValue('mail');
                $mail = \Mailer::send(
                    $content_info,
                    $tos,
                    $content->title,
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
            }
        }
    }

}
