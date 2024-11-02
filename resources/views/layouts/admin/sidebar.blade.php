<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Summary</li>
                <li>
                    <a href="/" class="waves-effect">
                        <i class='bx bx-home-alt'></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title" key="t-menu">Data</li>
                <li class="{{ request()->is('imports/*') == 1 ? 'mm-active' : ''}}">
                    <a href="/imports" class="waves-effect {{ request()->is('imports/*') == 1 ? 'active' : ''}}">
                        <i class='bx bxs-file-doc'></i>
                        <span key="t-access">Imports</span>
                    </a>
                </li>

                <li class="{{ request()->is('data/*') == 1 ? 'mm-active' : ''}}">
                    <a href="/data" class="waves-effect {{ request()->is('data/*') == 1 ? 'active' : ''}}">
                        <i class='bx bx-file'></i>
                        <span key="t-lokasi">Data</span>
                    </a>
                </li>

                <li class="menu-title" key="t-apps">Settings</li>
                <li class="{{ request()->is('users/*') == 1 ? 'mm-active' : ''}}">
                    <a href="/users" class="waves-effect {{ request()->is('users/*') == 1 ? 'active' : ''}}">
                        <i class='bx bx-user'></i>
                        <span key="t-provider">Users</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
