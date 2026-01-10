<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactformulier - Lucide Inkt</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f7f7f7;
            color: #222;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            padding: 32px 24px;
            box-shadow: 0 2px 8px #eee;
            box-sizing: border-box;
        }

        h1 {
            color: #ab0f14;
            font-size: 1.8em;
            margin-bottom: 24px;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .contact-info {
            background: #f7f7f7;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .contact-info p {
            margin: 8px 0;
            font-size: 15px;
        }

        .contact-info strong {
            color: #ab0f14;
            display: inline-block;
            min-width: 120px;
        }

        .message-box {
            background: #fff;
            border: 1px solid #e3e3e3;
            border-radius: 6px;
            padding: 20px;
            margin-top: 20px;
        }

        .message-box strong {
            color: #ab0f14;
            display: block;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .message-content {
            font-size: 15px;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .footer {
            font-size: 15px;
            color: #888;
            margin-top: 30px;
            text-align: left;
        }

        p {
            font-size: 15px;
            margin-bottom: 18px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Nieuw contactformulier bericht</h1>

        <div class="contact-info">
            <p><strong>Naam:</strong> {{ $name }}</p>
            <p><strong>E-mailadres:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>
            <p><strong>Land:</strong> {{ $country }}</p>
            <p><strong>Onderwerp:</strong> {{ $subject }}</p>
        </div>

        <div class="message-box">
            <strong>Bericht:</strong>
            <div class="message-content">{{ $messageText }}</div>
        </div>

        <div class="footer">
            Dit bericht is verzonden via het contactformulier op de website.<br>
            Je kunt direct antwoorden op dit e-mailadres om contact op te nemen met {{ $name }}.
        </div>
    </div>
</body>

</html>