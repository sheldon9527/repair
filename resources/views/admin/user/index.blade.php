@extends('admin.common.layout') @section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">报修人列表</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle btn-search">筛选 <span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right dropdown-search" role="menu">
                                <form class="form-horizontal" role="form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="姓名" name="name" value="">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="infos" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr role="row">
                                    <td>ID</td>
									<td>头像</td>
                                    <td>名字</td>
                                    <td>邮箱</td>
                                    <td>昵称</td>

									<td>创建时间</td>
                                    <td>登陆IP</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr role="row">
                                    <td><a>{{$user->id}}</a></td>
									<td><img src="{{$user->avatar}}" style="width:50px;height:50px;"></td>
                                    <td>{{$user->name}}</td>
									<td>{{$user->email}}</td>
                                    <td>{{$user->nickname}}</td>

									<td>{{$user->created_at}}</td>
									<td>{{$user->login_ip}}</td>
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
                            {!! $users->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
