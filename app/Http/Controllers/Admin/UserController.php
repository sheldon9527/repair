<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * [index 列表]
     */
    public function index(Request $request)
    {
        $users = User::query();
        $searchColumns = ['name' ];
        if ($name = $request->get('name')) {
            $users->where('name', 'like', '%'.$name.'%');
        }
        $users = $users->orderBy('id', 'desc')->paginate();

        return view('admin.user.index', compact('users'));
    }
}
