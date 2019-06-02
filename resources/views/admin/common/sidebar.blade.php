<aside class="main-sidebar">
    <div class="slimScrollDiv">
        <div class="sidebar" id="scrollspy">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{url('/images/admin-avatar.jpg')}}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="{{\Route::is('admin.dashboard') ? 'active' : ''}}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="fa fa-tachometer" aria-hidden="true"></i> <span>仪表盘</span>
                    </a>
                </li>
				@if ($admin->isSuper || $admin->can('users.manage'))
				<li class="treeview {{
						\Route::is('admin.users.*') ? 'active' : null
					}}">
					<a href="#">
						<i class="fa fa-users"></i> <span>报修人管理</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu menu-open">
						<li class="{{\Route::is('admin.users.*') ? 'active' : ''}}">
							<a href="{{route('admin.users.index')}}"><i class="fa fa-circle-o"></i>维修人列表</a>
						</li>
					</ul>
				</li>
				@endif
				@if ($admin->isSuper || $admin->can('repairs.manage'))
				<li class="treeview {{
						\Route::is('admin.repairs.*') ? 'active' : null
					}}">
					<a href="#">
						<i class="fa fa-th-list"></i> <span>维修管理</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu menu-open">
						<li class="{{\Route::is('admin.repairs.*') ? 'active' : ''}}">
							<a href="{{route('admin.repairs.index')}}"><i class="fa fa-circle-o"></i>维修列表</a>
						</li>
					</ul>
				</li>
				@endif
			   @if ($admin->isSuper || $admin->can('admins.manage'))
			   <li class="{{\Route::is('admin.admins.*','admin.roles.*','admin.permissions.*') ? 'active' : ''}}">
				  <a href="{{route('admin.admins.index')}}">
					  <i class="fa fa-user-secret"></i><span>管理员及权限</span>
				  </a>
			  </li>
			  @endif
            </ul>
        </div>
    </div>
</aside>
