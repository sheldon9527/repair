<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $user;

    public function user()
    {
        if (!$this->user) {
            $this->user = app('admin')->user();
        }

        return $this->user;
    }
}
