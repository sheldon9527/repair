<?php
namespace App\Presenters;

class RepairPresenter
{
    public function repairOperate($repair)
    {
        $content =[];
        if ($repair->status == 'PEND') {
            $content['name'] = '去维修';
            $content['status']  = 'PENDING';
        } elseif ($repair->status == 'PENDING') {
            $content['name'] = '完成';
            $content['status']  = 'FINISH';
        }

        return $content;
    }

    public function repairStatus($repair)
    {
        if ($repair->status == 'FINISH') {
            $content = '<span class="badge bg-green">状态:维修完</span>';
        } elseif ($repair->status == 'PENDING') {
            $content = '<span class="badge bg-red">状态:维修中</span>';
        } elseif ($repair->status == 'PEND') {
            $content = '<span class="badge bg-yellow">状态:未维修</span>';
        } else {
            $content = '';
        }

        return $content;
    }
}
