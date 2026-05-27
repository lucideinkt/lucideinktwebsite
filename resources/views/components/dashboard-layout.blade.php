<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    @if(app()->environment('staging'))
      Staging | @hasSection('title')@yield('title')@else Dashboard @endif
    @else
      Lucide Inkt | @hasSection('title')@yield('title')@else Dashboard @endif
    @endif
  </title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  @stack('head')
  @vite(['resources/js/dashboard.js', 'resources/css/dashboard-style.css'])
</head>

<script>if(localStorage.getItem('dashboard-theme')==='dark')document.documentElement.classList.add('dark');</script>
<body class="antialiased bg-gray-50 dark:bg-gray-900">

  {{-- ===================== TOP NAVBAR ===================== --}}
  <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">

        <div class="flex items-center justify-start">
          {{-- Mobile sidebar toggle --}}
          <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
            type="button"
            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
              <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" />
            </svg>
          </button>
          {{-- Logo --}}
          <a href="{{ route('home') }}" class="flex ms-2 md:me-24">
            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Lucide Inkt</span>
          </a>
        </div>

        {{-- Search --}}
        <div class="hidden lg:flex flex-1 mx-6">
          <div class="relative w-full max-w-xl">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
              </svg>
            </div>
            <input type="search" placeholder="Zoeken..."
              class="block w-full pl-10 pr-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
          </div>
        </div>

        {{-- Right side --}}
        <div class="flex items-center gap-3">
          {{-- Dark mode toggle --}}
          <button onclick="toggleDashboardTheme()"
            class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
            {{-- Moon: shown in light mode --}}
            <svg id="theme-icon-moon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            {{-- Sun: shown in dark mode --}}
            <svg id="theme-icon-sun" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
            </svg>
          </button>
          {{-- Cart --}}
          <a href="{{ route('cartPage') }}" class="relative p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
            <i class="fa-solid fa-cart-shopping text-lg"></i>
            @if(session('cart') && count(session('cart')))
              <span class="absolute top-1 right-1 w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full flex items-center justify-center">
                {{ collect(session('cart'))->sum('quantity') }}
              </span>
            @endif
          </a>

          {{-- User dropdown --}}
          <div class="flex items-center">
            <button type="button" data-dropdown-toggle="dropdown-user"
              class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
              <span class="sr-only">Open user menu</span>
              <div class="relative w-8 h-8 overflow-hidden bg-blue-600 rounded-full flex items-center justify-center">
                <span class="text-sm font-semibold text-white">{{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}</span>
              </div>
            </button>
            <div id="dropdown-user"
              class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600">
              <div class="px-4 py-3">
                <p class="text-sm text-gray-900 dark:text-white">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300">{{ auth()->user()->email }}</p>
              </div>
              <ul class="py-1">
                <li>
                  <a href="{{ route('editProfile') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Mijn profiel</a>
                </li>
                <li>
                  <a href="{{ route('showMyOrders') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">Mijn bestellingen</a>
                </li>
              </ul>
              <ul class="py-1">
                <li>
                  @auth
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                      class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                      Uitloggen
                    </button>
                  </form>
                  @endauth
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </nav>

  {{-- ===================== SIDEBAR ===================== --}}
  <aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">

        @anyrole('admin', 'user')
        <li>
          <a href="{{ route('dashboard') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-gauge text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Dashboard</span>
          </a>
        </li>
        @endanyrole

        @role('admin')
        <li class="pt-4 pb-1">
          <span class="text-xs font-semibold text-gray-400 uppercase dark:text-gray-500 px-2">Beheer</span>
        </li>
        <li>
          <a href="{{ route('productIndex') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('productIndex') || request()->routeIs('productCreatePage') || request()->routeIs('productEditPage') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-box-open text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Producten</span>
          </a>
        </li>
        <li>
          <a href="{{ route('bookContent.index') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('bookContent.index') || request()->routeIs('bookContent.edit') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-book text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Book Content</span>
          </a>
        </li>
        <li>
          <a href="{{ route('productCategoryIndex') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('productCategoryIndex') || request()->routeIs('productCategoryCreatePage') || request()->routeIs('productCategoryEditPage') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-tags text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Productcategorieën</span>
          </a>
        </li>
        <li>
          <a href="{{ route('orderIndex') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('orderIndex') || request()->routeIs('orderShow') || request()->routeIs('orderCreatePage') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-bag-shopping text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Bestellingen</span>
          </a>
        </li>
        <li>
          <a href="{{ route('discountIndex') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('discountIndex') || request()->routeIs('discountEdit') || request()->routeIs('discountCreate') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-percent text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Kortingscodes</span>
          </a>
        </li>
        <li>
          <a href="{{ route('shippingCostIndex') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('shippingCostIndex') || request()->routeIs('shippingCostCreatePage') || request()->routeIs('shippingCostEditPage') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-truck text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Verzendkosten</span>
          </a>
        </li>
        <li>
          <a href="{{ route('productCopyIndex') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('productCopyIndex') || request()->routeIs('productCopyEditPage') || request()->routeIs('productCopyCreatePage') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-copy text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Productexemplaren</span>
          </a>
        </li>
        <li>
          <a href="{{ route('customerIndex') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('customerIndex') || request()->routeIs('customerShow') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-users text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Klanten</span>
          </a>
        </li>
        <li>
          <a href="{{ route('userIndex') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('userIndex') || request()->routeIs('userShow') || request()->routeIs('userCreate') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-user-gear text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Gebruikers</span>
          </a>
        </li>

        <li class="pt-4 pb-1">
          <span class="text-xs font-semibold text-gray-400 uppercase dark:text-gray-500 px-2">Communicatie</span>
        </li>
        <li>
          <a href="{{ route('admin.newsletter.index') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('admin.newsletter.*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-envelope text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Abonnees</span>
          </a>
        </li>
        <li>
          <a href="{{ route('newsletter.campaigns.index') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('newsletter.campaigns.*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-newspaper text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Nieuwsbrieven</span>
          </a>
        </li>

        <li class="pt-4 pb-1">
          <span class="text-xs font-semibold text-gray-400 uppercase dark:text-gray-500 px-2">Analyse</span>
        </li>
        <li>
          <a href="{{ route('admin.analytics') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('admin.analytics') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-chart-line text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Statistieken</span>
          </a>
        </li>

        <li class="pt-2 border-t border-gray-200 dark:border-gray-700 mt-2">
          <a href="{{ route('admin.settings') }}"
            class="flex items-center p-2 rounded-lg group {{ request()->routeIs('admin.settings*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
            <i class="fa-solid fa-sliders text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 text-center"></i>
            <span class="ms-3">Site-instellingen</span>
            @if(\App\Services\SiteSettingService::isMaintenanceMode())
              <span class="ms-auto inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">Onderhoud</span>
            @endif
          </a>
        </li>
        @endrole

      </ul>
    </div>
  </aside>

  {{-- ===================== MAIN CONTENT ===================== --}}
  <div class="sm:ml-64">
    <div class="p-4 mt-14">
      {{ $slot }}
    </div>
  </div>

  @stack('scripts')

</body>
</html>
