<!DOCTYPE html>
<html lang="nl" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    <title>Beheerderslogin — Lucide Inkt</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* ── Same as Said Nursî page body ── */
            background-color: #f5eed8;
            background-image: url('../../images/51_geometric wallpaper texture-seamless_hr_new.webp');
            background-size: 500px;
            background-position: center;
            background-repeat: repeat;
            font-family: Georgia, serif;
            color: #620505;
            text-align: center;
            padding: 40px 20px;
        }

        /* Warm gradient wash over the texture */
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
            max-width: 480px;
            width: 100%;
            padding: 48px 44px;
            text-align: left;

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
                url('../../images/BillyPaper.webp');
            background-size: auto, 600px;
            background-position: center, center;
            background-repeat: no-repeat, repeat;

            /* ── Gold border + outer ring ── */
            border: 2px solid rgba(197, 155, 50, 0.72);
            outline: 1px solid rgba(197, 155, 50, 0.28);
            outline-offset: 5px;

            /* ── Layered shadow ── */
            box-shadow:
                0 1px 0   rgba(255, 248, 190, 0.70),
                0 2px 5px  rgba(30, 10, 0, 0.10),
                0 6px 16px rgba(25, 8,  0, 0.12),
                0 14px 35px rgba(18, 5, 0, 0.16),
                inset 0 0 0 1px rgba(255, 245, 175, 0.35),
                inset 0 1px 0   rgba(255, 252, 210, 0.55);
        }

        /* ── Internal warm vignette ── */
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
            max-width: 180px;
            margin: 0 auto 28px;
            display: block;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 28px;
            text-align: center;
            color: #620505;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(197,155,50,0.5), transparent);
            margin: 0 0 28px 0;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .alert-error {
            background: rgba(220, 53, 69, 0.08);
            border: 1px solid rgba(220, 53, 69, 0.25);
            color: #8b1a1a;
        }
        .alert-success {
            background: rgba(40, 167, 69, 0.08);
            border: 1px solid rgba(40, 167, 69, 0.25);
            color: #1a5c2a;
        }

        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 6px;
            color: #620505;
            font-weight: 600;
        }
        .required { color: #c0392b; }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid rgba(197,155,50,0.45);
            border-radius: 8px;
            background: rgba(255,248,230,0.85);
            color: #3a0a0a;
            font-family: Georgia, serif;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #c5972a;
            box-shadow: 0 0 0 3px rgba(197,155,42,0.12);
        }

        .error-msg { color: #c0392b; font-size: 0.8rem; margin-top: 4px; }

        .password-wrapper { position: relative; }
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #8b6040;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 0.9rem;
        }
        input[type="checkbox"] { width: 16px; height: 16px; accent-color: #620505; }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #2d5a2d;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: Georgia, serif;
            font-size: 1rem;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-login:hover { background: #1e3d1e; }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #620505;
            opacity: 0.45;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .back-link:hover { opacity: 0.8; }

        .maintenance-badge {
            background: rgba(197,155,50,0.15);
            border: 1px solid rgba(197,155,50,0.3);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #8b6a1a;
            margin: 0 auto 24px;
            display: block;
            width: fit-content;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="/images/logo_newest.webp" alt="Lucide Inkt" class="logo">

        <span class="maintenance-badge">🔧 Onderhoudsmodus</span>

        <h1>Beheerderslogin</h1>
        <div class="divider"></div>

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('loginUser') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">E-mail <span class="required">*</span></label>
                <input type="email" name="email" id="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    autofocus>
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord <span class="required">*</span></label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password"
                        autocomplete="current-password">
                    <button type="button" class="password-toggle" onclick="
                        const i = document.getElementById('password');
                        i.type = i.type === 'password' ? 'text' : 'password';
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-row">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" style="margin-bottom:0; font-weight:400;">Onthoud mij</label>
            </div>

            <button type="submit" class="btn-login">Inloggen</button>
        </form>

        <a href="{{ route('home') }}" class="back-link">← Terug naar onderhoudspagina</a>
    </div>
</body>
</html>
