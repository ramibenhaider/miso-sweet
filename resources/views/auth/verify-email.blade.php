<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تأكيد البريد الإلكترون</title>
</head>
<body style="font-family: Tahoma, Arial, sans-serif; line-height: 1.6; color: #333;">
<div class="container">
    <h2>تأكيد البريد الإلكتروني</h2>
    <p>شكراً لتسجيلك! قبل البدء، يرجى تأكيد بريدك الإلكتروني عبر الضغط على الرابط المرسل إليك.</p>

    @if (session('status') == 'تم إرسال رابط تأكيد جديد إلى بريدك الإلكتروني.')
        <div class="alert alert-success">
            تم إرسال رابط تحقق جديد إلى البريد المسجل.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">إعادة إرسال البريد</button>
    </form>
</div>
</body>
</html>