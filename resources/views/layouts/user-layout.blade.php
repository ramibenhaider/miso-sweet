<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ميسو سويت')</title>
    <link rel="icon" type="image/png" href="{{ asset('Favicon.png') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        header.top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 1000;
        }

        header.top-navbar nav.navbar-right {
            display: flex;
            align-items: center;
        }

        header.top-navbar nav.navbar-right ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        header.top-navbar nav.navbar-right a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .navbar-center-left {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-right: auto;
            margin-left: 20px;
        }

        .profile-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .avatar-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #ccc;
            object-fit: cover;
            vertical-align: middle;
            background-color: #eee;
        }

        .navbar-left {
            display: flex;
            align-items: center;
        }

        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo-img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        main.content-container {
            margin-top: 75px;
            margin-bottom: 140px;
            padding: 20px;
        }

        .bottom-message-box {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 999;
            background: white;
            border-top: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>

<body>

    <header class="top-navbar">
        <nav class="navbar-right">
            <ul>
                <li><a href="{{ route('home') ?? '#' }}">الصفحة الرئيسية</a></li>
                <li><a href="{{ route('products') ?? '#' }}">صفحة المنتجات</a></li>
                <li><a href="{{ route('about-us') ?? '#' }}">صفحة من نحن</a></li>
            </ul>
        </nav>

        <div class="navbar-center-left">
            @auth
                <a href="{{ route('profile.edit', auth()->id()) ?? '#' }}" title="البروفايل" class="profile-link">
                    <img src="{{ auth()->user()->picture ? asset('storage/' . auth()->user()->picture) : "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%23777' viewBox='0 0 24 24'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>" }}"
                        alt="البروفايل" class="avatar-img">
                    <span class="user-name">{{ auth()->user()->name }}</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">تسجيل خروج</button>
                </form>
            @else
                <a href="{{ route('login') }}" title="تسجيل الدخول" class="profile-link">
                    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%23ccc' viewBox='0 0 24 24'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>"
                        alt="تسجيل الدخول" class="avatar-img">
                    <span>تسجيل الدخول</span>
                </a>
            @endauth
        </div>

        <div class="navbar-left">
            <a href="{{ route('home') ?? '#' }}" title="الرئيسية" class="logo-link">
                <img src="{{ asset('Favicon.png') }}" alt="Logo" class="logo-img">
            </a>
        </div>
    </header>

    <main class="content-container">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <div class="bottom-message-box">
        <form action="{{ route('messages.store') ?? '#' }}" method="POST">
            @csrf
            <input type="text" name="phone" placeholder="رقم الهاتف (اختياري)">
            <textarea name="message" placeholder="اكتب رسالتك هنا..." required></textarea>
            <button type="submit">إرسال الرسالة</button>
        </form>
    </div>

</body>

</html>
