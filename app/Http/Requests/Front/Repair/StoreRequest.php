<?php

namespace App\Http\Requests\Front\Repair;

use App\Http\Requests\Admin\Request;

class StoreRequest extends Request
{
    public function rules()
    {
        $rules = [
            'name'                => 'required|string',
            'build_number'        => 'required|string',
            'home_number'         => 'required|string',
            'description'         => 'required|string',
            'category_ids'        => 'required|array',
        ];
        $telephone = $this->request->get('phone');
        if (!$telephone) {
            $rules['phone'] = 'required';
        }
        if (count(explode('-', $telephone)) > 1) {
            $rules['phone'] = 'required|regex:/^([0-9]{3,4}-)?[0-9]{7,8}$/';
        } else {
            $rules['phone'] = 'required|regex:/^1[3-5,7,8]{1}[0-9]{9}$/';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'              => '名称不能为空',
            'build_number.required'      => '楼号不能为空',
            'home_number.required'       => '宿舍号不能为空',
            'phone.required'             => '联系方式不能为空',
            'phone.regex'                => '联系方式填写有误',
            'category_ids.required'      => '分类不能为空',
            'category_ids.array'         => '分类必须是数组',
        ];
    }
}
