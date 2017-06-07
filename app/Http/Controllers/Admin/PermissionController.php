<?php
namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquents\PermissionEloquentRepository;

class PermissionController extends BaseController
{
    /**
     * [index 权限列表]
     * @param  PermissionEloquentRepository $permisionPepository [description]
     * @return [type]                                            [description]
     */
    public function index(PermissionEloquentRepository $permisionPepository)
    {
        $permissions = $permisionPepository->findAll();

        return view('admin.company.permission.index', compact('permissions'));
    }
}
