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
                <li
                    class="nav-item {{ request()->routeIs('pre.construction.operation') || request()->routeIs('work.permit.operation') ? 'active' : '' }}">
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
                <li
                    class="nav-item {{ request()->routeIs('operation.award.notices') || request()->routeIs('operation.award.notices') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#notices" aria-expanded="false">
                        <i class="fa-solid fa-award"></i>
                        <p>Notices</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="notices">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('operation.award.notices') ? 'active' : '' }}">
                                <a href="{{ route('operation.award.notices', 'view') }}">
                                    <span class="sub-item">Award Notice</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('operation.vacate.notices') ? 'active' : '' }}">
                                <a href="{{ route('operation.vacate.notices') }}">
                                    <span class="sub-item">Vacate Notice</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('operation.renewal.contract') || request()->routeIs('operation.termination.contract') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#contracts" aria-expanded="false">
                        <i class="fa-solid fa-file-signature"></i>
                        <p>Contract</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="contracts">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('operation.renewal.contract') ? 'active' : '' }}">
                                <a href="{{ route('operation.renewal.contract') }}">
                                    <span class="sub-item">Renewal of Contract</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('operation.termination.contract') ? 'active' : '' }}">
                                <a href="{{ route('operation.termination.contract') }}">
                                    <span class="sub-item">Termination of Contract</span>
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
                        <i class="fa-solid fa-gears"></i>
                        <p>Utility Reading</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
