<ul class="navbar-nav header-right">
    <li class="nav-item dropdown notification_dropdown">
        <a class="nav-link bell dlab-theme-mode p-0" href="javascript:void(0);">
            <i id="icon-light" class="fas fa-sun"></i>
            <i id="icon-dark" class="fas fa-moon"></i>
        </a>
    </li>
    <li class="nav-item dropdown header-profile">
        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
            {{--@php
                $user = auth()->user();
                $logo = null;
                if ($user->hasRole('admin')) {
                    $logo = $user->admin->logo ?? '';
                } elseif ($user->hasRole('teacher')) {
                    $logo = $user->teacher->image ?? '';
                } elseif ($user->hasRole('company')) {
                    $logo = $user->organization->logo ?? '';
                }
            @endphp--}}
            <img src="{{ asset(Auth::user()->pic?:"images/avatar/1.jpg") }}" width="20" alt="User Profile">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('admin.profile') }}" class="dropdown-item ai-icon">
                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span class="ms-2">Profile </span>
            </a>
            <a href="{{ route('logout') }}" class="dropdown-item ai-icon" {{--onclick="event.preventDefault(); document.getElementById('logout-form').submit();"--}}>
                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span class="ms-2">Logout</span>
            </a>

            {{--<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>--}}
        </div>
    </li>
</ul>
