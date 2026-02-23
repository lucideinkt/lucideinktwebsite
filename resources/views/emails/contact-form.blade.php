<!DOCTYPE html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Contactformulier - Lucide Inkt</title>
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
                        <td style="background-color: #224039; height: 3px; border-radius: 3px 3px 0 0;"></td>
                    </tr>
                    <!-- Main content -->
                    <tr>
                        <td style="background-color: #ffffff; padding: 40px 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                            <h1 style="color: #224039; font-size: 24px; margin: 0 0 24px 0; font-weight: 600; text-align: left;">Nieuw contactformulier bericht</h1>

                            <!-- Contact info box -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f9f9f9; border-radius: 6px; margin-bottom: 24px; border: 1px solid #e8e8e8;">
                                <tr>
                                    <td style="padding: 24px;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 8px 0; font-size: 15px; line-height: 1.6; color: #333;">
                                                    <strong style="color: #224039; display: inline-block; min-width: 120px;">Naam:</strong> {{ $name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; font-size: 15px; line-height: 1.6; color: #333;">
                                                    <strong style="color: #224039; display: inline-block; min-width: 120px;">E-mailadres:</strong> <a href="mailto:{{ $email }}" style="color: #996d3f; text-decoration: none;">{{ $email }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; font-size: 15px; line-height: 1.6; color: #333;">
                                                    <strong style="color: #224039; display: inline-block; min-width: 120px;">Land:</strong> {{ $country }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; font-size: 15px; line-height: 1.6; color: #333;">
                                                    <strong style="color: #224039; display: inline-block; min-width: 120px;">Onderwerp:</strong> {{ $subject }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Message box -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #fafafa; border-left: 3px solid #224039; border-radius: 4px; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <p style="margin: 0 0 12px 0; font-size: 15px; font-weight: 600; color: #224039;">Bericht:</p>
                                        <div style="font-size: 15px; line-height: 1.6; color: #333; white-space: pre-wrap;">{{ $messageText }}</div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Footer note -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-top: 20px; border-top: 1px solid #e8e8e8; font-size: 13px; line-height: 1.6; color: #666;">
                                        Dit bericht is verzonden via het contactformulier op de website.<br>
                                        Je kunt direct antwoorden op dit e-mailadres om contact op te nemen met {{ $name }}.
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
