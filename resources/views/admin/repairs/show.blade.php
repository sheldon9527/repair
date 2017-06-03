@extends('admin.common.layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <i class="fa fa-info"></i>
                    <h3 class="box-title">详细信息</h3>
                </div>
                <div class="box-body">
                    <table class="table table-hover table-striped">
                        <tbody>
							<tr>
								<td style="font-size:16px;"><strong>维修状态:</strong>
									@if($repair->status == 'PEND')
										<span class="badge bg-green">状态:未维修</span>
									@endif
									@if($repair->status == 'PENDING')
										<span class="badge bg-yellow">状态:维修中</span>
									@endif
									@if($repair->status == 'FINISH')
										<span class="badge bg-yellow">状态:维修完</span>
									@endif
								</td>
							</tr>
	                        <tr>
	                            <td style="font-size:16px;"><strong>姓名:</strong><B>{{$repair->name}}</B></td>
	                        </tr>
							<tr>
								<td style="font-size:16px;"><strong>联系方式:</strong><B>{{$repair->phone}}</B></td>
							</tr>
							<tr>
								<td style="font-size:16px;"><strong>楼号:</strong>{{$repair->build_number}}</td>
							</tr>
							<tr>
								<td style="font-size:16px;"><strong>宿舍号:</strong>{{$repair->home_number}}</td>
							</tr>
							<tr>
								<td style="font-size:16px;"><strong>创建时间:</strong>{{$repair->created_at}}</td>
							</tr>
							<tr>
								<td style="font-size:16px;"><strong>报修类别:</strong>
									@if($repair->categories)
										@foreach($repair->categories as $category)
											<div>
												{{$category->parent->name}}
													<button class="btn btn-default btn-xs">{{$category->name}}</button>
											</div>
										@endforeach
									@endif
								</td>
							</tr>
	                        <tr>
	                            <td style="font-size:16px;font-family:verdana;line-height:30px;"><strong>具体介绍:</strong></br>
	                            {{$repair->description}}</td>
	                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{route('admin.repairs.index')}}" >
                                    <button class="btn btn-info"  style="margin-right:60px;" type="submit">返回</button>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
</div>

@endsection
