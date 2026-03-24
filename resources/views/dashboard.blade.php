@if(auth()->user()->role === 'user')
    <x-layout>
        <div class="page-normal-background">
        <main class="container page user-dashboard">
            <x-breadcrumbs :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Dashboard', 'url' => route('dashboard')]
            ]" />

            <div class="dashboard-header">
                <h1 class="dashboard-title font-herina">Mijn Dashboard</h1>
                <p class="dashboard-subtitle">Welkom terug, {{ auth()->user()->first_name }}!</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
                    <span class="alert-text">{{ session('success') }}</span>
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">×</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                    <span class="alert-text">{{ session('error') }}</span>
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">×</button>
                </div>
            @endif

            <x-user-dashboard-layout>
                @livewire('user-dashboard')
            </x-user-dashboard-layout>
        </main>
        <div class="gradient-border"></div>
        <x-footer></x-footer>
        </div>
    </x-layout>
@else
    <x-dashboard-layout>
        <main class="container page dashboard">
            <h2>Dashboard</h2>
            <h3>Welkom, {{ $user->first_name }}</h3>
            @if(session('success'))
                <div class="alert alert-success" style="position: relative;">
                    <span class="alert-icon"><i class="fa-solid fa-circle-check"></i></span>
                    <span class="alert-text">{{ session('success') }}</span>
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">×</button>
                </div>
            @endif
        </main>
    </x-dashboard-layout>
@endif
