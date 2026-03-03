<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @if(isset($seoData))
        {!! seo($seoData) !!}
    @else
        <title>Lucide Inkt - Online Lezen</title>
        <meta name="description" content="Lees onze boeken direct online">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('head')

    <style>
        /* Reset and base styles */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        /* Minimal layout - no header/footer, full height */
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100vh;
            width: 100vw;
            background: #1a1a1a;
            touch-action: pan-y pan-x;
        }

        /* Hide any background overlays */
        body > div[style*="fixed"] {
            display: none !important;
        }
    </style>
</head>

<body>
    {{ $slot }}
</body>
</html>

