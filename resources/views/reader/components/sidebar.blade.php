<style>
    .logo-header img {
        height: 10vh;
        width: 100%;
    }

    .logo-header {
        /* margin-top: 10px; */
        display: flex;
        justify-content: center;
        text-align: center;
        align-items: center;
        /* background-color: aliceblue; */
    }

    .sidebar {
        background-color: #e1e0da;
        /* background-color: aliceblue; */
    }

    body {
        background-color: aliceblue;
    }

    a.page-link {
        background-color: #8B7231 !important;
        border-color: #8B7231 !important;
        color: white !important;
    }

    @media (min-width: 1024px) and (max-width: 1366px) {
        .logo-header {
            margin-top: 30px
        }

        .logo-header .btn-toggle {
            position: absolute;
            top: 10px;
            right: 10px;
            margin: 0 !important;
        }
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
                <li class="nav-item {{ request()->routeIs('reader.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('reader.dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('reader.reading') ? 'active' : '' }}">
                    <a href="{{ route('reader.reading') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Utility Reading</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
