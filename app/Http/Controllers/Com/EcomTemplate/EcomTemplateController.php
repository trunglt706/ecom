<?php

namespace App\Http\Controllers\Com\EcomTemplate;

use App\Http\Controllers\Controller;
use App\Com\Content\Content;
use App\Com\Content\ContentCategory;
use App\Com\Member\Member;
use App\Com\Member\MemberCard;
use App\Com\Member\MemberCategory;
use App\Com\Member\MemberCertificate;
use App\Com\Member\MemberContact;
use App\Com\Member\MemberLevelApprove;
use App\Com\Member\MemberMedia;
use App\Com\Member\MemberMediaCategory;
use App\Com\Member\MemberProduct;
use App\Com\Member\MemberRequest;
use App\Com\Member\MemberUser;
use App\Com\Menu\Menu;
use App\Com\Product\Product;
use App\Com\Product\ProductCategory;
use App\Com\Product\ProductCustomField;
use App\Com\Product\ProductMedia;
use App\Com\Product\ProductMediaCategory;

class EcomTemplateController extends Controller
{

    private $langs, $carts;

    public function __construct()
    {
        $this->langs = \Language::where('public', 1)->get();
        $this->carts = self::Carts();
    }

    public function getIndex($page, $params)
    {
        $page->langs     = $this->langs;
        $page->cart_menu = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        return view(\Path::viewTemplate('ecomtemplate.pages.index'))
                        ->with('data', [
                            'page'        => $page,
                            'blocks'      => \Block::renders($page),
                            'auth_member' => self::AuthMember($page),
                            'carts'       => $this->carts,
                            'menus'       => self::MenuAll($page)
        ]);
    }

    public function getMembers($page, $params)
    {
        $page->langs     = $this->langs;
        $page->cart_menu = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data            = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        return view(\Path::viewTemplate('ecomtemplate.pages.members'))->with('data', $data);
    }

    public function getMember($page, $params)
    {
        $page->langs     = $this->langs;
        $page->cart_menu = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data            = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];

        $cat_operation    = ContentCategory::where('category_name', 'Hoạt Động Doanh Nghiệp')->value('id');
        $content_path     = Menu::where('content', 'article_category')->where('lang', $page->lang)->where('attribs', '{"category_id":"' . $cat_operation . '"}')->value('alias');
        $data['contents'] = Content::where('lang', $page->lang)->where('category_id', $cat_operation)->orderByRaw("RAND()")->take(4)->get();
        foreach ($data['contents'] as $content)
        {
            $content->url = \Path::url($page->lang . '/' . ($content_path != '' ? $content_path : $page->alias) . '/' . $content->alias);
        }

        $data['style'] = '';
        $data['class'] = 'no-banner';
        if (!isset($params[1]))
        {
            $data['gold_members'] = [];
            $gold_member          = Member::where('lang', $page->lang)->where('member_level', 2)->where('member_approve', 1)->where('active', 1)->orderByRaw("RAND()")->take(5)->get();
            foreach ($gold_member as $gm)
            {
                $lvl_app = MemberLevelApprove::where('member_id', $gm->id)->where('member_level', 2)->where('member_approve', 1)->orderBy('id', 'desc')->first();
                $is_gold = false;
                if (isset($lvl_app))
                {
                    $date_now = (new \DateTime('NOW'))->modify('+7 hours');
                    $is_gold  = ($date_now >= (new \DateTime($lvl_app->start_at)) && $date_now <= (new \DateTime($lvl_app->ended_at)));
                }
                if ($is_gold)
                {
                    $media                  = \DB::table('vmember')->where('data_type', 'AVATAR')->where('member_id', $gm->id)->value('media');
                    $gm->media              = $media != '' ? config("data.PATH_ROOT") . $media : '';
                    $gm->url                = $data['menus']->member != '' ? $data['menus']->member . '/' . $gm->member_alias : '';
                    $data['gold_members'][] = $gm;
                }
            }
            return view(\Path::viewTemplate('ecomtemplate.pages.member'))->with('data', $data);
        }
        $member              = Member::where('lang', $page->lang)->where('member_alias', $params[1])->where('active', 1)->first();
        if (is_null($member))
            abort(404);
        \DB::table('members')->where('id', $member->id)->update(['views' => $member->views + 1]);
        $types               = json_decode($member->member_types);
        $data['is_supplier'] = in_array('supplier', $types);
        $data['is_customer'] = in_array('customer', $types);
        $is_own              = (\Auth::check() && \Auth::user()->login_frontend) ? (MemberUser::where('member_tin', $member->member_tin)->where('user_id', \Auth::user()->id)->count() > 0) : 0;
        if (!$is_own && $member->member_level == 0)
            abort(404);
        $data['is_gold']     = $member->member_level == 2 && $member->member_approve == 1;
        if ($data['is_gold'])
        {
            $lvl_app = MemberLevelApprove::where('member_id', $member->id)->where('member_level', 2)->where('member_approve', 1)->orderBy('id', 'desc')->first();
            if (isset($lvl_app))
            {
                $date_now        = (new \DateTime('NOW'))->modify('+7 hours');
                $data['is_gold'] = ($date_now >= (new \DateTime($lvl_app->start_at)) && $date_now <= (new \DateTime($lvl_app->ended_at)));
            }
        }
        $data['request_member'] = $member->member_level == 0 && $member->member_approve != -1;
        $member->url            = $data['menus']->member != '' ? $data['menus']->member . '/' . $member->member_alias : '';
        if (!isset($params[2]))
        {
            if (!$data['is_supplier'])
                abort(404);
            $media          = \DB::table('vmember')->where('data_type', 'AVATAR')->where('member_id', $member->id)->value('media');
            $member->media  = $media != '' ? config("data.PATH_ROOT") . $media : '';
            $data['member'] = $member;
            $banner         = \DB::table('vmember')->where('data_type', 'BANNER')->where('member_id', $member->id)->value('media');
            if ($banner != '')
            {
                $data['style'] = 'background-image: url(' . config("data.PATH_ROOT") . $banner . ');';
                $data['class'] = 'banner';
            }
            if ($member->member_level == 1 && $member->member_approve != -1)
                $data['request_gold'] = !$data['is_gold'];
            else
                $data['request_gold'] = false;
            $products             = \DB::table('vmember_products')->where('member_id', $member->id)->where('public', 1);
            $data['count']        = $products->count();
            $data['product']      = $products->orderByRaw("RAND()")->take(8)->get();
            foreach ($data['product'] as $product)
            {
                $product_media       = \DB::table('vproduct')->where('product_id', $product->product_id)->value('media');
                $product->media      = $product_media != '' ? config("data.PATH_ROOT") . $product_media : '';
                $product->url        = $data['menus']->product . '/' . $product->alias;
                $product->member_url = isset($data['menus']->member) ? $data['menus']->member . '/' . $product->member_alias : '';
                $product->info       = \DB::table('vproduct_fields')->where('product_id', $product->product_id)->where('lang', $page->lang)->get();
            }

            $data['certs'] = [];
            $certs         = \DB::table('vmember_certificates')->where('member_id', $member->id)->get();
            $x             = 0;
            foreach ($certs as $key => $cert)
            {
                $data['certs'][$x][] = $cert;
                if (($key % 6) == 5)
                    $x++;
            }

            $menu_products       = Menu::where('lang', $page->lang)->where('content', 'products')->where('public', 1)->first();
            $data['all_product'] = isset($menu_products->alias) ? \Path::url($page->lang . '/' . $menu_products->alias . '/' . $params[1]) : '';
            $data['is_own']      = $is_own;
            $data['layouts']     = json_decode($member->settings);
            $data['other_lang']  = [];
            $other_lang          = \Language::where('lang_code', '<>', $page->lang)->pluck('lang_code');
            if (count($other_lang) != 0)
            {
                $other_mem          = Member::where('lang', '<>', $page->lang)->where('member_tin', $member->member_tin)->pluck('lang');
                if (count($other_mem) < count($other_lang))
                    $data['other_lang'] = \Language::where('lang_code', '<>', $page->lang)->whereNotIn('lang_code', $other_mem)->get();
            }
            return view(\Path::viewTemplate('ecomtemplate.pages.member_detail'))->with('data', $data);
        }
        if (!isset($params[3]) && $is_own)
        {
            $data['member'] = $member;
            $data['uri']    = $params[2];
            if ($params[2] == 'dashboard')
                return view(\Path::viewTemplate('ecomtemplate.pages.member_dashboard'))->with('data', $data);
            if ($data['is_supplier'])
            {
                if ($params[2] == 'products')
                    return view(\Path::viewTemplate('ecomtemplate.pages.member_product'))->with('data', $data);
                if ($params[2] == 'certificates')
                    return view(\Path::viewTemplate('ecomtemplate.pages.member_certificate'))->with('data', $data)->with('M', new MemberCertificate);
                if ($params[2] == 'ads')
                    return view(\Path::viewTemplate('ecomtemplate.pages.member_ads'))->with('data', $data);
                if (!$data['request_member'])
                {
                    if ($params[2] == 'sample')
                        return view(\Path::viewTemplate('ecomtemplate.pages.member_sample'))->with('data', $data)->with('M', new MemberRequest);
                    if ($params[2] == 'quote')
                        return view(\Path::viewTemplate('ecomtemplate.pages.member_quote'))->with('data', $data)->with('M', new MemberRequest);
                }
            }
            if ($data['is_customer'])
            {
                if ($params[2] == 'request')
                    return view(\Path::viewTemplate('ecomtemplate.pages.member_request'))->with('data', $data)->with('M', new MemberRequest);
            }
            if ($params[2] == 'users')
                return view(\Path::viewTemplate('ecomtemplate.pages.member_user'))->with('data', $data);
            if ($params[2] == 'contact')
                return view(\Path::viewTemplate('ecomtemplate.pages.member_contact'))->with('data', $data)->with('M', new MemberContact);
            if ($params[2] == 'card')
                return view(\Path::viewTemplate('ecomtemplate.pages.member_card'))->with('data', $data);
        }
        abort(404);
    }

    public function getProducts($page, $params)
    {
        $page->langs                = $this->langs;
        $page->cart_menu            = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data                       = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        $cat_lang                   = ProductCategory::where('category_name', $data['page']->lang)->value('id');
        $data['product_categories'] = ProductCategory::where('parent_category', $cat_lang)->get();
        // $data['product_categories'] = ProductCategory::get();
        if (!isset($params[1]))
        {
            $data['members'] = Member::where('lang', $data['page']->lang)->where('active', 1)->where('member_level', '>', 0)->get();
        }
        if (isset($params[1]))
        {
            $member         = Member::where('member_alias', $params[1])->where('lang', $data['page']->lang)->where('active', 1)->first();
            if (!isset($member))
                abort(404);
            $data['member'] = $member;
        }
        $data['favorite'] = 0;
        if (!isset($params[2]))
            return view(\Path::viewTemplate('ecomtemplate.pages.products'))->with('data', $data);
        abort(404);
    }

    public function getProduct($page, $params)
    {
        $page->langs                   = $this->langs;
        $page->cart_menu               = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data                          = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        if (!isset($params[1]))
            abort(404);
//        if (!isset($params[1])) return view(\Path::viewTemplate('ecomtemplate.pages.category'))->with('data', $data);
        $product                       = \DB::table('vmember_products')->where('lang', $page->lang)->where('alias', $params[1])->where('public', 1)->first();
        if (is_null($product))
            abort(404);
        \DB::table('products')->where('id', $product->product_id)->update(['views' => $product->views + 1]);
        $menu_category                 = Menu::where('lang', $page->lang)->where('content', 'product_category')->where('attribs', '{"category_id":"' . $product->category_id . '"}')->where('public', 1)->first();
        $data['menus']->category       = isset($menu_category->alias) ? \Path::url($page->lang . '/' . $menu_category->alias) : '';
        $data['menus']->category_name  = isset($menu_category->menu_name) ? strip_tags($menu_category->menu_name) : '';
        $data['product']               = $product;
        $data['product']->url          = $data['menus']->product . '/' . $product->alias;
        $product_media                 = \DB::table('vproduct')->where('data_type', 'AVATAR')->where('product_id', $product->product_id)->value('media');
        $data['product']->media        = $product_media != '' ? config("data.PATH_ROOT") . $product_media : '';
        $data['product']->media_detail = \DB::table('vproduct')->where('data_type', 'DETAIL')->where('product_id', $product->product_id)->get();
//        $product_custom_fields = ProductCustomField::get();
        $data['product_fields']        = \DB::table('vproduct_fields')->where('lang', $page->lang)->where('product_id', $product->product_id)->get();
        $member_media                  = \DB::table('vmember')->where('data_type', 'AVATAR')->where('member_id', $product->member_id)->value('media');
        $data['product']->member_media = $member_media != '' ? config("data.PATH_ROOT") . $member_media : '';
        $data['product']->member_url   = isset($data['menus']->member) ? $data['menus']->member . '/' . $product->member_alias : '';
        $data['product_similar']       = \DB::table('vmember_products')->where('lang', $page->lang)->where('product_id', '<>', $product->product_id)->where('category_id', $product->category_id)->where('public', 1)->orderByRaw("RAND()")->take(3)->get();
        foreach ($data['product_similar'] as $similar)
        {
            $product_media       = \DB::table('vproduct')->where('data_type', 'AVATAR')->where('product_id', $similar->product_id)->value('media');
            $similar->media      = $product_media != '' ? config("data.PATH_ROOT") . $product_media : '';
            $similar->url        = $data['menus']->product . '/' . $similar->alias;
            $similar->member_url = isset($data['menus']->member) ? $data['menus']->member . '/' . $similar->member_alias : '';
            $similar->info       = \DB::table('vproduct_fields')->where('product_id', $similar->product_id)->where('lang', $page->lang)->get();
        }

        $cat_recipe       = ContentCategory::where('category_name', 'Công thức nấu ăn')->value('id');
        $content_path     = Menu::where('content', 'article_category')->where('lang', $page->lang)->where('attribs', '{"category_id":"' . $cat_recipe . '"}')->value('alias');
        $data['contents'] = Content::where('lang', $page->lang)->where('category_id', $cat_recipe)->orderByRaw("RAND()")->take(4)->get();
        foreach ($data['contents'] as $content)
        {
            $content->url = \Path::url($page->lang . '/' . ($content_path != '' ? $content_path : $page->alias) . '/' . $content->alias);
        }

        $cat_review              = ContentCategory::where('category_name', 'Đánh giá - Tin tức')->value('id');
        $content_path            = Menu::where('content', 'article_category')->where('lang', $page->lang)->where('attribs', '{"category_id":"' . $cat_review . '"}')->value('alias');
        $data['review_contents'] = Content::where('lang', $page->lang)->where('category_id', $cat_review)->orderByRaw("RAND()")->take(5)->get();
        foreach ($data['review_contents'] as $content)
        {
            $content->url = \Path::url($page->lang . '/' . ($content_path != '' ? $content_path : $page->alias) . '/' . $content->alias);
        }

        $data['page']->button        = '<i class="zmdi zmdi-shopping-cart"></i> ' . \Language::getTemplate('ecomtemplate.lbl_request_sample');
        $data['page']->button_action = 1;
        if (\Auth::check() && \Auth::user()->login_frontend)
        {
            $tmp['product_id']      = (string) $data['product']->product_id;
            $tmp['product_name']    = $data['product']->product_name;
            $tmp['product_content'] = $data['product']->media;
            $tmp['member_id']       = (string) $data['product']->member_id;
            $tmp['member_name']     = $data['product']->member_name;
            $member_request         = MemberRequest::where('type', 'sample')->where('supplier_id', $data['product']->member_id)->where('customer_id', $data['auth_member']->id)->where('attribs', json_encode($tmp))->orderBy('created_at', 'desc')->first();
            if (!is_null($member_request) && $member_request->status == 1)
            {
                $data['page']->button        = '<i class="zmdi zmdi-close"></i> ' . \Language::getTemplate('ecomtemplate.lbl_cancel_request');
                $data['page']->button_action = 0;
                $data['request']             = $member_request->id;
            }
        }
        $menu_sample                = Menu::where('parent_menu', $page->id)->where('content', 'request_sample')->first();
        $data['menus']->sample      = isset($menu_sample->alias) ? $data['menus']->product . '/' . $params[1] . '/' . $menu_sample->alias : '';
        $data['menus']->sample_name = isset($menu_sample->menu_name) ? strip_tags($menu_sample->menu_name) : '';
        if (!isset($params[2]))
            return view(\Path::viewTemplate('ecomtemplate.pages.product_detail'))->with('data', $data);
        if ($params[2] != $menu_sample->alias || $data['page']->button_action == 0)
            abort(404);
        if (!isset($params[3]))
            return view(\Path::viewTemplate('ecomtemplate.pages.sample'))->with('data', $data);
        abort(404);
    }

    public function getRegister($page, $params)
    {
        $page->langs      = $this->langs;
        $page->cart_menu  = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        if (self::AuthMember($page) != '')
            redirect('/');
        $data             = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page),
            'member'      => null,
            'user'        => null
        ];
        $cat_id           = ContentCategory::where('category_name', 'Điều Lệ Đăng Ký')->value('id');
        $contents         = Content::where('tags', 'like', '%regulations rules%')->orWhere('category_id', $cat_id)->where('public', 1)->where('lang', $page->lang)->get();
        foreach ($contents as $content)
            $content->url     = \Path::url($page->lang . '/' . $page->alias . '/' . $content->alias);
        $data['contents'] = $contents;
        if (\Input::has('k') && \Input::has('m') && \Input::has('u'))
        {
            $member = Member::find(\Input::get('m'));
            $user   = \User::find(\Input::get('u'));
            if (!(is_null($member) || is_null($user) || !\Hash::check($member->member_tin, \Input::get('k'))) && $member->active == 0)
            {
                $types            = json_decode($member->member_types);
                $member->supplier = in_array('supplier', $types);
                $member->customer = in_array('customer', $types);
                $data['member']   = $member;
                $data['user']     = $user;
            }
        }
        if (!isset($params[1]))
            return view(\Path::viewTemplate('ecomtemplate.pages.register'))->with('data', $data);
        abort(404);
    }

    public function getActive($page, $params)
    {
        $page->langs     = $this->langs;
        $page->cart_menu = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        if (!(\Input::has('k') && \Input::has('m') && \Input::has('u')))
            abort(404);
        $member          = Member::find(\Input::get('m'));
        $user            = \User::find(\Input::get('u'));
        if (is_null($member) || is_null($user) || !\Hash::check($member->member_tin, \Input::get('k')))
            abort(404);
        $user->active    = 1;
        $user->update();
        $member->active  = 1;
        $member->update();
        MemberMedia::createMemberFolder($member->member_tin);
        if (!isset($params[1]))
            return view(\Path::viewTemplate('ecomtemplate.pages.active'))
                            ->with('data', [
                                'page'        => $page,
                                'blocks'      => \Block::renders($page),
                                'auth_member' => self::AuthMember($page),
                                'carts'       => $this->carts,
                                'menus'       => self::MenuAll($page),
                                'response'    => 'Active success'
            ]);
        abort(404);
    }

    public function getCart($page, $params)
    {
        $page->langs       = $this->langs;
        $page->cart_menu   = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data              = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        $menu_register     = Menu::where('lang', $page->lang)->where('content', 'register')->where('public', 1)->first();
        $request           = [];
        $menu_member_vi    = Menu::where('lang', 'vi')->where('content', 'member')->where('public', 1)->value('alias');
        $menu_member_en    = Menu::where('lang', 'en')->where('content', 'member')->where('public', 1)->value('alias');
        $menu_member['vi'] = $menu_member_vi != '' ? \Path::url('vi' . '/' . $menu_member_vi) : '';
        $menu_member['en'] = $menu_member_en != '' ? \Path::url('en' . '/' . $menu_member_en) : '';
        $carts             = \Cookie::get('carts');
        if ($carts != '')
            foreach ($carts as $product_id => $quantity)
            {
                $product                        = \DB::table('vproducts')->where('id', $product_id)->first();
                $request[$product->member_id][] = [
                    'product_id'      => $product_id,
                    'product_name'    => $product->product_name,
                    // product_alias: val.product_alias,
                    'product_content' => config("data.PATH_ROOT") . $product->media,
                    'member_id'       => $product->member_id,
                    'member_name'     => $product->member_name,
                    'member_alias'    => $menu_member[$product->lang] . '/' . $product->member_alias,
                    'quantity'        => $quantity
                ];
            }
        $data['order']   = [];
        foreach ($request as $member_id => $order)
            $data['order'][] = $order;
        if (!isset($params[1]))
            return view(\Path::viewTemplate('ecomtemplate.pages.cart'))->with('data', $data);
        abort(404);
    }

    public function getArticles($page, $params)
    {
        $page->langs      = $this->langs;
        $page->cart_menu  = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data             = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        $cat_news_id      = ContentCategory::where('category_name', 'Tin tức')->value('id');
        $cat_ids          = ContentCategory::where('parent_category', $cat_news_id)->pluck('id');
        $contents         = Content::orderBy('created_at', 'desc')->where('lang', $page->lang)->whereIn('category_id', $cat_ids)->where('public', 1)->take(11)->get();
        $data['contents'] = $contents;
        foreach ($data['contents'] as $content)
        {
            $content_path = Menu::where('content', 'article_category')->where('lang', $page->lang)->where('attribs', '{"category_id":"' . $content->category_id . '"}')->value('alias');
            $content->url = \Path::url($page->lang . '/' . ($content_path != '' ? $content_path : $page->alias) . '/' . $content->alias);
        }
        $products = \DB::table('vmember_products')->where('lang', $page->lang)->where('public', 1)->where('featured', 1);
        if ($products->count() < 5)
        {
            $products = \DB::table('vmember_products')->where('lang', $page->lang)->where('public', 1)->orderByRaw("RAND()")->orderBy('featured', 'desc')->orderBy('member_level', 'desc');
        }
        $data['product'] = $products->orderByRaw("RAND()")->take(5)->get();
        foreach ($data['product'] as $product)
        {
            $product_media       = \DB::table('vproduct')->where('product_id', $product->product_id)->value('media');
            $product->media      = $product_media != '' ? config("data.PATH_ROOT") . $product_media : '';
            $product->url        = $data['menus']->product . '/' . $product->alias;
            $product->member_url = isset($data['menus']->member) ? $data['menus']->member . '/' . $product->member_alias : '';
            $product->info       = \DB::table('vproduct_fields')->where('product_id', $product->product_id)->where('lang', $page->lang)->get();
        }
        if (!isset($params[1]))
            return view(\Path::viewTemplate('ecomtemplate.pages.articles'))->with('data', $data);
        $content         = Content::where('alias', $params[1])->where('lang', $page->lang)->whereIn('category_id', $cat_ids)->where('public', 1)->first();
        if (is_null($content))
            abort(404);
        $data['content'] = $content;
//        $data['contents'] = [];
        if (!isset($params[2]))
            return view(\Path::viewTemplate('ecomtemplate.pages.article'))->with('data', $data);
        abort(404);
    }

    public function getArticle($page, $params)
    {
        $page->langs      = $this->langs;
        $page->cart_menu  = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data             = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        // $content = Content::find(json_decode($page->attribs)->content_id)->first();
        $content          = \DB::table('contents')->where('id', json_decode($page->attribs)->content_id)->first();
        if (is_null($content))
            abort(404);
        $data['content']  = $content;
        $data['contents'] = [];
        $products         = \DB::table('vmember_products')->where('lang', $page->lang)->where('public', 1)->where('featured', 1);
        if ($products->count() < 5)
        {
            $products = \DB::table('vmember_products')->where('lang', $page->lang)->where('public', 1)->orderByRaw("RAND()")->orderBy('featured', 'desc')->orderBy('member_level', 'desc');
        }
        $data['product'] = $products->orderByRaw("RAND()")->take(5)->get();
        foreach ($data['product'] as $product)
        {
            $product_media       = \DB::table('vproduct')->where('product_id', $product->product_id)->value('media');
            $product->media      = $product_media != '' ? config("data.PATH_ROOT") . $product_media : '';
            $product->url        = $data['menus']->product . '/' . $product->alias;
            $product->member_url = isset($data['menus']->member) ? $data['menus']->member . '/' . $product->member_alias : '';
            $product->info       = \DB::table('vproduct_fields')->where('product_id', $product->product_id)->where('lang', $page->lang)->get();
        }
        return view(\Path::viewTemplate('ecomtemplate.pages.article'))->with('data', $data);
        if (isset($params[1]))
            abort(404);
    }

    public function getArticle_category($page, $params)
    {
        $page->langs     = $this->langs;
        $page->cart_menu = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        // $page->url = \Path::url($page->lang . '/' . $page->alias);
        $data            = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        $products        = \DB::table('vmember_products')->where('lang', $page->lang)->where('public', 1)->where('featured', 1);
        if ($products->count() < 5)
        {
            $products = \DB::table('vmember_products')->where('lang', $page->lang)->where('public', 1)->orderByRaw("RAND()")->orderBy('featured', 'desc')->orderBy('member_level', 'desc');
        }
        $data['product'] = $products->orderByRaw("RAND()")->take(5)->get();
        foreach ($data['product'] as $product)
        {
            $product_media       = \DB::table('vproduct')->where('product_id', $product->product_id)->value('media');
            $product->media      = $product_media != '' ? config("data.PATH_ROOT") . $product_media : '';
            $product->url        = $data['menus']->product . '/' . $product->alias;
            $product->member_url = isset($data['menus']->member) ? $data['menus']->member . '/' . $product->member_alias : '';
            $product->info       = \DB::table('vproduct_fields')->where('product_id', $product->product_id)->where('lang', $page->lang)->get();
        }
        $cat_id           = json_decode($page->attribs)->category_id;
        $contents         = Content::orderBy('created_at', 'desc')->where('lang', $page->lang)->where('category_id', $cat_id)->where('public', 1)->take(11)->get();
        $data['contents'] = $contents;
        foreach ($data['contents'] as $content)
        {
            $content_path = Menu::where('content', 'article_category')->where('lang', $page->lang)->where('attribs', '{"category_id":"' . $content->category_id . '"}')->value('alias');
            $content->url = \Path::url($page->lang . '/' . ($content_path != '' ? $content_path : $page->alias) . '/' . $content->alias);
        }
        if (!isset($params[1]))
            return view(\Path::viewTemplate('ecomtemplate.pages.articles'))->with('data', $data);
        $content               = Content::where('alias', $params[1])->first();
        if (is_null($content))
            abort(404);
        $data['content']       = $content;
        $data['cat_menu']      = $page;
        $data['cat_menu']->url = \Path::url($page->lang . '/' . $page->alias);
        return view(\Path::viewTemplate('ecomtemplate.pages.article'))->with('data', $data);
    }

    public function getProduct_category($page, $params)
    {
        $page->langs      = $this->langs;
        $page->cart_menu  = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data             = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        $product_category = ProductCategory::find(json_decode($page->attribs)->category_id);
        if (!isset($params[1]))
        {
            if (!isset($product_category))
                abort(404);
            $data['product_category'] = $product_category;
            $data['members']          = Member::where('lang', $data['page']->lang)->where('active', 1)->where('member_level', '>', 0)->get();
        }
        if (isset($params[1]))
        {
            $member         = Member::where('member_alias', $params[1])->where('lang', $data['page']->lang)->where('active', 1)->first();
            if (!isset($member))
                abort(404);
            $data['member'] = $member;
        }
        $data['favorite'] = 0;
        if (!isset($params[2]))
            return view(\Path::viewTemplate('ecomtemplate.pages.products'))->with('data', $data);
        abort(404);
    }

    public function getPassword($page, $params)
    {
        if (!(\Input::has('k') && \Input::has('u')))
            abort(404);
        $user            = \User::where('username', \Input::get('u'))->where('attribs', \Input::get('k'))->first();
        if (is_null($user) || !\Hash::check($user->email, \Input::get('k')))
            abort(404);
        $page->langs     = $this->langs;
        $page->cart_menu = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data            = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page),
            'user'        => $user
        ];
        return view(\Path::viewTemplate('ecomtemplate.pages.password'))->with('data', $data);
    }

    public function getSearch($page, $params)
    {
        $page->langs     = $this->langs;
        $page->cart_menu = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data            = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        return view(\Path::viewTemplate('ecomtemplate.pages.search'))->with('data', $data);
        if (isset($params[1]))
            abort(404);
    }

    public function AuthMember($page)
    {
        $auth_member = '';
        if (\Auth::check() && \Auth::user()->login_frontend)
        {
            if (!\Auth::user()->login_backend)
            {
                $member_tin  = MemberUser::where('user_id', \Auth::user()->id)->value('member_tin');
                $auth_member = Member::where('lang', $page->lang)->where('member_tin', $member_tin)->where('active', 1)->first();
                if (is_null($auth_member))
                {
                    $lang_code   = \Language::where('lang_code', '<>', $page->lang)->where('public', 1)->value('lang_code');
                    $auth_member = Member::where('lang', $lang_code)->where('member_tin', $member_tin)->where('active', 1)->first();
                }
                $menu                  = Menu::where('lang', $auth_member->lang)->where('content', 'member')->where('public', 1)->first();
                $auth_member->url      = \Path::url($menu->lang . '/' . $menu->alias . '/' . $auth_member->member_alias);
                $types                 = json_decode($auth_member->member_types);
                $auth_member->supplier = in_array('supplier', $types);
                $auth_member->customer = in_array('customer', $types);
            }
            else
            {

            }
        }
        return $auth_member;
    }

    public function Carts()
    {
        $res   = [];
        $carts = \Cookie::get('carts');
        if ($carts != '')
            foreach ($carts as $product_id => $quantity)
            {
                $product = \DB::table('vproducts')->where('id', $product_id)->first();
                $res[]   = [
                    'product_id'      => $product_id,
                    'product_name'    => $product->product_name,
                    // product_alias: val.product_alias,
                    'product_content' => config("data.PATH_ROOT") . $product->media,
                    'member_id'       => $product->member_id,
                    'member_name'     => $product->member_name,
                    // member_alias: $product->member_alias,
                    'quantity'        => $quantity
                        // 'product_name'
                ];
            }
        return $res;
    }

    public function MenuAll($page)
    {
        $menu_index    = Menu::where('lang', $page->lang)->where('content', 'index')->where('public', 1)->first();
        $menu_member   = Menu::where('lang', $page->lang)->where('content', 'member')->where('public', 1)->first();
        $menu_product  = Menu::where('lang', $page->lang)->where('content', 'product')->where('public', 1)->first();
        $menu_register = Menu::where('lang', $page->lang)->where('content', 'register')->where('public', 1)->first();
        $menus         = (object) [];
        if (\Auth::check())
        {
            $menu_favorite        = Menu::where('lang', $page->lang)->where('content', 'favorite')->where('public', 1)->first();
            $menus->favorite      = isset($menu_favorite->alias) ? \Path::url($page->lang . '/' . $menu_favorite->alias) : '';
            $menus->favorite_name = isset($menu_favorite->menu_name) ? strip_tags($menu_favorite->menu_name) : '';
        }
        $menus->index         = \Path::url($page->lang);
        $menus->index_name    = isset($menu_index->menu_name) ? strip_tags($menu_index->menu_name) : '';
        $menus->member        = isset($menu_member->alias) ? \Path::url($page->lang . '/' . $menu_member->alias) : '';
        $menus->member_name   = isset($menu_member->menu_name) ? strip_tags($menu_member->menu_name) : '';
        $menus->product       = isset($menu_product->alias) ? \Path::url($page->lang . '/' . $menu_product->alias) : '';
        $menus->product_name  = isset($menu_product->menu_name) ? strip_tags($menu_product->menu_name) : '';
        $menus->register      = isset($menu_register->alias) ? \Path::url($page->lang . '/' . $menu_register->alias) : '';
        $menus->register_name = isset($menu_register->menu_name) ? strip_tags($menu_register->menu_name) : '';
        return $menus;
    }

    public function getSupport($page, $params)
    {
        $page->langs      = $this->langs;
        $page->cart_menu  = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data             = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        $contents         = Content::orderBy('created_at', 'desc')->where('lang', $page->lang)->take(11)->get();
        $data['contents'] = $contents;
        foreach ($data['contents'] as $content)
        {
            $content->url = \Path::url($page->lang . '/' . $page->alias . '/' . $content->alias);
        }
        if (!isset($params[1]))
            return view(\Path::viewTemplate('ecomtemplate.pages.support'))->with('data', $data);
        $content         = Content::where('alias', $params[1])->first();
        if (is_null($content))
            abort(404);
        $data['content'] = $content;
        if (!isset($params[2]))
            return view(\Path::viewTemplate('ecomtemplate.pages.support'))->with('data', $data);
        abort(404);
    }

    public function getContact($page, $params)
    {
        $page->langs     = $this->langs;
        $page->cart_menu = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data            = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        if (isset($params[1]))
            abort(404);
        return view(\Path::viewTemplate('ecomtemplate.pages.contact'))->with('data', $data);
    }

    public function getFavorite($page, $params)
    {
        $page->langs                = $this->langs;
        $page->cart_menu            = \Path::url($page->lang . '/' . Menu::where('content', 'cart')->where('public', 1)->where('lang', $page->lang)->value('alias'));
        $data                       = [
            'page'        => $page,
            'blocks'      => \Block::renders($page),
            'auth_member' => self::AuthMember($page),
            'carts'       => $this->carts,
            'menus'       => self::MenuAll($page)
        ];
        if (isset($params[1]) || !\Auth::check())
            abort(404);
        $cat_lang                   = ProductCategory::where('category_name', $data['page']->lang)->value('id');
        $data['product_categories'] = ProductCategory::where('parent_category', $cat_lang)->get();
        if (!isset($params[1]))
            $data['members']            = Member::where('lang', $data['page']->lang)->where('active', 1)->where('member_level', '>', 0)->get();
        $data['favorite']           = 1;
        return view(\Path::viewTemplate('ecomtemplate.pages.products'))->with('data', $data);
    }

}