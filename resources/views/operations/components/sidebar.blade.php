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
        background-color: aliceblue;
    }

    .sidebar {
        background-color: aliceblue;
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
                <li class="nav-item {{ request()->routeIs('operation.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('operation.dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('pre.construction.operation') || request()->routeIs('work.permit.operation') ? 'active' : '' }}">>
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Permits</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('pre.construction.operation') ? 'active' : '' }}">
                                <a href="{{ route('pre.construction.operation') }}">
                                    <span class="sub-item">Pre-Construction</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('work.permit.operation') ? 'active' : '' }}">
                                <a href="{{ route('work.permit.operation') }}">
                                    <span class="sub-item">Work Permits</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('space.construction.construction') ? 'active' : '' }}">
                    <a href="{{ route('space.construction.construction') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Space Construction</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('reading.reading.operation') ? 'active' : '' }}">
                    <a href="{{ route('reading.reading.operation') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Utility Reading</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>