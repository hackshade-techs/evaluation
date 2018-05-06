<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-university"></i> <span>Institution</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('faculty') }}"><i class="fa fa-institution"></i> <span>Faculties</span></a></li>
        <li><a href="{{ backpack_url('department') }}"><i class="fa fa-bars"></i> <span>Departments</span></a></li>
        <li><a href="{{ backpack_url('course') }}"><i class="fa fa-save"></i> <span>Courses</span></a></li>
        <li><a href="{{ backpack_url('courseunit') }}"><i class="fa fa-book"></i> <span>Course Units</span></a></li>
    </ul>
</li>

@if (Auth::user()->hasRole('super-administrator') || Auth::user()->hasRole('administrator'))

<li><a href="{{ backpack_url('student') }}"><i class="fa fa-users"></i> <span>Students</span></a></li>
<li><a href="{{ backpack_url('lecturer') }}"><i class="fa fa-group"></i> <span>Lecturers</span></a></li>

<li class="header">Suggestion & Evaluation</li>
<li><a href="{{ backpack_url('suggestion') }}"><i class="fa fa-envelope"></i> <span>Suggestions</span></a></li>
<li><a href="{{ backpack_url('evaluation') }}"><i class="fa fa-pencil"></i> <span>Evaluations</span></a></li>

<li class="header">Reports</li>
<li><a href="{{ backpack_url('report') }}"><i class="fa fa-file"></i> <span>Reports</span></a></li>
@endif

@role('student')
<li><a href="{{ backpack_url('lecturer') }}"><i class="fa fa-group"></i> <span>Lecturers</span></a></li>
<li><a href="{{ backpack_url('evaluation/create') }}"><i class="fa fa-pencil"></i> <span>Make Evaluations</span></a></li>
<li><a href="{{ backpack_url('suggestion/create') }}"><i class="fa fa-envelope"></i> <span>Make Suggestions</span></a></li>
@endrole

<li class="header">Administration</li>
@role('super-administrator')
<!-- Users, Roles Permissions -->
<li class="treeview">
<a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
</ul>
</li>
<li class="treeview">
    <a href="#"><i class="fa fa-cogs"></i> <span>Advanced</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
    <li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a></li>
    <li><a href="{{ backpack_url('backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>
    <li><a href="{{ backpack_url('log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>
    <li><a href="{{ backpack_url('setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
    </ul>
</li>
@endrole
<li><a href="{{ route('backpack.account.info') }}"><i class="fa fa-user-circle"></i> <span>My Account</span></a></li>