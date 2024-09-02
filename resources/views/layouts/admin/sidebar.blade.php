<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <ul aria-expanded="false">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{route('admin.dashboard')}}">Dashboard</a>
                </li>
            </ul>

            <li class="{{ request()->is('admin/user*') || request()->is('admin/roles*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/user*') || request()->is('admin/roles*') ? 'true' : 'false' }}">
                    <i class="la la-user"></i>
                    <span class="nav-text">Users{{-- & Roles--}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/user*') || request()->is('admin/roles*') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/user*') ? 'active mm-active' : '' }}">
                        <a href="{{route('user.index')}}">All Users </a>
                    </li>
                    <li class="{{ request()->is('admin/user/create') ? 'active mm-active' : '' }}">
                        <a href="{{route('user.create')}}">Create User</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="copyright">
            <p>{{config('app.name')}}</p>
            <p class="fs-12"></p>
        </div>
    </div>
</div>
