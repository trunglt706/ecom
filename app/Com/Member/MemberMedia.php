<?php

namespace App\Com\Member;

use Illuminate\Database\Eloquent\Model;
use App\Com\Member\Member;
use App\Com\Member\MemberUser;

class MemberMedia extends Model {

    /*
    |--------------------------------------------------------------------------
    | Table config
    |--------------------------------------------------------------------------
    |
    */
    protected $table = 'member_medias';
    protected $fillable = ['title', 'caption', 'content', 'sort', 'media_category_id', 'member_id', 'created_by'];
    public static $rules = [
        'title'             => '',
        'caption'           => '',
        'content'           => 'required',
        'sort'              => '',
        'media_category_id' => 'required',
        'member_id'         => 'required',
        'created_by'        => 'required'
    ];

    public static function fetch($member_id = null, $media_category_id = null) {
        $res = \DB::table('member_medias');
        if(!is_null($member_id)) $res->Where('member_id', $member_id);
        if(!is_null($media_category_id)) $res->Where('media_category_id', $media_category_id);
        return $res->select('caption', 'content', 'sort')->orderBy('sort', 'asc')->get();
    }

    public static function saveMedia($memberMedias, $member_id) {
        self::Where('member_id', $member_id)->delete();
        foreach ($memberMedias as $memberMedia) {
            if (isset($memberMedia['medias']))
            foreach ($memberMedia['medias'] as $media) {
                self::insert([
                    'member_id'         => $member_id,
                    'media_category_id' => $memberMedia['id'],
                    'title'             => '',
                    'caption'           => $media['caption'],
                    'content'           => $media['content'],
                    'sort'              => $media['sort'],
                    'created_by'        => \Auth::user()->id
                ]);
            }
        }
    }

    public static function getMemberFolder($member_tin) {
        return md5(config('app.key').'_'.config('data.MEMBER_UPLOAD_DIR').'_'.$member_tin);
    }

    public static function createMemberFolder($member_tin) {
        $dir = self::getMemberFolder($member_tin);
        $dir_user_group = \FileSystem::getFolderNameOfUserGroup(\UserGroup::where('group_code', 'MEMBER')->first()->id);
        $dir = base_path(config('data.UPLOAD_DIR').'/'.$dir_user_group.'/'.$dir);
        if (!is_dir($dir)) mkdir($dir, 0777, true);
    }

    public static function removeFolderNameOfUserGroup($ids) {
        $dir_user_group = \FileSystem::getFolderNameOfUserGroup(\UserGroup::where('group_code', 'MEMBER')->first()->id);
        foreach ($ids as $id) {
            $dir = self::getMemberFolder(Member::where('id', $id)->first()->member_alias);
            $dir = base_path(config('data.UPLOAD_DIR').'/'.$dir_user_group.'/'.$dir);
            \FileSystem::rrmdir($dir);
        }
    }

    public static function getCurrentRootFolder() {
        $member_id = MemberUser::where('user_id', \Auth::user()->id)->first()->member_id;
        $member_tin = Member::where('id', $member_id)->first()->member_tin;
        return config('data.UPLOAD_DIR').'/'.(\FileSystem::getFolderNameOfUserGroup(\Auth::user()->user_group_id).'/'.self::getMemberFolder($member_tin));
    }
}
