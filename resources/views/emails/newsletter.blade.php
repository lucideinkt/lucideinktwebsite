<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $newsletter->subject }}</title>
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
        .header {
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f7f7f7;
        }
        h1 {
            color: #ab0f14;
            font-size: 1.75em;
            margin: 0 0 8px 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .subject {
            font-size: 16px;
            color: #555;
            margin: 0;
        }
        .content {
            margin: 24px 0;
            font-size: 15px;
            line-height: 1.6;
        }
        .content img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .content p {
            font-size: 15px;
            margin-bottom: 18px;
        }
        .content h2 {
            color: #ab0f14;
            font-size: 1.3em;
            margin: 24px 0 12px 0;
        }
        .content h3 {
            color: #333;
            font-size: 1.1em;
            margin: 20px 0 10px 0;
        }
        .content ul, .content ol {
            margin: 12px 0;
            padding-left: 24px;
        }
        .content li {
            margin-bottom: 8px;
        }
        .content a {
            color: #ab0f14;
            text-decoration: none;
        }
        .content a:hover {
            text-decoration: underline;
        }
        .footer {
            font-size: 15px;
            color: #888;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f7f7f7;
            text-align: left;
        }
        .footer p {
            margin: 8px 0;
            font-size: 14px;
        }
        .unsubscribe-link {
            color: #888;
            text-decoration: none;
            font-size: 14px;
        }
        .unsubscribe-link:hover {
            text-decoration: underline;
            color: #ab0f14;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Nieuwsbrief Lucide Inkt</h1>
            <p class="subject">{{ $newsletter->subject }}</p>
        </div>

        <div class="content">
            {!! $newsletter->content !!}
        </div>

        <div class="footer">
            <p>Je ontvangt deze nieuwsbrief omdat je je hebt ingeschreven op onze website.</p>
            <p>
                <a href="{{ $unsubscribeUrl }}" class="unsubscribe-link">
                    Klik hier om je uit te schrijven
                </a>
            </p>
            <p style="margin-top: 16px;">
                Met vriendelijke groet,<br>
                Lucide Inkt
            </p>
            <p style="color: #aaa; font-size: 13px; margin-top: 8px;">
                © {{ date('Y') }} Lucide Inkt. Alle rechten voorbehouden.
            </p>
        </div>
    </div>
</body>
</html>
