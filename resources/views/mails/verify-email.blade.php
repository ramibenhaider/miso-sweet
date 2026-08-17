<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تأكيد الحساب</title>
</head>
<body style="font-family: Tahoma, Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>مرحباً {{ $user->name }}،</h2>
    <p>شكراً لإنشاء حسابك معنا. يرجى الضغط على الزر أدناه لتأكيد بريدك الإلكتروني وتفعيل الحساب:</p>
    
    <div style="margin: 25px 0;">
        <a href="{!! $url !!}" style="background-color: #2563eb; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
            تأكيد البريد الإلكتروني
        </a>
    </div>

    <p>إذا لم تقم بإنشاء هذا الحساب، يمكنك تجاهل هذه الرسالة بأمان.</p>
    <p>صلاحية هذا الرابط تنتهي خلال 60 دقيقة.</p>
</body>
</html>