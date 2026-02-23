<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Factuur #{{ $order['id'] }}</title>
    <style>
        @page {
            margin: 20px;
        }
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            background: #ffffff;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .invoice-container {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            padding: 0;
        }
        .header-border {
            background-color: #224039;
            height: 2px;
            margin-bottom: 20px;
        }
        .header {
            margin-bottom: 25px;
            text-align: right;
        }
        .logo {
            height: 48px;
            margin-bottom: 15px;
        }
        .company-info {
            font-size: 12px;
            color: #666;
            line-height: 1.6;
        }
        h1 {
            color: #224039;
            font-size: 24px;
            margin: 0 0 8px 0;
            font-weight: 600;
        }
        .meta {
            margin-bottom: 20px;
            font-size: 14px;
            color: #666;
        }
        .addresses-container {
            width: 100%;
            margin-bottom: 20px;
            font-size: 0;
        }
        .address-box {
            display: inline-block;
            width: 48%;
            padding: 16px;
            font-size: 13px;
            background: #f9f9f9;
            border: 1px solid #e8e8e8;
            vertical-align: top;
            line-height: 1.6;
            box-sizing: border-box;
        }
        .address-box:first-child {
            margin-right: 2%;
        }
        .address-box strong {
            font-size: 14px;
            color: #224039;
            display: block;
            margin-bottom: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 13px;
            border: 1px solid #e0e0e0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }
        th {
            background: #f9f9f9;
            color: #224039;
            font-weight: 600;
            border-bottom: 2px solid #e0e0e0;
        }
        tbody tr:last-child td {
            border-bottom: none;
        }
        tfoot tr {
            background: #fafafa;
        }
        tfoot td {
            font-weight: 600;
            color: #224039;
            border-bottom: none;
        }
        tfoot tr:last-child {
            background: #f0f0f0;
        }
        tfoot tr:last-child td {
            font-weight: 700;
            font-size: 14px;
        }
        .summary {
            margin-top: 20px;
            padding: 14px;
            background: #fffbea;
            border-left: 3px solid #f59e0b;
            font-size: 14px;
            color: #92400e;
            line-height: 1.6;
        }
        .summary strong {
            color: #92400e;
        }
        .summary span {
            color: #78350f;
        }
        .payment-info {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e8e8e8;
            font-size: 12px;
            color: #666;
            line-height: 1.6;
        }
        .footer-border {
            background-color: #224039;
            height: 2px;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header-border"></div>

        <div class="header">
            <div class="company-info">
                Stichting Lucide Inkt<br>
                Kerspellaan 12<br>
                7824 JG Emmen<br>
                info@lucideinkt.nl<br>
                Kvk: 54486890<br>
                IBAN: NL44 RABO 0142 3642 23<br>
                Factuur vrijgesteld van OB O.G.V. artikel 25 wet OB.
            </div>
        </div>

        <h1>Factuur</h1>
        <div class="meta">
            <span><strong>Ordernummer:</strong> {{ $order['id'] }}</span><br>
            <span><strong>Datum:</strong> {{ $order['created_at'] ?? date('d-m-Y') }}</span>
        </div>

        <div class="addresses-container">
            <div class="address-box">
                <strong>{{ __('Factuuradres') }}</strong>
                {{ $order['customer']['billing_first_name'] }} {{ $order['customer']['billing_last_name'] }}<br>
                @if(!empty($order['customer']['billing_company']))
                    {{ $order['customer']['billing_company'] }}<br>
                @endif
                {{ $order['customer']['billing_street'] }} {{ $order['customer']['billing_house_number'] }}{{ !empty($order['customer']['billing_house_number_addition']) ? ' ' . $order['customer']['billing_house_number_addition'] : '' }}<br>
                {{ $order['customer']['billing_postal_code'] }} {{ $order['customer']['billing_city'] }}<br>
                {{ config('countries.' . $order['customer']['billing_country']) ?? $order['customer']['billing_country'] }}<br>
                @if(!empty($order['customer']['billing_phone']))
                    Tel: {{ $order['customer']['billing_phone'] }}<br>
                @endif
                Email: {{ $order['customer']['billing_email'] }}
            </div><!--
            --><div class="address-box">
                <strong>{{ __('Verzendadres') }}</strong>
                @if(!empty($order['shipping_street']))
                    {{ $order['shipping_first_name'] }} {{ $order['shipping_last_name'] }}<br>
                    @if(!empty($order['shipping_company']))
                        {{ $order['shipping_company'] }}<br>
                    @endif
                    {{ $order['shipping_street'] }} {{ $order['shipping_house_number'] }}{{ !empty($order['shipping_house_number_addition']) ? ' ' . $order['shipping_house_number_addition'] : '' }}<br>
                    {{ $order['shipping_postal_code'] }} {{ $order['shipping_city'] }}<br>
                    {{ config('countries.' . $order['shipping_country']) ?? $order['shipping_country'] }}<br>
                    @if(!empty($order['shipping_phone']))
                        Tel: {{ $order['shipping_phone'] }}<br>
                    @endif
                @else
                    {{ $order['customer']['billing_first_name'] }} {{ $order['customer']['billing_last_name'] }}<br>
                    @if(!empty($order['customer']['billing_company']))
                        {{ $order['customer']['billing_company'] }}<br>
                    @endif
                    {{ $order['customer']['billing_street'] }} {{ $order['customer']['billing_house_number'] }}{{ !empty($order['customer']['billing_house_number_addition']) ? ' ' . $order['customer']['billing_house_number_addition'] : '' }}<br>
                    {{ $order['customer']['billing_postal_code'] }} {{ $order['customer']['billing_city'] }}<br>
                    {{ config('countries.' . $order['customer']['billing_country']) ?? $order['customer']['billing_country'] }}<br>
                    @if(!empty($order['customer']['billing_phone']))
                        Tel: {{ $order['customer']['billing_phone'] }}<br>
                    @endif
                @endif
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
                @foreach($order['items'] as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td style="text-align: center;">{{ $item['quantity'] }}</td>
                    <td style="text-align: right;">€ {{ number_format($item['unit_price'], 2, ',', '.') }}</td>
                    <td style="text-align: right;">€ {{ number_format($item['subtotal'], 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right;">Totaal</td>
                    <td style="text-align:right;">€ {{ number_format($order['total'], 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="summary">
            <strong>Te betalen:</strong> € {{ number_format($order['total'], 2, ',', '.') }}<br>
            <span>Gelieve het bedrag over te maken naar rekening NL44 RABO 0142 3642 23 t.n.v. Stichting Lucide Inkt o.v.v. uw ordernummer.</span>
        </div>

        <div class="payment-info">
            Heeft u vragen over deze factuur? Neem gerust contact op via info@lucideinkt.nl.<br>
            Dank voor uw bestelling!
        </div>

        <div class="footer-border"></div>
    </div>
</body>
</html>
