@if(auth()->user()->role === 'user')
    <x-layout>
        <main class="container page user-dashboard">
            <x-breadcrumbs :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Dashboard', 'url' => route('dashboard')]
            ]" />

            <div class="dashboard-header">
                <h1 class="dashboard-title font-herina">Mijn Dashboard</h1>
                <p class="dashboard-subtitle">Welkom terug, {{ auth()->user()->first_name }}! Beheer hier je profiel en bestellingen.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            @endif

            <x-user-dashboard-layout>
                @livewire('user-dashboard')
            </x-user-dashboard-layout>
        </main>
        <div class="gradient-border"></div>
        <x-footer></x-footer>
    </x-layout>
@else
    <x-dashboard-layout>
        <main class="container page dashboard">
            <h2>Dashboard</h2>
            <h3>Welkom, {{ $user->first_name }}</h3>
            @if(session('success'))
                <div class="alert alert-success" style="position: relative;">
                    {{ session('success') }}
                    <button type="button" class="alert-close"
                        onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            @endif
        </main>
    </x-dashboard-layout>
@endif
