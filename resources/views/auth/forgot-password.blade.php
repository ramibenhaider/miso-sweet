<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>استعادة كلمة المرور</title>
</head>
<body style="font-family: Tahoma, Arial, sans-serif; line-height: 1.6; color: #333;">
<div class="container">
    <h2>استعادة كلمة المرور</h2>
    <p>أدخل بريدك الإلكتروني وسنرسل لك رابطاً لإعادة تعيين كلمة المرور.</p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <label for="email">البريد الإلكتروني:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button type="submit">إرسال الرابط</button>
    </form>
</div>
</body>
</html>