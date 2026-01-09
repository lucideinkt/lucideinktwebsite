<ul>
    <li class="nav-item">
        <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><span class="first-letter">H</span>OME</a>
    </li>
    <li class="nav-item">
        <a class="{{ request()->routeIs('risale') ? 'active' : '' }}" href="{{ route('risale') }}"><span class="first-letter">R</span>İSALE-İ NUR</a>
    </li>
    <li class="nav-item">
        <a class="{{ request()->routeIs('saidnursi') ? 'active' : '' }}"  href="{{ route("saidnursi")  }}"><span class="first-letter">S</span>AİD NURSÎ</a>
    </li>
    <li class="nav-item">
        <a class="{{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}"><span class="first-letter">W</span>INKEL</a>
    </li>
    <li class="nav-item">
        <a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route("contact") }}"><span class="first-letter">C</span>ONTACT</a>
    </li>

    @guest
    <li class="nav-item">
        <a class="{{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route("login") }}"><i class="fa-solid fa-user"></i></a>
    </li>
    @endguest


    <li class="nav-item cart">
        <a href="{{ route('cartPage') }}"><i
            class="fa-solid fa-cart-shopping"></i>
        @if(session('cart') && count(session('cart')))
        <span class="cart-quantity">
            {{
            collect(session('cart'))->sum('quantity')
            }}
        </span>
        @endif
        </a>
    </li>

    @auth
    <li class="nav-item" style="margin-right: 20px;">
        <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route("dashboard") }}"><span class="first-letter">D</span>ASHBOARD</a>
    </li>
    @endauth
</ul>

