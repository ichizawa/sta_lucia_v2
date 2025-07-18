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

                <li
                    class="nav-item {{ request()->routeIs('leasesInfo.mall.leases') || request()->routeIs('leasesProposal.leases.proposal') || request()->routeIs('leases.add.proposal') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#leases" aria-expanded="false">
                        <i class="fa-solid fa-house"></i>
                        <p>Leases</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="leases">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('leasesInfo.mall.leases') ? 'active' : '' }}">
                                <a href="{{ route('leasesInfo.mall.leases') }}">
                                    <span class="sub-item">Mall Leaseable Info</span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->routeIs('leasesProposal.leases.proposal') || request()->routeIs('leasesProposal.leases.proposal') ? 'active' : '' }}">
                                <a href="{{ route('leasesProposal.leases.proposal') }}">
                                    <span class="sub-item">Lease Proposal</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li 
                class="nav-item 
                {{-- {{ request()->routeIs('lease.tenants') ? 'active' : '' }} --}}
                 "
                >
                    <a 
                    {{-- href="{{ route('lease.tenants') }}" --}}
                     aria-expanded="false">
                        <i class="fa-solid fa-people-carry-box"></i>
                        <p>Tenants</p>
                    </a>
                </li>


                <li
                    class="nav-item {{ request()->routeIs('lease.space') || request()->routeIs('space.add.space') ? 'active' : '' }}">
                    <a href="{{ route('lease.space') }}" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                        <p>Space</p>
                    </a>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('lease.award.notices') || request()->routeIs('lease.vacate.notices') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#notices" aria-expanded="false">
                        <i class="fa-solid fa-award"></i>
                        <p>Notices</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="notices">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('lease.award.notices') ? 'active' : '' }}">
                                <a href="{{ route('lease.award.notices', 'view') }}">
                                    <span class="sub-item">Award Notice</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('lease.vacate.notices') ? 'active' : '' }}">
                                <a href="{{ route('lease.vacate.notices') }}">
                                    <span class="sub-item">Vacate Notice</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('lease.renewal.contract') || request()->routeIs('lease.termination.contract') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#contracts" aria-expanded="false">
                        <i class="fa-solid fa-file-signature"></i>
                        <p>Contract</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="contracts">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('lease.renewal.contract') ? 'active' : '' }}">
                                <a href="{{ route('lease.renewal.contract') }}">
                                    <span class="sub-item">Renewal of Contract</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('lease.termination.contract') ? 'active' : '' }}">
                                <a href="{{ route('lease.termination.contract') }}">
                                    <span class="sub-item">Termination of Contract</span>
                                </a>
                            </li>
                        </ul>
                    </div>
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


