<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Auth\StoreRequest;

class AuthController extends BaseController
{
    /**
     * [getLogin 登录页面]
     * @return [type] [description]
     */
    public function getLogin()
    {
        if ($this->user()) {
            return redirect(route('admin.dashboard'));
        }

        return view('admin.auth.login');
    }
    /**
     * [postLogin 登录]
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function postLogin(StoreRequest $request)
    {
        $credentials  = $request->only('username', 'password');
        $adminService = app('admin');
        if (!$token = $adminService->attempt($credentials)) {
            $request->flashOnly('username');

            return redirect(route('admin.auth.login.get'))->withErrors(['用户名或密码错误']);
        }
        $redirect = session('url.intended') ?: route('admin.dashboard');

        return redirect($redirect);
    }
    /**
     * [logout 退出]
     * @return [type] [description]
     */
    public function logout()
    {
        app('admin')->logout();

        return redirect(route('admin.auth.login.get'));
    }
}
