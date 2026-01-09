@if(auth()->user()->role === 'user')
    <x-layout>
        @if(session('success'))
            <div class="alert alert-success" style="position: relative;">
                {{ session('success') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif
        <x-user-dashboard-layout>
            @livewire('user-dashboard')
        </x-user-dashboard-layout>
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