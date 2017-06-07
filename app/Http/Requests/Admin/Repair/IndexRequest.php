<?php
namespace App\Http\Requests\Admin\Repair;

use App\Http\Requests\Admin\Request;

class IndexRequest extends Request
{
    public function rules()
    {
        return [
            'home_number'        => 'string',
            'description' => 'string',
        ];
    }
}
