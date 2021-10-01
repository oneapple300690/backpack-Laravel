<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
@can('view-program')
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('program') }}'><i class='nav-icon la la-list-ul'></i> Programs</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('module') }}'><i class='nav-icon la la-th-list'></i> Modules</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('stepping-stone') }}'><i class='nav-icon la la-th-large'></i> Stepping stones</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
@endcan