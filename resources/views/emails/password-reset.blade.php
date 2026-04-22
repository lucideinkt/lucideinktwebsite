<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>{{ __('Wachtwoord opnieuw instellen — Lucide Inkt') }}</title>
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
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px; margin: 0 auto;">
                    <!-- Header with subtle border -->
                    <tr>
                        <td style="background-color: #620505; height: 3px; border-radius: 3px 3px 0 0;"></td>
                    </tr>
                    <!-- Main content -->
                    <tr>
                        <td style="background-color: #ffffff; padding: 40px 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                            <h1 style="color: #620505; font-size: 24px; margin: 0 0 24px 0; font-weight: 600; text-align: left;">{{ __('Wachtwoord opnieuw instellen') }}</h1>

                            <!-- Greeting -->
                            <p style="font-size: 15px; line-height: 1.6; color: #333; margin: 0 0 16px 0;">{{ __('Beste') }} {{ $first_name }},</p>

                            <p style="font-size: 15px; line-height: 1.6; color: #333; margin: 0 0 16px 0;">
                                {{ __('Je hebt aangegeven dat je je wachtwoord opnieuw wilt instellen voor je account op Lucide Inkt.') }}
                            </p>

                            <p style="font-size: 15px; line-height: 1.6; color: #333; margin: 0 0 24px 0;">
                                {{ __('Klik op de onderstaande knop om een nieuw wachtwoord in te stellen:') }}
                            </p>

                            <!-- CTA Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 24px;">
                                <tr>
                                    <td align="center" style="padding: 10px 0;">
                                        <a href="{{ url('reset-password', $token) . '?email=' . urlencode($email) }}" style="display: inline-block; padding: 14px 32px; background: #2c582f; color: #ffffff; text-decoration: none; border-radius: 6px; font-size: 16px; font-weight: 600; box-shadow: 0 2px 8px rgba(34, 64, 57, 0.3);">{{ __('Wachtwoord resetten') }}</a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Security notice -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #fef3c7; border-left: 3px solid #f59e0b; border-radius: 4px; margin-bottom: 20px;">
                                <tr>
                                    <td style="padding: 16px; font-size: 14px; line-height: 1.6; color: #92400e;">
                                        {{ __('Als je deze aanvraag niet hebt gedaan, hoef je niets te doen.') }}
                                    </td>
                                </tr>
                            </table>

                            <!-- Footer -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-top: 20px; border-top: 1px solid #e8e8e8; font-size: 13px; line-height: 1.6; color: #666;">
                                        {{ __('Met vriendelijke groet,') }}<br>
                                        <strong style="color: #620505;">Lucide Inkt</strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Bottom subtle border -->
                    <tr>
                        <td style="background-color: #620505; height: 3px; border-radius: 0 0 3px 3px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
