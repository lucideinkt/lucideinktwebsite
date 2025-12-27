<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('Welkom bij Lucide Inkt') }}</title>
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
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 32px;
    }
    .logo {
      height: 40px;
    }
    .company-info {
      font-size: 15px;
      color: #555;
      text-align: right;
    }
    h1 {
      color: #ab0f14;
      font-size: 2em;
      margin-bottom: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .meta {
      margin-bottom: 18px;
      font-size: 15px;
    }
    .address-blocks {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      margin-bottom: 18px;
    }
    .address {
      min-width: 220px;
      flex: 1;
      font-size: 15px;
      background: #f7f7f7;
      border-radius: 6px;
      padding: 16px;
    }
    .address strong {
      font-size: 1.08em;
      color: #ab0f14;
    }
    .table-responsive {
      width: 100%;
      overflow-x: auto;
      margin-bottom: 18px;
      box-sizing: border-box;
      max-width: 100%;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 15px;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #e3e3e3;
      padding: 10px;
    }
    th {
      background: #f7f7f7;
      color: #222;
      font-weight: 600;
    }
    tfoot td {
      font-weight: bold;
      background: #f7f7f7;
    }
    .summary {
      margin-top: 24px;
      font-size: 16px;
    }
    .footer {
      font-size: 15px;
      color: #888;
      margin-top: 30px;
      text-align: left;
    }
    .details {
      margin: 24px 0;
      font-size: 15px;
    }
    p {
      font-size: 15px;
      margin-bottom: 18px;
    }
    .btn {
      display: inline-block;
      padding: 12px 24px;
      background: #ab0f14;
      color: #fff !important;
      text-decoration: none;
      border-radius: 4px;
      margin-top: 16px;
      font-size: 16px;
      font-weight: 400;
    }
  </style>
</head>
<body>
<div class="email-container">
  <p>{{ __('Beste') }} {{ $user->first_name }},</p>
  <p>
    {{ __('Je bent succesvol als nieuwe gebruiker geregistreerd bij Lucide Inkt.') }}<br>
  </p>
  <div class="details">
    <strong>{{ __('Jouw gegevens:') }}</strong><br>
    {{ __('Naam:') }} {{ $user->first_name }} {{ $user->last_name }}<br>
    {{ __('E-mailadres:') }} {{ $user->email }}
  </div>
  <a href="https://lucideinkt.nl/login" class="btn">{{ __('Inloggen bij Lucide Inkt') }}</a>
  <p style="margin-top:24px;">
    {{ __('Heb je vragen of hulp nodig? Neem gerust contact met ons op via') }} <a href="mailto:info@lucideinkt.nl">info@lucideinkt.nl</a>.
  </p>
  <div class="footer">
    {{ __('Met vriendelijke groet,') }}<br>
    Lucide Inkt
  </div>
</div>
</body>
</html>
