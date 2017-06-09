<?php
namespace App\Http\Requests\Admin\Repair;

use App\Http\Requests\Admin\Request;

class UpdateRequest extends Request
{
    public function rules()
    {
        return [
            'home_number' => 'required|string',
            'description' => 'required|string',
            'status'      => 'required|string|in:PEND,PENDING,ACTIVE,INACTIVE,FINISH',
        ];
    }
}
