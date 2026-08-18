<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #f8f9fa; border-bottom: 1px solid #ddd;">
        <h2>الصفحة الرئيسية</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="padding: 8px 16px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">تسجيل الخروج</button>
        </form>
    </div>

    <div style="padding: 20px;">
        <h3>مرحباً بك في الصفحة الرئيسية!</h3>
    </div>
</body>
</html>