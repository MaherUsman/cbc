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
            <li class="{{ request()->is('admin/categories*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/categories*') ? 'true' : 'false' }}">
                    <i class="la la-building"></i>
                    <span class="nav-text">Categories</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/categories*') ? 'true' : 'false' }}">
                    <li class="{{ request()->routeIs('categories.index') ? 'active mm-active' : '' }}">
                        <a href="{{route('categories.index')}}">All Categories</a>
                    </li>
                    <li class="{{ request()->routeIs('categories.create') ? 'active mm-active' : '' }}">
                        <a href="{{route('categories.create')}}">Create Category</a>
                    </li>
                </ul>
            </li>

            {{--
            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="la la-briefcase"></i>
                    <span class="nav-text">Jobs</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.organization-jobs.index')}}">All Jobs</a></li>
                    <li><a href="{{route('admin.organization-jobs.create')}}">Create Job</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="la la-comment"></i>
                    <span class="nav-text">Testimonials</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.testimonials.index')}}">All Testimonials</a></li>
                    <li><a href="{{route('admin.testimonials.create')}}">Create Testimonial</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Subjects</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.subjects.index')}}">All Subjects</a></li>
                    <li><a href="{{route('admin.subjects.create')}}">Create Subject</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="la la-cube"></i>
                    <span class="nav-text">Plans</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.package_plans.index')}}">All Plans</a></li>
                    <li><a href="{{route('admin.package_plans.create')}}">Create Plan</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="la la-chalkboard-teacher"></i>
                    <span class="nav-text">Teachers</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.teachers.index')}}">All Teachers</a></li>
                    <li><a href="{{route('admin.teachers.create')}}">Create Teacher</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="la la-cube"></i>
                    <span class="nav-text">Courses</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.courses.index')}}">All Courses</a></li>
                    <li><a href="{{route('admin.courses.create')}}">Create Course</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="la la-cube"></i>
                    <span class="nav-text">Skill</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.skill.index')}}">All Skills</a></li>
                    <li><a href="{{route('admin.skill.create')}}">Create Skill</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="la la-cube"></i>
                    <span class="nav-text">Designation</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.designation.index')}}">All Designations</a></li>
                    <li><a href="{{route('admin.designation.create')}}">Create Designations</a></li>
                </ul>
            </li>--}}

        </ul>

        <div class="copyright">
            <p>{{config('app.name')}}</p>
            <p class="fs-12"></p>
        </div>
    </div>
</div>
