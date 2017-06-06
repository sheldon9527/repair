<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Admin\Role\StoreRequest;

class RoleController extends BaseController
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.company.role.index', compact('roles'));
    }

    public function store(StoreRequest $request)
    {
        $role = new Role();
        $role->name = $role->display_name =  $request->get('name');
        $role->description = $request->get('description');
        $role->save();

        return redirect(route('admin.roles.index'));
    }

    public function udpate()
    {
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }

        $role->delete();

        return redirect(route('admin.roles.index'));
    }

    public function permissionEdit($id)
    {
        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }

        $permissions = Permission::all();

        return view('admin.company.role.permissionIndex', compact('permissions', 'role'));
    }

    public function permissionUpdate($id)
    {
        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }

        $permissionIds = $this->request->get('permission_ids');
        $role->perms()->detach();
        $role->attachPermissions($permissionIds);

        return redirect(route('admin.roles.index'));
    }
}
