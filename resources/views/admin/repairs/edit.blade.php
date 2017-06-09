@extends('admin.common.layout')

@section('content')
<div class="nav-tabs-custom">
    <div class="tab-content">
        <div class="nav-tabs-custom">
        <div class="row">
            <form method="post" action="{{route('admin.repairs.update',$repair->id)}}" id="form" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
				@inject('repairPresenter','App\Presenters\RepairPresenter')
                @include('admin.common.errors')
                <input type="hidden" name="_method" value="PUT" />
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2"><span class="text-red">*</span>联系姓名</label>
                        <div class="col-md-6">
                            <input type="text" value="{{$repair->name}}" class="form-control" readonly>
                        </div>
                    </div>
					<div class="form-group">
						<label class="col-md-2"><span class="text-red">*</span>联系方式</label>
						<div class="col-md-6">
							<input type="text" value="{{$repair->phone}}" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2"><span class="text-red">*</span>报修状态</label>
						<div class="col-sm-3">
							<select name="status" class="selectpicker" multiple>
								{!! $repairPresenter->repairSelectStatus($repair) !!}
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2"><span class="text-red">*</span>宿舍楼号</label>
						<div class="col-md-8">
							@include('admin.common.dorms')
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2"><span class="text-red">*</span>宿舍房号</label>
						<div class="col-md-6">
							<input type="number" name="home_number" value="{{$repair->home_number}}" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2"><span class="text-red">*</span>报修种类</label>
						<div class="col-md-8">
							@include('admin.common.category')
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-md-2"><span class="text-red">*</span>报修详情</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="5" placeholder="描述详情便于报修。。。。。。" style='font-size:16px' required>{{$repair->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <a href="">
                            <button class="btn btn-primary" type="submit">保存</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
<script>
    require(['jquery'], function($) {
    });
</script>
@endsection
