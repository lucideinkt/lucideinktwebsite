<x-layout>
    <main class="container page shop">
        {{-- <h2>Winkel</h2> --}}
        @if (session('success'))
            <div class="alert alert-success" style="position: relative;">
                {{ session('success') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error" style="position: relative;">
                {{ session('error') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Winkel', 'url' => route('shop')],
        ]" />

        <div class="book-box product-cards-grid">
            @foreach ($products as $product)
                @livewire('product-card', ['product' => $product], key('product-' . $product->id))
            @endforeach
        </div>

    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
