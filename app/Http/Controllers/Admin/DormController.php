<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Dorm\StoreRequest;
use App\Models\Attachment;
use App\Models\Dorm;

class DormController extends BaseController
{
    public function index()
    {
        $roots = Dorm::where('parent_id', 0)->get();

        return view('admin.dorms.index', compact('roots'));
    }

    public function store(StoreRequest $request)
    {
        $category = Dorm::create($request->only(['name', 'en_name']));

        // $category
        if ($parentId = $request->get('parent_id')) {
            $parent = Dorm::find($parentId);
            $category->makeChildOf($parent);
        }
        if ($iconUrl = $request->file('icon_url')) {
            $category->icon_url = $this->dealImage($iconUrl);
            $category->save();
        }

        return redirect(route('admin.dorms.index'));
    }

    public function update($id)
    {
        $category = Dorm::find($id);

        if (!$category) {
            abort(404);
        }

        if ($operate = $this->request->get('operate')) {
            if ($operate == 'up') {
                $category->moveLeft();
            } else {
                $category->moveRight();
            }
        }

        if ($this->request->ajax()) {
            return response()->json(['success' => 1]);
        }

        $params = $this->request->only('name', 'en_name');
        if ($params) {
            $category->fill($params);
            if ($iconUrl = $this->request->file('icon_url')) {
                $category->icon_url = $this->dealImage($iconUrl);
            }

            $category->save();
        }

        return redirect(route('admin.dorms.index'));
    }

    private function dealImage($file)
    {
        $extension  = $file->getClientOriginalExtension();
        $fileName   = mt_rand() . uniqid() . '.' . $extension;
        $pathAvatar = (string) $file->move('assets/categories/' . date('y/m'), $fileName);
        $pathAvatar = Attachment::syncFile($pathAvatar, 'image');

        return $pathAvatar;
    }

    public function destroy($id)
    {
        $category = Dorm::find($id);

        if (!$category) {
            abort(404);
        }

        $category->delete();

        return redirect(route('admin.dorms.index'));
    }
}
