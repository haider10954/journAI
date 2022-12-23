        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{ route('admin_index') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-white.png')}}" alt="" height="50">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{ route('admin_index') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-white.png')}}" alt="" height="50">
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
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link menu-link @if(\Request::route()->getName() == 'admin_index') active @endif" href="{{ route('admin_index') }}">
                                <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if(\Request::route()->getName() == 'admin_user_notes') active @endif" href="{{route('admin_user_notes') }}">
                                <i class="ri-account-circle-line"></i> <span>Users Notes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if(\Request::route()->getName() == 'admin_user') active @endif" href="{{ route('admin_user') }}">
                                <i class="ri-apps-2-line"></i> <span>Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link @if(\Request::route()->getName() == 'admin_profile') active @endif" href="{{ route('admin_profile') }}">
                                <i class="ri-compasses-2-line"></i> <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->