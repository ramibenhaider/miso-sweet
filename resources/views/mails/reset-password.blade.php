<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إعادة تعيين كلمة المرور</title>
</head>
<body style="font-family: Tahoma, Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>مرحباً {{ $user->name }}،</h2>
    <p>لقد تلقينا طلباً لإعادة تعيين كلمة المرور الخاصة بحسابك.</p>
    
    <div style="margin: 25px 0;">
        <a href="{!! $resetUrl !!}" style="background-color: #dc2626; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
            إعادة تعيين كلمة المرور
        </a>
    </div>

    <p>صلاحية هذا الرابط تنتهي خلال 60 دقيقة.</p>
    <p>إذا لم تطلب إعادة تعيين كلمة المرور، فلا داعي لاتخاذ أي إجراء إضافي.</p>
</body>
</html>