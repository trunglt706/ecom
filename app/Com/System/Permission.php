<?php

namespace App\Com\System;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    |
    */
    // get permission for user group
    public static function get($user_group_id = null, $localtion = null){
        $routes = \App\Com\System\Route::get();
        $per = [];
        foreach($routes as $route){
            if(self::hasPerm($route->alias, 'CAN_ACCESS')){
                $route->perm = json_decode($route->perm);
                $p = [];
                foreach($route->perm as $key=>$val){
                    array_push($p, [
                        'code'  => $key,
                        'val'   => in_array($user_group_id, $val) ? 'T':'F'
                    ]);
                }
                array_push($per, [
                    'id'    => $route->id,
                    'fn'    => \Language::get('com/'.strtolower($route->extension_name).'.lbl_'.$route->name) . ($route->location == 'site' ? ' [Site]':''),
                    'perm'  => $p
                ]);
            }
        }
        return $per;
    }
    // update permission for user group
    public static function updatePerm($user_group_id, $permission){
        foreach ($permission as $perm){
            $route = \App\Com\System\Route::find($perm->id);
            if(!is_null($route)){
                $upd_perm = json_decode($route->perm);
                foreach ($perm->perm as $p){
                    $code = $p->code;
                    if(isset($upd_perm->$code)){
                        if($p->val == 'T'){
                            // add user_group_id to perm
                            $upd_perm->$code = array_unique(array_merge($upd_perm->$code,[$user_group_id]), SORT_ASC);
                        }else{
                            // remove user_group_id in perm
                            $_arr = [];
                            foreach ($upd_perm->$code as $grp){
                                if($grp != $user_group_id) array_push ($_arr, $grp);
                            }
                            $upd_perm->$code = $_arr;
                        }
                    }
                }
                //update perm
                \App\Com\System\Route::find($perm->id)->update(['perm'=>  json_encode($upd_perm)]);
            }
        }
    }

    // delete user group
    public static function deleteGroup($ids){
        $routes = \App\Com\System\Route::get();
        foreach($routes as $route){
            $perm = json_decode($route->perm);
            foreach($perm as $key=>$val){
                $_arr = [];
                foreach ($val as $grp){
                    if(!in_array($grp, $ids)) array_push ($_arr, $grp);
                }
                $perm->$key = $_arr;
            }
            \App\Com\System\Route::find($route->id)->update(['perm'=>  json_encode($perm)]);
        }
    }

    // check permission
    // $route: alias of route
    // $action: permission code
    public static function hasPerm($route, $action){
        $routes = \App\Com\System\Route::get(null, $route);
        if(!is_null($routes)){
            $perm = json_decode($routes->perm);
            return  isset($perm->$action) && in_array( \Auth::user()->user_group_id , $perm->$action );
        }
        return false;
    }
    // $route as array of route
    public static function inHasPerm($routes, $action){
        foreach ($routes as $route){
            if(self::hasPerm($route, $action)) return true;
        }
        return false;
    }

    public static function is_allowed($route, $action, $callback){
        if(!self::hasPerm($route, $action)){
            if($action == 'CAN_ACCESS') abort(404);
            else return ['status'=>'error', 'message'=> \Language::get('global.message_auth_permission_'.strtolower(explode("CAN_",$action)[1]).'_denied')];
        }else return $callback();
    }

    public static function is_group_code($group_code){
        if(!\Auth::check()) return false;
        return \DB::table('user_groups')
                ->where('id', \Auth::user()->user_group_id)
                ->where('group_code', $group_code)
                ->count();
    }
    public static function in_group_code($group_codes){
        foreach ($group_codes as $group_code) {
            if(self::is_group_code($group_code)) return true;
        }
        return false;
    }

    // assignment for page
    public static function can_access($assignment){
        switch ($assignment->mode) {
            case 'and':
                if (count($assignment->assignment)!=0){
                    if (!\Auth::check() || !in_array(\Auth::user()->user_group, $assignment->assignment)) return false;
                }
                break;
            case 'not':
                if (count($assignment->assignment)!=0){
                    if (\Auth::check() && in_array(\Auth::user()->user_group, $assignment->assignment)) return false;
                }
                break;
        }
        return true;
    }
}
