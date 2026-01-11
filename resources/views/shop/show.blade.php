<x-layout>
    @push('head')
        {!! seo($product) !!}
    @endpush
    <main class="container page product">
        <x-breadcrumbs :items="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Winkel', 'url' => route('shop')],
            ['label' => $product->title, 'url' => ''],
        ]" />

        <div class="product-detail">
            @if ($product)
                <livewire:product-detail :product="$product" />
            @else
                <p>Geen product gevonden</p>
            @endif
        </div>
    </main>
</x-layout>

