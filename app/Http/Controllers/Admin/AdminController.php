<?php
namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquents\AdminEloquentRepository;
use App\Repositories\Eloquents\RoleEloquentRepository;
use App\Http\Requests\Admin\Admin\StoreRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use App\Http\Requests\Admin\Admin\IndexRequest;

class AdminController extends BaseController
{
    /**
     * [index 管理员列表]
     * @param  IndexRequest            $request         [description]
     * @param  AdminEloquentRepository $adminRepository [description]
     * @param  RoleEloquentRepository  $roleRepository  [description]
     * @return [type]                                   [description]
     */
    public function index(IndexRequest $request, AdminEloquentRepository $adminRepository, RoleEloquentRepository $roleRepository)
    {
        $adminRepositories = $adminRepository;
        $searchColumns = ['name', 'cellphone', 'status'];
        if ($name = $request->get('name')) {
            $adminRepositories->where('first_name', 'like', '%'.$name.'%')
                ->orWhere('last_name', 'like', '%'.$name.'%');
        }
        if ($cellphone = $request->get('cellphone')) {
            $adminRepositories->where('cellphone', 'LIKE', "%$cellphone%");
        }
        if ($status = $request->get('status')) {
            $adminRepositories->where('status', $status);
        }
        $admins = $adminRepositories->orderBy('id', 'desc')->paginate();
        $params = array_filter($request->all());
        $admins->appends($params);
        $roles = $roleRepository->findAll();

        return view('admin.company.index', compact('admins', 'searchColumns', 'roles'));
    }
    /**
     * [store 创建管理员]
     * @param  StoreRequest            $request         [description]
     * @param  AdminEloquentRepository $adminRepository [description]
     * @return [type]                                   [description]
     */
    public function store(StoreRequest $request, AdminEloquentRepository $adminRepository)
    {
        if ($username = $request->get('username')) {
            $exist = $adminRepository->findBy('username', $username);
            if ($exist) {
                return redirect(route('admin.admins.index'))->withErrors(['登陆账号已经存在']);
            }
        }
        $createdEntity = $adminRepository->create([
            'username'  => $request->get('username'),
            'email'     => $request->get('email'),
            'cellphone' => $request->get('cellphone'),
            'password'  => bcrypt(trim($request->get('password'))),
            'status'    => $request->get('status'),
        ]);
        list($status, $admin) = $createdEntity;
        if ($roles = $request->get('roles')) {
            $admin->attachRoles($roles);
        }

        return redirect(route('admin.admins.index'));
    }
    /**
     * [edit 编辑管理员]
     * @param  [type]                  $id              [description]
     * @param  AdminEloquentRepository $adminRepository [description]
     * @param  RoleEloquentRepository  $roleRepository  [description]
     * @return [type]                                   [description]
     */
    public function edit($id, AdminEloquentRepository $adminRepository, RoleEloquentRepository $roleRepository)
    {
        $admin = $adminRepository->find($id);
        if (!$admin) {
            abort(404);
        }
        $roles = $roleRepository->findAll();

        return view('admin.company.edit', compact('admin', 'roles'));
    }
    /**
     * [update 更新管理员]
     * @param  [type]                  $id              [description]
     * @param  UpdateRequest           $request         [description]
     * @param  AdminEloquentRepository $adminRepository [description]
     * @return [type]                                   [description]
     */
    public function update($id, UpdateRequest $request, AdminEloquentRepository $adminRepository)
    {
        $admin = $adminRepository->find($id);
        if (!$admin) {
            abort(404);
        }
        if ($username = $request->get('username')  && $admin->isDirty('username')) {
            $exist = $adminRepository->findBy('username', $username);
            if ($exist) {
                return redirect(route('admin.admins.edit', $id))->withErrors(['登陆账号已经存在']);
            }
        }
        $admin->username = $request->get('username');
        $admin->email = $request->get('email');
        $admin->cellphone = $request->get('cellphone');
        if ($password = $request->get('password')) {
            $admin->password = bcrypt(trim($request->get('password')));
        }
        if ($roles = $request->get('roles')) {
            $admin->roles()->detach();
            $admin->attachRoles($roles);
        }
        $admin->status = $request->get('status');
        $admin->save();

        return redirect(route('admin.admins.show', $id));
    }
    /**
     * [show 管理员详情]
     * @param  [type]                  $id              [description]
     * @param  AdminEloquentRepository $adminRepository [description]
     * @return [type]                                   [description]
     */
    public function show($id, AdminEloquentRepository $adminRepository)
    {
        $admin = $adminRepository->find($id);
        if (!$admin) {
            abort(404);
        }

        return view('admin.company.show', compact('admin'));
    }
    /**
     * [destroy 删除管理员]
     * @param  [type]                  $id              [description]
     * @param  AdminEloquentRepository $adminRepository [description]
     * @return [type]                                   [description]
     */
    public function destroy($id, AdminEloquentRepository $adminRepository)
    {
        $admin = $adminRepository->find($id);
        if (!$admin) {
            abort(404);
        }
        if ($admin->isSuper) {
            abort(403);
        }
        $admin->delete();

        return redirect(route('admin.admins.index'));
    }
}
