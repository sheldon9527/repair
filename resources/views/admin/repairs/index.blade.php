@extends('admin.common.layout')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">维修列表</h3>
        </div>
		@inject('repairPresenter','App\Presenters\RepairPresenter')
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
					@if (session('delete'))
						<?php
                        echo "<script>alert('Delete Success!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
                        ?>
                    @endif
                    @if (session('update'))
                        <?php
                        echo "<script>alert('Update Success!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
                        ?>
                    @endif
                    <div class="col-md-12">
                        <div class="box box-info box-min-height">
                            <form class="form-inline" action="{{route('admin.repairs.index')}}" method="get">
                              <div class="box-body">
                                  <div class="form-group">
                                     <a class="btn btn-info" id='link'>删除选中</a>
                                  </div>
                                  <div class="form-group">
                                     <a class="btn btn-info" id='approval'>修理选中</a>
                                  </div>
                                  <div class="form-group">
                                     <a class="btn btn-info" id='finish'>完成选中</a>
                                 </div>
                                  <div class="form-group">
                                    <label><h4>宿舍楼号</h4></label>
                                      <select name="dorm_id" id="status" class="form-control">
                                          <option value="">全部</option>
                                          @foreach($rootDroms as $root)
                                              <option disabled="disabled">{{$root->name}} </option>
                                              @foreach($root->children as $children)
                                              <option value="{{$children->id}}" @if($searchColumns['dorm_id'] == $children->id) selected = "selected" @endif>&nbsp;&nbsp;&nbsp;&nbsp;--|{{$children->name}}
                                              </option>
                                              @endforeach
                                          @endforeach
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label><h4>报修种类</h4></label>
                                      <select name="status" id="status" class="form-control">
                                          <option value="">全部</option>
                                          <option value="PEND" @if($searchColumns['status'] =='PEND') selected = "selected" @endif>未维修</option>
                                          <option value="PENDING" @if($searchColumns['status'] =='PENDING') selected = "selected" @endif>维修中</option>
                                           <option value="FINISH" @if($searchColumns['status'] =='FINISH') selected = "selected" @endif>维修完</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                       <label><h4>宿舍房号</h4></label>
                                      <input type="number"  class="form-control" name="home_number" placeholder="336" value="{{$searchColumns['home_number']}}">
                                  </div></br></br>
                                  <div>
                                      <div class="form-group">
                                         <label><h4>联系姓名</h4></label>
                                        <input type="text"  class="form-control" name="name" placeholder="SheldonYi" value="{{$searchColumns['name']}}">
                                        </div>
                                      <div class="form-group">
                                          <label>开始时间</label>
                                              <input  type="text" name="start_time" value="{{$searchColumns['startTime']}}" class="form_datatime form-control form-control" placeholder="开始时间">
                                      </div>
                                      <div class="form-group">
                                          <label>结束时间</label>
                                              <input  type="text" name="end_time" value="{{$searchColumns['endTimte']}}" class="form_datatime form-control form-control" placeholder="结束时间">
                                      </div>
                                      <div class="form-group" >
                                         <button class="btn btn-info"><i class="fa fa-search"></i></button>
                                     </div>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="box">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" >
                            <thead>
                                <tr role="row">
                                    <th class="sorting" style="text-align:center;width:6%" tabindex="0"  rowspan="1" colspan="1">
                                        <input name="" type="checkbox">
                                    </th>
                                    <th class="sorting" style="text-align:center; font-size:20px" tabindex="0"  rowspan="1" colspan="1">
                                        报修相关信息
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($repairs as $key => $repair)
                                    <tr @if($key%2 == 0) style="background:#F0F8FF;" @endif role="row">
                                        <td class="" align="center" valign="middle"><input style="margin-top:60px;" name="input" type="checkbox" value="{{$repair->id}}"></td>
                                        <td class="">
                                            <div class="row">
                                                <div class="col-xs-6 col-md-3">
                                                    <div style="margin-top:15px;">
                                                        <h4 class="box-title">联系姓名:{{$repair->name}}</h4>
                                                    </div>
                                                    <div style="margin-top:15px;">
                                                        <h4 class="box-title">联系方式:{{$repair->phone}}</h4>
                                                    </div>
                                                    <div style="margin-top:15px;">
                                                        <h4 class="box-title">宿舍楼号:{{$repair->dorm->parent->name}}[{{$repair->dorm->name}}]</h4>
                                                    </div>
                                                    <div style="margin-top:15px;">
                                                        <h4 class="box-title">宿舍房号:{{$repair->home_number}}</h4>
                                                    </div>
                                                    <div style="margin-top:15px;">
                                                        <h4 class="box-title">创建时间:{{$repair->created_at}}</h4>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-md-3">
                                                    <div style="margin-top:15px;">
                                                        <h4 class="box-title">报修种类:</h4>
                                                        @if($repair->categories)
                                                            @foreach($repair->categories as $keyCa => $category)
                                                                @if($keyCa%2 == 0 && $keyCa !=0) </br> @endif
                                                                <div class="col-xs-6 col-md-6">
                                                                {{$category->parent->name}}
                                                                <button class="btn btn-default btn-xs">{{$category->name}}</button>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-md-4">
                                                    <div style="margin-top:15px;">
                                                        <h4 class="box-title">报修详情:</h4>{{$repair->description}}
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-md-2">
                                                    <div style="margin-top:10px;">
                                                        {!! $repairPresenter->repairStatus($repair) !!}
                                                    </div>
                                                    <div style="margin-top:10px;">
                                                        @if($repair->status == 'FINISH')
                                                           <span class="badge">已完成</span>
                                                        @else
                                                            <a href="{{route('admin.repairs.status.update',$repair->id)}}?status={{$repairPresenter->repairOperate($repair)['status']}}"  class="badge bg-aqua">{{$repairPresenter->repairOperate($repair)['name']}}
                                                            </a>
                                                        @endif
                                                     </div>
                                                     <div style="margin-top:10px;">
                                                        <a href="{{route('admin.repairs.edit',$repair->id)}}" class="badge bg-yellow" id='link'>编辑</a>
                                                     </div>
                                                     <div style="margin-top:10px;">
                                                        <a href="{{route('admin.repairs.show',$repair->id)}}" class="badge bg-aqua" id='link'>详情</a>
                                                     </div>
                                                     <div style="margin-top:10px;">
                                                        <a href="{{route('admin.repairs.destory',$repair->id)}}" data-method='delete' data-confirm="你确定要删除吗？"  class="badge bg-red" id='link'>删除</a>
                                                     </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                {!! $repairs->render() !!}
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script src="/js/form.js" type="text/javascript"></script>
    <script src="/js/checkbox.js" type="text/javascript"></script>
    <script type="text/javascript">
    require(['jquery','datepicker'], function($,datepicker) {
    $("#link").on('click',function(){
        ids = getCheckboxValue();
        if (ids == "") {
            alert("请先选择一条数据！");
        }else{
            alert('你确定删除？');
            data = [
                {
                    'name':'repairIds',
                    'value':ids,
                },
                {
                    'name':'type',
                    'value':'delete',
                },
            ];
            buildForm('get','<?php echo route('admin.repairs.multiDestory') ?>',data);
        }
    });

    $("#approval").on('click',function(){
        ids = getCheckboxValue();
        if (ids == "") {
            alert("请先选择一条数据！");
        }else{
            alert('你确定更新？');
            data = [
                {
                    'name':'repairIds',
                    'value':ids,
                },
                {
                    'name':'type',
                    'value':'approval',
                },
            ];
            buildForm('get','<?php echo route('admin.repairs.multiUpdate') ?>',data);
        }
    });
    $("#finish").on('click',function(){
        ids = getCheckboxValue();
        if (ids == "") {
            alert("请先选择一条数据！");
        }else{
            alert('你确定更新？');
            data = [
                {
                    'name':'repairIds',
                    'value':ids,
                },
                {
                    'name':'type',
                    'value':'finish',
                },
            ];
            buildForm('get','<?php echo route('admin.repairs.multiUpdate') ?>',data);
        }
    });

    $('input.form_datatime').datepicker({
        title: true,
        todayBtn: 'linked',
        todayHighlight: 'true',
        autoclose: true,
        format: "yyyy-mm-dd"
    });
});
    </script>
@endsection
