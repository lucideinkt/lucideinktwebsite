<x-layout>
    <main class="container auth-page page">
        <div class="login-card">
            <form action="{{ route('loginUser') }}" method="POST" class="login-form">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success" style="position: relative;">
                        {{ session('success') }}
                        <button type="button" class="alert-close"
                            onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success" style="position: relative;">
                        {{ session('status') }}
                        <button type="button" class="alert-close"
                            onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                        <button type="button" class="alert-close"
                            onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif

                @if (session('no_right_link'))
                    <div class="alert alert-error">
                        {{ session('no_right_link') }}
                        <button type="button" class="alert-close"
                            onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif

                <h2 class="login-title">Inloggen</h2>

                <div class="form-input">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-input">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" id="password" class="form-control"
                        autocomplete="current-password">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-me-box">
                    <input type="checkbox" class="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Onthoud mij</label>
                </div>

                <div class="form-input">
                    <button type="submit" class="btn-login"><span class="loader"></span>Inloggen</button>
                </div>

                <div class="form-input forgot-password">
                    <span>Wachtwoord vergeten? <a href="{{ route('password.request') }}">Klik hier</a></span>
                </div>
            </form>
        </div>
    </main>

    <div class="gradient-border"></div>
    <x-footer></x-footer>

    <style>
        .auth-page {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            background: var(--surface-3);
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: var(--shadow-1);
            border: 1px solid var(--border-1);
        }

        .login-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--main-font-color);
            text-align: center;
            margin: 0 0 2rem 0;
            font-family: var(--font-bold);
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .form-input {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.25rem;
        }

        .form-input label {
            font-size: 14px;
            font-weight: 500;
            color: var(--main-font-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-1);
            border-radius: 6px;
            font-size: 16px;
            font-family: var(--font-regular);
            color: var(--main-font-color);
            background: var(--surface-2);
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--main-color);
            box-shadow: 0 0 0 3px rgba(171, 15, 20, 0.1);
        }

        /* Hide all browser password reveal buttons */
        input[type="password"]::-webkit-credentials-auto-fill-button,
        input[type="text"][autocomplete*="password"]::-webkit-credentials-auto-fill-button {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        .remember-me-box {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--main-color);
        }

        .remember-me-box label {
            font-size: 14px;
            color: var(--main-font-color);
            cursor: pointer;
            margin: 0;
        }

        .btn-login {
            width: 100%;
            padding: 12px 24px;
            background: var(--green-2);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: #1a3028;
        }

        .forgot-password {
            text-align: center;
            margin-top: 0.5rem;
            margin-bottom: 0;
        }

        .forgot-password span {
            font-size: 14px;
            color: var(--main-font-color);
        }

        .forgot-password a {
            color: var(--main-font-color);
            text-decoration: underline;
            transition: color 0.2s;
        }

        .forgot-password a:hover {
            color: var(--main-color);
        }

        .error {
            font-size: 13px;
            color: var(--red-1);
            margin-top: 0.5rem;
        }

        .alert {
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .alert-success {
            background: var(--success-bg);
            color: var(--success-text);
            border: 1px solid var(--success-border);
        }

        .alert-error {
            background: #fee;
            color: var(--red-1);
            border: 1px solid #fcc;
        }

        .alert-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
            transition: opacity 0.2s;
            padding: 0;
            margin-left: 12px;
        }

        .alert-close:hover {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 24px;
            }
        }
    </style>
</x-layout>
