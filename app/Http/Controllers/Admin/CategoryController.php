<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Repositories\Eloquents\AttachmentEloquentRepository;
use App\Repositories\Eloquents\CategoryEloquentRepository;

class CategoryController extends BaseController
{
    /**
     * [index 报修种类列表]
     * @param  CategoryEloquentRepository $categoryRepository [description]
     * @return [type]                                         [description]
     */
    public function index(CategoryEloquentRepository $categoryRepository)
    {
        $roots = $categoryRepository->where('parent_id', 0)->findAll();

        return view('admin.categories.index', compact('roots'));
    }
    /**
     * [store 添加报修种类]
     * @param  StoreRequest               $request            [description]
     * @param  CategoryEloquentRepository $categoryRepository [description]
     * @return [type]                                         [description]
     */
    public function store(StoreRequest $request, CategoryEloquentRepository $categoryRepository)
    {
        $createdEntity = $categoryRepository->create([
            'name'          => $request->get('name'),
            'en_name'       => $request->get('en_name')
        ]);
        list($status, $category) = $createdEntity;
        if ($parentId = $request->get('parent_id')) {
            $parent = $categoryRepository->find($parentId);
            $category->makeChildOf($parent);
        }
        if ($iconUrl = $request->file('icon_url')) {
            $category->icon_url = $this->dealImage($iconUrl);
            $category->save();
        }

        return redirect(route('admin.categories.index'));
    }
    /**
     * [update 报修种类编辑]
     * @param  [type]                     $id                 [description]
     * @param  CategoryEloquentRepository $categoryRepository [description]
     * @return [type]                                         [description]
     */
    public function update($id, CategoryEloquentRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);
        if (!$category) {
            abort(404);
        }
        if ($operate = $request->get('operate')) {
            if ($operate == 'up') {
                $category->moveLeft();
            } else {
                $category->moveRight();
            }
        }

        if ($request->ajax()) {
            return response()->json(['success' => 1]);
        }

        $params = $request->only('name', 'en_name');
        if ($params) {
            $category->fill($params);
            if ($iconUrl = $request->file('icon_url')) {
                $category->icon_url = $this->dealImage($iconUrl);
            }

            $category->save();
        }

        return redirect(route('admin.categories.index'));
    }
    /**
     * [dealImage 图片]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    private function dealImage($file)
    {
        $extension  = $file->getClientOriginalExtension();
        $fileName   = mt_rand() . uniqid() . '.' . $extension;
        $pathAvatar = (string) $file->move('assets/categories/' . date('y/m'), $fileName);

        return $pathAvatar;
    }
    /**
     * [destroy 报修种类删除]
     * @param  [type]                     $id                 [description]
     * @param  CategoryEloquentRepository $categoryRepository [description]
     * @return [type]                                         [description]
     */
    public function destroy($id, CategoryEloquentRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);
        if (!$category) {
            abort(404);
        }
        $category->delete();

        return redirect(route('admin.categories.index'));
    }
}
