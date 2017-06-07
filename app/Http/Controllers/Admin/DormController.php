<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Dorm\StoreRequest;
use App\Http\Requests\Admin\Dorm\UpdateRequest;
use App\Repositories\Eloquents\AttachmentEloquentRepository;
use App\Repositories\Eloquents\DormEloquentRepository;

class DormController extends BaseController
{
    /**
     * [index 宿舍楼列表]
     * @param  DormEloquentRepository $dormRepository [description]
     * @return [type]                                 [description]
     */
    public function index(DormEloquentRepository $dormRepository)
    {
        $roots = $dormRepository->where('parent_id', 0)->findAll();

        return view('admin.dorms.index', compact('roots'));
    }
    /**
     * [store 增加宿舍楼]
     * @param  StoreRequest           $request        [description]
     * @param  DormEloquentRepository $dormRepository [description]
     * @return [type]                                 [description]
     */
    public function store(StoreRequest $request, DormEloquentRepository $dormRepository)
    {
        $createdEntity = $dormRepository->create([
            'name'          => $request->get('name'),
            'en_name'   => $request->get('en_name')
        ]);
        list($status, $category) = $createdEntity;
        if ($parentId = $request->get('parent_id')) {
            $parent = $dormRepository->find($parentId);
            $category->makeChildOf($parent);
        }
        if ($iconUrl = $request->file('icon_url')) {
            $category->icon_url = $this->dealImage($iconUrl);
            $category->save();
        }

        return redirect(route('admin.dorms.index'));
    }
    /**
     * [update 更新宿舍楼]
     * @param  [type]                 $id             [description]
     * @param  UpdateRequest          $request        [description]
     * @param  DormEloquentRepository $dormRepository [description]
     * @return [type]                                 [description]
     */
    public function update($id, UpdateRequest $request, DormEloquentRepository $dormRepository)
    {
        $category = $dormRepository->find($id);
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

        return redirect(route('admin.dorms.index'));
    }
    /**
     * [dealImage 图片]
     * @param  [type]                       $file                 [description]
     * @return [type]                                             [description]
     */
    private function dealImage($file)
    {
        $extension  = $file->getClientOriginalExtension();
        $fileName   = mt_rand() . uniqid() . '.' . $extension;
        $pathAvatar = (string) $file->move('assets/categories/' . date('y/m'), $fileName);

        return $pathAvatar;
    }
    /**
     * [destroy 宿舍楼删除]
     * @param  [type]                 $id             [description]
     * @param  DormEloquentRepository $dormRepository [description]
     * @return [type]                                 [description]
     */
    public function destroy($id, DormEloquentRepository $dormRepository)
    {
        $category = $dormRepository->find($id);
        if (!$category) {
            abort(404);
        }
        $category->delete();

        return redirect(route('admin.dorms.index'));
    }
}
