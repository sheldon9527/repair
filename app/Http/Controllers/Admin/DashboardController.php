<?php

namespace App\Http\Controllers\Admin;

use App\Models\Repair;
use Carbon\Carbon;

class DashboardController extends BaseController
{
    public function dashboard()
    {

        for ($i = 7; $i > 0; --$i) {
            $startDay = Carbon::today()->subDays($i);
            $endDay   = Carbon::today()
                ->subDays($i)
                ->endOfDay();

            $addressCount = Repair::where('created_at', '>', $startDay)
                ->where('created_at', '<', $endDay)
                ->count();

            $addressData[] = [
                'y'     => (string) $startDay,
                'value' => $addressCount,
            ];
        }

        // 小B用户统计
        $allCount                               = Repair::count();
        $statisticData['addresses']['dayCount'] = json_encode($addressData);
        $statisticData['addresses']['total']    = $allCount;

        for ($i = 7; $i > 0; --$i) {
            $startDay = Carbon::today()->subDays($i);
            $endDay   = Carbon::today()
                ->subDays($i)
                ->endOfDay();

            $noApprovalCount = Repair::where('created_at', '>', $startDay)
                ->where('created_at', '<', $endDay)
                ->where('status', 'PEND')
                ->count();

            $noApprovalData[] = [
                'y'     => (string) $startDay,
                'value' => $noApprovalCount,
            ];
        }

        // 小B用户统计
        $noCount = Repair::where('status', 'PEND')->count();

        $statisticData['no_address']['dayCount'] = json_encode($noApprovalData);
        $statisticData['no_address']['total']    = $noCount;

        return view('admin.dashboard.dashboard', compact('statisticData'));
    }
}
