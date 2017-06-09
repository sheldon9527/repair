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
            $content['name'] = '去完成';
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

    public function repairSelectStatus($repair)
    {
        $content = '';
        switch ($repair->status) {
            case 'FINISH':
                $content .='<option value="PENDING" >未维修</option>';
                $content .='<option value="FINISH" selected="selected">维修完</option>';
                $content .='<option value="PEND">维修中</option>';
                break;
            case 'PENDING':
                $content .='<option value="PENDING" selected="selected">维修中</option>';
                $content .='<option value="FINISH">维修完</option>';
                $content .='<option value="PEND">未维修</option>';
                break;
            case 'PEND':
                $content .='<option value="PENDING">维修中</option>';
                $content .='<option value="FINISH">维修完</option>';
                $content .='<option value="PEND" selected="selected">未维修</option>';
                break;
        }

        return $content;
    }
}
