<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;

class PermissionController extends BaseController
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.company.permission.index', compact('permissions'));
    }
}
