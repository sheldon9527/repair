<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Repositories\Eloquents\RepairEloquentRepository;

class DashboardController extends BaseController
{
    public function dashboard(RepairEloquentRepository $repairRepository)
    {
        for ($i = 7; $i > 0; --$i) {
            $startDay = Carbon::today()->subDays($i);
            $endDay   = Carbon::today()
                ->subDays($i)
                ->endOfDay();
            $addressCount = $repairRepository->where('created_at', '>', $startDay)
                ->where('created_at', '<', $endDay)
                ->findAll()
                ->count();
            $addressData[] = [
                'y'     => (string) $startDay,
                'value' => $addressCount,
            ];
        }
        // 总的
        $allCount                               = $repairRepository->findAll()->count();
        $statisticData['addresses']['dayCount'] = json_encode($addressData);
        $statisticData['addresses']['total']    = $allCount;
        for ($i = 7; $i > 0; --$i) {
            $startDay = Carbon::today()->subDays($i);
            $endDay   = Carbon::today()
                ->subDays($i)
                ->endOfDay();
            $noApprovalCount = $repairRepository->where('created_at', '>', $startDay)
                ->where('created_at', '<', $endDay)
                ->where('status', 'PEND')
                ->findAll()
                ->count();
            $noApprovalData[] = [
                'y'     => (string) $startDay,
                'value' => $noApprovalCount,
            ];
        }

        //未维修
        $noCount = $repairRepository->where('status', 'PEND')->count();
        $statisticData['no_address']['dayCount'] = json_encode($noApprovalData);
        $statisticData['no_address']['total']    = $noCount;

        return view('admin.dashboard.dashboard', compact('statisticData'));
    }
}
