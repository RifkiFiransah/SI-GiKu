<div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
        {{-- <h1 class=""> --}}
            <a href="./index.html" class="text-nowrap logo-img text-dark fw-bold" style="font-weight: 900">
            <img src="{{ asset('assets/images/logos/GenBIoriginal.webp') }}" width="170" alt="" />
            {{-- SI-GiKu --}}
            </a>
        {{-- </h1> --}}
        <div class="cursor-pointer close-btn d-xl-none d-block sidebartoggler" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
        </div>
    </div>
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}" href="{{ route('backend.dashboard') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
                <a class="sidebar-link {{ request()->routeIs('absensi.*') ? 'active' : '' }}" href="{{ route('absensi.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-file-spreadsheet"></i>
                    </span>
                    <span class="hide-menu">Absensi Kegiatan</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">FEATURE</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ request()->routeIs('backend') ? 'active' : '' }}" href="./ui-buttons.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-stack-2"></i>
                    </span>
                    <span class="hide-menu">Program Kerja</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ request()->routeIs('backend') ? 'active' : '' }}" href="./ui-card.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Divisi</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-users"></i>
                    </span>
                    <span class="hide-menu">User</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ request()->routeIs('backend') ? 'active' : '' }}" href="./ui-alerts.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-world"></i>
                    </span>
                    <span class="hide-menu">Genbi Wilayah</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">SELF</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ request()->routeIs('backend') ? 'active' : '' }}" href="./authentication-login.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-user"></i>
                    </span>
                    <span class="hide-menu">Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ request()->routeIs('backend') ? 'active' : '' }}" href="./authentication-register.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-logout"></i>
                    </span>
                    <span class="hide-menu">Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
