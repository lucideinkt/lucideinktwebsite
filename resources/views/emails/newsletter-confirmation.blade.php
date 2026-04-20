<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Bevestig je nieuwsbrief inschrijving</title>
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
                            <h1 style="color: #620505; font-size: 24px; margin: 0 0 24px 0; font-weight: 600; text-align: left;">Bevestig je inschrijving</h1>

                            <p style="font-size: 15px; line-height: 1.6; color: #333; margin: 0 0 20px 0;">
                                Bedankt voor je inschrijving voor de nieuwsbrief van <strong style="color: #620505;">Lucide Inkt</strong>!<br>
                                Om je inschrijving te bevestigen en updates te ontvangen, klik je op de knop hieronder.
                            </p>

                            <!-- Info box -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f9f9f9; border-radius: 6px; margin-bottom: 28px; border: 1px solid #e8e8e8;">
                                <tr>
                                    <td style="padding: 20px 24px;">
                                        <p style="margin: 0 0 8px 0; font-size: 14px; font-weight: 600; color: #620505;">Inschrijving voor:</p>
                                        <p style="margin: 0; font-size: 15px; color: #333;">{{ $subscriber->email }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 24px;">
                                <tr>
                                    <td align="center" style="padding: 10px 0;">
                                        <a href="{{ $confirmUrl }}" style="display: inline-block; padding: 10px 24px; background: #2c582f; color: #ffffff; text-decoration: none; border-radius: 5px; font-size: 14px; font-weight: 600; box-shadow: 0 2px 6px rgba(34, 64, 57, 0.25);">✓ Bevestig mijn inschrijving</a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 13px; line-height: 1.6; color: #666; margin: 0 0 20px 0; text-align: center;">
                                Werkt de knop niet? Kopieer dan deze link naar je browser:<br>
                                <a href="{{ $confirmUrl }}" style="color: #996d3f; text-decoration: none; word-break: break-all;">{{ $confirmUrl }}</a>
                            </p>

                            <p style="font-size: 13px; line-height: 1.6; color: #999; margin: 0 0 20px 0;">
                                Heb jij je niet aangemeld? Dan kun je deze e-mail veilig negeren.
                            </p>

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

