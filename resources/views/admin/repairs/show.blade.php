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
				@inject('repairPresenter','App\Presenters\RepairPresenter')
                <div class="box-body">
                    <table class="table table-hover table-striped">
                        <tbody>
							<tr>
								<td style="font-size:16px;"><strong>维修状态:</strong>
									{!! $repairPresenter->repairStatus($repair) !!}
								</td>
							</tr>
	                        <tr>
	                            <td style="font-size:16px;"><strong>标题:</strong><B>{{$repair->name}}</B></td>
	                        </tr>
							<tr>
								<td style="font-size:16px;"><strong>创建时间:</strong>{{$repair->created_at}}</td>
							</tr>
	                        <tr>
	                            <td style="font-size:16px;font-family:verdana;line-height:30px;"><strong>具体介绍:</strong></br>
	                            {{$repair->description}}
								@if($repair->attachment)
									@foreach($repair->attachment as $image)
										<image style="width:100px;height:100px;" src="{{$image->relative_path}}"></image>
									@endforeach
								@endif
							</td>
	                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{route('admin.repairs.index')}}" >
                                    <button class="btn btn-info"  style="margin-right:60px;" type="submit">返回</button>
                                </a>
								<a href="{{route('admin.repairs.edit',$repair->id)}}" >
									<button class="btn btn-info"  style="margin-right:60px;" type="submit">编辑</button>
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
