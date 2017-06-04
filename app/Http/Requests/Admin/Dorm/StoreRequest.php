<?php
namespace App\Http\Requests\Admin\Dorm;

use App\Http\Requests\Admin\Request;

class StoreRequest extends Request
{
    public function rules()
    {
        return [
            'parent_id' => 'integer|exists:dorms,id',
            'name'      => 'required|string',
            'icon_url'  => 'image',
        ];
    }
}
