<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */
Route::pattern('id', '[0-9]+');
Route::pattern('oid', '[0-9]+');
Route::pattern('alpha', '[A-Za-z]+');
$api = app('api.router');
// Route::get('/', [
//     'as' => 'inquiry.get',
//     'uses' => 'Front\HomeController@home',
// ]);
// Route::post('/', [
//     'as' => 'inquiry.post',
//     'uses' => 'Front\HomeController@store',
// ]);
/*
 * 运营后台
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'manager'], function () {
    // 登录页面
    Route::get('auth/login', [
        'as' => 'admin.auth.login.get',
        'uses' => 'AuthController@getLogin',
    ]);
    // 登录提交
    Route::post('auth/login', [
        'as' => 'admin.auth.login.post',
        'uses' => 'AuthController@postLogin',
    ]);
    // 替代用户登陆
    Route::get('replacement/login/{id}', [
        'as' => 'admin.auth.replacement.login',
        'uses' => 'AuthController@replaceLogin',
    ]);
    Route::group(['middleware' => ['admin.auth']], function () {
        #登出
        Route::get('logout', [
            'as' => 'admin.auth.logout',
            'uses' => 'AuthController@logout',
        ]);
        Route::get('/', function () {
            return redirect(route('admin.dashboard'));
        });
        # Dashboard
        // 后台统计信息
        Route::get('dashboard', [
            'as' => 'admin.dashboard',
            'uses' => 'DashboardController@dashboard',
        ]);
        /**
         * 维修管理
         */
        Route::get('repairs', [
             'as' => 'admin.repairs.index',
             'uses' => 'RepairController@index',
         ]);
        Route::get('repairs/{id}', [
             'as' => 'admin.repairs.show',
             'uses' => 'RepairController@show',
         ]);
        Route::delete('repairs/{id}', [
             'as' => 'admin.repairs.destory',
             'uses' => 'RepairController@destory',
         ]);
        Route::get('repairs/{id}/edit', [
             'as' => 'admin.repairs.edit',
             'uses' => 'RepairController@edit',
         ]);
        Route::put('repairs/{id}', [
             'as' => 'admin.repairs.update',
             'uses' => 'RepairController@update',
         ]);
        Route::get('repairs/multiDestory', [
             'as' => 'admin.repairs.multiDestory',
             'uses' => 'RepairController@multiDestory',
         ]);
        Route::get('repairs/multiUpdate', [
             'as' => 'admin.repairs.multiUpdate',
             'uses' => 'RepairController@multiUpdate',
         ]);

        Route::get('repairs/{id}/status', [
          'as' => 'admin.repairs.status.update',
          'uses' => 'RepairController@statusUpdate',
        ]);

        /**
         * users
         */
        Route::get('users', [
            'as' => 'admin.users.index',
            'uses' => 'UserController@index',
        ]);

        /**
         * admins
         */
        Route::get('admins', [
            'as' => 'admin.admins.index',
            'uses' => 'AdminController@index',
        ]);
        Route::post('admins', [
            'as' => 'admin.admins.store',
            'uses' => 'AdminController@store',
        ]);
        Route::get('admins/{id}/edit', [
            'as' => 'admin.admins.edit',
            'uses' => 'AdminController@edit',
        ]);
        Route::put('admins/{id}', [
            'as' => 'admin.admins.update',
            'uses' => 'AdminController@update',
        ]);
        Route::get('admins/{id}', [
            'as' => 'admin.admins.show',
            'uses' => 'AdminController@show',
        ]);
        Route::delete('admins/{id}', [
            'as' => 'admin.admins.destroy',
            'uses' => 'AdminController@destroy',
        ]);
        Route::get('admins/roles', [
            'as' => 'admin.roles.index',
            'uses' => 'RoleController@index',
        ]);
        Route::get('admins/roles/{id}', [
            'as' => 'admin.roles.show',
            'uses' => 'RoleController@show',
        ]);
        Route::post('admins/roles', [
            'as' => 'admin.roles.store',
            'uses' => 'RoleController@store',
        ]);
        Route::delete('admins/roles/{id}', [
            'as' => 'admin.roles.destroy',
            'uses' => 'RoleController@destroy',
        ]);
        Route::delete('admins/roles/{id}', [
            'as' => 'admin.roles.destroy',
            'uses' => 'RoleController@destroy',
        ]);

        Route::get('admins/roles/{id}/permissions/edit', [
            'as' => 'admin.roles.permissions.edit',
            'uses' => 'RoleController@permissionEdit',
        ]);
        Route::put('admins/roles/{id}/permissions', [
            'as' => 'admin.roles.permissions.update',
            'uses' => 'RoleController@permissionUpdate',
        ]);

        Route::get('admins/permissions', [
            'as' => 'admin.permissions.index',
            'uses' => 'PermissionController@index',
        ]);
        /**
         * Attachment
         */
        Route::post('attachments/download', [
             'as' => 'admin.attachments.download',
             'uses' => 'AttachmentController@download',
        ]);
        Route::get('attachments', [
            'as' => 'admin.attachments.index',
            'uses' => 'AttachmentController@index',
        ]);
        Route::post('attachments', [
            'as' => 'admin.attachments.store',
            'uses' => 'AttachmentController@store',
        ]);
        Route::delete('attachments/{id}', [
            'as' => 'admin.attachments.destroy',
            'uses' => 'AttachmentController@destroy',
        ]);
        /**
         * categories
         */
        Route::get('categories', [
            'as' => 'admin.categories.index',
            'uses' => 'CategoryController@index',
        ]);
        Route::post('categories', [
            'as' => 'admin.categories.store',
            'uses' => 'CategoryController@store',
        ]);
        Route::put('categories/{id}', [
            'as' => 'admin.categories.update',
            'uses' => 'CategoryController@update',
        ]);
        Route::delete('categories/{id}', [
            'as' => 'admin.categories.destroy',
            'uses' => 'CategoryController@destroy',
        ]);

        /**
         * dorms
         */
        Route::get('dorms', [
            'as' => 'admin.dorms.index',
            'uses' => 'DormController@index',
        ]);
        Route::post('dorms', [
            'as' => 'admin.dorms.store',
            'uses' => 'DormController@store',
        ]);
        Route::put('dorms/{id}', [
            'as' => 'admin.dorms.update',
            'uses' => 'DormController@update',
        ]);
        Route::delete('dorms/{id}', [
            'as' => 'admin.dorms.destroy',
            'uses' => 'DormController@destroy',
        ]);
    });
});
