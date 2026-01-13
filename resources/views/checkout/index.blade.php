<x-layout>
    <main class="container page checkout">
        <h2 class="checkout-page-title">Afrekenen</h2>

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

        @if ($errors->has('stock'))
            <div class="alert alert-error">
                <div>
                    <div>
                        <a style="text-decoration: none" href="{{ route('cartPage') }}">← Terug naar winkelmand</a>
                    </div>
                    {!! $errors->first('stock') !!}
                </div>
                <button type="button" class="alert-close"
                    onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        <form class="form checkout" action="{{ route('storeCheckout') }}" method="POST">
            @csrf
            <div class="checkout-grid">

                <div>
                    <div class="item customer-details checkout-card">
                        <h3 class="checkout-section-title">Factuurgegevens</h3>

                        @auth
                            <div>
                                <p>Je bent ingelogd als <strong>{{ auth()->user()->email }}</strong>.</p>
                            </div>
                        @else
                            <div>
                                <p>Je rekent af als gast.</p>
                            </div>
                        @endauth

                        <div class="form-input">
                            <label for="billing_email">E-mailadres</label>
                            <input type="email" name="billing_email" autocomplete="email"
                                value="{{ old('billing_email', auth()->check() ? auth()->user()->email : '') }}">
                            @error('billing_email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="name-box">
                            <div class="form-input">
                                <label for="billing_first_name">Voornaam</label>
                                <input type="text" name="billing_first_name" autocomplete="given-name"
                                    value="{{ old('billing_first_name') }}">
                                @error('billing_first_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="billing_last_name">Achternaam</label>
                                <input type="text" name="billing_last_name" autocomplete="family-name"
                                    value="{{ old('billing_last_name') }}">
                                @error('billing_last_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="street-box">
                            <div class="form-input street">
                                <label for="billing_street">Straatnaam</label>
                                <input type="text" name="billing_street" autocomplete="address-line1"
                                    value="{{ old('billing_street') }}">
                                @error('billing_street')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="housnumber-box">
                                <div class="form-input">
                                    <label for="billing_house_number">Huisnummer</label>
                                    <input type="number" name="billing_house_number" autocomplete="address-line2"
                                        value="{{ old('billing_house_number') }}">
                                    @error('billing_house_number')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="billing_house_number-add">Toevoeging</label>
                                    <input type="text" name="billing_house_number-add" autocomplete="address-line2"
                                        value="{{ old('billing_house_number-add') }}">
                                    @error('billing_house_number-add')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-input">
                            <label for="billing_postal_code">Postcode</label>
                            <input type="text" name="billing_postal_code" autocomplete="postal-code"
                                value="{{ old('billing_postal_code') }}">
                            @error('billing_postal_code')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_city">Plaats</label>
                            <input type="text" name="billing_city" autocomplete="address-level2"
                                value="{{ old('billing_city') }}">
                            @error('billing_city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_phone">Telefoonnummer</label>
                            <input type="text" name="billing_phone" autocomplete="tel"
                                value="{{ old('billing_phone') }}">
                            @error('billing_phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_company">Bedrijfsnaam (optioneel)</label>
                            <input type="text" name="billing_company" autocomplete="organization"
                                value="{{ old('billing_company') }}">
                            @error('billing_company')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="billing_country">Land</label>
                            <select name="billing_country" autocomplete="country">
                                <option value="NL" {{ old('billing_country') == 'nl' ? 'selected' : '' }}>
                                    Nederland
                                </option>
                                <option value="BE" {{ old('billing_country') == 'be' ? 'selected' : '' }}>België
                                </option>
                            </select>
                            @error('billing_country')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input alt-shipping">
                            <label for="alt-shipping">Verzenden naar een ander adres?</label>
                            <input type="checkbox" name="alt-shipping" id="alt-shipping"
                                {{ old('alt-shipping') ? 'checked' : '' }}>
                        </div>


                        <div style="height: 0px; margin-bottom: 0" class="form-input myparcel_choice"
                            style="visibility: hidden">
                            <input style="height: 0px" type="radio" checked name="myparcel_choice"
                                value="with_myparcel" id="with_myparcel">
                        </div>

                    </div>

                    <div class="item customer-details alternate checkout-card" id="shipping-fields">
                        <h3 class="checkout-section-title">Alternatief verzendadres</h3>

                        <div class="name-box">
                            <div class="form-input">
                                <label for="shipping_first_name">Voornaam</label>
                                <input type="text" name="shipping_first_name" autocomplete="shipping given-name"
                                    value="{{ old('shipping_first_name') }}">
                                @error('shipping_first_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="shipping_last_name">Achternaam</label>
                                <input type="text" name="shipping_last_name" autocomplete="shipping family-name"
                                    value="{{ old('shipping_last_name') }}">
                                @error('shipping_last_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="street-box">
                            <div class="form-input street">
                                <label for="shipping_street">Straatnaam</label>
                                <input type="text" name="shipping_street" autocomplete="shipping address-line1"
                                    value="{{ old('shipping_street') }}">
                                @error('shipping_street')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="housnumber-box">
                                <div class="form-input">
                                    <label for="shipping_house_number">Huisnummer</label>
                                    <input type="number" name="shipping_house_number"
                                        autocomplete="shipping address-line2"
                                        value="{{ old('shipping_house_number') }}">
                                    @error('shipping_house_number')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="shipping_house_number-add">Toevoeging</label>
                                    <input type="text" name="shipping_house_number-add"
                                        value="{{ old('shipping_house_number-add') }}">
                                    @error('shipping_house_number-add')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-input">
                            <label for="shipping_postal_code">Postcode</label>
                            <input type="text" name="shipping_postal_code" autocomplete="shipping postal-code"
                                value="{{ old('shipping_postal_code') }}">
                            @error('shipping_postal_code')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_city">Plaats</label>
                            <input type="text" name="shipping_city" autocomplete="shipping address-level2"
                                value="{{ old('shipping_city') }}">
                            @error('shipping_city')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_phone">Telefoonnummer</label>
                            <input type="text" name="shipping_phone" autocomplete="shipping tel"
                                value="{{ old('shipping_phone') }}">
                            @error('shipping_phone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_company">Bedrijfsnaam (optioneel)</label>
                            <input type="text" name="shipping_company" autocomplete="shipping organization"
                                value="{{ old('shipping_company') }}">
                            @error('shipping_company')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input">
                            <label for="shipping_country">Land</label>
                            <select name="shipping_country" autocomplete="shipping country">
                                <option value="NL">Nederland</option>
                                <option value="BE">België</option>
                            </select>
                            @error('shipping_country')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="item order-details checkout-card">
                    <p class="back-to-cart"><a href="{{ route('cartPage') }}">← Terug naar winkelmand</a></p>

                    <h3 class="checkout-section-title">Bestelling</h3>

                    <div class="form-input">
                        <div style="display: flex;flex-direction: column">
                            <input style="width: fit-content; margin-bottom: 10px" type="text"
                                name="discount_code" id="discount_code" value="{{ old('discount_code') }}"
                                placeholder="Vul kortingscode in">
                            <button id="add_discount_code" style="height: 32px" class="btn small"><span
                                    class="loader" style="display:none"></span>Kortingscode toepassen</button>
                        </div>
                        @error('discount_code')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <table class="order-table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th style="text-align:right">Subtotaal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr>
                                    <td>{{ $item['quantity'] }} &times; {{ $item['name'] }}</td>
                                    <td style="text-align:right">&euro;
                                        {{ number_format($item['subtotal'] ?? $item['price'] * $item['quantity'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align:right; border:none;">
                                    <span id="shipping-cost" style="font-weight:normal;"></span>
                                </td>
                            </tr>
                            <tr class="total-price" id="total-row">
                                <td><strong>Totaal</strong></td>
                                <td style="text-align:right">
                                    <strong id="order-total"
                                        data-subtotal="{{ collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']) }}">&euro;
                                        {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']), 2, ',', '.') }}</strong>
                                </td>
                            </tr>
                            <tr id="discount-row" style="display:none">
                                <td><span>Korting</span> <span id="discount-code-label"
                                        style="font-size:12px;color:#666;"></span></td>
                                <td style="text-align:right;color:#b30000;">-<span id="discount-amount">0,00</span>
                                </td>
                            </tr>
                            <tr id="new-total-row" style="display:none">
                                <td><strong>Totaal na korting</strong></td>
                                <td style="text-align:right"><strong id="order-new-total">&euro; 0,00</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="remove-discount-container" style="display:none;margin-bottom:10px;">
                        <button type="button" id="remove_discount_code" class="btn small"
                            style="background:#eee;color:#b30000;">Verwijder kortingscode</button>
                    </div>

                    <div id="myparcel-delivery-options"></div>

                    <div id="opening-hours" class="pickup-opening-hours"></div>

                    <input type="hidden" name="myparcel_delivery_options" id="myparcel_delivery_options" />

                    @guest
                        <div class="checkout-create-account">
                            <div class="form-input customer-account">
                                <p>
                                    <b>Nog geen account? (optioneel)</b><br>
                                    Vul hieronder je gegevens en een wachtwoord in, we maken dan automatisch een account
                                    voor je aan.
                                    Heb je al een account? <a style="text-decoration: underline"
                                        href="{{ route('login') }}">Log dan in</a> om je eerdere bestellingen te bekijken.
                                </p>
                            </div>

                            <div class="create-account-box">
                                <div class="form-input">
                                    <label for="password">Wachtwoord</label>
                                    <input type="password" name="password">
                                    @error('password')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <label for="password_confirmation">Bevestig wachtwoord</label>
                                    <input type="password" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    @endguest

                    <div class="place-order">
                        @error('myparcel_delivery_options')
                            <div class="error" style="color:#b30000; margin-bottom:10px;">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn"><span class="loader"></span>Plaats bestelling</button>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <style>
        .checkout-page-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--main-font-color);
            margin-bottom: 2rem;
            font-family: var(--font-bold);
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
            margin-top: 1rem;
        }

        .checkout-card {
            background: #fff !important;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: var(--shadow-1);
            border: 1px solid var(--border-1);
            margin-bottom: 1.5rem;
            width: 100%;
        }

        .page.checkout .item.checkout-card {
            background: #fff !important;
        }

        .checkout-section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--main-font-color);
            margin: 0 0 2rem 0;
            font-family: var(--font-bold);
        }

        .checkout-card .form-input {
            margin-bottom: 1.25rem;
        }

        .checkout-card .form-input label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--main-font-color);
            margin-bottom: 0.5rem;
        }

        .checkout-card .form-input input,
        .checkout-card .form-input select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-1);
            border-radius: 6px;
            font-size: 16px;
            font-family: var(--font-regular);
            color: var(--main-font-color);
            background: var(--surface-2);
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }

        .checkout-card .form-input input:focus,
        .checkout-card .form-input select:focus {
            outline: none;
            border-color: var(--main-color);
            box-shadow: 0 0 0 3px rgba(171, 15, 20, 0.1);
        }

        .checkout-card .form-input .error {
            font-size: 13px;
            color: var(--red-1);
            margin-top: 0.5rem;
        }

        .name-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .street-box {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1rem;
        }

        .housnumber-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
        }

        .form-input.alt-shipping {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-1);
        }

        .form-input.alt-shipping label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .form-input.alt-shipping input[type="checkbox"] {
            width: auto;
            accent-color: var(--main-color);
        }

        .item.alternate {
            display: none;
        }

        .item.alternate.show {
            display: block;
        }

        .back-to-cart {
            margin-bottom: 1rem;
        }

        .back-to-cart a {
            color: var(--main-font-color);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .back-to-cart a:hover {
            color: var(--main-color);
            text-decoration: underline;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .order-table thead {
            border-bottom: 2px solid var(--border-1);
        }

        .order-table thead tr {
            background: var(--ink-1) !important;
        }

        .order-table th {
            text-align: left;
            padding: 0.75rem 0;
            font-weight: 600;
            color: #fff !important;
            font-size: 14px;
            background: var(--ink-1) !important;
        }

        .order-table th:last-child {
            text-align: right;
        }

        .order-table tbody tr {
            border-bottom: 1px solid var(--border-2);
        }

        .order-table tbody td {
            padding: 0.75rem 0;
            font-size: 14px;
            color: var(--main-font-color);
        }

        .order-table tbody td:last-child {
            text-align: right;
        }

        .order-table tfoot tr {
            border-top: 2px solid var(--border-1);
        }

        .order-table tfoot td {
            padding: 1rem 0;
            font-size: 16px;
        }

        .order-table .total-price td {
            font-size: 18px;
            font-weight: 600;
            color: var(--main-font-color);
            padding-top: 1rem;
        }

        .form-input #discount_code {
            width: 100%;
            max-width: 250px;
            margin-bottom: 0.75rem;
        }

        #add_discount_code {
            padding: 10px 20px;
            background: var(--main-color);
            color: var(--surface-2);
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            width: fit-content;
        }

        #add_discount_code:hover {
            background: var(--main-font-color);
        }

        #remove_discount_code {
            padding: 8px 16px;
            background: #eee;
            color: var(--red-1);
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s;
        }

        #remove_discount_code:hover {
            background: #ddd;
        }

        .checkout-create-account {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-1);
        }

        .checkout-create-account p {
            font-size: 14px;
            color: var(--main-font-color);
            margin-bottom: 1rem;
        }

        .checkout-create-account a {
            color: var(--main-color);
            text-decoration: underline;
        }

        .create-account-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .place-order {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid var(--border-1);
        }

        .place-order .btn {
            width: 100%;
            padding: 14px 24px;
            background: var(--green-2);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .place-order .btn:hover {
            background: #1a3028;
        }

        .alert {
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .alert-success {
            background: var(--success-bg);
            color: var(--success-text);
            border: 1px solid var(--success-border);
        }

        .alert-error {
            background: #fee;
            color: var(--red-1);
            border: 1px solid #fcc;
        }

        .alert-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
            transition: opacity 0.2s;
            padding: 0;
            margin-left: 12px;
        }

        .alert-close:hover {
            opacity: 1;
        }

        @media (max-width: 1024px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .checkout-page-title {
                font-size: 24px;
            }

            .checkout-card {
                padding: 1.5rem;
            }

            .name-box,
            .street-box,
            .create-account-box {
                grid-template-columns: 1fr;
            }

            .housnumber-box {
                grid-template-columns: 2fr 1fr;
            }
        }
    </style>

    <script>
        // Toggle alternate shipping address
        document.addEventListener('DOMContentLoaded', function() {
            const altShippingCheckbox = document.getElementById('alt-shipping');
            const shippingFields = document.getElementById('shipping-fields');

            if (altShippingCheckbox && shippingFields) {
                altShippingCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        shippingFields.classList.add('show');
                    } else {
                        shippingFields.classList.remove('show');
                    }
                });

                // Check on page load if checkbox is checked
                if (altShippingCheckbox.checked) {
                    shippingFields.classList.add('show');
                }
            }
        });
    </script>

</x-layout>
