<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ميسو سويت - Miso Sweet | أشهى الحلويات الطازجة')</title>
    <meta name="google-site-verification" content="PQkDxcJ69w0b7_Qo2GrQO2gAI8mYiqXgRfzodxguNyk" />
    <meta name="description" content="@yield('meta_description', 'متجر ميسو سويت (Miso Sweet) - أشهى وأطيب الحلويات والكيك الطازج يومياً بأعلى جودة وطعم استثنائي.')">
    <meta name="keywords" content="ميسو سويت, Miso Sweet, miso sweet, متجر حلويات, كيك طازج, حلويات ميسو">
    <meta property="og:title" content="ميسو سويت - Miso Sweet">
    <meta property="og:description" content="متجر ميسو سويت (Miso Sweet) - أشهى وأطيب الحلويات والكيك الطازج يومياً.">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/png" href="{{ asset('Favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #FDFBF7;
            color: #2C1A11;
        }

        header.top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 65px;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            z-index: 1000;
            display: flex;
            align-items: center;
        }

        .nav-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo-img {
            height: 48px;
            width: auto;
            object-fit: contain;
        }

        .nav-links-wrapper {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 40px;
            margin: 0;
            padding: 0;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
            font-size: 15px;
            transition: color 0.2s ease;
        }

        .nav-menu a:hover {
            color: #e53935;
        }

        .user-auth-section {
            display: flex;
            align-items: center;
            gap: 15px;
            border-right: 2px solid #f0f0f0;
            padding-right: 18px;
        }

        .profile-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            font-size: 15px;
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

        .logout-btn {
            background-color: #e53935;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        .logout-btn:hover {
            background-color: #c62828;
        }

        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            justify-content: space-around;
            width: 30px;
            height: 24px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            z-index: 1001;
        }

        .mobile-menu-toggle span {
            width: 100%;
            height: 3px;
            background-color: #333;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* Responsive Breakpoints */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
            }

            .nav-links-wrapper {
                position: fixed;
                top: 65px;
                right: 0;
                left: 0;
                background-color: #ffffff;
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
                gap: 20px;
                border-bottom: 1px solid #ddd;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                display: none;
            }

            .nav-links-wrapper.active {
                display: flex;
            }

            .nav-menu {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
                gap: 15px;
            }

            .user-auth-section {
                border-right: none;
                border-top: 1px solid #eee;
                padding-right: 0;
                padding-top: 15px;
                width: 100%;
                justify-content: space-between;
            }
        }

        main.content-container {
            margin-top: 85px;
            margin-bottom: 40px;
            padding: 20px;
            min-height: calc(100vh - 450px);
        }

        .site-footer {
            background: linear-gradient(135deg, #2C1A11 0%, #1F120B 100%);
            color: #FFFFFF;
            padding: 50px 20px 20px 20px;
            margin-top: 50px;
            border-top: 3px solid #7A4E32;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        .footer-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 30px;
            backdrop-filter: blur(10px);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .header-icon {
            font-size: 24px;
            color: #D4BBA5;
            background: rgba(212, 187, 165, 0.15);
            padding: 12px;
            border-radius: 12px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 700;
            color: #FFFFFF;
        }

        .card-header p {
            margin: 4px 0 0 0;
            font-size: 0.85rem;
            color: #A09085;
        }

        .footer-message-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-field {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8E7C70;
            font-size: 15px;
        }

        .textarea-icon {
            top: 18px;
            transform: none;
        }

        .form-field input,
        .form-field textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            padding: 12px 42px 12px 15px;
            color: #FFFFFF;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            box-sizing: border-box;
            transition: all 0.25s ease;
        }

        .form-field textarea {
            height: 100px;
            resize: vertical;
        }

        .form-field input::placeholder,
        .form-field textarea::placeholder {
            color: #8E7C70;
        }

        .form-field input:focus,
        .form-field textarea:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: #D4BBA5;
            box-shadow: 0 0 0 3px rgba(212, 187, 165, 0.15);
        }

        .submit-msg-btn {
            background: linear-gradient(135deg, #7A4E32 0%, #5E3B24 100%);
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            padding: 13px 20px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .submit-msg-btn:hover {
            background: linear-gradient(135deg, #8E5B3C 0%, #6E462B 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }

        .contact-info-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-info {
            margin-bottom: 25px;
        }

        .footer-logo {
            height: 50px;
            margin-bottom: 12px;
        }

        .brand-info h2 {
            margin: 0 0 8px 0;
            font-size: 1.5rem;
            color: #FFFFFF;
        }

        .brand-info p {
            margin: 0;
            font-size: 0.9rem;
            color: #A09085;
            line-height: 1.6;
        }

        .social-links-grid {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-top: 15px;
        }

        .social-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #FFFFFF;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-sizing: border-box;
        }

        .social-btn i {
            font-size: 20px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.25s ease;
        }

        /* Specific Optical Sizing for standard alignment & consistency */
        .social-btn.whatsapp i {
            font-size: 22px;
        }

        .social-btn.instagram i {
            font-size: 21px;
        }

        .social-btn.youtube i {
            font-size: 19px;
        }

        .social-btn.tiktok i {
            font-size: 20px;
        }

        .social-btn.facebook i {
            font-size: 20px;
        }

        .social-btn:hover {
            transform: translateY(-3px) scale(1.05);
            border-color: transparent;
        }

        .social-btn:hover i {
            transform: scale(1.1);
        }

        /* Individual Social Colors on Hover */
        .social-btn.whatsapp:hover {
            background-color: #25D366;
            color: #fff;
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.35);
        }

        .social-btn.instagram:hover {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            color: #fff;
            box-shadow: 0 6px 16px rgba(220, 39, 67, 0.35);
        }

        .social-btn.youtube:hover {
            background-color: #FF0000;
            color: #fff;
            box-shadow: 0 6px 16px rgba(255, 0, 0, 0.35);
        }

        .social-btn.tiktok:hover {
            background-color: #000000;
            border-color: #00F2FE;
            color: #fff;
            box-shadow: 0 6px 16px rgba(0, 242, 254, 0.25);
        }

        .social-btn.facebook:hover {
            background-color: #1877F2;
            color: #fff;
            box-shadow: 0 6px 16px rgba(24, 119, 242, 0.35);
        }

        .contact-details-section {
            margin-bottom: 22px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .contact-detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            background: rgba(255, 255, 255, 0.05);
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.25s ease;
        }

        .contact-detail-item:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(212, 187, 165, 0.3);
        }

        .contact-detail-item i {
            font-size: 16px;
            color: #D4BBA5;
            min-width: 18px;
        }

        .contact-detail-item .detail-info {
            display: flex;
            flex-direction: column;
        }

        .contact-detail-item .detail-label {
            font-size: 0.75rem;
            color: #8E7C70;
            margin-bottom: 2px;
        }

        .contact-detail-item a {
            color: #FFFFFF;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            direction: ltr;
            unicode-bidi: embed;
        }

        .contact-detail-item a:hover {
            color: #D4BBA5;
        }

        .footer-bottom-bar {
            max-width: 1200px;
            margin: 40px auto 0 auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            font-size: 0.85rem;
            color: #7E6B5D;
        }

        @media (max-width: 900px) {
            .footer-container {
                grid-template-columns: 1fr;
                gap: 25px;
            }
        }

        @media (max-width: 480px) {
            .social-links-grid {
                justify-content: center;
            }

            .contact-details-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    @include('partials.popup-message')

    <header class="top-navbar">
        <div class="nav-container">
            <nav class="nav-links-wrapper" id="navLinksWrapper">
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}">الرئيسية</a></li>
                    <li><a href="{{ route('products') }}">المنتجات</a></li>
                    <li><a href="{{ route('about-us') }}">من نحن</a></li>
                </ul>

                <div class="user-auth-section">
                    @auth
                        <a href="{{ route('profile.edit', auth()->id()) }}" title="البروفايل" class="profile-link">
                            <img src="{{ auth()->user()->picture ? asset('storage/' . auth()->user()->picture) : "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%23777' viewBox='0 0 24 24'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>" }}"
                                alt="البروفايل" class="avatar-img">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                        </a>

                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn">تسجيل خروج</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" title="تسجيل الدخول" class="profile-link">
                            <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%23ccc' viewBox='0 0 24 24'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>"
                                alt="تسجيل الدخول" class="avatar-img">
                            <span>تسجيل الدخول</span>
                        </a>
                    @endauth
                </div>
            </nav>

            <a href="{{ route('home') ?? '#' }}" title="الرئيسية" class="logo-link">
                <img src="{{ asset('Favicon.png') }}" alt="Logo" class="logo-img">
            </a>

            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="قائمة التنقل">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <main class="content-container">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    @php
        $contactInfo = $contact ?? \App\Models\Contact::first();
    @endphp
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-card message-card">
                <div class="card-header">
                    <i class="fa-solid fa-paper-plane header-icon"></i>
                    <div>
                        <h3>أرسل لنا رسالة</h3>
                        <p>يسعدنا دائماً استقبال استفساراتك واقتراحاتك</p>
                    </div>
                </div>
                <form action="{{ route('messages.store') ?? '#' }}" method="POST" class="footer-message-form">
                    @csrf
                    <div class="form-field">
                        <i class="fa-solid fa-phone input-icon"></i>
                        <input type="text" name="phone" placeholder="رقم الهاتف أو الواتساب (اختياري)">
                    </div>
                    <div class="form-field">
                        <i class="fa-solid fa-comment-dots input-icon textarea-icon"></i>
                        <textarea name="message" placeholder="اكتب رسالتك هنا..." required></textarea>
                    </div>
                    @auth
                        <button type="submit" class="submit-msg-btn">
                            <span>إرسال الرسالة</span>
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="submit-msg-btn">
                            <span>تسجيل الدخول لإرسال رسالة</span>
                            <i class="fa-solid fa-paper-plane"></i>
                        </a>
                    @endauth
                </form>
            </div>

            <div class="footer-card contact-info-card">
                <div class="brand-info">
                    <img src="{{ asset('Favicon.png') }}" alt="ميسو سويت" class="footer-logo">
                    <h2>تواصلوا معنا</h2>
                    <p>يسعدنا تواصلكم معنا عبر مختلف المنصات وقنوات الاتصال لمعرفة أحدث العروض والحلويات الطازجة يومياً.
                    </p>
                </div>

                @if(!empty($contactInfo?->email) || !empty($contactInfo?->phone1) || !empty($contactInfo?->phone2) || !empty($contactInfo?->phone3))
                    <div class="contact-details-section">
                        @if(!empty($contactInfo?->email))
                            <div class="contact-detail-item">
                                <i class="fa-solid fa-envelope"></i>
                                <div class="detail-info">
                                    <a href="mailto:{{ $contactInfo->email }}">{{ $contactInfo->email }}</a>
                                </div>
                            </div>
                        @endif

                        @if(!empty($contactInfo?->phone1))
                            <div class="contact-detail-item">
                                <i class="fa-solid fa-phone"></i>
                                <div class="detail-info">
                                    <a href="tel:{{ $contactInfo->phone1 }}">{{ $contactInfo->phone1 }}</a>
                                </div>
                            </div>
                        @endif

                        @if(!empty($contactInfo?->phone2))
                            <div class="contact-detail-item">
                                <i class="fa-solid fa-phone"></i>
                                <div class="detail-info">
                                    <a href="tel:{{ $contactInfo->phone2 }}">{{ $contactInfo->phone2 }}</a>
                                </div>
                            </div>
                        @endif

                        @if(!empty($contactInfo?->phone3))
                            <div class="contact-detail-item">
                                <i class="fa-solid fa-phone"></i>
                                <div class="detail-info">
                                    <a href="tel:{{ $contactInfo->phone3 }}">{{ $contactInfo->phone3 }}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <div class="social-links-grid">
                    @if(!empty($contactInfo?->whatsapp))
                        <a href="{{ str_starts_with($contactInfo->whatsapp, 'http') ? $contactInfo->whatsapp : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $contactInfo->whatsapp) }}"
                            target="_blank" class="social-btn whatsapp" title="واتساب">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    @endif

                    @if(!empty($contactInfo?->instagram))
                        <a href="{{ str_starts_with($contactInfo->instagram, 'http') ? $contactInfo->instagram : 'https://www.instagram.com/' . $contactInfo->instagram }}"
                            target="_blank" class="social-btn instagram" title="إنستغرام">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif

                    @if(!empty($contactInfo?->youtube))
                        <a href="{{ str_starts_with($contactInfo->youtube, 'http') ? $contactInfo->youtube : 'https://www.youtube.com/' . $contactInfo->youtube }}"
                            target="_blank" class="social-btn youtube" title="يوتيوب">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    @endif

                    @if(!empty($contactInfo?->tiktok))
                        <a href="{{ str_starts_with($contactInfo->tiktok, 'http') ? $contactInfo->tiktok : 'https://www.tiktok.com/@' . $contactInfo->tiktok }}"
                            target="_blank" class="social-btn tiktok" title="تيك توك">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    @endif

                    @if(!empty($contactInfo?->facebook))
                        <a href="{{ str_starts_with($contactInfo->facebook, 'http') ? $contactInfo->facebook : 'https://www.facebook.com/' . $contactInfo->facebook }}"
                            target="_blank" class="social-btn facebook" title="فيسبوك">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="footer-bottom-bar">
            <p>© {{ date('Y') }} ميسو سويت - جميع الحقوق محفوظة</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('mobileMenuToggle');
            const navWrapper = document.getElementById('navLinksWrapper');
            if (toggleBtn && navWrapper) {
                toggleBtn.addEventListener('click', function () {
                    navWrapper.classList.toggle('active');
                });
            }
        });
    </script>
</body>

</html>