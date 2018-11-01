<?php

namespace App\Http\Controllers\Com\Member;

use App\Http\Controllers\Controller;
use App\Com\Member\Member;
use App\Com\Member\MemberCategory;
use App\Com\Member\MemberMediaCategory;
use App\Com\Member\MemberMedia;
use App\Com\Member\MemberLevelApprove;
use App\Com\Member\MemberProduct;
use App\Com\Member\MemberUser;

use App\Com\Menu\Menu;

use App\Com\Product\Product;
use App\Com\Product\ProductMedia;

class MemberController extends Controller
{
    private $model;

    public function __construct(Member $model) {
        $this->model = $model;
    }

    public function getIndex() {
        return view(\Path::viewAdmin('layouts.crud'), ['M' => $this->model]);
    }

    public function postIndex() {
        return Member::fetch();
    }

    public function postAdd() {
        return ['status' => 'warning', 'message' => 'Không cấp quyền!!!'];
        $alias = \Input::has('member_alias') ? \Input::get('member_alias') : \Input::get('member_name');
        \Input::merge(["member_alias" => \_Route::urlencode($alias)]);
        \Input::merge(["member_approve" => 1]);
        \Input::merge(["member_level" => 1]);
        \Input::merge(["active" => 1]);
        \Input::merge(["member_seo" => '{"title":"","keywords":"","description":""}']);
        \Input::merge(["attribs" => '[{"id":"intro"},{"id":"product"},{"id":"certificate"},{"id":"news"},{"id":"contact"}]']);
        $res = \CRUD::insert($this->model);
        // if($res['status'] == 'success') {
            // MemberMedia::createMemberFolder($res['model']->member_tin);
            // $resApp = MemberLevelApprove::approve();
        // }
        return $res;
    }

    public function postUpdate() {
        // $input = \Input::all();
        \Input::merge(["member_id" => \Input::get('id')]);
        if ((\Input::has('approve') && \Input::get('approve') != \Input::get('member_approve')) || (\Input::has('level') && \Input::get('level') != \Input::get('member_level')))
        {
            $member_user = MemberUser::where('member_tin', \Input::get('member_tin'))->orderBy('created_at', 'asc')->pluck('user_id');
            if (count($member_user) == 0) return ['status' => 'error', 'message' => 'Không tìm thấy người dùng!!!', 'info' => $member_user];
            foreach ($member_user as $value) {
                $user = \DB::table('users')->where('id', $value)->first();
                if (!isset($user->fullname)) MemberUser::where('user_id', $value)->delete();
                else break;
            }
            if (!isset($user->fullname)) return ['status' => 'error', 'message' => 'Không tìm thấy người dùng!!!', 'info' => $member_user];
            if (\Input::has('approve'))
            {
                if (\Input::get('approve') == 1)
                {
                    \Input::merge(["member_level" => \Input::get('member_level') + 1]);
                    // mail chúc mừng
                    if (\Input::get('member_level') == 1)
                        $mail_message = "Chào <b>".$user->fullname."</b>!<br><br>Doanh nghiệp của quý khách tại trang web <a href='http://mekongfishmarket.com'>mekongfishmarket.com</a> đã được kích hoạt thành viên chính thức.<br><br>Chân thành cảm ơn quý khách.";
                    else
                        $mail_message = "Chào <b>".$user->fullname."</b>!<br><br>Doanh nghiệp của quý khách tại trang web <a href='http://mekongfishmarket.com'>mekongfishmarket.com</a> đã được kích hoạt thành viên vàng.<br><br>Chân thành cảm ơn quý khách.";
                }
                if (\Input::get('approve') == 0)
                {
                    // mail lí do ko duyệt trả về
                    if (\Input::get('member_level') == 0)
                    {
                        $mail_message = "Chào <b>".$user->fullname."</b>!<br><br>Doanh nghiệp của quý khách tại trang web <a href='http://mekongfishmarket.com'>mekongfishmarket.com</a> chưa được kích hoạt thành viên chính thức.<br>Lý do:".\Input::get('note')."<br><br>Chân thành cảm ơn quý khách.";
                        // $menu_register = Menu::where('lang', \Input::get('lang'))->where('content', 'register')->where('public', 1)->value('alias');
                        // $mail_message = \Language::getCom('member.message_register_mail_error', [
                        //     'fullname'  => $user->fullname,
                        //     'link_vpa'  => 'http://mekongfishmarket.com',
                        //     'vpa'       => 'mekongfishmarket.com',
                        //     'link'      => \Path::url('/' . \Input::get('lang') . '/' . $menu_register . '?k=' . $hash_id . '&m=' . \Input::get('id') . '&u=' . $user->id),
                        //     'note'      => \Input::get('note')
                        // ]);
                    }
                    else
                        $mail_message = "Chào <b>".$user->fullname."</b>!<br><br>Doanh nghiệp của quý khách tại trang web <a href='http://mekongfishmarket.com'>mekongfishmarket.com</a> chưa được kích hoạt thành viên vàng.<br>Lý do:".\Input::get('note')."<br><br>Chân thành cảm ơn quý khách.";
                }
                $mail_title = 'Về việc đăng ký ' . \Input::get('member_name');
                \Input::merge(["member_approve" => \Input::get('approve')]);
            }
            else
            {
                $mail_title = 'Về việc hạ cấp ' . \Input::get('member_name');
                if (\Input::get('level') == 0)
                {
                    \Input::merge(["member_level" => 0]);
                    \Input::merge(["member_approve" => 0]);
                    $mail_message = "Chào <b>".$user->fullname."</b>!<br><br>Doanh nghiệp của quý khách tại trang web <a href='http://mekongfishmarket.com'>mekongfishmarket.com</a> đã không còn là thành viên chính thức.<br>Lý do:".\Input::get('note')."<br><br>Chân thành cảm ơn quý khách.";
                    // \Input::merge(["active" => 1]);
                    // $user->active = 1;
                    // $user->update();
                    // $menu_register = Menu::where('lang', \Input::get('lang'))->where('content', 'register')->where('public', 1)->value('alias');
                    // $mail_message = \Language::getCom('member.message_register_mail_error', [
                    //     'fullname'  => $user->fullname,
                    //     'link_vpa'  => 'http://mekongfishmarket.com',
                    //     'vpa'       => 'mekongfishmarket.com',
                    //     'link'      => \Path::url('/' . \Input::get('lang') . '/' . $menu_register . '?k=' . $hash_id . '&m=' . \Input::get('id') . '&u=' . $user->id),
                    //     'note'      => \Input::get('note')
                    // ]);
                }
                if (\Input::get('level') == 1)
                {
                    if (\Input::get('member_level') == 0)
                    {
                        $mail_title = 'Về việc đăng ký ' . \Input::get('member_name');
                        $mail_message = "Chào <b>".$user->fullname."</b>!<br><br>Doanh nghiệp của quý khách tại trang web <a href='http://mekongfishmarket.com'>mekongfishmarket.com</a> đã là thành viên chính thức.<br>Lý do:".\Input::get('note')."<br><br>Chân thành cảm ơn quý khách.";
                    }
                    else
                    {
                        // mail lí do hạ cấp
                        $mail_message = "Chào <b>".$user->fullname."</b>!<br><br>Doanh nghiệp của quý khách tại trang web <a href='http://mekongfishmarket.com'>mekongfishmarket.com</a> đã không còn là thành viên vàng.<br>Lý do:".\Input::get('note')."<br><br>Chân thành cảm ơn quý khách.";
                    }
                    \Input::merge(["member_level" => 1]);
                }
                if (\Input::get('level') == 2)
                {
                    \Input::merge(["member_level" => 2]);
                    $mail_title = 'Về việc thăng hạng ' . \Input::get('member_name');
                    // mail chúc mừng
                    $mail_message = "Chào <b>".$user->fullname."</b>!<br><br>Doanh nghiệp của quý khách tại trang web <a href='http://mekongfishmarket.com'>mekongfishmarket.com</a> đã được kích hoạt thành viên vàng.<br><br>Chân thành cảm ơn quý khách.";
                }
            }
            // $resApp = MemberLevelApprove::approve();
            $resApp = \CRUD::insert(new MemberLevelApprove, [
                'member_id' => \Input::get('id'),
                'approved_by' => \Input::has('approved_by') ? \Input::get('approved_by') : \Auth::user()->id,
                'member_level' => \Input::get('member_level'),
                'member_approve' => \Input::get('member_approve'),
                'start_at' => \Input::get('start_at'),
                'ended_at' => \Input::get('ended_at')
            ]);

            if ($resApp['status'] != 'success') return $resApp;
            else
            {
                $tos = [];
                array_push($tos, ['address'=>$user->email]);
                $mail_config = \System::getValue('mail');
                \Mailer::send(
                    $mail_message,
                    $tos,
                    $mail_title,
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
            }
            if (\Input::has('approve'))
                return \CRUD::update($this->model, [], array_only(\Input::all(), ['id', 'member_level', 'member_approve']));
        }
        $alias = \Input::has('member_alias') ? \Input::get('member_alias') : \Input::get('member_name');
        \Input::merge(["member_alias" => \_Route::urlencode($alias)]);
        $rules = Member::$rules;
        $rules['member_alias'] .=','.\Input::get('id');
        $res = \CRUD::update($this->model, $rules);
        if($res['status'] == 'success')
        {
            if (isset($user->fullname)) {
                $user->active = \Input::get('active');
                $user->update();
            }
//            $member_product_id = MemberProduct::where('member_id', \Input::get('id'))->pluck('product_id');
//            foreach (Product::whereIn('id', $member_product_id)->get() as $product) {
//                foreach (\DB::table('product_medias')->where('product_id', $product->id)->get() as $product_media) {
//                    \DB::table('product_medias')->where('id', $product_media->id)->update(['content' => str_replace(MemberMedia::getMemberFolder(\Input::get('member_alias')), MemberMedia::getMemberFolder(\Input::get('member_tin')), $product_media->content)]);
//                }
//            }

            // MemberMedia::createMemberFolder(\Input::get('member_tin'));
           MemberMedia::saveMedia(\Input::get('memberMedias'), \Input::get('id'));
//            MemberUser::saveUser(json_decode(\Input::get('users')), $res['model']->id);
//            MemberProduct::approveProduct($input['memberProducts'], $input['id']);
        }
        return $res;
    }

    public function postDelete() {
        MemberMedia::removeFolderNameOfUserGroup(json_decode(\Input::get('ids')));
        return \CRUD::delete($this->model);
    }

    public function postMemberMedia() {
        $res = MemberMediaCategory::fetch();
        foreach ($res as $cat) {
            $cat->multiple = ($cat->attribs == '');
            $cat->medias = \Input::has('member_id') ? MemberMedia::fetch(\Input::get('member_id'), $cat->id) : [];
        }
        return $res;
    }

    public function postMemberProduct() {
        $res = \App\Com\Product\ProductCategory::fetch();
        if (\Input::has('member_id')) {
            $avatar_id = \App\Com\Product\ProductMediaCategory::where('display_type', 'AVATAR')->first()->id;
            $product_id = MemberProduct::where('member_id', \Input::get('member_id'))->pluck('product_id');
            foreach ($res as $cat) {
                $cat->products = \App\Com\Product\Product::select('id', 'product_name', 'alias')->whereIn('id', $product_id)->where('category_id', $cat->id)->orderBy('sort', 'asc')->get();
                foreach ($cat->products as $product) {
                    $pm = \DB::table('product_medias')->select('content')->where('media_category_id', $avatar_id)->where('product_id', $product->id)->orderBy('sort', 'asc')->first();
                    $product->content = isset($pm) ? $pm->content : '';
                    $member_product = MemberProduct::where('member_id', \Input::get('member_id'))->where('product_id', $product->id)->first();
                    $product->member_product_id = $member_product->id;
//                    $member_product_approve =
                    $product->approved = isset($member_product->approved_by);
                    $product->approved_at = isset($member_product->approved_at) ? $member_product->approved_at : '';
                }
            }
        }
        else {
            foreach ($res as $cat) {
                $cat->products = [];
            }
        }
        return $res;
    }

    function postUser() {
        return MemberUser::fetch();
    }

    public function getProducts() {
        if(!$this->acceptSecretKey(\Input::get('akey', ''))) \App::abort(404);
        return view(\Path::viewAdminCom('filemanager.dialog'), ['M' => new \App\Com\FileManager\FileManager]);
    }
    // key key
    public static function acceptSecretKey($key) {
        $str = \Auth::user()->id.config('app.key');
        return \Hash::check($str, $key);
    }

    public static function postImport() {

    }

    public static function postExport() {

    }

    public function member_gold($page, $block) {
        $res = [];
        $res['block'] = $block;
        $res['page'] = $page;
        $menu_member = Menu::where('lang', $page->lang)->where('content', 'member')->where('public', 1)->first();
        $attribs = json_decode($block->attribs);
        $cat_id = MemberMediaCategory::where('data_type', 'AVATAR')->value('id');
        $res['members'] = [];
        $members = Member::where('lang', $page->lang)->where('member_level', json_decode($block->attribs)->level)->where('member_level', '>', 0)->where('active', 1)->orderByRaw("RAND()")->get();
        $count = 0;
        foreach($members as $member) {
            if ($count == 2) break;
            if (json_decode($block->attribs)->level == 2) {
                $lvl_app = MemberLevelApprove::where('member_id', $member->id)->where('member_level', 2)->where('member_approve', 1)->orderBy('id', 'desc')->first();
                $is_gold = false;
                if (isset($lvl_app)) {
                    $date_now = (new \DateTime('NOW'))->modify('+7 hours');
                    $is_gold = ($date_now >= (new \DateTime($lvl_app->start_at)) && $date_now <= (new \DateTime($lvl_app->ended_at)));
                }
                if (!$is_gold) continue;
            }
            $member_media = MemberMedia::where('media_category_id', $attribs->media_category_id)->where('member_id', $member->id)->first();
            $member->content = isset($member_media->content) ? config("data.PATH_ROOT").$member_media->content : \Path::urlCurrentTemplate($page->lang, 'images/product_bg.jpg');
            $member->alias = \Path::url($page->lang . '/' . (isset($menu_member->alias) ? $menu_member->alias : \Language::getTemplate('ecomtemplate.lbl_member_alias')) . (isset($member->member_alias) ? '/' . $member->member_alias : \Path::urlCurrentTemplate($page->lang, 'images/product_bg.jpg')));
            $res['members'][] = $member;
            $count++;
        }
        return $res;
    }

    public function member_option($page, $block) {
        $res = [];
        $res['block'] = $block;
        $res['page'] = $page;
        $menu_member = Menu::where('lang', $page->lang)->where('content', 'member')->where('public', 1)->first();
        $menu_members = Menu::where('lang', $page->lang)->where('content', 'members')->where('public', 1)->value('alias');
        $res['menu_members'] = $menu_members != '' ? \Path::url($page->lang . '/' . $menu_members) : '';
        $attribs = json_decode($block->attribs);
//        $member_level_approves = MemberLevelApprove::where('member_level_id', $attribs->level);
        $members = Member::where('lang', $page->lang)->where('member_level', json_decode($block->attribs)->level)->where('active', 1)->orderByRaw("RAND()");
        $res['bg_color'] = $attribs->level == '2' ? 'background-color: #eceadf;' : '';
        $res['color'] = $attribs->level == '1' ? 'color: #007cbd;' : 'color: #bd6a00;';
        $res['count'] = $members->count();
        $res['members'] = [];
//        ->take($attribs->limit * 6)
        $members = $members->get();
        $x = 0;
        foreach($members as $key=>$member) {
            $member_media = MemberMedia::where('media_category_id', $attribs->media_category_id)->where('member_id', $member->id)->first();
            $member->content = isset($member_media->content) ? config("data.PATH_ROOT").$member_media->content : \Path::urlCurrentTemplate($page->lang, 'images/product_bg.jpg');
            $member->alias = \Path::url($page->lang . '/' . (isset($menu_member->alias) ? $menu_member->alias : \Language::getTemplate('ecomtemplate.lbl_member_alias')) . (isset($member->member_alias) ? '/' . $member->member_alias : ''));
            $res['members'][$x][] = $member;
            if (($key % 6) == 5) $x++;
        }
//        for ($l = 0; $l < $attribs->limit; $l++) {
//            for ($i = 0; $i < 6; $i++, $x++) {
//                $member_media = MemberMedia::where('media_category_id', $attribs->media_category_id)->where('member_id', $members[$x]->id)->first();
//                $members[$x]->content = isset($member_media->content) ? $member_media->content : '';
//                $members[$x]->alias = \Path::url($page->lang . '/' . (isset($menu_member->alias) ? $menu_member->alias : \Language::getTemplate('ecomtemplate.lbl_member_alias')) . (isset($members[$x]->member_alias) ? '/' . $members[$x]->member_alias : ''));
//                $res['members'][$l][] = $members[$x];
//            }
//        }
        return $res;
    }
}
