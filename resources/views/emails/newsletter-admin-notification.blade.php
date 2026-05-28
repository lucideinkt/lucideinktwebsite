<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Nieuwe nieuwsbrief inschrijving</title>
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
                    <!-- Header accent -->
                    <tr>
                        <td style="background-color: #620505; height: 3px; border-radius: 3px 3px 0 0;"></td>
                    </tr>
                    <!-- Main content -->
                    <tr>
                        <td style="background-color: #ffffff; padding: 40px 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">

                            <!-- Company info -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 24px;">
                                <tr>
                                    <td style="font-size: 13px; line-height: 1.6; color: #666;">
                                        Stichting Lucide Inkt<br>
                                        info@lucideinkt.nl
                                    </td>
                                </tr>
                            </table>

                            <h1 style="color: #620505; font-size: 24px; margin: 0 0 16px 0; font-weight: 600;">✉ Nieuwe nieuwsbrief inschrijving</h1>

                            <p style="font-size: 15px; line-height: 1.6; color: #333; margin: 0 0 24px 0;">
                                Er heeft zich zojuist iemand ingeschreven voor de nieuwsbrief van <strong style="color: #620505;">Lucide Inkt</strong> en de inschrijving is <strong>bevestigd</strong>.
                            </p>

                            <!-- Subscriber details box -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f9f9f9; border-radius: 6px; margin-bottom: 28px; border: 1px solid #e8e8e8;">
                                <tr>
                                    <td style="padding: 20px 24px;">
                                        <p style="margin: 0 0 8px 0; font-size: 14px; font-weight: 600; color: #620505;">E-mailadres inschrijver:</p>
                                        <p style="margin: 0 0 16px 0; font-size: 15px; color: #333;">{{ $subscriber->email }}</p>

                                        <p style="margin: 0 0 8px 0; font-size: 14px; font-weight: 600; color: #620505;">Bevestigd op:</p>
                                        <p style="margin: 0; font-size: 15px; color: #333;">{{ $subscriber->subscribed_at?->format('d-m-Y \o\m H:i') ?? now()->format('d-m-Y \o\m H:i') }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 10px 0;">
                                        <a href="{{ route('admin.newsletter.index') }}" style="display: inline-block; padding: 12px 28px; background: #2c582f; color: #ffffff; text-decoration: none; border-radius: 6px; font-size: 15px; font-weight: 600; box-shadow: 0 2px 8px rgba(34, 64, 57, 0.3);">Bekijk alle inschrijvingen</a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Footer -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-top: 20px; border-top: 1px solid #e8e8e8; font-size: 13px; line-height: 1.6; color: #666;">
                                        Met vriendelijke groet,<br>
                                        <strong style="color: #620505;">Lucide Inkt</strong><br>
                                        <a href="mailto:info@lucideinkt.nl" style="color: #996d3f; text-decoration: none;">info@lucideinkt.nl</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Bottom accent -->
                    <tr>
                        <td style="background-color: #620505; height: 3px; border-radius: 0 0 3px 3px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>


