<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            {{-- <li class="nav-label first">{{__('sidebar.main_menu')}}</li> --}}
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-dashboard']))
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="" href="{{route('admin.dashboard')}}">
                        <i class="la la-home"></i>
                        <span class="nav-text">{{__('sidebar.dashboard')}}</span>
                    </a>
                </li>
            @endif
            <li class="nav-label">Pages</li>

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

            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-event']))
                <li class="{{ request()->is('admin/blogs*') ? 'active mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);"
                       aria-expanded="{{ request()->is('admin/blogs*') ? 'true' : 'false' }}">
                        <i class="la la-calendar"></i>
                        <span class="nav-text">{{__('sidebar.events.name')}}</span>
                    </a>
                    <ul aria-expanded="{{ request()->is('admin/blogs*') ? 'true' : 'false' }}">
                        <li class="{{ request()->is('admin/blogs*') ? 'active mm-active' : '' }}">
                            <a href="{{route('blogs.index')}}">{{__('sidebar.events.index')}}</a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['create-event']))
                            <li class="{{ request()->is('admin/blogs/create') ? 'active mm-active' : '' }}">
                                <a href="{{route('blogs.create')}}">{{__('sidebar.events.create')}}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-slider']))
                <li class="{{ request()->is('admin/sliders*') ? 'active mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);"
                       aria-expanded="{{ request()->is('admin/sliders*') ? 'true' : 'false' }}">
                        <i class="la la-sliders-h"></i>
                        <span class="nav-text">{{__('sidebar.sliders.name')}}</span>
                    </a>
                    <ul aria-expanded="{{ request()->is('admin/sliders*') ? 'true' : 'false' }}">
                        <li class="{{ request()->is('admin/sliders*') ? 'active mm-active' : '' }}">
                            <a href="{{route('sliders.index')}}">{{__('sidebar.sliders.index')}}</a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['create-slider']))
                            <li class="{{ request()->is('admin/sliders/create') ? 'active mm-active' : '' }}">
                                <a href="{{route('sliders.create')}}">{{__('sidebar.sliders.create')}}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-intro']))
                <li {{ request()->is('admin/intros*') ? 'active mm-active' : '' }}>
                    <a class="ai-icon" href="{{route('intros.COE')}}" aria-expanded="false">
                        <i class="la la-calendar"></i>
                        <span class="nav-text">Site Introduction</span>
                    </a>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-about-us']))
                <li {{ request()->is('admin/about-uses*') ? 'active mm-active' : '' }}>
                    <a class="ai-icon" href="{{route('about-uses.COE')}}" aria-expanded="false">
                        <i class="la la-calendar"></i>
                        <span class="nav-text">{{__('sidebar.aboutUs.sec')}}</span>
                    </a>
                </li>
            @endif

            {{--            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-toba']))--}}
            <li {{ request()->is('admin/toba*') ? 'active mm-active' : '' }}>
                <a class="ai-icon" href="{{route('toba.COE')}}" aria-expanded="false">
                    <i class="la la-calendar"></i>
                    <span class="nav-text">{{__('sidebar.toba.sec')}}</span>
                </a>
            </li>
            <li {{ request()->is('admin/toba*') ? 'active mm-active' : '' }}>
                <a class="ai-icon" href="{{route('toba.COE')}}" aria-expanded="false">
                    <i class="la la-calendar"></i>
                    <span class="nav-text">{{__('sidebar.toba.sec')}}</span>
                </a>
            </li>
            {{--            @endif--}}


            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-animal']))
                <li class="{{ request()->is('admin/animals*') ? 'active mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);"
                       aria-expanded="{{ request()->is('admin/animals*') ? 'true' : 'false' }}">
                        <i class="la la-cat"></i>
                        <span class="nav-text">{{__('sidebar.animals.name')}}</span>
                    </a>
                    <ul aria-expanded="{{ request()->is('admin/animal-categories*') ? 'true' : 'false' }}">
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-animal-category']))
                            <li class="{{ request()->is('admin/animal-categories*') ? 'active mm-active' : '' }}">
                                <a href="{{route('animal-categories.index')}}">{{__('sidebar.animalCategories.index')}}</a>
                            </li>
                        @endif
                        <li class="{{ request()->is('admin/animals*') ? 'active mm-active' : '' }}">
                            <a href="{{route('animals.index')}}">{{__('sidebar.animals.index')}}</a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['create-animal']))
                            <li class="{{ request()->is('admin/animals/create') ? 'active mm-active' : '' }}">
                                <a href="{{route('animals.create')}}">{{__('sidebar.animals.create')}}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            <li class="nav-label">Galleries</li>
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-about-us-gallery']))
                <li class="{{ request()->is('admin/abouts*') ? 'active mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);"
                       aria-expanded="{{ request()->is('admin/abouts*') ? 'true' : 'false' }}">
                        <i class="la la-pager"></i>
                        <span class="nav-text">{{__('sidebar.aboutUs.name')}}</span>
                    </a>
                    <ul aria-expanded="{{ request()->is('admin/about-us-galleries*') ? 'true' : 'false' }}">
                        <li class="{{ request()->is('admin/about-us-galleries*') ? 'active mm-active' : '' }}">
                            <a href="{{route('about-us-galleries.index')}}">{{__('sidebar.aboutUs.index')}}</a>
                        </li>
                        {{--                    <li class="{{ request()->is('admin/about-us-galleries/create') ? 'active mm-active' : '' }}">--}}
                        {{--                        <a href="{{route('about-us-galleries.create')}}">{{__('sidebar.aboutUs.create')}}</a>--}}
                        {{--                    </li>--}}
                    </ul>
                </li>
            @endif
            {{--        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-tobas-gallery']))--}}
            {{--            <li class="{{ request()->is('admin/topas-galleries*') ? 'active mm-active' : '' }}">--}}
            {{--                <a class="has-arrow" href="javascript:void(0);"--}}
            {{--                   aria-expanded="{{ request()->is('admin/topas-galleries*') ? 'true' : 'false' }}">--}}
            {{--                    <i class="la la-images"></i>--}}
            {{--                    <span class="nav-text">{{__('sidebar.topas.name')}}</span>--}}
            {{--                </a>--}}
            {{--                <ul aria-expanded="{{ request()->is('admin/topas-galleries*') ? 'true' : 'false' }}">--}}
            {{--                    <li class="{{ request()->is('admin/topas-galleries*') ? 'active mm-active' : '' }}">--}}
            {{--                        <a href="{{route('topas-galleries.index')}}">{{__('sidebar.topas.index')}}</a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--        @endif--}}
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-visitor-gallery']))
                <li class="{{ request()->is('admin/visitor-galleries*') ? 'active mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);"
                       aria-expanded="{{ request()->is('admin/visitor-galleries*') ? 'true' : 'false' }}">
                        <i class="la la-images"></i>
                        <span class="nav-text">{{__('sidebar.visitor.name')}}</span>
                    </a>
                    <ul aria-expanded="{{ request()->is('admin/visitor-galleries*') ? 'true' : 'false' }}">
                        <li class="{{ request()->is('admin/visitor-galleries*') ? 'active mm-active' : '' }}">
                            <a href="{{route('visitor-galleries.index')}}">{{__('sidebar.visitor.index')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-activity-gallery']))
                <li class="{{ request()->is('admin/activity-galleries*') ? 'active mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);"
                       aria-expanded="{{ request()->is('admin/activity-galleries*') ? 'true' : 'false' }}">
                        <i class="la la-images"></i>
                        <span class="nav-text">{{__('sidebar.activity.name')}}</span>
                    </a>
                    <ul aria-expanded="{{ request()->is('admin/activity-galleries*') ? 'true' : 'false' }}">
                        <li class="{{ request()->is('admin/activity-galleries*') ? 'active mm-active' : '' }}">
                            <a href="{{route('activity-galleries.index')}}">{{__('sidebar.activity.index')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="nav-label"></li>
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-team']))
                <li class="{{ request()->is('admin/teams*') ? 'active mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);"
                       aria-expanded="{{ request()->is('admin/teams*') ? 'true' : 'false' }}">
                        <i class="la la-user-times"></i>
                        <span class="nav-text">{{__('sidebar.team.name')}}</span>
                    </a>
                    <ul aria-expanded="{{ request()->is('admin/teams*') ? 'true' : 'false' }}">
                        <li class="{{ request()->is('admin/teams*') ? 'active mm-active' : '' }}">
                            <a href="{{route('teams.index')}}">{{__('sidebar.team.index')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-setting']))
                {{-- <li class="nav-label">{{__('sidebar.setting_page')}}</li> --}}
                <li class="{{ request()->is('admin/settings') ? 'active mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);"
                       aria-expanded="{{ request()->is('admin/settings') ? 'true' : 'false' }}">
                        <i class="la la-sitemap"></i>
                        <span class="nav-text">{{__('sidebar.setting.name')}}</span>
                    </a>
                    <ul aria-expanded="{{ request()->is('admin/settings') ? 'true' : 'false' }}">
                        <li class="{{ request()->is('admin/settings') ? 'active mm-active' : '' }}">
                            <a href="{{route('admin.settings')}}">{{__('sidebar.setting.update')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-job']))
                <li class="{{ request()->is('admin/jobs*') ? 'active mm-active' : '' }}">
                    <a class="has-arrow" href="javascript:void(0);"
                       aria-expanded="{{ request()->is('admin/jobs*') ? 'true' : 'false' }}">
                        <i class="la la-sitemap"></i>
                        <span class="nav-text">{{__('sidebar.jobs.name')}}</span>
                    </a>
                    <ul aria-expanded="{{ request()->is('admin/jobs*') ? 'true' : 'false' }}">
                        <li class="{{ request()->is('admin/jobs*') ? 'active mm-active' : '' }}">
                            <a href="{{route('jobs.index')}}">{{__('sidebar.jobs.index')}}</a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['create-job']))
                            <li class="{{ request()->is('admin/jobs/create') ? 'active mm-active' : '' }}">
                                <a href="{{route('jobs.create')}}">{{__('sidebar.jobs.create')}}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            {{-- <li class="nav-label">{{__('sidebar.career_listing_page')}}</li> --}}
            {{--            <li class="{{ request()->is('admin/career-listing') ? 'active mm-active' : '' }}">--}}
            {{--                <a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->is('admin/career-listing') ? 'true' : 'false' }}">--}}
            {{--                    <i class="la la-note"></i>--}}
            {{--                    <span class="nav-text">{{__('sidebar.career_listing_page')}}</span>--}}
            {{--                </a>--}}
            {{--                <ul aria-expanded="{{ request()->is('admin/career-listing') ? 'true' : 'false' }}">--}}
            {{--                    <li class="{{ request()->is('admin/career-listing') ? 'active mm-active' : '' }}">--}}
            {{--                        <a href="{{route('admin.career-listing')}}">{{__('sidebar.career-listing.name')}}</a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}

            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-contact-us']))
                <li class="{{ request()->routeIs('admin/contact-us') ? 'active' : '' }}">
                    <a class="" href="{{route('contact-us.index')}}">
                        <i class="la la-home"></i>
                        <span class="nav-text">{{__('sidebar.contactUs.name')}}</span>
                    </a>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission(['view-career-listing']))
                <li class="{{ request()->is('admin/career-listing') ? 'active mm-active' : '' }}">
                    <a class="" href="{{route('admin.career-listing')}}">
                        <i class="la la-th-list"></i>
                        <span class="nav-text">{{__('sidebar.career-listing.name')}}</span>
                    </a>
                </li>
            @endif
        </ul>


        {{--        <div class="copyright">--}}
        {{--            <p>{{config('app.name')}}</p>--}}
        {{--            <p class="fs-12"></p>--}}
        {{--        </div>--}}
    </div>
</div>
