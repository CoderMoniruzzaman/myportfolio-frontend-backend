  <!-- sidebar menu area start -->
  <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{url('/admin')}}"><img src="{{asset('images/logo-light.png')}}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <!-- nav link item--->
                    <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                    </li>
                    <!-- nav link item--->
                    <li class="">
                        <a href="{{ url('/') }}" target="_blank" aria-expanded="true"><i class="ti-home"></i><span>Visit mysite</span></a>
                    </li>

                    <!-- nav link item--->
                    <li >
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i><span>Mail</span></a>
                        <ul class="collapse">
                            <li><i class="ti-control-record"></i> <span>All Role</span></a></li>
                            <li><a href="{{url('/admin/role/create')}}"> <i class="ti-control-record"></i> <span>New Role</span></a></li>
                        </ul>
                    </li>
                    <!-- nav link item--->
                    <li class="{{ Route::is('admin.work.skill.index') || Route::is('admin.work.index') || Route::is('admin.work.create')|| Route::is('admin.category.index') || Route::is('admin.category.create')? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-desktop"></i><span>Work Management
                            </span></a>
                        <ul class="collapse{{ Route::is('admin.work.skill.index') || Route::is('admin.work.create')||Route::is('admin.category.index')|| Route::is('admin.category.create')? 'active' : '' }}">
                            <li class="{{ Route::is('admin.work.create')? 'active' : '' }}"><a href="{{url('/admin/work/create')}}"> <i class="ti-control-record"></i> <span>Add new work</span></a></li>
                            <li class="{{ Route::is('admin.category.create')||Route::is('admin.category.index')? 'active' : '' }}"><a href="{{url('/admin/category')}}"> <i class="ti-control-record"></i> <span>Category</span></a></li>
                            <li class="{{ Route::is('admin.work.skill.index')? 'active' : '' }}"><a href="{{ url('/admin/workskill') }}"> <i class="ti-control-record"></i> <span>Skill</span></a></li>
                        </ul>
                    </li>

                    {{--
                    <!-- nav link item--->
                    <li class="{{ Route::is('admin.admins.index') || Route::is('admin.admins.create') || Route::is('admin.admins.edit') || Route::is('admin.role.create') || Route::is('admin.role.index') || Route::is('admin.role.edit') || Route::is('admin.role.show') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>admins Management
                            </span></a>
                        <ul class="collapse {{ Route::is('admin.admin.index') || Route::is('admin.admins.create') || Route::is('admin.admins.edit') || Route::is('admin.role.create') || Route::is('admin.role.index') || Route::is('admin.role.edit') || Route::is('admin.role.show') ? 'in' : '' }}">

                            <li class="{{ Route::is('admin.admins.index')  || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{url('/admin/admins')}}"> <i class="ti-control-record"></i> <span>All admins</span></a></li>

                            <li class="{{ Route::is('admin.admins.create') ? 'active' : '' }}"><a href="{{url('/admin/admins/create')}}"> <i class="ti-control-record"></i> <span>Add New admins</span></a></li>

                            <li class="{{ Route::is('admin.role.index')  || Route::is('admin.role.edit') ? 'active' : '' }}"><a href="{{url('/admin/role')}}"> <i class="ti-control-record"></i> <span>All Role</span></a></li>

                            <li class="{{ Route::is('admin.role.create')? 'active' : '' }}"><a href="{{url('/admin/role/create')}}"> <i class="ti-control-record"></i> <span>Add New Role</span></a></li>
                        </ul>
                    </li> --}}

                    <!-- nav link item--->
                    <li >
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>admins Management
                            </span></a>
                        <ul class="collapse">

                            <li><i class="ti-control-record"></i> <span>All Role</span></a></li>
                            <li><a href="{{url('/admin/role/create')}}"> <i class="ti-control-record"></i> <span>New Role</span></a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
