<x-dashboard-layout>
@push('head')
  <script src="https://cdn.jsdelivr.net/npm/vue@3.4"></script>
  <script src="https://cdn.jsdelivr.net/npm/@myparcel/delivery-options@6/dist/myparcel.lib.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@myparcel/delivery-options@6/dist/style.css" />
@endpush

<style>
  /* Alt shipping panel: hidden until JS adds .open */
  .customer-details.alternate { display: none; }
  .customer-details.alternate.open { display: block; }
</style>

<nav class="flex mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="{{ route('orderIndex') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
        <svg class="w-3 h-3 me-2.5" fill="currentColor" viewBox="0 0 20 20"><path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/></svg>
        Bestellingen
      </a>
    </li>
    <li aria-current="page">
      <div class="flex items-center">
        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Bestelling aanmaken</span>
      </div>
    </li>
  </ol>
</nav>

@if(session('success'))
<div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
  <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
  <span class="ms-2 text-sm font-medium">{{ session('success') }}</span>
  <button type="button" onclick="document.getElementById('alert-success').remove()" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700">
    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
  </button>
</div>
@endif

@if($errors->has('stock'))
<div class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
  <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
  <span class="ms-2 text-sm font-medium">{!! $errors->first('stock') !!}</span>
</div>
@endif

@if($errors->has('items'))
<div class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
  <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
  <span class="ms-2 text-sm font-medium">{{ $errors->first('items') }}</span>
</div>
@endif

<form action="{{ route('orderStore') }}" method="POST">
  @csrf

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- ─── LEFT: Products + Discount ─── --}}
    <div class="lg:col-span-2 space-y-4">

      {{-- Producten --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
          <div class="flex items-center justify-between mb-3">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Producten toevoegen</h2>
            <span id="total-price" class="text-sm font-bold text-primary-600 dark:text-primary-400"></span>
          </div>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
            </div>
            <input type="text" id="product-search"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-9 p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              placeholder="Filter producten...">
          </div>
        </div>
        <div id="product-list" class="divide-y divide-gray-100 dark:divide-gray-700 max-h-[440px] overflow-y-auto">
          @foreach ($products as $product)
          @php $inputName = "items.{$product->id}.qty"; @endphp
          <div class="product-row flex items-center justify-between px-4 py-2.5 hover:bg-gray-50 dark:hover:bg-gray-700/40" data-name="{{ strtolower($product->title) }}">
            <div class="flex-1 min-w-0 mr-3">
              <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $product->title }}</p>
              <p class="text-xs text-gray-400 dark:text-gray-500">€ {{ number_format($product->price, 2, ',', '.') }}</p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
              <span class="text-xs font-medium text-primary-600 dark:text-primary-400 w-16 text-right tabular-nums" id="sub-item-price-{{ $product->id }}"></span>
              <input
                type="number"
                name="items[{{ $product->id }}][qty]"
                id="product_{{ $product->id }}"
                value="{{ old($inputName, 0) }}"
                min="0"
                class="qty-input w-20 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2 text-center dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                data-price="{{ $product->price }}"
                data-id="{{ $product->id }}"
              >
            </div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Korting --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-base font-semibold text-gray-900 dark:text-white">Korting</h2>
        </div>
        <div class="p-4">
          @php
            $resetDiscount = !$errors->any() && !old('discount_value') && !old('discount_type');
            $discountValue = $resetDiscount ? 0 : old('discount_value', session('discount_value', 0));
            $discountType  = $resetDiscount ? 'amount' : old('discount_type', session('discount_type', 'amount'));
          @endphp
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label for="discount_value" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Kortingswaarde</label>
              <input type="number" step="0.01" min="0" id="discount_value" name="discount_value" value="{{ $discountValue }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="0.00">
            </div>
            <div>
              <label for="discount_type" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
              <select id="discount_type" name="discount_type"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="amount"  {{ $discountType==='amount'  ? 'selected' : '' }}>Bedrag (€)</option>
                <option value="percent" {{ $discountType==='percent' ? 'selected' : '' }}>Percentage (%)</option>
              </select>
            </div>
          </div>
          <div id="discounted-total" class="mt-3 text-sm font-medium text-primary-600 dark:text-primary-400"></div>
        </div>
      </div>

    </div>

    {{-- ─── RIGHT: Billing + Alt Shipping + MyParcel + Submit ─── --}}
    <div class="space-y-4">

      {{-- Factuurgegevens --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-base font-semibold text-gray-900 dark:text-white">Factuurgegevens</h2>
        </div>
        <div class="p-4 space-y-3">

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">E-mailadres</label>
            <input type="email" name="billing_email" autocomplete="email" value="{{ old('billing_email') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_email') border-red-500 @enderror">
            @error('billing_email')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
          </div>

          <div class="grid grid-cols-2 gap-2">
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Voornaam</label>
              <input type="text" name="billing_first_name" autocomplete="given-name" value="{{ old('billing_first_name') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_first_name') border-red-500 @enderror">
              @error('billing_first_name')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Achternaam</label>
              <input type="text" name="billing_last_name" autocomplete="family-name" value="{{ old('billing_last_name') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_last_name') border-red-500 @enderror">
              @error('billing_last_name')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
          </div>

          <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Straatnaam</label>
              <input type="text" name="billing_street" autocomplete="address-line1" value="{{ old('billing_street') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_street') border-red-500 @enderror">
              @error('billing_street')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Nr.</label>
              <input type="number" name="billing_house_number" autocomplete="address-line2" value="{{ old('billing_house_number') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_house_number') border-red-500 @enderror">
              @error('billing_house_number')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
          </div>

          <div class="grid grid-cols-2 gap-2">
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Toevoeging</label>
              <input type="text" name="billing_house_number-add" autocomplete="address-line2" value="{{ old('billing_house_number-add') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Postcode</label>
              <input type="text" name="billing_postal_code" autocomplete="postal-code" value="{{ old('billing_postal_code') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_postal_code') border-red-500 @enderror">
              @error('billing_postal_code')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Plaats</label>
            <input type="text" name="billing_city" autocomplete="address-level2" value="{{ old('billing_city') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('billing_city') border-red-500 @enderror">
            @error('billing_city')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Land</label>
            <select name="billing_country" autocomplete="country"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              <option value="NL" {{ old('billing_country')=='NL' ? 'selected' : '' }}>Nederland</option>
              <option value="BE" {{ old('billing_country')=='BE' ? 'selected' : '' }}>België</option>
            </select>
            @error('billing_country')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Telefoonnummer</label>
            <input type="text" name="billing_phone" autocomplete="tel" value="{{ old('billing_phone') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('phone')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Bedrijfsnaam <span class="text-gray-400 font-normal">(optioneel)</span></label>
            <input type="text" name="billing_company" autocomplete="organization" value="{{ old('billing_company') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          </div>

        </div>
      </div>

      {{-- Alternatief verzendadres --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4">
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="alt-shipping" id="alt-shipping"
              class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Alternatief verzendadres gebruiken</span>
          </label>
        </div>
        {{-- KEEP .customer-details.alternate — JS uses this selector --}}
        <div class="customer-details alternate border-t border-gray-200 dark:border-gray-700 p-4 space-y-3">

          <div class="grid grid-cols-2 gap-2">
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Voornaam</label>
              <input type="text" name="shipping_first_name" autocomplete="shipping given-name" value="{{ old('shipping_first_name') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              @error('shipping_first_name')<p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Achternaam</label>
              <input type="text" name="shipping_last_name" autocomplete="shipping family-name" value="{{ old('shipping_last_name') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
          </div>

          <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Straatnaam</label>
              <input type="text" name="shipping_street" autocomplete="shipping address-line1" value="{{ old('shipping_street') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Nr.</label>
              <input type="number" name="shipping_house_number" autocomplete="shipping address-line2" value="{{ old('shipping_house_number') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
          </div>

          <div class="grid grid-cols-2 gap-2">
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Toevoeging</label>
              <input type="text" name="shipping_house_number-add" value="{{ old('shipping_house_number-add') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
              <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Postcode</label>
              <input type="text" name="shipping_postal_code" autocomplete="shipping postal-code" value="{{ old('shipping_postal_code') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Plaats</label>
            <input type="text" name="shipping_city" autocomplete="shipping address-level2" value="{{ old('shipping_city') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Land</label>
            <select name="shipping_country" autocomplete="country"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              <option value="NL" {{ old('shipping_country')=='NL' ? 'selected' : '' }}>Nederland</option>
              <option value="BE" {{ old('shipping_country')=='BE' ? 'selected' : '' }}>België</option>
            </select>
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Telefoonnummer</label>
            <input type="text" name="shipping_phone" autocomplete="shipping tel" value="{{ old('shipping_phone') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Bedrijfsnaam <span class="text-gray-400 font-normal">(optioneel)</span></label>
            <input type="text" name="shipping_company" autocomplete="shipping organization" value="{{ old('shipping_company') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          </div>

        </div>
      </div>

      {{-- Verzending (MyParcel) --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-base font-semibold text-gray-900 dark:text-white">Verzending</h2>
        </div>
        <div class="p-4 space-y-3">
          <div class="flex gap-4">
            <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700 dark:text-gray-300">
              <input type="radio" name="myparcel_choice" value="without_myparcel" id="without_myparcel" checked
                class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
              Zonder MyParcel
            </label>
            <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700 dark:text-gray-300">
              <input type="radio" name="myparcel_choice" value="with_myparcel" id="with_myparcel"
                class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
              Met MyParcel
            </label>
          </div>
          <div id="myparcel-delivery-options"></div>
          <input type="hidden" name="myparcel_delivery_options" id="myparcel_delivery_options">
        </div>
      </div>

      {{-- Submit --}}
      <button type="submit"
        class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 flex items-center justify-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        Bestelling plaatsen
      </button>

    </div>

  </div>
</form>

<script>
// Live product search/filter
const productSearch = document.getElementById('product-search');
if (productSearch) {
    productSearch.addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();
        document.querySelectorAll('#product-list .product-row').forEach(row => {
            row.style.display = (!q || row.dataset.name.includes(q)) ? '' : 'none';
        });
    });
}
</script>

</x-dashboard-layout>
