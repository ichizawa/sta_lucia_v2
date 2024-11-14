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
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fa-solid fa-square-poll-vertical"></i>
                        <p>Dashboard</p>
                        {{-- <span class="caret"></span> --}}
                    </a>

                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                {{-- <li class="nav-item {{ request()->routeIs('admin.branch') ? 'active' : '' }}">
                    <a href="{{route('admin.branch')}}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Branch</p>
                    </a>
                </li> --}}
                <li
                    class="nav-item {{ request()->routeIs('leases.mall.leases') || request()->routeIs('leases.leases.proposal') || request()->routeIs('leases.add.proposal') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#leases" aria-expanded="false">
                        <i class="fa-solid fa-house"></i>
                        <p>Leases</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="leases">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('leases.mall.leases') ? 'active' : '' }}">
                                <a href="{{ route('leases.mall.leases') }}">
                                    <span class="sub-item">Mall Leaseable Info</span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->routeIs('leases.leases.proposal') || request()->routeIs('leases.add.proposal') ? 'active' : '' }}">
                                <a href="{{ route('leases.leases.proposal') }}">
                                    <span class="sub-item">Lease Proposal</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.tenants') ? 'active' : '' }}">
                    <a href="{{ route('admin.tenants') }}" aria-expanded="false">
                        <i class="fa-solid fa-people-carry-box"></i>
                        <p>Tenants</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.space') || request()->routeIs('space.add.space') ? 'active' : '' }}">
                    <a href="{{ route('admin.space') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Space</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.award.notices') || request()->routeIs('admin.vacate.notices') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#notices" aria-expanded="false">
                        <i class="fa-solid fa-award"></i>
                        <p>Notices</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="notices">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('admin.award.notices') ? 'active' : '' }}">
                                <a href="{{ route('admin.award.notices', 'view') }}">
                                    <span class="sub-item">Award Notice</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.vacate.notices') ? 'active' : '' }}">
                                <a href="{{ route('admin.vacate.notices') }}">
                                    <span class="sub-item">Vacate Notice</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.renewal.contract') || request()->routeIs('admin.termination.contract') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#contracts" aria-expanded="false">
                        <i class="fa-solid fa-file-signature"></i>
                        <p>Contract</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="contracts">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('admin.renewal.contract') ? 'active' : '' }}">
                                <a href="{{ route('admin.renewal.contract') }}">
                                    <span class="sub-item">Renewal of Contract</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.termination.contract') ? 'active' : '' }}">
                                <a href="{{ route('admin.termination.contract') }}">
                                    <span class="sub-item">Termination of Contract</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('commencement.lists') ? 'active' : '' }}">
                    <a href="{{ route('commencement.lists') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Commencement</p>
                    </a>
                </li>
                <li class="nav-item  {{ request()->routeIs('admin.utility')
    || request()->routeIs('admin.category')
    || request()->routeIs('admin.charges')
    || request()->routeIs('admin.amenities')
    || request()->routeIs('space.edit.mall')
    || request()->routeIs('space.edit.building')
    || request()->routeIs('space.edit.level')
    ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#setup" aria-expanded="false">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <p>Setup</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="setup">
                        <ul class="nav nav-collapse">
                            <li class=" {{ request()->routeIs('admin.utility') ? 'active' : '' }}">
                                <a href="{{ route('admin.utility') }}">
                                    <span class="sub-item">Utility</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.category') ? 'active' : '' }}">
                                <a href="{{ route('admin.category') }}">
                                    <span class="sub-item">Category</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.charges') ? 'active' : '' }}">
                                <a href="{{ route('admin.charges') }}">
                                    <span class="sub-item">Charges</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.amenities') ? 'active' : '' }}">
                                <a href="{{ route('admin.amenities') }}">
                                    <span class="sub-item">Amenities</span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->routeIs('space.edit.mall', 'mall') || request()->routeIs('space.edit.building', 'building') || request()->routeIs('space.edit.level', 'level') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Space Options</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li class="{{ request()->routeIs('space.edit.mall', 'mall') ? 'active' : '' }}">
                                            <a href="{{ route('space.edit.mall', 'mall') }}">
                                                <span class="sub-item">Mall Codes</span>
                                            </a>
                                        </li>
                                        <li
                                            class="{{ request()->routeIs('space.edit.building', 'building') ? 'active' : '' }}">
                                            <a href="{{ route('space.edit.building', 'building') }}">
                                                <span class="sub-item">Building Numbers</span>
                                            </a>
                                        </li>
                                        <li
                                            class="{{ request()->routeIs('space.edit.level', 'level') ? 'active' : '' }}">
                                            <a href="{{ route('space.edit.level', 'level') }}">
                                                <span class="sub-item">Level Numbers</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            {{-- <li class="{{ request()->routeIs('admin.amenities') ? 'active' : '' }}">
                                <a href="{{ route('admin.amenities') }}">
                                    <span class="sub-item">Mall</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.amenities') ? 'active' : '' }}">
                                <a href="{{ route('admin.amenities') }}">
                                    <span class="sub-item">Building</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.amenities') ? 'active' : '' }}">
                                <a href="{{ route('admin.amenities') }}">
                                    <span class="sub-item">Level</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.bill.period') ? 'active' : '' }}">
                    <a href="{{ route('admin.bill.period') }}" aria-expanded="false">
                        <i class="fa-solid fa-file-invoice"></i>
                        <p>Billing Periods</p>
                    </a>
                </li>
                {{-- <li class="nav-item {{ request()->routeIs('admin.invoices') ? 'active' : '' }}">
                    <a href="{{ route('admin.invoices') }}" aria-expanded="false">
                        <i class="fa-solid fa-file-invoice"></i>
                        <p>Invoices</p>
                    </a>
                </li> --}}

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Extras</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings') }}" aria-expanded="false">
                        <i class="fa-solid fa-gear"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Reports</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>