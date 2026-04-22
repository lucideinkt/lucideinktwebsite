<x-layout>
    <div class="page-normal-background">
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
        <div class="gradient-border"></div>
        <x-footer></x-footer>
        </div>
</x-layout>

