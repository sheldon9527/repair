<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdatePermissionRequest;
use App\Repositories\Eloquents\RoleEloquentRepository;
use App\Repositories\Eloquents\PermissionEloquentRepository;

class RoleController extends BaseController
{
    /**
     * [index 角色列表]
     * @param  RoleEloquentRepository $roleRepository [description]
     * @return [type]                                 [description]
     */
    public function index(RoleEloquentRepository $roleRepository)
    {
        $roles = $roleRepository->findAll();

        return view('admin.company.role.index', compact('roles'));
    }
    /**
     * [store 保存角色]
     * @param  StoreRequest           $request        [description]
     * @param  RoleEloquentRepository $roleRepository [description]
     * @return [type]                                 [description]
     */
    public function store(StoreRequest $request, RoleEloquentRepository $roleRepository)
    {
        $createdEntity = $roleRepository->create([
            'name'          => $request->get('name'),
            'display_name'  => $request->get('name'),
            'description'   => $request->get('description')
        ]);

        return redirect(route('admin.roles.index'));
    }
    /**
     * [destroy 删除角色]
     * @param  [type]                 $id             [description]
     * @param  RoleEloquentRepository $roleRepository [description]
     * @return [type]                                 [description]
     */
    public function destroy($id, RoleEloquentRepository $roleRepository)
    {
        $role = $roleRepository->find($id);
        if (!$role) {
            abort(404);
        }
        $role->delete();

        return redirect(route('admin.roles.index'));
    }
    /**
     * [permissionEdit 编辑权限]
     * @param  [type]                       $id                   [description]
     * @param  RoleEloquentRepository       $roleRepository       [description]
     * @param  PermissionEloquentRepository $permissionRepository [description]
     * @return [type]                                             [description]
     */
    public function permissionEdit($id, RoleEloquentRepository $roleRepository, PermissionEloquentRepository $permissionRepository)
    {
        $role = $roleRepository->find($id);
        if (!$role) {
            abort(404);
        }
        $permissions = $permissionRepository->findAll();

        return view('admin.company.role.permissionIndex', compact('permissions', 'role'));
    }
    /**
     * [permissionUpdate 更新权限]
     * @param  [type]                 $id             [description]
     * @param  RoleEloquentRepository $roleRepository [description]
     * @return [type]                                 [description]
     */
    public function permissionUpdate($id, UpdatePermissionRequest $request, RoleEloquentRepository $roleRepository)
    {
        $role = $roleRepository->find($id);
        if (!$role) {
            abort(404);
        }
        $permissionIds = $request->get('permission_ids');
        $role->perms()->detach();
        $role->attachPermissions($permissionIds);

        return redirect(route('admin.roles.index'));
    }
}
