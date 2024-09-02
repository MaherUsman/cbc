<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            @can('view-dashboard')
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                </ul>
            @endcan

            @canany(['roles.view_role', 'roles.add_role', 'roles.edit_role', 'roles.delete_role', 'users.view_user', 'users.add_user', 'users.edit_user', 'users.delete_user'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-user"></i>
                        <span class="nav-text">Users & Roles</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('users.view_user')
                            <li><a href="{{route('admin.users.index')}}">All Users</a></li>
                        @endcan
                        @can('users.add_user')
                            <li><a href="{{route('admin.users.create')}}">Create User</a></li>
                        @endcan
                        @can('roles.view_role')
                            <li><a href="{{route('admin.roles.index')}}">Roles</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['jobs.view_job', 'jobs.add_job', 'jobs.edit_job', 'jobs.delete_job'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-briefcase"></i>
                        <span class="nav-text">Jobs</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('jobs.view_job')
                            <li><a href="{{route('admin.organization-jobs.index')}}">All Jobs</a></li>
                        @endcan
                        @can('jobs.add_job')
                            <li><a href="{{route('admin.organization-jobs.create')}}">Create Job</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
        </ul>

        <div class="copyright">
            <p>{{config('app.name')}}</p>
            <p class="fs-12"></p>
        </div>
    </div>
</div>
