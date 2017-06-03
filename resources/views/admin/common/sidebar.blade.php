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
				<li class="treeview {{
						\Route::is('admin.teach.addresses.*') ? 'active' : null
					}}">
					<a href="#">
						<i class="fa fa-users"></i> <span>维修管理</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu menu-open">
						<li class="">
							<a href=""><i class="fa fa-circle-o"></i> 维修列表</a>
						</li>
					</ul>
				</li>
				<li class="treeview {{
						\Route::is('admin.admins.*', 'admin.categories.*') ? 'active' : null
					}}">
					<a href="#">
						<i class="fa fa-users"></i> <span>系统管理</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu menu-open">
						<li class="{{\Route::is('admin.admins.*') ? 'active' : ''}}">
						   <a href="{{route('admin.admins.index')}}">
							   <i class="fa fa-user-secret"></i><span>管理员</span>
						   </a>
					   </li>
					   <li class="{{\Route::is('admin.categories.*') ? 'active' : ''}}">
						   <a href="{{route('admin.categories.index')}}">
							   <i class="fa fa-sitemap"></i><span>维修分类</span>
						   </a>
					   </li>
					</ul>
				</li>
            </ul>
        </div>
    </div>
</aside>
