<?php
namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquents\RepairEloquentRepository;
use App\Repositories\Eloquents\DormEloquentRepository;
use App\Repositories\Eloquents\CategoryEloquentRepository;
use App\Http\Requests\Admin\Repair\IndexRequest;
use App\Http\Requests\Admin\Repair\MultiDestoryRequest;
use App\Http\Requests\Admin\Repair\MultiUpdateRequest;
use App\Http\Requests\Admin\Repair\StatusUpdateRequest;
use App\Http\Requests\Admin\Repair\UpdateRequest;

class RepairController extends BaseController
{
    /**
     * [index 列表]
     * @return [type] [description]
     */
    public function index(RepairEloquentRepository $repairRepository, DormEloquentRepository $dormRepository, IndexRequest $request)
    {
        $repairRepositories = $repairRepository;
        if ($home_number = $request->get('home_number')) {
            $repairRepositories->where('home_number', $home_number);
        }
        if ($dorm_id = $request->get('dorm_id')) {
            $repairRepositories->where('dorm_id', $dorm_id);
        }
        if ($status = $request->get('status')) {
            $repairRepositories->where('status', $status);
        }
        if ($name = $request->get('name')) {
            $repairRepositories->where('name', 'like', '%' . $name . '%');
        }
        if ($startTime = $request->get('start_time')) {
            $repairRepositories->where('created_at', '>=', $startTime);
        }
        if ($endTimte = $request->get('end_time')) {
            $repairRepositories->where('created_at', '<=', $endTimte);
        }
        $repairs     = $repairRepositories->orderBy('id', 'desc')->paginate(10);
        $searchColumns = [
            'home_number'   => $home_number,
            'dorm_id'       => $dorm_id,
            'status'        => $status,
            'startTime'     => $startTime,
            'endTimte'      => $endTimte,
            'name'          => $name,
        ];
        $rootDroms = $dormRepository->where('parent_id', 0)->with(['children'])->findAll();

        return view('admin.repairs.index', compact('repairs', 'searchColumns', 'rootDroms'));
    }
    /**
     * [show 详情]
     * @param  [type]                   $id               [description]
     * @param  RepairEloquentRepository $repairRepository [description]
     * @return [type]                                     [description]
     */
    public function show($id, RepairEloquentRepository $repairRepository)
    {
        $repair = $repairRepository->find($id);
        if (!$repair) {
            abort(404);
        }

        return view('admin.repairs.show', compact('repair'));
    }
    /**
     * [edit 编辑页面]
     * @param  [type]                     $id                 [description]
     * @param  RepairEloquentRepository   $repairRepository   [description]
     * @param  DormEloquentRepository     $dormRepository     [description]
     * @param  CategoryEloquentRepository $categoryRepository [description]
     * @return [type]                                         [description]
     */
    public function edit($id, RepairEloquentRepository $repairRepository, DormEloquentRepository $dormRepository, CategoryEloquentRepository $categoryRepository)
    {
        $repair = $repairRepository->find($id);
        if (!$repair) {
            abort(404);
        }
        $categories = $categoryRepository->where('parent_id', 0)->with(['children'])->findAll();
        $dorms = $dormRepository->where('parent_id', 0)->with(['children'])->findAll();
        $userDrom = [$repair->dorm->id];
        $ownerCategoryIds =  $repair->categories->lists('id')->all();
        // dd($userCategories);

        return view('admin.repairs.edit', compact('repair', 'categories', 'dorms', 'userDrom', 'ownerCategoryIds'));
    }
    public function update($id, UpdateRequest $request, RepairEloquentRepository $repairRepository)
    {
        $updatedEntity = $repairRepository->update($id, [
            'dorm_id'     => $request->get('dorm_id'),
            'home_number' => $request->get('home_number'),
            'status'      => $request->get('status'),
            'description' => $request->get('description'),
        ]);
        list($status, $repair) = $updatedEntity;
        $repair->categories()->detach();
        if ($categoryIds = $request->get('category_ids')) {
            $repair->categories()->attach($categoryIds);
        }

        return redirect(route('admin.repairs.show', $id));
    }
    /**
     * [destory 删除]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destory($id, RepairEloquentRepository $repairRepository)
    {
        $repair = $repairRepository->find($id);
        if (!$repair) {
            abort(404);
        }
        $repair->delete();

        return redirect(route('admin.repairs.index'))->with('delete', 'Delete Success!');
    }
    /**
     * [multiDestory 批量删除]
     * @return [type] [description]
     */
    public function multiDestory(RepairEloquentRepository $repairRepository, MultiDestoryRequest $request)
    {
        $repairIds = $request->get('repairIds');
        $type      = $request->get('type');
        $repairIdsArray = explode(',', $repairIds);
        foreach ($repairIdsArray as $repairId) {
            $repair = $repairRepository->find($repairId);
            if (!$repair) {
                continue;
            }
            switch ($type) {
                case 'delete':
                    $repair->delete();
                    break;
            }
        }

        return redirect(route('admin.repairs.index'))->with('delete', 'Delete Success!');
    }
    /**
     * [multiUpdate 批量审批]
     * @return [type] [description]
     */
    public function multiUpdate(RepairEloquentRepository $repairRepository, MultiUpdateRequest $request)
    {
        $repairIds = $request->get('repairIds');
        $type      = $request->get('type');
        $repairIdsArray = explode(',', $repairIds);
        foreach ($repairIdsArray as $repairId) {
            $repair = $repairRepository->find($repairId);
            if (!$repair) {
                continue;
            }
            switch ($type) {
                case 'approval':
                    $repair->status = 'PENDING';
                    break;
                case 'finish':
                    $repair->status = 'FINISH';
                    break;
            }
            $repair->save();
        }

        return redirect(route('admin.repairs.index'))->with('update', 'Update Success!');
    }
    /**
     * [statusUpdate 修改状态]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function statusUpdate($id, RepairEloquentRepository $repairRepository, StatusUpdateRequest $request)
    {
        $status = $request->get('status');
        $repair = $repairRepository->find($id);
        if (!$repair) {
            abort(404);
        }
        $repair->status = $status;
        $repair->save();

        return redirect(\URL::previous())->with('update', 'Update Success!');
    }
}
