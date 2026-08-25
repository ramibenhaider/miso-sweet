<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم - ميسو سويت')</title>
    <link rel="icon" type="image/png" href="{{ asset('Favicon.png') }}">

    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --admin-bg: #FAF7F2;
            --admin-card-bg: #FFFFFF;
            --admin-primary: #8B5A2B;
            --admin-primary-hover: #6E4420;
            --admin-dark: #2C1A11;
            --admin-text-body: #4A3B32;
            --admin-border: rgba(44, 26, 17, 0.08);
            --admin-radius: 12px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Tajawal', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--admin-bg);
            color: var(--admin-text-body);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header Navigation */
        .admin-header {
            background: linear-gradient(135deg, #2C1A11 0%, #1F120B 100%);
            color: #FFFFFF;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .admin-nav-container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #FFFFFF;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 800;
        }

        .admin-brand i {
            color: #8B5A2B;
            font-size: 1.4rem;
        }

        .admin-nav-menu {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 15px;
            color: #E6DCD3;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.25s ease;
        }

        .admin-nav-link:hover, .admin-nav-link.active {
            background: rgba(139, 90, 43, 0.25);
            color: #FFFFFF;
        }

        .admin-user-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-profile-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #FDFBF7;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.08);
            padding: 7px 14px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            transition: background 0.25s ease;
        }

        .admin-profile-btn:hover {
            background: rgba(255, 255, 255, 0.18);
        }

        .btn-logout {
            background: rgba(198, 40, 40, 0.85);
            color: #FFFFFF;
            border: none;
            padding: 7px 14px;
            border-radius: 20px;
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.25s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-logout:hover {
            background: #C62828;
        }

        /* Main Content Container */
        .admin-main-content {
            flex: 1;
            max-width: 1250px;
            width: 100%;
            margin: 0 auto;
            padding: 30px 20px 60px;
        }

        .admin-page-header {
            margin-bottom: 25px;
        }

        .admin-page-title {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--admin-dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-page-title i {
            color: var(--admin-primary);
        }

        /* Reusable Card Component */
        .admin-card {
            background: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: var(--admin-radius);
            padding: 28px;
            margin-bottom: 28px;
            box-shadow: 0 4px 18px rgba(44, 26, 17, 0.04);
        }

        .admin-card-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--admin-dark);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #F0EAE1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-card-title i {
            color: var(--admin-primary);
        }

        /* Form Controls Styling */
        .admin-form-group {
            margin-bottom: 20px;
        }

        .admin-form-group label {
            display: block;
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--admin-dark);
            margin-bottom: 8px;
        }

        .admin-input, .admin-select, .admin-textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1.5px solid #EFEBE4;
            background: #FDFBF7;
            font-family: inherit;
            font-size: 0.95rem;
            color: var(--admin-dark);
            transition: all 0.25s ease;
            box-sizing: border-box;
        }

        .admin-input:focus, .admin-select:focus, .admin-textarea:focus {
            outline: none;
            border-color: var(--admin-primary);
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(139, 90, 43, 0.12);
        }

        .admin-btn-primary {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-hover) 100%);
            color: #FFFFFF;
            border: none;
            padding: 12px 26px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(139, 90, 43, 0.2);
        }

        .admin-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 90, 43, 0.3);
        }

        .admin-btn-danger {
            background: #C62828;
            color: #FFFFFF;
            border: none;
            padding: 9px 18px;
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .admin-btn-danger:hover {
            background: #B71C1C;
        }

        /* Tables Styling */
        .admin-table-responsive {
            overflow-x: auto;
            border-radius: 10px;
            border: 1px solid var(--admin-border);
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background: #FFFFFF;
            text-align: right;
        }

        .admin-table th {
            background: #F5F0EB;
            color: var(--admin-dark);
            font-weight: 800;
            font-size: 0.9rem;
            padding: 14px 16px;
            border-bottom: 2px solid #EFEBE4;
        }

        .admin-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #F0EAE1;
            font-size: 0.92rem;
            vertical-align: middle;
        }

        .admin-table tbody tr:hover {
            background-color: #FDFBF7;
        }

        /* Footer */
        .admin-footer {
            background: #FFFFFF;
            border-top: 1px solid var(--admin-border);
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            color: #7E6B5D;
            margin-top: auto;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .admin-nav-container {
                flex-direction: column;
                height: auto;
                padding: 15px;
                gap: 15px;
            }

            .admin-nav-menu {
                flex-wrap: wrap;
                justify-content: center;
            }

            .admin-user-controls {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    @include('partials.popup-message')

    @if (auth()->check() && auth()->user()->role == 'admin')
        <header class="admin-header">
            <div class="admin-nav-container">
                <a href="{{ route('categories-contacts') }}" class="admin-brand">
                    <i class="fa-solid fa-crown"></i>
                    <span>ميسو سويت - لوحة التحكم</span>
                </a>

                <nav>
                    <ul class="admin-nav-menu">
                        <li>
                            <a href="{{ route('categories-contacts') }}" class="admin-nav-link {{ request()->routeIs('categories-contacts') ? 'active' : '' }}">
                                <i class="fa-solid fa-sliders"></i>
                                <span>الأقسام والتواصل</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.index') }}" class="admin-nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}">
                                <i class="fa-solid fa-box-open"></i>
                                <span>إدارة المنتجات</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}" class="admin-nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                                <i class="fa-solid fa-users"></i>
                                <span>إدارة المستخدمين</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('messages.index') }}" class="admin-nav-link {{ request()->routeIs('messages.index') ? 'active' : '' }}">
                                <i class="fa-solid fa-comments"></i>
                                <span>الرسائل</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about-us.index') }}" class="admin-nav-link {{ request()->routeIs('about-us.edit') ? 'active' : '' }}">
                                <i class="fa-solid fa-circle-info"></i>
                                <span>من نحن</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" class="admin-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="fa-solid fa-home"></i>
                                <span>الموقع</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="admin-user-controls">
                    <a href="{{ route('profile.edit', auth()->user()->id) }}" class="admin-profile-btn">
                        <i class="fa-solid fa-user-gear"></i>
                        <span>{{ auth()->user()->name }}</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>خروج</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>
    @endif

    <main class="admin-main-content">
        @yield('content')
    </main>

    <footer class="admin-footer">
        <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة - لوحة تحكم ميسو سويت</p>
    </footer>

</body>

</html>