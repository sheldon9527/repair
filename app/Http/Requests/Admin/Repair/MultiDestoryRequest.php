<?php
namespace App\Http\Requests\Admin\Repair;

use App\Http\Requests\Admin\Request;

class MultiDestoryRequest extends Request
{
    public function rules()
    {
        return [
            'repairIds'        => 'required|string',
            'type'             => 'required|string|in:delete',
        ];
    }
}
