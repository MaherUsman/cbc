<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">{{__('sidebar.main_menu')}}</li>
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a class="" href="{{route('admin.dashboard')}}">
                    <i class="la la-home"></i>
                    <span class="nav-text">{{__('sidebar.dashboard')}}</span>
                </a>
            </li>
{{--            <ul aria-expanded="false">--}}
{{--                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.dashboard')}}">--}}
{{--                        <i class="la la-home"></i>--}}
{{--                        <span class="nav-text">{{__('sidebar.dashboard')}}</span></a>--}}
{{--                </li>--}}
{{--            </ul>--}}

{{--            <li class="{{ request()->is('admin/user*') || request()->is('admin/roles*') ? 'active mm-active' : '' }}">--}}
{{--                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/user*') || request()->is('admin/roles*') ? 'true' : 'false' }}">--}}
{{--                    <i class="la la-user"></i>--}}
{{--                    <span class="nav-text">{{__('sidebar.users.name')}} & Roles</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="{{ request()->is('admin/user*') || request()->is('admin/roles*') ? 'true' : 'false' }}">--}}
{{--                    <li class="{{ request()->is('admin/user*') ? 'active mm-active' : '' }}">--}}
{{--                        <a href="{{route('user.index')}}">{{__('sidebar.users.index')}}</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ request()->is('admin/user/create') ? 'active mm-active' : '' }}">--}}
{{--                        <a href="{{route('user.create')}}">{{__('sidebar.users.create')}}</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}


            <li class="{{ request()->is('admin/blogs*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/blogs*') ? 'true' : 'false' }}">
                    <i class="la la-calendar"></i>
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

{{--            <li class="{{ request()->is('admin/contact-uses*') ? 'active mm-active' : '' }}">--}}
{{--                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/contact-uses*') ? 'true' : 'false' }}">--}}
{{--                    <i class="la la-note"></i>--}}
{{--                    <span class="nav-text">{{__('sidebar.contactUs.name')}}</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="{{ request()->is('admin/contact-uses*') ? 'true' : 'false' }}">--}}
{{--                    <li class="{{ request()->is('admin/contact-uses*') ? 'active mm-active' : '' }}">--}}
{{--                        <a href="{{route('contact-uses.index')}}">{{__('sidebar.contactUs.index')}}</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ request()->is('admin/contact-uses/create') ? 'active mm-active' : '' }}">--}}
{{--                        <a href="{{route('contact-uses.create')}}">{{__('sidebar.contactUs.create')}}</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}


            <li class="{{ request()->routeIs('admin/contact-us') ? 'active' : '' }}"><a class="" href="{{route('contact-us.index')}}">
                    <i class="la la-home"></i>
                    <span class="nav-text">{{__('sidebar.contactUs.name')}}</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/sliders*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/sliders*') ? 'true' : 'false' }}">
                    <i class="la la-sliders-h"></i>
                    <span class="nav-text">{{__('sidebar.sliders.name')}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/sliders*') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/sliders*') ? 'active mm-active' : '' }}">
                        <a href="{{route('sliders.index')}}">{{__('sidebar.sliders.index')}}</a>
                    </li>
                    <li class="{{ request()->is('admin/sliders/create') ? 'active mm-active' : '' }}">
                        <a href="{{route('sliders.create')}}">{{__('sidebar.sliders.create')}}</a>
                    </li>
                </ul>
            </li>
            <li {{ request()->is('admin/intros*') ? 'active mm-active' : '' }}>
                <a class="ai-icon" href="{{route('intros.COE')}}" aria-expanded="false">
                    <i class="la la-calendar"></i>
                    <span class="nav-text">Site Introduction</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/abouts*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/abouts*') ? 'true' : 'false' }}">
                    <i class="la la-home"></i>
                    <span class="nav-text">{{__('sidebar.abouts.name')}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/abouts*') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/abouts*') ? 'active mm-active' : '' }}">
                        <a href="{{route('abouts.index')}}">{{__('sidebar.abouts.index')}}</a>
                    </li>
                    <li class="{{ request()->is('admin/abouts/create') ? 'active mm-active' : '' }}">
                        <a href="{{route('abouts.create')}}">{{__('sidebar.abouts.create')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-label">{{__('sidebar.aboutUs_page')}}</li>
            <li {{ request()->is('admin/about-uses*') ? 'active mm-active' : '' }}>
                <a class="ai-icon" href="{{route('about-uses.COE')}}" aria-expanded="false">
                    <i class="la la-calendar"></i>
                    <span class="nav-text">{{__('sidebar.aboutUs.sec')}}</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/abouts*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/abouts*') ? 'true' : 'false' }}">
                    <i class="la la-pager"></i>
                    <span class="nav-text">{{__('sidebar.aboutUs.name')}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/about-us-galleries*') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/about-us-galleries*') ? 'active mm-active' : '' }}">
                        <a href="{{route('about-us-galleries.index')}}">{{__('sidebar.aboutUs.index')}}</a>
                    </li>
                    <li class="{{ request()->is('admin/about-us-galleries/create') ? 'active mm-active' : '' }}">
                        <a href="{{route('about-us-galleries.create')}}">{{__('sidebar.aboutUs.create')}}</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('admin/animals*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/animals*') ? 'true' : 'false' }}">
                    <i class="la fab la-evernote"></i>
                    <span class="nav-text">{{__('sidebar.animals.name')}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/animal-categories*') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/animal-categories*') ? 'active mm-active' : '' }}">
                        <a href="{{route('animal-categories.index')}}">{{__('sidebar.animalCategories.index')}}</a>
                    </li>
                    <li class="{{ request()->is('admin/animals*') ? 'active mm-active' : '' }}">
                        <a href="{{route('animals.index')}}">{{__('sidebar.animals.index')}}</a>
                    </li>
                    <li class="{{ request()->is('admin/animals/create') ? 'active mm-active' : '' }}">
                        <a href="{{route('animals.create')}}">{{__('sidebar.animals.create')}}</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('admin/topas-galleries*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/topas-galleries*') ? 'true' : 'false' }}">
                    <i class="la la-images"></i>
                    <span class="nav-text">{{__('sidebar.topas.name')}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/topas-galleries*') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/topas-galleries*') ? 'active mm-active' : '' }}">
                        <a href="{{route('topas-galleries.index')}}">{{__('sidebar.topas.index')}}</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('admin/visitor-galleries*') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/visitor-galleries*') ? 'true' : 'false' }}">
                    <i class="la la-images"></i>
                    <span class="nav-text">{{__('sidebar.visitor.name')}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/visitor-galleries*') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/visitor-galleries*') ? 'active mm-active' : '' }}">
                        <a href="{{route('visitor-galleries.index')}}">{{__('sidebar.visitor.index')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-label">{{__('sidebar.setting_page')}}</li>
            <li class="{{ request()->is('admin/settings') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/settings') ? 'true' : 'false' }}">
                    <i class="la la-sitemap"></i>
                    <span class="nav-text">{{__('sidebar.setting.name')}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/settings') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/settings') ? 'active mm-active' : '' }}">
                        <a href="{{route('admin.settings')}}">{{__('sidebar.setting.update')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-label">{{__('sidebar.career_listing_page')}}</li>
            <li class="{{ request()->is('admin/career-listing') ? 'active mm-active' : '' }}">
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/career-listing') ? 'true' : 'false' }}">
                    <i class="la la-note"></i>
                    <span class="nav-text">{{__('sidebar.career_listing_page')}}</span>
                </a>
                <ul aria-expanded="{{ request()->is('admin/career-listing') ? 'true' : 'false' }}">
                    <li class="{{ request()->is('admin/career-listing') ? 'active mm-active' : '' }}">
                        <a href="{{route('admin.career-listing')}}">{{__('sidebar.career-listing.name')}}</a>
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
