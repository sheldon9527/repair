@extends('admin.common.layout')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">维修列表</h3>
        </div>
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
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" >
                        <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">
                                    <input name="" type="checkbox" value="" style="margin-top:20px;">
                                </th>
                                <th class="sorting" tabindex="0"  rowspan="1" colspan="1">
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
                                            <label><h4>楼号</h4></label>
                                              <select name="build_number" id="status" class="form-control">
                                                  <option value="">全部</option>
                                                  <option value=1 @if($searchColumns['build_number'] == 1) selected = "selected" @endif>一号楼</option>
                                                  <option value=2 @if($searchColumns['build_number'] == 2) selected = "selected" @endif>二号楼</option>
                                                   <option value=3 @if($searchColumns['build_number'] == 3) selected = "selected" @endif>三号楼</option>
                                                   <option value=4 @if($searchColumns['build_number'] == 4) selected = "selected" @endif>四号楼</option>
                                                   <option value=5 @if($searchColumns['build_number'] == 5) selected = "selected" @endif>五号楼</option>
                                                    <option value=6 @if($searchColumns['build_number'] == 6) selected = "selected" @endif>六号楼</option>
                                                    <option value=7 @if($searchColumns['build_number'] == 7) selected = "selected" @endif>七号楼</option>
                                                    <option value=8 @if($searchColumns['build_number'] == 8) selected = "selected" @endif>八号楼</option>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                              <label><h4>维修类型</h4></label>
                                              <select name="status" id="status" class="form-control">
                                                  <option value="">全部</option>
                                                  <option value="PEND" @if($searchColumns['status'] =='PEND') selected = "selected" @endif>未维修</option>
                                                  <option value="PENDING" @if($searchColumns['status'] =='PENDING') selected = "selected" @endif>维修中</option>
                                                   <option value="FINISH" @if($searchColumns['status'] =='FINISH') selected = "selected" @endif>维修完</option>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                               <label><h4>宿舍号</h4></label>
                                              <input type="number"  class="form-control" name="home_number" placeholder="例如:336" value="{{$searchColumns['home_number']}}">
                                          </div>

                                          <div>
                                              <div class="form-group">
                                                 <label><h4>用户姓名</h4></label>
                                                <input type="text"  class="form-control" name="name" placeholder="例如:Sheldon Yi" value="{{$searchColumns['name']}}">
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
                                                    <h4 class="box-title">名字:{{$repair->name}}</h4>
                                                </div>
                                                <div style="margin-top:15px;">
                                                    <h4 class="box-title">联系方式:{{$repair->phone}}</h4>
                                                </div>
                                                <div style="margin-top:15px;">
                                                    <h4 class="box-title">楼号:{{$repair->build_number}}</h4>
                                                </div>
                                                <div style="margin-top:15px;">
                                                    <h4 class="box-title">宿舍号:{{$repair->home_number}}</h4>
                                                </div>
                                                <div style="margin-top:15px;">
                                                    <h4 class="box-title">创建时间:{{$repair->created_at}}</h4>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-3">
                                                <div style="margin-top:15px;">
                                                    <h4 class="box-title">报修类别:</h4>
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
                                                    @if($repair->status == 'FINISH')
                                                        <span class="badge bg-green">状态:维修完</span>
                                                    @endif
                                                    @if($repair->status == 'PENDING')
                                                        <span class="badge bg-red">状态:维修中</span>
                                                    @endif
                                                    @if($repair->status == 'PEND')
                                                        <span class="badge bg-yellow">状态:未维修</span>
                                                    @endif
                                                </div>
                                                <div style="margin-top:10px;">
                                                    @if($repair->status == 'PEND')
                                                        <a href="{{route('admin.repairs.status.update',$repair->id)}}?status=PENDING"  class="badge bg-aqua">去维修</a>
                                                    @endif
                                                    @if($repair->status == 'PENDING')
                                                    <a href="{{route('admin.repairs.status.update',$repair->id)}}?status=FINISH"  class="badge bg-aqua">完成</a>
                                                    @endif
                                                    @if($repair->status == 'FINISH')
                                                        <span class="badge">已完成</span>
                                                    @endif
                                                 </div>
                                                 <div style="margin-top:10px;">
                                                    <a href="{{route('admin.repairs.show',$repair->id)}}" class="badge bg-aqua" id='link'>详情</a>
                                                 </div>
                                                 <div style="margin-top:10px;">
                                                    <a href="{{route('admin.repairs.destory',$repair->id)}}" data-method='delete' data-confirm="你确定要删除吗？"  class="badge bg-aqua" id='link'>删除</a>
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
