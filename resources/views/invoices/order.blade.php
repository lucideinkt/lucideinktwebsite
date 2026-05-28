<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Factuur #{{ $order->id }}</title>
    <style>
        @page {
            margin: 12mm;
        }
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            background: #ffffff;
            color: #222;
            margin: 0;
            padding: 12px;
            font-size: 13px;
            line-height: 1.5;
        }
        .invoice-container {
            max-width: 100%;
            margin: 0 auto;
            background: #fff;
            padding: 0;
        }
        .header-border {
            background-color: #620505;
            height: 4px;
            margin-bottom: 12px;
        }
        .header-section {
            display: table;
            width: 100%;
            margin-bottom: 14px;
        }
        .header-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .header-right {
            display: table-cell;
            width: 50%;
            text-align: right;
            vertical-align: top;
        }
        h1 {
            color: #620505;
            font-size: 26px;
            margin: 0 0 6px 0;
            font-weight: 700;
            letter-spacing: 0.02em;
        }
        .meta {
            font-size: 13px;
            color: #555;
            line-height: 1.6;
        }
        .meta strong {
            color: #222;
            font-weight: 600;
        }
        .company-info {
            font-size: 12px;
            color: #555;
            line-height: 1.65;
        }
        .addresses-section {
            margin: 12px 0 14px;
            display: table;
            width: 100%;
        }
        .address-column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 8px;
        }
        .address-column:last-child {
            padding-right: 0;
            padding-left: 8px;
        }
        .address-box {
            padding: 10px 12px;
            font-size: 12px;
            background: #fafafa;
            border: 1px solid #ddd;
            border-radius: 5px;
            line-height: 1.7;
            min-height: 120px;
        }
        .address-box strong {
            font-size: 13px;
            color: #620505;
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            letter-spacing: 0.01em;
        }
        .address-company {
            font-weight: 700;
            font-size: 13px;
            color: #222;
            margin-bottom: 1px;
        }
        .address-contact {
            color: #555;
            font-size: 12px;
            margin-bottom: 3px;
        }
        .address-reg-block {
            margin: 5px 0 5px 0;
            padding: 4px 7px;
            background: #f0f0f0;
            border-left: 3px solid #c0392b;
            font-size: 11px;
            color: #444;
            line-height: 1.7;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
            font-size: 12px;
            border: 1px solid #ddd;
        }
        th, td {
            padding: 9px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background: #f5f5f5;
            color: #620505;
            font-weight: 700;
            font-size: 12px;
            border-bottom: 2px solid #ddd;
            letter-spacing: 0.02em;
        }
        tbody tr:last-child td {
            border-bottom: 1px solid #ddd;
        }
        tbody td {
            color: #333;
        }
        tfoot tr {
            background: #fafafa;
        }
        tfoot td {
            font-weight: 600;
            color: #444;
            border-bottom: 1px solid #eee;
            font-size: 12px;
            padding: 7px 10px;
        }
        tfoot tr:last-child {
            background: #f0f0f0;
        }
        tfoot tr:last-child td {
            font-weight: 700;
            font-size: 14px;
            color: #620505;
            border-bottom: none;
            padding: 10px;
        }
        .summary {
            margin-top: 12px;
            padding: 6px 0;
            background: none;
            border: none;
            border-radius: 0;
            font-size: 13px;
            color: #222;
            line-height: 1.65;
        }
        .summary strong {
            color: #222;
            font-weight: 700;
        }
        .summary.unpaid {
            background: #fffbea;
            border-left-color: #f59e0b;
            color: #92400e;
        }
        .summary.unpaid strong {
            color: #92400e;
            font-weight: 700;
        }
        .summary.unpaid span {
            color: #78350f;
            display: block;
            margin-top: 5px;
            font-size: 12px;
        }
        .payment-info {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #555;
            line-height: 1.7;
        }
        .footer-border {
            background-color: #620505;
            height: 4px;
            margin-top: 16px;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="header-border"></div>

    <div class="header-section">
        <div class="header-left">
            <h1>Factuur</h1>
            <div class="meta">
                <strong>Ordernummer:</strong> {{ $order->id }}<br>
                <strong>Datum:</strong> {{ $order->created_at->format('d-m-Y') }}
            </div>
        </div>
        <div class="header-right">
            <div class="company-info">
                Stichting Lucide Inkt<br>
                Kerspellaan 12<br>
                7824 JG Emmen<br>
                info@lucideinkt.nl<br>
                KvK: 54486890<br>
                IBAN: NL44 RABO 0142 3642 23<br>
                Factuur vrijgesteld van OB O.G.V. artikel 25 wet OB.
            </div>
        </div>
    </div>

    <div class="addresses-section">
        <div class="address-column">
            <div class="address-box">
                <strong>{{ __('Factuuradres') }}</strong>
                @if(!empty($order->customer->billing_company))
                    <div class="address-company">{{ $order->customer->billing_company }}</div>
                    <div class="address-contact">t.a.v. {{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</div>
                @else
                    <div class="address-company">{{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}</div>
                @endif
                {{ $order->customer->billing_street }} {{ $order->customer->billing_house_number }}{{ !empty($order->customer->billing_house_number_addition) ? ' ' . $order->customer->billing_house_number_addition : '' }}<br>
                {{ $order->customer->billing_postal_code }} {{ $order->customer->billing_city }}<br>
                {{ config('countries.' . $order->customer->billing_country) ?? $order->customer->billing_country }}<br>
                @if(!empty($order->customer->billing_phone))
                    Tel: {{ $order->customer->billing_phone }}<br>
                @endif
                Email: {{ $order->customer->billing_email }}
                @if(!empty($order->customer->btw_nummer) || !empty($order->customer->kvk_nummer) || !empty($order->customer->rsin_nummer))
                <div class="address-reg-block">
                    @if(!empty($order->customer->btw_nummer))
                        BTW-nr: {{ $order->customer->btw_nummer }}<br>
                    @endif
                    @if(!empty($order->customer->kvk_nummer))
                        KVK: {{ $order->customer->kvk_nummer }}<br>
                    @endif
                    @if(!empty($order->customer->rsin_nummer))
                        RSIN: {{ $order->customer->rsin_nummer }}<br>
                    @endif
                </div>
                @endif
            </div>
        </div>
        <div class="address-column">
            <div class="address-box">
                <strong>{{ __('Verzendadres') }}</strong>
                @if(!empty($order->shipping_street))
                    {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                    @if(!empty($order->shipping_company))
                        {{ $order->shipping_company }}<br>
                    @endif
                    {{ $order->shipping_street }} {{ $order->shipping_house_number }}{{ !empty($order->shipping_house_number_addition) ? ' ' . $order->shipping_house_number_addition : '' }}<br>
                    {{ $order->shipping_postal_code }} {{ $order->shipping_city }}<br>
                    {{ config('countries.' . $order->shipping_country) ?? $order->shipping_country }}<br>
                    @if(!empty($order->shipping_phone))
                        Tel: {{ $order->shipping_phone }}<br>
                    @endif
                @else
                    {{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}<br>
                    @if(!empty($order->customer->billing_company))
                        {{ $order->customer->billing_company }}<br>
                    @endif
                    {{ $order->customer->billing_street }} {{ $order->customer->billing_house_number }}{{ !empty($order->customer->billing_house_number_addition) ? ' ' . $order->customer->billing_house_number_addition : '' }}<br>
                    {{ $order->customer->billing_postal_code }} {{ $order->customer->billing_city }}<br>
                    {{ config('countries.' . $order->customer->billing_country) ?? $order->customer->billing_country }}<br>
                    @if(!empty($order->customer->billing_phone))
                        Tel: {{ $order->customer->billing_phone }}<br>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th style="text-align: center;">Aantal</th>
            <th style="text-align: right;">Stukprijs</th>
            <th style="text-align: right;">Subtotaal</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td style="text-align: right;">€ {{ number_format($item->unit_price, 2, ',', '.') }}</td>
                <td style="text-align: right;">€ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" style="text-align:right;">Totaal</td>
            <td style="text-align:right;">€ {{ number_format($order->total_before, 2, ',', '.') }}</td>
        </tr>
        @if(isset($order->discount_type) && $order->discount_price_total > 0)
            <tr>
                <td colspan="3" style="text-align:right;">Korting ({{ $order->discount_type === 'percent' ? intval($order->discount_value) . '%' : '€ ' . number_format($order->discount_value, 2, ',', '.') }})</td>
                <td style="text-align:right;">-€ {{ number_format($order->discount_price_total, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;">Totaal na korting</td>
                <td style="text-align:right;">€ {{ number_format($order->total, 2, ',', '.') }}</td>
            </tr>
        @endif
        @if(!empty($order->shipping_cost_amount) && $order->shipping_cost_amount > 0)
            <tr>
                <td colspan="3" style="text-align:right;">Verzendkosten</td>
                <td style="text-align:right;">€ {{ is_numeric($order->shipping_cost_amount) ? number_format($order->shipping_cost_amount, 2, ',', '.') : number_format((float)($order->shipping_cost_amount->amount ?? 0), 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;">Totaal incl. verzendkosten</td>
                <td style="text-align:right;">€ {{ number_format($order->total, 2, ',', '.') }}</td>
            </tr>
        @endif
        </tfoot>
    </table>

    @if ($order->payment_status == 'paid')
        <div class="summary">
            <strong>Factuur is betaald</strong>
        </div>
    @else
        <div class="summary unpaid">
            <strong>Te betalen:</strong> € {{ number_format($order->total, 2, ',', '.') }}<br>
            <span>Gelieve het bedrag over te maken naar rekening NL44 RABO 0142 3642 23 t.n.v. Stichting Lucide Inkt o.v.v. je ordernummer.</span>
        </div>
    @endif

    <div class="payment-info">
        Heb je vragen over deze factuur? Neem gerust contact op via info@lucideinkt.nl.<br>
        Dank voor je bestelling!
    </div>

    <div class="footer-border"></div>
</div>
</body>
</html>

