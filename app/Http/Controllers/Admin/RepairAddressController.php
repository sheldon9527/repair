<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Repair;
use Geohash\Geohash;

class RepairAddressController extends BaseController
{
    /**
     * [index 列表]
     * @return [type] [description]
     */
    public function index()
    {
        $repairs     = Repair::query();
        if ($home_number = $this->request->get('home_number')) {
            $repairs->where('home_number', $home_number);
        }
        if ($type = $this->request->get('build_number')) {
            $repairs->where('build_number', $type);
        }
        if ($status = $this->request->get('status')) {
            $repairs->where('status', $status);
        }
        if ($startTime = $this->request->get('start_time')) {
            $repairs->where('created_at', '>=', $startTime);
        }
        if ($endTimte = $this->request->get('end_time')) {
            $repairs->where('created_at', '<=', $endTimte);
        }
        $repairs     = $repairs->orderBy('id', 'desc')->paginate(10);
        $searchColumns = [
            'home_number'   => $home_number,
            'build_number'  => $type,
            'status'        => $status,
            'startTime'     => $startTime,
            'endTimte'      => $endTimte,
        ];
        return view('admin.repairs.index', compact('repairs', 'searchColumns'));
    }
    /**
     * [show 目的地详情]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $repair = Repair::withTrashed()->find($id);
        if (!$repair) {
            abort(404);
        }

        return view('admin.repairs.show', compact('repair'));
    }
    /**
     * [destory 删除]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destory($id)
    {
        $repair = Repair::withTrashed()->find($id);
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
    public function multiDestory()
    {
        $repairIds = $this->request->get('repairIds');
        $type      = $this->request->get('type');
        if (!$repairIds) {
            abort(404);
        }
        $repairIdsArray = explode(',', $repairIds);
        if (empty($repairIdsArray)) {
            abort(404);
        }

        foreach ($repairIdsArray as $repairId) {
            $repair = Repair::withTrashed()->find($repairId);
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
        ;
    }
    /**
     * [multiUpdate 批量审批]
     * @return [type] [description]
     */
    public function multiUpdate()
    {
        $repairIds = $this->request->get('repairIds');
        $type            = $this->request->get('type');
        if (!$repairIds) {
            abort(404);
        }
        $repairIdsArray = explode(',', $repairIds);
        if (empty($repairIdsArray)) {
            abort(404);
        }
        foreach ($repairIdsArray as $repairId) {
            $repair = Repair::find($repairId);
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
        ;
    }
    /**
     * [statusUpdate 修改状态]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function statusUpdate($id)
    {
        $status = $this->request->get('status');
        if (!$status) {
            abort(404);
        }
        if (!in_array($status, ['PEND','PENDING','ACTIVE','INACTIVE','FINISH'])) {
            abort(404);
        }
        $repair = Repair::withTrashed()->find($id);
        if (!$repair) {
            abort(404);
        }
        $repair->status = $status;
        $repair->save();

        return redirect(\URL::previous())->with('update', 'Update Success!');
    }
}
