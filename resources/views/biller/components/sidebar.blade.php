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
                <li class="nav-item {{ request()->routeIs('bill.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('bill.dashboard') }}" class="collapsed" aria-expanded="false">
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
                <li class="nav-item {{ request()->routeIs('bill.billing') ? 'active' : '' }}">
                    <a href="{{ route('bill.billing') }}" aria-expanded="false">
                        <i class="fa-solid fa-receipt"></i>
                        <p>Billing</p>
                    </a>
                </li>
                {{-- <li class="nav-item {{ request()->routeIs('utility.reading') || request()->routeIs('utility.reading.lists') ? 'active' : '' }}">
                    <a href="{{ route('utility.reading') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Utility Reading</p>
                    </a>
                </li> --}}
                <li class="nav-item {{ request()->routeIs('bill.period') ? 'active' : '' }}">
                    <a href="{{ route('bill.period') }}" aria-expanded="false">
                        <i class="fa-solid fa-calendar-day"></i>
                        <p>Billing Period</p>
                    </a>
                </li>
                <!-- <li class="nav-item {{ request()->routeIs('bill.cashier') ? 'active' : '' }}">
                    <a href="{{ route('bill.cashier') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Biller</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item {{ request()->routeIs('bill.cashier') ? 'active' : '' }}">
                    <a href="{{ route('bill.cashier') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Billing</p>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
</div>
