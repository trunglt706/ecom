<?php

namespace App\Http\Controllers\Com\System;

class CRUDController {

    public static function fetch($M) {
        $query = $M::select()->where('id', '>', 0);
        if (\Input::has('idc')) $query->where('category_id', '=', \Input::get('idc'));
        if (\Input::has('search'))
            $query->where(function($query) use ($M)
            {
                $cols = $M::cols();
                $search = \Input::get('search');
                foreach ($cols as $key => $val){
                    if (in_array('src', $val['filter'])) {
                        if(isset($val['fkey'])){
                            $query->orWhere(function($query) use ($val, $search){
                                $arr = \DB::table($val['fkey']['tbl'])->where($val['fkey']['col'], 'like', '%'.$search.'%')->get();
                                foreach ($arr as $row) {
                                    $query->orWhere($val['fkey']['fkey'], '=', $row->id);
                                }
                            });
                        }else $query->orWhere($key, 'like', '%'.$search.'%');
                    }
                }
            });
        if(\Input::has('filters')){
            $query->where(function($query) use ($M)
            {
                $filters = \Input::get('filters');
                $keys = [];
                foreach ($filters as $filter)
                    $keys[$filter['key']][] = $filter['value'];
                foreach ($keys as $key => $value)
                    $query->whereIn($key, $value);
            });
        }
        if(\Input::has('sort')){
            if(isset($M::cols()[\Input::get('sort')]['fkey'])){
                $query->orderBy($M::cols()[\Input::get('sort')]['fkey']['fkey'], \Input::get('order'));
            }else $query->orderBy(\Input::get('sort'), \Input::get('order'));
        }
        $result['total'] = $query->count();
        $query->skip((\Input::get('pagenum', 1)-1)*\Input::get('pagesize', 10));
        $query->take(\Input::get('pagesize', 10));
        $result['rows']  = $query->get();
        // add fkey render
        foreach ($result['rows'] as $row){
            $cols = $M::cols();
            foreach ($cols as $key => $val){
                if(isset($val['fkey'])){
                    $key_render = $val['fkey']['fkey'].'_render';
                    $row->$key_render = \DB::table($val['fkey']['tbl'])->where('id', $row->$val['fkey']['fkey'])->pluck($val['fkey']['col']);
                }
            }
        }
        return $result;
    }

    public static function insert($M, $dat = null) {
        $data = isset($dat) ? $dat : \Input::all();
        try {
            $validator = \Validator::make($data, $M::$rules);
            if ($validator->fails())
                return [ 'status' => 'warning',
                         'message' =>  \Language::get('global.message_crud_insert_warning', ['Message'=>$validator->messages()->toJson() ]),
                         'info' => $validator->messages()->toJson()];

            $model = $M::create($data);
        } catch(\Exception $e) {
            return [ 'status' => 'error',
                     'message' =>  \Language::get('global.message_crud_insert_error'),
                     'info' => $e->getMessage()];
        }
        return ['status' => 'success', 'message' => \Language::get('global.message_crud_insert_success'), 'model'=>$model];
    }

    public static function update($M,$valid = null, $dat = null) {
        $data = isset($dat) ? $dat : \Input::all();
        $data['id'] = isset($data['id']) ? $data['id'] : \Input::get('id');
        try {
            $r = $M::findOrFail($data['id']);
            $rules = isset($valid) ? $valid : $M::$rules;
            $validator = \Validator::make($data, $rules);
            if ($validator->fails())
                return [ 'status' => 'warning',
                         'message' =>  \Language::get('global.message_crud_update_warning', ['Message'=>$validator->messages()->toJson() ]),
                         'info' => $validator->messages()->toJson()];

            $r->update($data);
        } catch(\Exception $e) {
            return [ 'status' => 'error',
                     'message' =>  \Language::get('global.message_crud_update_error'),
                     'info' => $e->getMessage()];
        }
        return ['status' => 'success', 'message' => \Language::get('global.message_crud_update_success')];
    }

    public static function delete($M, $data = null) {
        try {
            $ids = isset($data) ? $data : json_decode(\Input::get('ids'));
            $M::destroy($ids);
        } catch(\Exception $e) {
            return [ 'status' => 'error',
                     'message' =>  \Language::get('global.message_crud_delete_error'),
                     'info' => $e->getMessage()];
        }
        return ['status' => 'success', 'message' => \Language::get('global.message_crud_delete_success', ["delNum"=>count($ids)])];
    }

}
