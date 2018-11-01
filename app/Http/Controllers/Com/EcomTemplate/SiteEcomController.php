<?php

namespace App\Http\Controllers\Com\EcomTemplate;

use App\Http\Controllers\Controller;

use App\Com\Contact\Contact;

use App\Com\Content\Content;
use App\Com\Content\ContentCategory;
use App\Com\Content\ContentSubcribe;

use App\Com\FileManager\FileManager;

use App\Com\Product\Product;
use App\Com\Product\ProductPrice;
use App\Com\Product\ProductCustomField;
use App\Com\Product\ProductCustomFieldData;
use App\Com\Product\ProductMedia;
use App\Com\Product\ProductMediaCategory;

use App\Com\Member\Member;
use App\Com\Member\MemberCard;
use App\Com\Member\MemberCertificate;
use App\Com\Member\MemberContact;
use App\Com\Member\MemberProduct;
use App\Com\Member\MemberMedia;
use App\Com\Member\MemberMediaCategory;
use App\Com\Member\MemberLevelApprove;
use App\Com\Member\MemberRequest;
use App\Com\Member\MemberUser;

use App\Com\Menu\Menu;

class SiteEcomController extends Controller
{
    private $model;

    function postChangeLogo() {
        $cat_id = MemberMediaCategory::where('data_type', 'AVATAR')->value('id');
        \Input::merge(["media_category_id" => $cat_id]);
        \Input::merge(["created_by" => \Auth::user()->id]);
        $media_id = MemberMedia::where('member_id', \Input::get('member_id'))->where('media_category_id', $cat_id)->value('id');
        if ($media_id != '') {
            \Input::merge(["id" => $media_id]);
            return \CRUD::update(new MemberMedia);
        }
        return \CRUD::insert(new MemberMedia);
    }

    function postChangeBanner() {
        $cat_id = MemberMediaCategory::where('data_type', 'BANNER')->value('id');
        if (\Input::has('content')) {
            \Input::merge(["media_category_id" => $cat_id]);
            \Input::merge(["created_by" => \Auth::user()->id]);
            $media_id = MemberMedia::where('member_id', \Input::get('member_id'))->where('media_category_id', $cat_id)->value('id');
            if ($media_id != '') {
                \Input::merge(["id" => $media_id]);
                return \CRUD::update(new MemberMedia);
            }
            return \CRUD::insert(new MemberMedia);
        }
        else {
            $media_id = MemberMedia::where('member_id', \Input::get('member_id'))->where('media_category_id', $cat_id)->value('id');
            if ($media_id != '')
                return \CRUD::delete(new MemberMedia, [$media_id]);
        }
    }

    function postForget() {
        return \User::forgetPass();
    }

    function postReset() {
        return \User::resetPass();
    }

    function postContactVpa() {
        return \CRUD::insert(new Contact);
    }

    function postChange() {
        $rules      = array(
            'password'   => 'required|min:6',
            'repassword' => 'required|min:6'
        );
        $validation = \Validator::make(\Input::all(), $rules);
        if ($validation->passes() && \Input::has('user')) {
            if (\Input::get('password') == \Input::get('repassword')) {
                \Input::merge(array('password' => \Hash::make(\Input::get('password'))));
                \Input::merge(array('attribs' => ''));
                \Input::merge(array('id' => \Input::get('user')));
                return \CRUD::update(new \User, []);
            }
            return ['status' => 'warning', 'message' => \Language::getTemplate('ecomtemplate.message_pass_not_match')];
        }
        return ['status' => 'error', 'message' => \Language::getTemplate('ecomtemplate.message_change_pass_error')];
    }

    function postLogin() {
        $rules      = array(
            'username' => 'required',
            'password' => 'required'
        );
        $user_login = array(
            'username'          => trim(\Input::get('username')),
            'password'          => \Input::get('password'),
            'active'            => 1,
            'login_frontend'    => 1
        );
        $validation = \Validator::make(\Input::all(), $rules);
        if ($validation->passes()) {
            if (\Auth::attempt($user_login))
            {
                \User::where('id', \Auth::user()->id)->update(['last_login'=>date("Y-m-d H:i:s", time())]);
                return ['status' => 'success', 'message' => ''];
            }
        }
        return ['status' => 'warning', 'message' => \Language::get('global.message_auth_login_error')];
    }

    function postLogout() {
        \Auth::logout();
    }

    function postRegister() {
        $exist_member = Member::where('member_tin', \Input::get('member_tin'))->first();
        if (!is_null($exist_member) && ($exist_member->active == 1 || $exist_member->member_approve != 0))
            return ['status' => 'error', 'message' => \Language::getTemplate('ecomtemplate.message_exist_member'), 'approve' => $exist_member];
        $input = \Input::all();
        $member_types = [];
        if (\Input::get('supplier')) $member_types[] = "supplier";
        if (\Input::get('customer')) $member_types[] = "customer";
        \Input::merge(["member_alias" => \_Route::urlencode(\Input::get('member_name'))]);
        \Input::merge(["member_types" => json_encode($member_types)]);
        \Input::merge(["member_approve" => 1]);
        \Input::merge(["member_level" => 0]);
        \Input::merge(["active" => 0]);
        \Input::merge(["member_seo" => '{"title":"","keywords":"","description":""}']);
        \Input::merge(["settings" => '[{"id":"intro"},{"id":"product"},{"id":"certificate"},{"id":"news"},{"id":"contact"}]']);
        $members = new Member;
        if (!is_null($exist_member) && $exist_member->active == 0 && $exist_member->member_approve == 0) {
            \Input::merge(["id" => \Input::get('m')]);
            $rules = Member::$rules;
            $rules['member_alias'] .=','.\Input::get('m');
            $member = \CRUD::update($members, $rules);
        }
        else $member = \CRUD::insert($members);
        if ($member['status'] == 'success') {
            $input['password'] = \Hash::make(\Input::get('password'));
            $input['user_group_id'] = \UserGroup::where('group_code', 'MEMBER')->first()->id;
            $input['active'] = false;
            $input['login_backend'] = false;
            $input['login_frontend'] = true;
            $users = new \User;
            if (!is_null($exist_member) && $exist_member->active == 0 && $exist_member->member_approve == 0) {
                $input['id'] = \Input::get('u');
                $rules = \User::$rules;
                $rules['username'] .= ','.\Input::get('u');
                $user = \CRUD::update($users, $rules, $input);
                $user['member_approve'] = \Input::get('member_approve');
                return $user;
            }
            else $user = \CRUD::insert($users, $input);
            if ($user['status'] == 'success') {
                $input['user_id'] = $user['model']->id;
                $input['member_tin'] = \Input::get('member_tin');
                $member_users = new MemberUser;
                $member_user = \CRUD::insert($member_users, $input);
                if ($member_user['status'] == 'success') {
                    $menu_active = Menu::where('lang', \Input::get('lang'))->where('content', 'active')->where('public', 1)->value('alias');
                    $mail_message = \Language::getCom('member.message_register_mail_success', [
                        'fullname'  => $user['model']->fullname,
                        'link_vpa'  => 'http://mekongfishmarket.com',
                        'vpa'       => 'mekongfishmarket.com',
                        'link'      => \Path::url('/' . \Input::get('lang') . '/' . $menu_active . '?k=' . \Hash::make(\Input::get('member_tin')) . '&m=' . $member['model']->id . '&u=' . $user['model']->id),
                        'username'  => $user['model']->username
                    ]);
                    $tos = [];
                    array_push($tos, ['address'=>$user['model']->email]);
                    $mail_config = \System::getValue('mail');
                    \Mailer::send(
                        $mail_message,
                        $tos,
                        \System::getValue(\Input::get('lang')),
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
                    $mail_message = \Language::getTemplate('ecomtemplate.message_register_mail_success', [
                        'fullname'  => $user['model']->fullname,
                        'link_vpa'  => 'http://mekongfishmarket.com',
                        'vpa'       => 'mekongfishmarket.com'
                    ]);
                    return ['status' => 'success', 'message' => $mail_message];

                    \Input::merge(["member_id" => $member['model']->id]);
                    \Input::merge(["approved_by" => $user['model']->id]);
                    MemberLevelApprove::approve();
                    $mail_message = \Language::getTemplate('ecomtemplate.message_register_mail_success', [
                        'fullname'  => $user['model']->fullname,
                        'link_vpa'  => 'http://mekongfishmarket.com',
                        'vpa'       => 'mekongfishmarket.com'
                    ]);
                    MemberMedia::createMemberFolder(\Input::get('member_tin'));
                    return ['status' => 'success', 'message' => $mail_message];
                }
                \CRUD::delete($member_users, $member_user['model']->id);
                \CRUD::delete($users, $user['model']->id);
                \CRUD::delete($members, $member['model']->id);
                return ['status' => 'warning', 'message' => \Language::getTemplate('ecomtemplate.message_register_user_error'), 'info' => $member_user];
            }
            \CRUD::delete($members, $member['model']->id);
            return ['status' => 'warning', 'message' => \Language::getTemplate('ecomtemplate.message_register_user_error'), 'info' => $user];
        }
        return $member;
        return ['status' => 'error', 'message' => \Language::get('global.message_input_error'), 'info' => $member];
    }

    function postMembers() {
        return \DB::table('members')->select('id', 'member_name AS text')->get();
    }

    function postCurrentMember() {
        return Member::find(\Input::get('current_member'));
    }

    function postSaveMember() {
        $alias = \Input::has('member_alias') ? \Input::get('member_alias') : \Input::get('member_name');
        \Input::merge(["member_alias" => \_Route::urlencode($alias)]);
        if (\Input::get('newlang') == 'true') {
            \Input::merge(["lang" => \Language::where('lang_code', '<>', \Input::get('lang'))->value('lang_code')]);
            $input = array_except(\Input::all(), ['id']);
            return \CRUD::insert(new Member, $input);
        }
        else {
            $input = array_except(\Input::all(), ['member_name', 'member_tin']);
            $rules = Member::$rules;
            $rules['member_alias'] .=','.\Input::get('id');
            $rules['member_name'] = '';
            return \CRUD::update(new Member, $rules, $input);
        }
    }

    function postRequestApprove() {
        if (\Input::has('start_at') && \Input::has('ended_at')) {
            if (new \DateTime(\Input::get('start_at')) > new \DateTime(\Input::get('ended_at')))
                return ['status'  => 'error', 'message' => ''];
            $member_level = 1;
        }
        else {
            $member_level = 0;
        }
        Member::where('member_tin', \Input::get('member_tin'))->update(['member_level' => $member_level, 'member_approve' => -1]);
        \CRUD::insert(new MemberLevelApprove, [
            'member_id' => \Input::get('member_id'),
            'approved_by' => \Input::has('approved_by') ? \Input::get('approved_by') : \Auth::user()->id,
            'member_level' => $member_level,
            'member_approve' => -1,
            'start_at' => \Input::get('start_at'),
            'ended_at' => \Input::get('ended_at')
        ]);
        $other_id = Member::where('member_tin', \Input::get('member_tin'))->where('id', '<>', \Input::get('member_id'))->value('id');
        if ($other_id != '')
            \CRUD::insert(new MemberLevelApprove, [
                'member_id' => $other_id,
                'approved_by' => \Input::has('approved_by') ? \Input::get('approved_by') : \Auth::user()->id,
                'member_level' => $member_level,
                'member_approve' => -1,
                'start_at' => \Input::get('start_at'),
                'ended_at' => \Input::get('ended_at')
            ]);
        // MemberLevelApprove::insert()
        return ['status'  => 'success', 'message' => ''];
    }

    function postSaveInfo() {
        Member::find(\Input::get('id'))->update([\Input::get('type') => \Input::get('info')]);
        return ['status'  => 'success', 'message' => ''];
    }

    function postMemberUsers() {
        $member_user_ids = MemberUser::where('member_tin', \Input::get('member_tin'))->orderBy('created_at', 'asc')->pluck('user_id');
        return \User::whereIn('id', $member_user_ids)->get();
    }

    function postSaveUsers() {
        \Input::merge(array('password' => \Hash::make(\Input::get('password'))));
        if (\Input::has('id')) {
            $rules = \User::$rules;
            $rules['username'] .= ','.\Input::get('id');
            return \CRUD::update(new \User, $rules);
        }
        $input = \Input::all();
        $input['user_group_id'] = \UserGroup::where('group_code', 'MEMBER')->first()->id;
        $input['login_backend'] = false;
        $input['login_frontend'] = true;
        $user = \CRUD::insert(new \User, $input);
        if ($user['status'] == 'success') {
            $input['user_id'] = $user['model']->id;
            $input['member_tin'] = \Input::get('member_tin');
            $member_users = new MemberUser;
            $member_user = \CRUD::insert($member_users, $input);
            if ($member_user['status'] != 'success')
                \CRUD::delete(new \User, $user['model']->id);
            return $member_user;
        }
        return $user;
    }

    function postMemberProducts() {
        $res = [];
        $cat_avatar_id = ProductMediaCategory::where('data_type', 'AVATAR')->value('id');
        // $member_ids = Member::where('member_tin', \Input::get('member_tin'))->where('member_level', '>', 0)->pluck('id');
        $member_product_ids = MemberProduct::where('member_id', \Input::get('member_id'))->pluck('product_id');
        $query = Product::select()->where('id', '>', 0)->whereIn('id', $member_product_ids);
        if (\Input::has('search'))
            $query->where('product_name', 'like', '%'.\Input::get('search').'%');
        $products = $query->get();
        foreach ($products as $product) {
            $product_media = ProductMedia::where('product_id', $product->id)->where('media_category_id', $cat_avatar_id)->value('content');
            $product->media = $product_media != '' ? config("data.PATH_ROOT").$product_media : \Path::urlCurrentTemplate(\Input::get('lang'), 'images/product_bg.jpg');
            $member_product = MemberProduct::where('product_id', $product->id)->first();
            $product->price = $member_product->price;
            $product->unit = $member_product->unit;
            $product->certs = $member_product->certs;
            // $product->prices = ProductPrice::where('product_id', $product->id)->orderBy('id', 'desc')->get();
            // if (isset($product->prices[0]->id)) {
            //     $product->price = $product->prices[0]->price;
            //     $product->price_note = $product->prices[0]->note;
            // }
            $field_data_ids = ProductCustomFieldData::where('product_id', $product->id)->pluck('field_id');
            $product->custom_fields = ProductCustomField::whereIn('id', $field_data_ids)->where('lang', \Input::get('lang'))->pluck('id');
        }
        return $products;
    }

    function postSaveProducts() {
        $alias = \Input::has('alias') ? \Input::get('alias') : \Input::get('product_name');
        \Input::merge(["alias"=>\_Route::urlencode($alias)]);
        if (\Input::has('id')) {
            $rules = Product::$rules;
            $rules['alias'] .=','.\Input::get('id');
            $res = \CRUD::update(new Product, $rules);
            $input['product_id'] = \Input::get('id');
            // if (\Input::get('price') != \Input::get('prices')[0]->price) {
            //     $price = new ProductPrice;
            //     $price->product_id = \Input::get('id');
            //     $price->price = \Input::get('price');
            //     $price->note = \Input::get('price_note');
            //     $price->save();
            // }
            // else $price = ProductPrice::find(\Input::get('prices')[0]->id)->update(['note' => \Input::get('price_note')]);
        }
        else {
            $res = \CRUD::insert(new Product);
            if ($res['status'] == 'success')
                $input['product_id'] = $res['model']->id;
            else return $res;
        }
        if ($res['status'] == 'success') {
            $cat_avatar_id = ProductMediaCategory::where('data_type', 'AVATAR')->value('id');
            $input['content'] = \Input::get('media');
            $input['media_category_id'] = $cat_avatar_id;
            $input['sort'] = 1;
            $product_media_id = ProductMedia::where('product_id', $input['product_id'])->where('media_category_id', $cat_avatar_id)->value('id');
            if ($product_media_id != '') {
                $input['id'] = $product_media_id;
                \CRUD::update(new ProductMedia, [], $input);
            }
            else \CRUD::insert(new ProductMedia, $input);
            $input['price'] = \Input::get('price');
            $input['unit'] = \Input::get('unit');
            $input['certs'] = \Input::get('certs');
            $member_product_id = MemberProduct::where('member_id', \Input::get('member_id'))->where('product_id', $input['product_id'])->value('id');
            if ($member_product_id != '') {
                $input['id'] = $member_product_id;
                \CRUD::update(new MemberProduct, [], $input);
            }
            else {
                $input['member_id'] = \Input::get('member_id');
                $input['created_by'] = \Auth::user()->id;
                \CRUD::insert(new MemberProduct, $input);
            }
            $field_del = ProductCustomFieldData::where('product_id', $input['product_id']);
            if (\Input::has('productInfo'))
                foreach (\Input::get('productInfo') as $key => $value) {
                    $field_id = explode('field_', $key)[1];
                    $field_del->where('field_id', '<>', $field_id);
                    $value = [
                        'field_id'   => $field_id,
                        'product_id' => $input['product_id'],
                        'value'      => $value
                    ];
                    $field_data = ProductCustomFieldData::where('field_id', $field_id)->where('product_id', $input['product_id'])->first();
                    if (is_null($field_data))
                        ProductCustomFieldData::insert($value);
                    else $field_data->update($value);
                }
            $field_del->delete();
        }
        return $res;
    }

    function postDelProduct () {
        ProductCustomFieldData::where('product_id', \Input::get('id'))->delete();
        ProductMedia::where('product_id', \Input::get('id'))->delete();
        MemberProduct::where('member_id', \Input::get('member_id'))->where('product_id', \Input::get('id'))->delete();
        \Input::merge(["ids"=>\Input::get('id')]);
        return \CRUD::delete(new Product);
    }

    public function postProductMedia() {
        $res = ProductMediaCategory::fetch();
        $r = [];
        foreach ($res as $cat) {
            if ($cat->data_type != 'AVATAR') {
                $cat->medias = \Input::has('product_id') ? ProductMedia::fetch(\Input::get('product_id'), $cat->id) : [];
                $r[] = $cat;
            }
        }
        return $r;
    }

    public function postProductCustomFields() {
        $fields = ProductCustomField::where('lang', \Input::get('lang'))->get();
        $res = [];
        foreach ($fields as $field)
            $res[] = '<option value="'.$field->id.'">'.$field->field_name.'</option>';
        return $res;
    }

    public function postProductInfo() {
        $fields = ProductCustomField::whereIn('id', \Input::get('product_custom_field'))->get();
        foreach ($fields as $field) {
            $field->value = ProductCustomFieldData::where('field_id', $field->id)->where('product_id', \Input::get('product_id'))->value('value');
        }
        return view(\Path::viewTemplate('ecomtemplate.forms.product_custom_field_control'))->with('fields', $fields)->render();
    }

    function postMemberCards() {
        return MemberCard::where('member_id', \Input::get('member_id'))->get();
    }

    function postSaveCard() {
        if (\Input::get('current') == 1)
            MemberCard::where('member_id', \Input::get('member_id'))->update(['current' => 0]);
        if (\Input::has('id')) return \CRUD::update(new MemberCard);
        return \CRUD::insert(new MemberCard);
    }

    function postAddToCart() {
        $input = \Input::all();
        $carts = \Cookie::get('carts');
        if ($carts == '') $carts = [];
        if (isset($carts[$input['product_id']])) {
            $status = 'update';
            $carts[$input['product_id']] += $input['quantity'];
        }
        else {
            $status = 'add';
            $carts[$input['product_id']] = $input['quantity'];
        }
        \Cookie::queue('carts', $carts);
        return [
            'status'    => $status,
            'message'   => \Language::getTemplate('ecomtemplate.message_add_to_cart_success', ['Product'=>$input['product_name']])
        ];
    }

    function postAddToFavorite() {
        if (!\Auth::check())
            return [
                'status'    => 'error',
                'message'   => \Language::getTemplate('ecomtemplate.message_login_please')
            ];
        try {
            $model = \DB::table('users_products')->insert([
                'user_id' => \Auth::user()->id,
                'product_id' => \Input::get('product_id')
            ]);
        } catch(\Exception $e) {
            return [ 'status' => 'warning',
                     'message' =>  \Language::getTemplate('ecomtemplate.message_added_to_favorite', ['Product'=>\Input::get('product_name')]),
                     'info' => $e->getMessage()];
        }
        return ['status' => 'success', 'message' => \Language::getTemplate('ecomtemplate.message_add_to_favorite_success', ['Product'=>\Input::get('product_name')])];
    }

    function postRemoveFavorite() {
        if (!\Auth::check())
            return [
                'status'    => 'error',
                'message'   => \Language::getTemplate('ecomtemplate.message_login_please')
            ];
        try {
            \DB::table('users_products')->where('user_id', \Auth::user()->id)->where('product_id', \Input::get('product_id'))->delete();
        } catch(\Exception $e) {
            return [ 'status' => 'warning',
                     'message' =>  \Language::getTemplate('ecomtemplate.message_added_to_favorite', ['Product'=>\Input::get('product_name')]),
                     'info' => $e->getMessage()];
        }
        return ['status' => 'success', 'message' => \Language::getTemplate('ecomtemplate.message_remove_favorite_success', ['Product'=>\Input::get('product_name')])];
    }

    function postDelCart() {
        \Cookie::queue('carts', array_except(\Cookie::get('carts'), \Input::get('product_id')));
        return ['status'  => 'success', 'message' => ''];
    }

    function postSendOrder() {
        return ['status'  => 'success', 'message' => ''];
    }

    function postRequestQuote() {
        \Input::merge(["type"=>"quote"]);
        \Input::merge(["status"=>-1]);
        $order = [];
        foreach (\Input::get('order') as $ord) {
            $order[] = array_only($ord, ['product_id', 'product_name', 'product_content', 'quantity']);
        }
        \Input::merge(["attribs"=>json_encode($order)]);
        \Input::merge(["supplier_id"=>\Input::get('order')[0]['member_id']]);
        if (isset(\Input::get('card')['id'])) {
            \Input::merge(["customer_id"=>\Input::get('member_id')]);
            \Input::merge(["customer_card"=>\Input::get('card')['id']]);
        }
        else \Input::merge(["customer"=>json_encode(\Input::get('card'))]);
        $res = \CRUD::insert(new MemberRequest);
        if ($res['status'] == 'success') {
            $res['message'] = 'Đã gởi yêu cầu thành công!';
            \Cookie::queue('carts', array_except(\Cookie::get('carts'), array_pluck(\Input::get('order'), 'product_id')));
        }
        return $res;
    }

    function postRequestSample() {
        \Input::merge(["type"=>"sample"]);
        \Input::merge(["status"=>-1]);
        \Input::merge(["attribs"=>json_encode(\Input::get('order'))]);
        \Input::merge(["supplier_id"=>\Input::get('order')['member_id']]);
        if (isset(\Input::get('card')['id'])) {
            \Input::merge(["customer_id"=>\Input::get('member_id')]);
            \Input::merge(["customer_card"=>\Input::get('card')['id']]);
        }
        else \Input::merge(["customer"=>json_encode(\Input::get('card'))]);
        $res = \CRUD::insert(new MemberRequest);
        if ($res['status'] == 'success') {
            $res['message'] = \Language::getTemplate('ecomtemplate.msg_send_request_success');
            // \Cookie::queue('carts', array_except(\Cookie::get('carts'), array_pluck(\Input::get('order'), 'product_id')));
        }
        return $res;
    }

    function postCancelSample() {
        try {
            MemberRequest::find(\Input::get('request'))->update(['status' => 0]);
        } catch(\Exception $e) {
            return [ 'status' => 'error',
                     'message' =>  \Language::get('global.message_crud_update_error'),
                     'info' => $e->getMessage()];
        }
        return ['status' => 'success', 'message' => \Language::getTemplate('ecomtemplate.msg_cancel_request_success')];
    }

    function postProducts() {
        $cat_id = ProductMediaCategory::where('category_name', 'Đại diện')->first()->id;
        $products = Product::where('public', 1)->where('category_id', \Input::get('category_id'))->orderByRaw("RAND()")->take(4)->get();
        foreach ($products as $product) {
            $product_medias = \DB::table('product_medias')->where('media_category_id', $cat_id)->where('product_id', $product->id)->first();
            if (isset($product_medias->content))
                $product->content = $product_medias->content;
            $member_product = MemberProduct::where('product_id', $product->id)->first();
            if (isset($member_product->member_id))
                $member = Member::find($member_product->member_id);
            $product->member = (isset($member->member_shortname) && $member->member_shortname != '') ? $member->member_shortname : ((isset($member->member_othername) && $member->member_othername != '') ? $member->member_othername : ((isset($member->member_name) && $member->member_name != '') ? $member->member_name : \Language::getTemplate('ecomtemplate.lbl_member_not_found')));
            $product->member_alias = (isset($member->member_alias) && $member->member_alias != '') ? $member->member_alias : '#';
//            $product_custom_fields_id = json_decode(DB::table('product_categories')->where('id', $product->category_id)->value('product_custom_fields'));
//            $product_custom_fields = DB::table('product_custom_fields')->whereIn('id', $product_custom_fields_id)->get();
        }
        return $products;
    }

    function postMemberConfigLayout(){
        \DB::table('members')
            ->where('id', \Input::get('id'))
            ->update([
                'settings'=>\Input::get('settings')
            ]);
        return ['status' => 'success', 'message' => \Language::get('global.message_crud_update_success')];
    }

    public function postSearch(){
        $lang = \Input::get('lang');
        $alias_member = Menu::where('lang', $lang)->where('content', 'member')->where('public', 1)->value('alias');
        $alias_product = Menu::where('lang', $lang)->where('content', 'product')->where('public', 1)->value('alias');
        // $path = \DB::table('menus')->where('public', 1)->where('content', 'product')->where('lang', $lang)->value('alias');
        if ($alias_member == '' && $alias_product == '') return [];
        $menu_member = $alias_member != '' ? \Path::url($lang . '/' . $alias_member) : '';
        $menu_product = $alias_product != '' ? \Path::url($lang . '/' . $alias_product) : '';
        $results = [];
        $query = \DB::table('vmember_products')->where('public', 1)->where('lang', $lang);
        $query->where(function($query)
        {
            $search = \Input::get('search');
            $cols = ['product_name', 'desc', 'member_name', 'member_address', 'member_tin', 'member_email', 'member_website'];
            foreach ($cols as $col){
                $query->orWhere($col, 'like', '%'.$search.'%');
            }
        });
        $query->take(10);
        foreach ($query->get() as $pro) {
            // $img = \DB::table('product_medias')
            //     ->join('product_media_categories', 'product_medias.media_category_id', '=', 'product_media_categories.id')
            //     ->where('product_medias.product_id', '=', $pro->id)
            //     ->where('product_media_categories.data_type', '=', 'AVATAR')
            //     ->value('product_medias.content');
            $media_product = \DB::table('vproduct')->where('product_id', $pro->product_id)->where('data_type', 'AVATAR')->value('media');
            $media_member = \DB::table('vmember')->where('member_id', $pro->member_id)->where('data_type', 'AVATAR')->value('media');
            if ($media_product != '')
            array_push($results, [
                // 'path' => $menu_product.'/'.$pro->alias,
                'text' => '
                <div class="media">
                    <div class="pull-left">
                        <img width="64px" class="thumbnail" src="'.config("data.PATH_ROOT").$media_product.'">
                    </div>
                    <div class="media-body">
                        <a href="'.$menu_product.'/'.$pro->alias.'"><div class="lv-title"><b>'.$pro->product_name.'</b></div></a>
                        <a href="'.$menu_member.'/'.$pro->member_alias.'"><small class="lv-small">'.strip_tags($pro->member_name).'</small></a>
                        <small class="lv-small">'.strip_tags($pro->desc).'</small>
                    </div>
                </div>
                '
            ]);
        }
        // $path = \DB::table('menus')->where('public', 1)->where('content', 'member')->where('lang', $lang)->value('alias');
        // $query = \DB::table('members')->where('member_level', '>', 0)->where('lang', $lang);
        // $query->where(function($query)
        // {
        //     $search = \Input::get('search');
        //     $cols = ['member_name', 'member_address', 'member_tin', 'member_email', 'member_website'];
        //     foreach ($cols as $col){
        //         $query->orWhere($col, 'like', '%'.$search.'%');
        //     }
        // });
        // $query->take(10);
        // foreach ($query->get() as $member) {
        //     $img = \DB::table('member_medias')
        //         ->join('member_media_categories', 'member_medias.media_category_id', '=', 'member_media_categories.id')
        //         ->where('member_medias.member_id', '=', $member->id)
        //         ->where('member_media_categories.data_type', '=', 'AVATAR')
        //         ->value('member_medias.content');
        //     array_push($results, [
        //         'path' => url($lang.'/'.$path.'/'.$member->member_alias),
        //         'text' => '
        //         <div class="media">
        //             <div class="pull-left">
        //                 <img width="64px" class="thumbnail" src="'.config("data.PATH_ROOT").$img.'">
        //             </div>
        //             <div class="media-body">
        //                 <div class="lv-title"><b>'.$member->member_name.'</b></div>
        //                 <small class="lv-small">'.strip_tags($member->member_address).'</small>
        //             </div>
        //         </div>
        //         '
        //     ]);
        // }
        return $results;
    }

    public function postQuote() {
        return MemberRequest::fetchQuote();
    }

    public function postSample() {
        return MemberRequest::fetchSample();
    }

    public function postRequest() {
        return MemberRequest::fetchRequest();
    }

    public function postCertificates() {
        return MemberCertificate::fetch();
    }

    public function postContact() {
        return MemberContact::fetch();
    }

    public function postSendContact() {
        \Input::merge(array('type' => 'contact'));
        \Input::merge(array('status' => 0));
        $res = \CRUD::insert(new MemberContact);
        if ($res['status'] == 'success')
            $res['message'] = \Language::getTemplate('ecomtemplate.msg_send_contact_success');
        return $res;
    }

    function postSendMail() {
        $tos = [];
        $input = \Input::all();
        foreach (explode(',', $input['to']) as $to) {
            array_push($tos, ['address'=>$to]);
        }
        $mail_config = \System::getValue('mail');
        $mail = \Mailer::send(
            $input['message'],
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
        if ($mail['status'] == 'success') {
            $cur_contact = MemberContact::find(\Input::get('id'));
            $cur_contact->status = 1;
            $cur_contact->save();
            $new_contact = array_except($cur_contact->toArray(), ['id']);
            $new_contact['type'] = 'feedback';
            $new_contact['note'] = $input['message'];
            \CRUD::insert(new MemberContact, $new_contact);
        }
        return $mail;
    }

    function postMailQuote() {
        $tos = [];
        $input = \Input::all();
        foreach (explode(',', $input['to']) as $to) {
            array_push($tos, ['address'=>$to]);
        }
        $mail_config = \System::getValue('mail');
        $mail = \Mailer::send(
            $input['message'],
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
        if ($mail['status'] == 'success') {
            $cur_quote = MemberRequest::find(\Input::get('id'));
            $cur_quote->status = 1;
            $cur_quote->save();
            $new_quote = array_except($cur_quote->toArray(), ['id']);
            $new_quote['type'] = 'feedback-quote';
            $new_quote['note'] = $input['message'];
            \CRUD::insert(new MemberRequest, $new_quote);
        }
        return $mail;
    }

    public function postAdd() {
        switch (\Input::get('uri')) {
            case 'certificates':
                return \CRUD::insert(new MemberCertificate);
                break;
            default:
                return ['status' => 'warning', 'message' => \Language::getTemplate('ecomtemplate.message_not_permission')];
                break;
        }
    }

    public function postUpdate() {
        switch (\Input::get('uri')) {
            case 'certificates':
                return \CRUD::update(new MemberCertificate);
                break;
            default:
                return ['status' => 'warning', 'message' => \Language::getTemplate('ecomtemplate.message_not_permission')];
                break;
        }
    }

    public function postDelete() {
        switch (\Input::get('uri')) {
            case 'contact':
                return \CRUD::delete(new MemberContact);
                break;
            case 'certificates':
                return \CRUD::delete(new MemberCertificate);
                break;
            default:
                return ['status' => 'warning', 'message' => \Language::getTemplate('ecomtemplate.message_not_permission')];
                break;
        }
    }

    public function postSubcriber() {
        return \CRUD::insert(new ContentSubcribe);
    }

    public function postFetch() {
        switch (\Input::get('uri')) {
            case 'members':
                $filters = \Input::get('filters');
                $filters[] = [
                    'key' => 'member_level',
                    'value' => 1
                ];
                $filters[] = [
                    'key' => 'member_level',
                    'value' => 2
                ];
                $filters[] = [
                    'key' => 'member_types',
                    'value' => '["supplier"]'
                ];
                $filters[] = [
                    'key' => 'member_types',
                    'value' => '["supplier","customer"]'
                ];
                \Input::merge(['filters' => $filters]);
                $res = \CRUD::fetch(new Member);
                foreach ($res['rows'] as $row) {
                    $member_media = \DB::table('vmember')->where('data_type', 'AVATAR')->where('member_id', $row->id)->value('media');
                    $row->logo = $member_media != '' ? config("data.PATH_ROOT").$member_media : '';
                    $menu_member = Menu::where('lang', \Input::get('lang'))->where('content', 'member')->where('public', 1)->first();
                    $row->url = isset($menu_member->alias) ? \Path::url(\Input::get('lang') . '/' . $menu_member->alias) . '/' . $row->member_alias : '';
                }
                return $res;
                break;
            case 'products':
                if (\Input::has('members'))
                    $product_ids = \DB::table('vmember_products')->whereIn('member_id', \Input::get('members'))->pluck('product_id');
                else $product_ids = \DB::table('vmember_products')->where('member_level', '<>', 0)->pluck('product_id');
                if (\Input::get('favorite')) {
                    $product_favorites = \DB::table('users_products')->where('user_id', \Auth::user()->id)->pluck('product_id');
                    $product_ids = collect($product_ids)->intersect($product_favorites);
                }
                $filters = \Input::get('filters');
                if (count($product_ids) == 0)
                    $filters[] = [
                        'key' => 'id',
                        'value' => 0
                    ];
                else
                    foreach ($product_ids as $product_id) {
                        $filters[] = [
                            'key' => 'id',
                            'value' => $product_id
                        ];
                    }
                \Input::merge(['filters' => $filters]);
                $res = \CRUD::fetch(new Product);
                foreach ($res['rows'] as $product) {
                    $product_member = \DB::table('vmember_products')->where('product_id', $product->id)->first();
                    $product_media = \DB::table('vproduct')->where('product_id', $product->id)->value('media');
                    $product->media = $product_media != '' ? config("data.PATH_ROOT").$product_media : '';
                    $menu_product = Menu::where('lang', \Input::get('lang'))->where('content', 'product')->where('public', 1)->first();
                    $product->url = isset($menu_product->alias) ? \Path::url(\Input::get('lang') . '/' . $menu_product->alias) . '/' . $product->alias : '';
                    $menu_member = Menu::where('lang', \Input::get('lang'))->where('content', 'member')->where('public', 1)->first();
                    $product->member_url = isset($menu_member->alias) ? \Path::url(\Input::get('lang') . '/' . $menu_member->alias) . '/' . $product_member->member_alias : '';
                    $product->member_name = $product_member->member_name;
                    $product->info = \DB::table('vproduct_fields')->where('product_id', $product->id)->where('lang', \Input::get('lang'))->get();
                }
                return $res;
                break;
            default:
                // return ['status' => 'warning', 'message' => \Language::getTemplate('ecomtemplate.message_not_permission')];
                break;
        }
    }
}
