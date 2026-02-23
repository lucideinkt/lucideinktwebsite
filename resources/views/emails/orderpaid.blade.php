<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>{{ __('Bestelling betaald') }}</title>
    <!--[if mso]>
    <style type="text/css">
        table {border-collapse: collapse !important;}
    </style>
    <![endif]-->
</head>
<body style="margin: 0; padding: 0; background-color: #f5f5f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0; padding: 0; background-color: #f5f5f5;">
        <tr>
            <td style="padding: 40px 15px;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 650px; margin: 0 auto;">
                    <!-- Header with subtle border -->
                    <tr>
                        <td style="background-color: #224039; height: 3px; border-radius: 3px 3px 0 0;"></td>
                    </tr>
                    <!-- Main content -->
                    <tr>
                        <td style="background-color: #ffffff; padding: 40px 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">

                            <!-- Company info -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 24px;">
                                <tr>
                                    <td style="font-size: 13px; line-height: 1.6; color: #666;">
                                        Stichting Lucide Inkt<br>
                                        Kerspellaan 12<br>
                                        7824 JG Emmen<br>
                                        info@lucideinkt.nl
                                    </td>
                                </tr>
                            </table>

                            <h1 style="color: #224039; font-size: 24px; margin: 0 0 8px 0; font-weight: 600;">{{ __('Bedankt voor je bestelling!') }}</h1>

                            <!-- Order meta -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 20px;">
                                <tr>
                                    <td style="font-size: 15px; line-height: 1.8; color: #333;">
                                        <strong>{{ __('Ordernummer:') }}</strong> {{ $order->id }}<br>
                                        <strong>{{ __('Besteldatum:') }}</strong> {{ $order->created_at->format('d-m-Y H:i') }}
                                    </td>
                                </tr>
                            </table>

                            @if($order->order_note)
                            <!-- Order note -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #fffbea; border-left: 4px solid #f59e0b; border-radius: 4px; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 16px; font-size: 14px; line-height: 1.6;">
                                        <strong style="color: #92400e;">Bestelnotitie:</strong><br>
                                        <span style="color: #78350f;">{{ $order->order_note }}</span>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            <!-- Verzendadres & Factuuradres side-by-side -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 16px;">
                                <tr>
                                    <td style="width: 50%; padding-right: 10px; vertical-align: top;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f9f9f9; border-radius: 6px; border: 1px solid #e8e8e8;">
                                            <tr>
                                                <td style="padding: 20px; font-size: 14px; line-height: 1.6; color: #333;">
                                                    <strong style="color: #224039; font-size: 15px; display: block; margin-bottom: 8px;">{{ __('Verzendadres') }}</strong>
                                                    @if($order->shipping_street)
                                                        {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                                                        @if($order->shipping_company)
                                                            {{ $order->shipping_company }}<br>
                                                        @endif
                                                        {{ $order->shipping_street }} {{ $order->shipping_house_number }}{{ $order->shipping_house_number_addition ? ' '.$order->shipping_house_number_addition : '' }}<br>
                                                        {{ $order->shipping_postal_code }} {{ $order->shipping_city }}<br>
                                                        {{ config('countries.' . $order->shipping_country) ?? $order->shipping_country }}<br>
                                                        @if($order->shipping_phone)
                                                            {{ __('Tel:') }} {{ $order->shipping_phone }}<br>
                                                        @endif
                                                    @else
                                                        {{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}<br>
                                                        @if($order->customer->billing_company)
                                                            {{ $order->customer->billing_company }}<br>
                                                        @endif
                                                        {{ $order->customer->billing_street }} {{ $order->customer->billing_house_number }}{{ $order->customer->billing_house_number_addition ? ' '.$order->customer->billing_house_number_addition : '' }}<br>
                                                        {{ $order->customer->billing_postal_code }} {{ $order->customer->billing_city }}<br>
                                                        {{ config('countries.' . $order->customer->billing_country) ?? $order->customer->billing_country }}<br>
                                                        @if($order->customer->billing_phone)
                                                            {{ __('Tel:') }} {{ $order->customer->billing_phone }}<br>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 50%; padding-left: 10px; vertical-align: top;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f9f9f9; border-radius: 6px; border: 1px solid #e8e8e8;">
                                            <tr>
                                                <td style="padding: 20px; font-size: 14px; line-height: 1.6; color: #333;">
                                                    <strong style="color: #224039; font-size: 15px; display: block; margin-bottom: 8px;">{{ __('Factuuradres') }}</strong>
                                                    {{ $order->customer->billing_first_name }} {{ $order->customer->billing_last_name }}<br>
                                                    @if($order->customer->billing_company)
                                                        {{ $order->customer->billing_company }}<br>
                                                    @endif
                                                    {{ $order->customer->billing_street }} {{ $order->customer->billing_house_number }}{{ $order->customer->billing_house_number_addition ? ' '.$order->customer->billing_house_number_addition : '' }}<br>
                                                    {{ $order->customer->billing_postal_code }} {{ $order->customer->billing_city }}<br>
                                                    {{ config('countries.' . $order->customer->billing_country) ?? $order->customer->billing_country }}<br>
                                                    @if($order->customer->billing_phone)
                                                        {{ __('Tel:') }} {{ $order->customer->billing_phone }}<br>
                                                    @endif
                                                    {{ __('Email:') }} {{ $order->customer->billing_email }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Bezorging (delivery) below -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f9f9f9; border-radius: 6px; margin-bottom: 24px; border: 1px solid #e8e8e8;">
                                <tr>
                                    <td style="padding: 20px; font-size: 14px; line-height: 1.6; color: #333;">
                                        @if(isset($delivery) && !empty($delivery['deliveryType']) && strtolower($delivery['deliveryType']) === 'pickup')
                                            <strong style="color: #224039; font-size: 15px; display: block; margin-bottom: 8px;">Bezorging</strong>
                                            Afhalen bij afhaalpunt<br>
                                            {{ $pickupLocation['locationName'] ?? '-' }}<br>
                                            {{ $pickupLocation['street'] ?? '' }} {{ $pickupLocation['number'] ?? '' }}<br>
                                            {{ $pickupLocation['postalCode'] ?? '' }} {{ $pickupLocation['city'] ?? '' }}
                                        @else
                                            <strong style="color: #224039; font-size: 15px; display: block; margin-bottom: 8px;">Bezorging</strong>
                                            Thuisbezorging
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <!-- Order items table -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border: 1px solid #e0e0e0; border-radius: 6px; overflow: hidden; margin-bottom: 24px;">
                                <thead>
                                    <tr style="background-color: #f9f9f9;">
                                        <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600; color: #224039; border-bottom: 2px solid #e0e0e0;">{{ __('Product') }}</th>
                                        <th style="padding: 12px; text-align: center; font-size: 14px; font-weight: 600; color: #224039; border-bottom: 2px solid #e0e0e0;">{{ __('Aantal') }}</th>
                                        <th style="padding: 12px; text-align: right; font-size: 14px; font-weight: 600; color: #224039; border-bottom: 2px solid #e0e0e0;">{{ __('Stukprijs') }}</th>
                                        <th style="padding: 12px; text-align: right; font-size: 14px; font-weight: 600; color: #224039; border-bottom: 2px solid #e0e0e0;">{{ __('Subtotaal') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr style="border-bottom: 1px solid #f0f0f0;">
                                        <td style="padding: 12px; font-size: 14px; color: #333;">{{ $item->product_name }}</td>
                                        <td style="padding: 12px; text-align: center; font-size: 14px; color: #333;">{{ $item->quantity }}</td>
                                        <td style="padding: 12px; text-align: right; font-size: 14px; color: #333;">€ {{ number_format($item->unit_price, 2, ',', '.') }}</td>
                                        <td style="padding: 12px; text-align: right; font-size: 14px; color: #333;">€ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #fafafa;">
                                        <td colspan="3" style="padding: 12px; text-align: right; font-size: 15px; font-weight: 600; color: #224039;">{{ __('Totaal') }}</td>
                                        <td style="padding: 12px; text-align: right; font-size: 15px; font-weight: 600; color: #224039;">€ {{ number_format($order->total_before, 2, ',', '.') }}</td>
                                    </tr>
                                    @if(isset($order->discount_type) && $order->discount_price_total > 0)
                                    <tr style="background-color: #fafafa;">
                                        <td colspan="3" style="padding: 12px; text-align: right; font-size: 14px; color: #666;">{{ __('Korting') }} ({{ $order->discount_type === 'percent' ? intval($order->discount_value) . '%' : '€ ' . number_format($order->discount_value, 2, ',', '.') }})</td>
                                        <td style="padding: 12px; text-align: right; font-size: 14px; color: #666;">-€ {{ number_format($order->discount_price_total, 2, ',', '.') }}</td>
                                    </tr>
                                    <tr style="background-color: #fafafa;">
                                        <td colspan="3" style="padding: 12px; text-align: right; font-size: 15px; font-weight: 600; color: #224039;">{{ __('Totaal na korting') }}</td>
                                        <td style="padding: 12px; text-align: right; font-size: 15px; font-weight: 600; color: #224039;">€ {{ number_format($order->total - $order->discount_price_total, 2, ',', '.') }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($order->shipping_cost_amount) && $order->shipping_cost_amount > 0)
                                    <tr style="background-color: #fafafa;">
                                        <td colspan="3" style="padding: 12px; text-align: right; font-size: 14px; color: #666;">{{ __('Verzendkosten') }}</td>
                                        <td style="padding: 12px; text-align: right; font-size: 14px; color: #666;">€ {{ is_numeric($order->shipping_cost_amount) ? number_format($order->shipping_cost_amount, 2, ',', '.') : number_format((float)($order->shipping_cost_amount->amount ?? 0), 2, ',', '.') }}</td>
                                    </tr>
                                    <tr style="background-color: #f0f0f0;">
                                        <td colspan="3" style="padding: 12px; text-align: right; font-size: 16px; font-weight: 700; color: #224039;">{{ __('Totaal incl. verzendkosten') }}</td>
                                        <td style="padding: 12px; text-align: right; font-size: 16px; font-weight: 700; color: #224039;">€ {{ number_format($order->total, 2, ',', '.') }}</td>
                                    </tr>
                                    @endif
                                </tfoot>
                            </table>

                            <!-- Summary message -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f0f9f4; border-left: 3px solid #22c55e; border-radius: 4px; margin-bottom: 20px;">
                                <tr>
                                    <td style="padding: 16px; font-size: 14px; line-height: 1.6; color: #166534; font-weight: 500;">
                                        {{ __('Je bestelling wordt zo snel mogelijk verzonden. Je ontvangt een e-mail zodra je pakket onderweg is.') }}
                                    </td>
                                </tr>
                            </table>

                            <!-- Footer -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-top: 20px; border-top: 1px solid #e8e8e8; font-size: 13px; line-height: 1.6; color: #666;">
                                        {{ __('Heb je vragen? Neem gerust contact met ons op.') }}<br>
                                        {{ __('Met vriendelijke groet,') }}<br>
                                        <strong style="color: #224039;">{{ config('app.name') }}</strong>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <!-- Bottom subtle border -->
                    <tr>
                        <td style="background-color: #224039; height: 3px; border-radius: 0 0 3px 3px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
