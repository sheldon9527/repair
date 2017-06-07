<?php
namespace App\Http\Requests\Admin\Repair;

use App\Http\Requests\Admin\Request;

class MultiUpdateRequest extends Request
{
    public function rules()
    {
        return [
            'repairIds'        => 'required|string',
            'type'             => 'required|string|in:approval,finish',
        ];
    }
}
