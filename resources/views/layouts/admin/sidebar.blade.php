<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">{{__('sidebar.main_menu')}}</li>
            <ul aria-expanded="false">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{route('admin.dashboard')}}">{{__('sidebar.dashboard')}}</a>
                </li>
            </ul>

            <li class="{{ request()->is('admin/user*') || request()->is('admin/roles*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/user*') || request()->is('admin/roles*') ? 'true' : 'false' }}">
                    <i class="la la-user"></i>
                    <span class="nav-text">{{__('sidebar.users.name')}}{{-- & Roles--}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/user*') || request()->is('admin/roles*') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/user*') ? 'active mm-active' : '' }}">
                        <a href="{{route('user.index')}}">{{__('sidebar.users.index')}}</a>
                    </li>
                    <li class="{{ request()->is('admin/user/create') ? 'active mm-active' : '' }}">
                        <a href="{{route('user.create')}}">{{__('sidebar.users.create')}}</a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->is('admin/blogs*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/blogs*') ? 'true' : 'false' }}">
                    <i class="la la-note"></i>
                    <span class="nav-text">{{__('sidebar.events.name')}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/blogs*') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/blogs*') ? 'active mm-active' : '' }}">
                        <a href="{{route('blogs.index')}}">{{__('sidebar.events.index')}}</a>
                    </li>
                    <li class="{{ request()->is('admin/blogs/create') ? 'active mm-active' : '' }}">
                        <a href="{{route('blogs.create')}}">{{__('sidebar.events.create')}}</a>
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
