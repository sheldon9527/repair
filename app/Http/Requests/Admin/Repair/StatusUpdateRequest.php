<?php
namespace App\Http\Requests\Admin\Repair;

use App\Http\Requests\Admin\Request;

class StatusUpdateRequest extends Request
{
    public function rules()
    {
        return [
            'status'             => 'required|string|in:PEND,PENDING,ACTIVE,INACTIVE,FINISH',
        ];
    }
}
