<div class="user-dashboard-container">
    <nav class="user-dashboard-nav">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}"
                    class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge"></i>
                    <span>Overzicht</span>
                </a>
            </li>
            <li>
                <a href="{{ route('editProfile') }}"
                    class="nav-item {{ request()->routeIs('editProfile') ? 'active' : '' }}">
                    <i class="fa-solid fa-user"></i>
                    <span>Mijn Profiel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('showMyOrders') }}"
                    class="nav-item {{ request()->routeIs('showMyOrders') || request()->routeIs('showMyOrder') ? 'active' : '' }}">
                    <i class="fa-solid fa-box"></i>
                    <span>Bestellingen</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Uitloggen</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="user-dashboard-content">
        {{ $slot }}
    </div>
</div>
