<?php

namespace App\Http\Requests\Admin\Admin;

use App\Http\Requests\Admin\Request;

class IndexRequest extends Request
{
    public function rules()
    {
        return [
            'cellphone' => 'numeric',
            'name'      => 'string',
            'status'    => 'in:ACTIVE,INACTIVE',
        ];
    }

    public function messages()
    {
        return [
            'cellphone.numeric'  => '请填写正确格式的手机号!',
            'status.in'          => '请选择正确的类型!',
        ];
    }
}
