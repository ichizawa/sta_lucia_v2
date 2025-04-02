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
                <li class="nav-item {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('client.dashboard') }}" class="collapsed" aria-expanded="false">
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
                @if (Auth::user()->status == 1)
                    <li class="nav-item {{ request()->routeIs('client.proposal') ? 'active' : '' }}">
                        <a href="{{ route('client.proposal') }}" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <p>Lease Proposals</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('client.award.notice') ? 'active' : '' }}">
                        <a href="{{ route('client.award.notice') }}" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <p>Award Notice</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('client.contracts') ? 'active' : '' }}">
                        <a href="{{ route('client.contracts') }}" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <p>Contracts</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('client.space') ? 'active' : '' }}">
                        <a href="{{ route('client.space') }}" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <p>Spaces</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('client.ledger') ? 'active' : '' }}">
                        <a href="{{ route('client.ledger') }}" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <p>Ledger</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('client.auth.person') || request()->routeIs('client.documents') ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#leases" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <p>Setup</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="leases">
                            <ul class="nav nav-collapse">
                                <li class="{{ request()->routeIs('client.auth.person') ? 'active' : '' }}">
                                    <a href="{{ route('client.auth.person') }}">
                                        <span class="sub-item">Authorized Personnel</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('client.documents') ? 'active' : '' }}">
                                    <a href="{{ route('client.documents') }}">
                                        <span class="sub-item">Documents</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @else
                    <li class="nav-item {{ request()->routeIs('client.all.documents') ? 'active' : '' }}">
                        <a href="{{ route('client.all.documents') }}" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <p>Documents</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
