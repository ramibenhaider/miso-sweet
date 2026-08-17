<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الرسائل - Messages</title>
</head>
<body>
    <h1>إدارة الرسائل (Messages)</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <hr>

    <h2>الرسائل الواردة</h2>

    @forelse ($messages ?? [] as $message)
        <div style="border: 1px solid #000; padding: 15px; margin-bottom: 15px;">
            <h3>رسالة رقم #{{ $loop->iteration }}</h3>
            <p><strong>تاريخ الرسالة:</strong> {{ $message->created_at }}</p>

            <h4>معلومات المرسل:</h4>
            @if ($message->user)
                <p><strong>الاسم:</strong> {{ $message->user->name }}</p>
                <p><strong>البريد الإلكتروني:</strong> {{ $message->user->email }}</p>
            @else
                <p><em>مرسل غير معروف / غير مسجل</em></p>
            @endif

            @if ($message->phone)
                <p><strong>رقم الهاتف:</strong> {{ $message->phone }}</p>
            @endif

            <h4>نص الرسالة:</h4>
            <p>{{ $message->message }}</p>

            <!-- نموذج حذف الرسالة -->
            <form action="#" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذه الرسالة؟')">حذف الرسالة</button>
            </form>
        </div>
    @empty
        <p>لا توجد رسائل واردة حتى الآن.</p>
    @endforelse
</body>
</html>
