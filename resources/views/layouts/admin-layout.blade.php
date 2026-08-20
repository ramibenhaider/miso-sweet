<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم')</title>
    <link rel="icon" type="image/png" href="{{ asset('Favicon.png') }}">
</head>

<body>
    @if (auth()->user()->role == 'admin')
        <header>
            <nav>
                <ul>
                    <li><a href="{{ route('categories-contacts') }}">الأقسام والتواصل</a></li>
                    <li><a href="{{ route('product.index') }}">إدارة المنتجات</a></li>
                    <li><a href="{{ route('users.index') }}">إدارة المستخدمين</a></li>
                    <li><a href="{{ route('messages.index') }}">الرسائل</a></li>
                </ul>
            </nav>

            <div>
                @auth
                    <a href="{{ route('profile.edit', auth()->user()->id) }}">تعديل البروفايل ({{ auth()->user()->name }})</a>

                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit">تسجيل الخروج</button>
                    </form>
                @endauth
            </div>
        </header>
    @endif
    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة - لوحة التحكم</p>
    </footer>

</body>

</html>