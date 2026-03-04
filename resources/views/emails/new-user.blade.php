<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>{{ __('Welkom bij Lucide Inkt') }}</title>
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
                            <h1 style="color: #620505; font-size: 24px; margin: 0 0 24px 0; font-weight: 600; text-align: left;">{{ __('Welkom bij Lucide Inkt!') }}</h1>

                            <!-- Greeting -->
                            <p style="font-size: 15px; line-height: 1.6; color: #333; margin: 0 0 16px 0;">{{ __('Beste') }} {{ $user->first_name }},</p>

                            <p style="font-size: 15px; line-height: 1.6; color: #333; margin: 0 0 20px 0;">
                                {{ __('Je bent succesvol als nieuwe gebruiker geregistreerd bij Lucide Inkt.') }}<br>
                                {{ __('Je account is aangemaakt en je kunt nu eenvoudig je bestellingen volgen en beheren.') }}
                            </p>

                            <!-- Account details box -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f9f9f9; border-radius: 6px; margin-bottom: 24px; border: 1px solid #e8e8e8;">
                                <tr>
                                    <td style="padding: 24px;">
                                        <p style="margin: 0 0 12px 0; font-size: 16px; font-weight: 600; color: #620505;">{{ __('Jouw gegevens:') }}</p>
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 6px 0; font-size: 15px; line-height: 1.6; color: #333;">
                                                    {{ __('Naam:') }} {{ $user->first_name }} {{ $user->last_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px 0; font-size: 15px; line-height: 1.6; color: #333;">
                                                    {{ __('E-mailadres:') }} {{ $user->email }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 20px;">
                                <tr>
                                    <td align="center" style="padding: 10px 0;">
                                        <a href="https://lucideinkt.nl/login" style="display: inline-block; padding: 14px 32px; background: #2c582f; color: #ffffff; text-decoration: none; border-radius: 6px; font-size: 16px; font-weight: 600; box-shadow: 0 2px 8px rgba(34, 64, 57, 0.3);">{{ __('Inloggen bij Lucide Inkt') }}</a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Help section -->
                            <p style="font-size: 15px; line-height: 1.6; color: #333; margin: 20px 0 0 0;">
                                {{ __('Heb je vragen of hulp nodig? Neem gerust contact met ons op via') }} <a href="mailto:info@lucideinkt.nl" style="color: #996d3f; text-decoration: none;">info@lucideinkt.nl</a>.
                            </p>

                            <!-- Footer -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-top: 20px; border-top: 1px solid #e8e8e8; font-size: 13px; line-height: 1.6; color: #666;">
                                        {{ __('Bedankt voor je vertrouwen in Lucide Inkt!') }}<br>
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
