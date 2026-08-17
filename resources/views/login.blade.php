<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
</head>
<body>
    <h2>تسجيل الدخول</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('doLogin') }}" method="POST">
        @csrf
        <div>
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <br>

        <div>
            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <br>

        <div>
            <button type="submit">تسجيل الدخول</button>
        </div>
    </form>

    <br>

    <div>
        <p>ليس لديك حساب؟ <a href="{{ route('register') }}">تسجيل حساب جديد</a></p>
    </div>
</body>
</html>
