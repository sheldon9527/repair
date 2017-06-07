<?php

namespace App\Http\Requests\Admin\Attachment;

use App\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;

class StoreRequest extends Request
{
    public function rules()
    {
        return [
            'type'              => 'string',
            'file'              => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.required'              => '请填写文件!',
        ];
    }
}
