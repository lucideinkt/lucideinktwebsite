<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucide Inkt — Binnenkort online</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f5eed8;
            background-image: url('/images/51_geometric wallpaper texture-seamless_hr_new.webp');
            background-size: 500px;
            background-position: center;
            background-repeat: repeat;
            font-family: Georgia, serif;
            color: #620505;
            text-align: center;
            padding: 40px 20px;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background:
                radial-gradient(
                    ellipse 120% 80% at 50% 0%,
                    rgba(255, 245, 200, 0.28) 0%,
                    transparent 60%
                ),
                radial-gradient(
                    ellipse 120% 80% at 50% 100%,
                    rgba(180, 100, 20, 0.10) 0%,
                    transparent 60%
                ),
                linear-gradient(
                    160deg,
                    rgba(255, 250, 220, 0.20)  0%,
                    rgba(240, 200, 100, 0.06) 40%,
                    rgba(180,  80,  10, 0.08) 100%
                );
        }

        .card {
            position: relative;
            z-index: 1;
            border-radius: 40px;
            overflow: hidden;
            padding: 56px 48px;
            max-width: 560px;
            width: 100%;

            /* ── Same stacked background as .said-nursi-page__text-box ── */
            background-color: #f7e9c4;
            background-image:
                linear-gradient(
                    180deg,
                    rgba(210, 175, 110, 0.22)  0%,
                    transparent                18%,
                    transparent                82%,
                    rgba(210, 175, 110, 0.22)  100%
                ),
                url('/images/BillyPaper.webp');
            background-size: auto, 600px;
            background-position: center, center;
            background-repeat: no-repeat, repeat;

            border: 2px solid rgba(197, 155, 50, 0.72);
            outline: 1px solid rgba(197, 155, 50, 0.28);
            outline-offset: 5px;

            box-shadow:
                0 1px 0   rgba(255, 248, 190, 0.70),
                0 2px 5px  rgba(30, 10, 0, 0.10),
                0 6px 16px rgba(25, 8,  0, 0.12),
                0 14px 35px rgba(18, 5, 0, 0.16),
                inset 0 0 0 1px rgba(255, 245, 175, 0.35),
                inset 0 1px 0   rgba(255, 252, 210, 0.55);
        }

        .card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(
                ellipse 85% 75% at 50% 38%,
                transparent              30%,
                rgba(140, 70, 10, 0.07)  75%,
                rgba(100, 45,  5, 0.13) 100%
            );
            pointer-events: none;
            z-index: 0;
        }

        .card > * { position: relative; z-index: 1; }

        .logo {
            max-width: 240px;
            margin: 0 auto 32px;
            display: block;
        }

        h1 {
            font-size: 2rem;
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        p {
            font-size: 1rem;
            opacity: 0.75;
            line-height: 1.8;
            margin-bottom: 32px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(197,155,50,0.5), transparent);
            margin: 32px 0;
        }

        .login-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: #620505;
            opacity: 0.5;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .login-link:hover { opacity: 0.9; }

        .login-link svg {
            width: 14px;
            height: 14px;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="/images/logo_newest.webp" alt="Lucide Inkt" class="logo">

        <h1>Binnenkort online</h1>

        <p>
            We zijn druk bezig met het verbeteren van onze website.<br>
            Kom snel terug — we zijn er bijna!
        </p>

        <div class="divider"></div>

        <a href="{{ $loginUrl }}" class="login-link">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                <polyline points="10 17 15 12 10 7"/>
                <line x1="15" y1="12" x2="3" y2="12"/>
            </svg>
            Beheerderslogin
        </a>
    </div>
</body>
</html>
