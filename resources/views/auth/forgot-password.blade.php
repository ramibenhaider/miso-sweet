<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استعادة كلمة المرور</title>
    <link rel="icon" type="image/png" href="{{ asset('Favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient-start: #FDFBF7;
            --bg-gradient-end: #F3EBE1;
            --card-bg: #FFFFFF;
            --dark-brown: #2C1A11;
            --medium-brown: #5C4033;
            --light-brown: #D4BBA5;
            --soft-brown-bg: #F7F1EA;
            --border-color: #E6D8C9;
            --accent-brown: #7A4E32;
            --accent-brown-hover: #5E3B24;
            --text-muted: #7E6B5D;
            --error-red: #A93226;
            --error-bg: #FADBD8;
            --success-green: #1E8449;
            --success-bg: #D4EFDF;
            --radius-lg: 16px;
            --radius-md: 10px;
            --shadow-soft: 0 10px 30px rgba(44, 26, 17, 0.06), 0 2px 8px rgba(44, 26, 17, 0.04);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            color: var(--dark-brown);
            direction: rtl;
        }

        .forgot-card {
            background-color: var(--card-bg);
            width: 100%;
            max-width: 440px;
            padding: 2.5rem 2rem;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-soft);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .header-section {
            text-align: center;
            margin-bottom: 1.8rem;
        }

        .login-logo {
            max-height: 80px;
            width: auto;
            margin: 0 auto 1.2rem auto;
            display: block;
            object-fit: contain;
        }

        .header-section h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark-brown);
            letter-spacing: -0.02em;
            margin-bottom: 0.4rem;
        }

        .header-section p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .alert {
            padding: 0.85rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            line-height: 1.5;
        }

        .alert-success {
            background-color: var(--success-bg);
            color: var(--success-green);
            border: 1px solid rgba(30, 132, 73, 0.2);
        }

        .form-group {
            margin-bottom: 1.4rem;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--medium-brown);
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            color: var(--dark-brown);
            background-color: var(--soft-brown-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            outline: none;
            transition: all 0.25s ease;
        }

        .form-control:focus {
            background-color: #FFFFFF;
            border-color: var(--accent-brown);
            box-shadow: 0 0 0 3.5px rgba(122, 78, 50, 0.15);
        }

        .error-message {
            display: block;
            color: var(--error-red);
            font-size: 0.825rem;
            margin-top: 0.4rem;
            font-weight: 500;
        }

        .btn-primary {
            width: 100%;
            padding: 0.9rem 1.2rem;
            font-size: 1rem;
            font-weight: 700;
            color: #FFFFFF;
            background: linear-gradient(135deg, var(--dark-brown) 0%, var(--accent-brown) 100%);
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(44, 26, 17, 0.15);
            margin-top: 0.5rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1F120B 0%, var(--accent-brown-hover) 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(44, 26, 17, 0.22);
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(44, 26, 17, 0.15);
        }

        .footer-links {
            margin-top: 1.8rem;
            padding-top: 1.4rem;
            border-top: 1px dashed var(--border-color);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            text-align: center;
        }

        .footer-links p {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .footer-links a {
            color: var(--accent-brown);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: var(--dark-brown);
            text-decoration: underline;
        }

        /* Responsive adjustments for mobile devices */
        @media (max-width: 480px) {
            body {
                padding: 1rem 0.75rem;
            }

            .forgot-card {
                padding: 1.8rem 1.25rem;
                border-radius: 12px;
            }

            .header-section h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="forgot-card">
        <div class="header-section">
            <img src="{{ asset('Favicon.png') }}" alt="Logo" class="login-logo">
            <h2>استعادة كلمة المرور</h2>
            <p>أدخل بريدك الإلكتروني وسنرسل لك رابطاً لإعادة تعيين كلمة المرور الخاصة بك.</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="example@domain.com" required autofocus autocomplete="email">
                </div>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary">إرسال رابط إعادة التعيين</button>
        </form>

        <div class="footer-links">
            <p>تذكرت كلمة المرور؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
        </div>
    </div>
</body>

</html>