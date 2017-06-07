<?php
namespace App\Http\Requests\Admin\Dorm;

use App\Http\Requests\Admin\Request;

class UpdateRequest extends Request
{
    public function rules()
    {
        return [
            'parent_id' => 'integer|exists:dorms,id',
            'name'      => 'string',
            'icon_url'  => 'image',
            'en_name'   => 'string',
            'operate'   => 'string|in:up',
        ];
    }
}
