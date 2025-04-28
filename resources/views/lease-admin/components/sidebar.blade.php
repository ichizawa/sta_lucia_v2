<style>
    .logo-header img {
        height: 10vh;
        width: 100%;

    }

    .logo-header {
        display: flex;
        justify-content: center;
        text-align: center;
        align-items: center;
    }

    .sidebar {
        background-color: #e1e0da;
    }

    body {
        background-color: aliceblue;
    }

    a.page-link {
        background-color: #8B7231 !important;
        border-color: #8B7231 !important;
        color: white !important;
    }
</style>

<div class="sidebar sidebar-style-2">
    <div class="sidebar-logo">

        <div class="logo-header">
            <a href="#" class="logo">
                <img src="{{ asset('assets/img/sta_lucia_logo2.png') }}" alt="navbar brand" class="navbar-brand" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>

    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('lease.admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('lease.admin.dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fa-solid fa-square-poll-vertical"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('lease.admin.permits.lists') ? 'active' : '' }}">
                    <a href="{{ route('lease.admin.permits.lists') }}" aria-expanded="false">
                        <i class="far fa-chart-bar"></i>
                        <p>Issue Permits</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('lease.admin.commencement.lists') ? 'active' : '' }}">
                    <a href="{{ route('lease.admin.commencement.lists') }}" aria-expanded="false">
                        <i class="fa-solid fa-calendar-check"></i>
                        <p>Tenant Commencement</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
