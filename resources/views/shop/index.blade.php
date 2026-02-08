<x-layout>
    <main class="container page shop">
        {{-- <h2>Winkel</h2> --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        <x-breadcrumbs :items="[
          ['label' => 'Home', 'url' => route('home')],
          ['label' => 'Winkel', 'url' => route('shop')],
        ]" />

        <div class="shop-header">
            <h1 class="shop-title">Onze Winkel</h1>
{{--            <p class="shop-subtitle">Ontdek onze collectie boeken en bestel direct online</p>--}}
        </div>

        <div class="book-box product-cards-grid">
            @foreach ($products as $product)
                @livewire('product-card', ['product' => $product], key('product-' . $product->id))
            @endforeach
        </div>

    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
</x-layout>
