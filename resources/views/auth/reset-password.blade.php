<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعيين كلمة المرور الجديدة</title>
</head>
<body style="font-family: Tahoma, Arial, sans-serif; line-height: 1.6; color: #333;">
<div class="container">
    <h2>تعيين كلمة المرور الجديدة</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email">البريد الإلكتروني:</label>
            <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password">كلمة المرور الجديدة:</label>
            <input id="password" type="password" name="password" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation">تأكيد كلمة المرور:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <button type="submit">حفظ كلمة المرور</button>
    </form>
</div>
</body>
</html>