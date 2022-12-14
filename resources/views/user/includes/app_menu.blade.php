<div class="app-menu navbar-menu d-none">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav justify-content-center" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'index') active @endif" href="{{ route('index') }}">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link " href="javascript:void()">
                        <i class="ri-layout-3-line"></i> <span data-key="t-apps">C</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'notes') active @endif" href="{{ route('notes') }}">
                        <i class="ri-account-circle-line"></i> <span data-key="t-apps">My Notes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('user_logout') }}">
                        <i class="ri-pages-line"></i> <span data-key="t-apps">Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>