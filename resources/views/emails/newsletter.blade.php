<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>{{ $newsletter->subject }}</title>
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
                            <!-- Header section -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #e8e8e8;">
                                <tr>
                                    <td>
                                        <h1 style="color: #620505; font-size: 28px; margin: 0; font-weight: 600;">{{ $newsletter->subject }}</h1>
                                    </td>
                                </tr>
                            </table>

                            <!-- Content section -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 24px;">
                                <tr>
                                    <td style="font-size: 15px; line-height: 1.7; color: #333;">
                                        <div style="color: #333;">
                                            {!! $newsletter->content !!}
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Footer -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-top: 20px; border-top: 1px solid #e8e8e8; font-size: 13px; line-height: 1.6; color: #666;">
                                        <p style="margin: 0 0 12px 0; font-size: 13px; color: #888;">Je ontvangt deze nieuwsbrief omdat je je hebt ingeschreven op onze website.</p>
                                        <p style="margin: 0 0 16px 0;">
                                            <a href="{{ $unsubscribeUrl }}" style="color: #620505; text-decoration: none; font-size: 13px;">Klik hier om je uit te schrijven</a>
                                        </p>
                                        <p style="margin: 16px 0 0 0; font-size: 13px; color: #666;">
                                            Met vriendelijke groet,<br>
                                            <strong style="color: #620505;">Lucide Inkt</strong>
                                        </p>
                                        <p style="margin: 12px 0 0 0; font-size: 12px; color: #aaa;">
                                            © {{ date('Y') }} Lucide Inkt. Alle rechten voorbehouden.
                                        </p>
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
