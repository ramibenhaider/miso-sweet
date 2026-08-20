<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد الحساب</title>
</head>
<body style="margin: 0; padding: 0; background-color: #FDFBF7; font-family: 'Tajawal', Tahoma, Arial, sans-serif; direction: rtl; text-align: right; color: #2C1A11;">
    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="background: linear-gradient(135deg, #FDFBF7 0%, #F3EBE1 100%); padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 500px; background-color: #FFFFFF; border-radius: 16px; border: 1px solid #E6D8C9; box-shadow: 0 10px 30px rgba(44, 26, 17, 0.06); padding: 35px 25px; text-align: center;">
                    <tr>
                        <td>
                            <h2 style="color: #2C1A11; font-size: 24px; font-weight: 700; margin: 0 0 12px 0;">مرحباً {{ $user->name }}،</h2>
                            <p style="color: #5C4033; font-size: 15px; line-height: 1.6; margin: 0 0 25px 0;">
                                شكراً لإنشاء حسابك معنا! يرجى الضغط على الزر أدناه لتأكيد بريدك الإلكتروني وتفعيل الحساب:
                            </p>

                            <div style="margin: 30px 0;">
                                <a href="{!! $url !!}" target="_blank" style="background: linear-gradient(135deg, #2C1A11 0%, #7A4E32 100%); color: #FFFFFF; padding: 14px 32px; text-decoration: none; border-radius: 10px; font-weight: 700; font-size: 16px; display: inline-block; box-shadow: 0 4px 12px rgba(44, 26, 17, 0.15);">
                                    تأكيد البريد الإلكتروني
                                </a>
                            </div>

                            <p style="color: #7E6B5D; font-size: 13px; line-height: 1.5; margin: 25px 0 10px 0;">
                                تنتهي صلاحية هذا الرابط خلال 60 دقيقة.
                            </p>
                            <p style="color: #7E6B5D; font-size: 13px; line-height: 1.5; margin: 0;">
                                إذا لم تقم بإنشاء هذا الحساب، يمكنك تجاهل هذه الرسالة بأمان.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>