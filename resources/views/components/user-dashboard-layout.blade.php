<main class="container page dashboard">
    <div class="user-dashboard-container">
        <aside class="user-dashboard-menu">
            <div class="menu-header">
                <h3>Welkom, {{ $user->first_name }}</h3>
            </div>
            <nav class="menu-list">
                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-gauge"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('editProfile') }}"
                            class="menu-item {{ request()->routeIs('editProfile') ? 'active' : '' }}">
                            <i class="fa-solid fa-user"></i>
                            <span>Mijn Profiel</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('showMyOrders') }}"
                            class="menu-item {{ request()->routeIs('showMyOrders') || request()->routeIs('showMyOrder') ? 'active' : '' }}">
                            <i class="fa-solid fa-box"></i>
                            <span>Mijn Bestellingen</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-item">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Uitloggen</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="user-dashboard-content">
            <div class="content-wrapper">
                {{ $slot }}
            </div>
        </div>
    </div>
</main>