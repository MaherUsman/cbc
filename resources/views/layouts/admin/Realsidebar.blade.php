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

            @canany(['companies.view_company', 'companies.add_company', 'companies.edit_company', 'companies.delete_company'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-building"></i>
                        <span class="nav-text">Companies</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('companies.view_company')
                            <li><a href="{{route('admin.companies.index')}}">All Companies</a></li>
                        @endcan
                        @can('companies.add_company')
                            <li><a href="{{route('admin.companies.create')}}">Create Company</a></li>
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

            @canany(['testimonials.view_testimonial', 'testimonials.add_testimonial', 'testimonials.edit_testimonial', 'testimonials.delete_testimonial'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-comment"></i>
                        <span class="nav-text">Testimonials</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('testimonials.view_testimonial')
                            <li><a href="{{route('admin.testimonials.index')}}">All Testimonials</a></li>
                        @endcan
                        @can('testimonials.add_testimonial')
                            <li><a href="{{route('admin.testimonials.create')}}">Create Testimonial</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['subjects.view_subject', 'subjects.add_subject', 'subjects.edit_subject', 'subjects.delete_subject'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-book"></i>
                        <span class="nav-text">Subjects</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('subjects.view_subject')
                            <li><a href="{{route('admin.subjects.index')}}">All Subjects</a></li>
                        @endcan
                        @can('subjects.add_subject')
                            <li><a href="{{route('admin.subjects.create')}}">Create Subject</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['plans.view_plan', 'plans.add_plan', 'plans.edit_plan', 'plans.delete_plan'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-cube"></i>
                        <span class="nav-text">Plans</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('plans.view_plan')
                            <li><a href="{{route('admin.package_plans.index')}}">All Plans</a></li>
                        @endcan
                        @can('plans.add_plan')
                            <li><a href="{{route('admin.package_plans.create')}}">Create Plan</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['teachers.view_teacher', 'teachers.add_teacher', 'teachers.edit_teacher', 'teachers.delete_teacher'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-chalkboard-teacher"></i>
                        <span class="nav-text">Teachers</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('teachers.view_teacher')
                            <li><a href="{{route('admin.teachers.index')}}">All Teachers</a></li>
                        @endcan
                        @can('teachers.add_teacher')
                            <li><a href="{{route('admin.teachers.create')}}">Create Teacher</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['courses.view_course', 'courses.add_course', 'courses.edit_course', 'courses.delete_course'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-cube"></i>
                        <span class="nav-text">Courses</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('courses.view_course')
                            <li><a href="{{route('admin.courses.index')}}">All Courses</a></li>
                        @endcan
                        @can('courses.add_course')
                            <li><a href="{{route('admin.courses.create')}}">Create Course</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['skill.view_skill', 'skill.add_skill', 'skill.edit_skill', 'skill.delete_skill'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-cube"></i>
                        <span class="nav-text">Skill</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('skill.view_skill')
                            <li><a href="{{route('admin.skill.index')}}">All Skills</a></li>
                        @endcan
                        @can('courses.add_course')
                            <li><a href="{{route('admin.skill.create')}}">Create Skill</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['designation.view_designation', 'designation.create_designation', 'designation.edit_designation.', 'courses.designation.delete_designation'])
                <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                        <i class="la la-cube"></i>
                        <span class="nav-text">Designation</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('designation.view_designation')
                            <li><a href="{{route('admin.designation.index')}}">All Designations</a></li>
                        @endcan
                        @can('designation.create_designation')
                            <li><a href="{{route('admin.designation.create')}}">Create Designations</a></li>
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
