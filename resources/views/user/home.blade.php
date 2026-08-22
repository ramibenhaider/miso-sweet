@extends('layouts.user-layout')

@section('title', 'الصفحة الرئيسية - ميسو سويت')

@section('content')
    <style>
        .hero-video-section {
            position: relative;
            width: 100vw;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            margin-top: -20px;
            height: 78vh;
            min-height: 520px;
            max-height: 750px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #1F120B;
        }

        .hero-bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            z-index: 1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, rgba(31, 18, 11, 0.55) 0%, rgba(31, 18, 11, 0.82) 100%);
            z-index: 2;
        }

        .hero-content-wrapper {
            position: relative;
            z-index: 3;
            max-width: 850px;
            padding: 0 20px;
            text-align: center;
            color: #FFFFFF;
        }

        .hero-badge-tag {
            display: inline-block;
            background: rgba(139, 90, 43, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #FDFBF7;
            font-size: 0.88rem;
            font-weight: 700;
            padding: 6px 18px;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
            backdrop-filter: blur(4px);
        }

        .hero-main-title {
            font-size: 2.8rem;
            font-weight: 900;
            line-height: 1.3;
            margin: 0 0 20px 0;
            color: #FFFFFF;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .hero-subtitle-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #E6DCD3;
            margin: 0 0 35px 0;
            font-weight: 500;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        }

        .hero-cta-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .hero-btn-primary {
            background: #8B5A2B;
            color: #FFFFFF;
            text-decoration: none;
            padding: 15px 36px;
            font-size: 1.05rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #8B5A2B;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .hero-btn-primary:hover {
            background: #6E4420;
            border-color: #6E4420;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .hero-btn-secondary {
            background: rgba(255, 255, 255, 0.12);
            color: #FFFFFF;
            text-decoration: none;
            padding: 15px 30px;
            font-size: 1.05rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }

        .hero-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #FFFFFF;
            transform: translateY(-3px);
        }

        .hero-fallback-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, #3D2317 0%, #1F120B 100%);
            z-index: 1;
        }

        .home-sections-container {
            max-width: 1200px;
            margin: 50px auto 40px;
            padding: 0 20px;
        }

        .home-section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .home-section-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #2C1A11;
            margin: 0 0 10px 0;
        }

        .home-section-header p {
            color: #7E6B5D;
            font-size: 1rem;
            margin: 0;
        }

        .categories-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
        }

        .category-preview-card {
            background: #FFFFFF;
            border: 1px solid rgba(44, 26, 17, 0.08);
            padding: 25px 20px;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
        }

        .category-preview-card:hover {
            transform: translateY(-6px);
            border-color: #8B5A2B;
            box-shadow: 0 12px 25px rgba(44, 26, 17, 0.08);
        }

        .category-icon-box {
            width: 60px;
            height: 60px;
            background: #FDFBF7;
            border: 1px solid #F0EAE1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8B5A2B;
            font-size: 1.6rem;
            margin-bottom: 16px;
        }

        .category-preview-card h3 {
            font-size: 1.2rem;
            font-weight: 800;
            color: #2C1A11;
            margin: 0 0 8px 0;
        }

        .category-preview-card p {
            font-size: 0.88rem;
            color: #7E6B5D;
            margin: 0;
        }

        @media (max-width: 768px) {
            .hero-video-section {
                height: 65vh;
                min-height: 440px;
            }

            .hero-main-title {
                font-size: 1.9rem;
            }

            .hero-subtitle-text {
                font-size: 1rem;
                margin-bottom: 25px;
            }

            .hero-btn-primary,
            .hero-btn-secondary {
                width: 100%;
                justify-content: center;
                padding: 13px 20px;
                font-size: 0.98rem;
            }
        }

        @media (max-width: 480px) {
            .hero-video-section {
                height: 70vh;
                min-height: 400px;
            }

            .hero-main-title {
                font-size: 1.55rem;
                margin-bottom: 12px;
            }

            .hero-subtitle-text {
                font-size: 0.92rem;
                line-height: 1.65;
                margin-bottom: 20px;
            }

            .hero-badge-tag {
                font-size: 0.78rem;
                padding: 4px 12px;
                margin-bottom: 12px;
            }

            .categories-preview-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Messages / Testimonials Section */
        .messages-section-container {
            max-width: 1200px;
            margin: 60px auto 40px;
            padding: 0 15px;
        }

        .messages-section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .messages-section-header h2 {
            font-size: 2.1rem;
            font-weight: 800;
            color: #2C1A11;
            margin-bottom: 8px;
        }

        .messages-section-header p {
            font-size: 1rem;
            color: #7E6B5D;
            font-weight: 500;
        }

        .messages-marquee-wrapper {
            overflow: hidden;
            position: relative;
            width: 100%;
            padding: 10px 0 25px 0;
            mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%);
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 4%, black 96%, transparent 100%);
        }

        .messages-marquee-track {
            display: flex;
            gap: 20px;
            width: max-content;
            animation: marqueeContinuous 38s linear infinite;
        }

        .messages-marquee-wrapper:hover .messages-marquee-track {
            animation-play-state: paused;
        }

        .message-testimonial-card {
            flex: 0 0 320px;
            width: 320px;
            background: #FFFFFF;
            border: 1px solid rgba(44, 26, 17, 0.08);
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(44, 26, 17, 0.04);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .message-testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(44, 26, 17, 0.1);
        }

        .message-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .message-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .message-user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #EFEBE4;
            background: #FDFBF7;
        }

        .message-user-name {
            font-size: 0.98rem;
            font-weight: 700;
            color: #2C1A11;
            margin: 0;
        }

        .quote-icon {
            font-size: 1.5rem;
            color: rgba(139, 90, 43, 0.25);
        }

        .message-card-body {
            font-size: 0.93rem;
            line-height: 1.65;
            color: #4A3B32;
            margin-bottom: 20px;
            flex: 1;
            white-space: pre-line;
        }

        .message-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
            color: #A09085;
            border-top: 1px dashed #EFEBE4;
            padding-top: 12px;
        }

        @keyframes marqueeContinuous {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(50%);
            }
        }
    </style>

    <div class="hero-video-section">
        @php
            $videoUrl = null;
            if (!empty($heroSettings?->hero_video)) {
                $videoUrl = str_starts_with($heroSettings->hero_video, 'http')
                    ? $heroSettings->hero_video
                    : asset('storage/' . $heroSettings->hero_video);
            }
        @endphp

        @if($videoUrl)
            <video autoplay loop muted playsinline class="hero-bg-video">
                <source src="{{ $videoUrl }}" type="video/mp4">
                <source src="{{ $videoUrl }}" type="video/webm">
            </video>
        @else
            <div class="hero-fallback-bg"></div>
        @endif

        <div class="hero-overlay"></div>

        <div class="hero-content-wrapper">
            <span class="hero-badge-tag">ميسو سويت ✨</span>

            <h1 class="hero-main-title">
                {{ $heroSettings?->hero_title ?? '' }}
            </h1>

            <p class="hero-subtitle-text">
                {{ $heroSettings?->hero_subtitle ?? '' }}
            </p>

            <div class="hero-cta-group">
                <a href="{{ $heroSettings?->hero_button_link ?? route('products') }}" class="hero-btn-primary">
                    <span>{{ $heroSettings?->hero_button_text ?? 'تصفح قائمة المنتجات' }}</span>
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                @if(!empty($heroSettings?->whatsapp))
                    <a href="{{ str_starts_with($heroSettings->whatsapp, 'http') ? $heroSettings->whatsapp : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $heroSettings->whatsapp) }}"
                        target="_blank" class="hero-btn-secondary">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>تواصل معنا مباشرة</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="home-sections-container">
        <div class="home-section-header">
            <h2>أقسامنا المميزة</h2>
            <p>استكشف تشكيلتنا المتنوعة من الحلويات والمخبوزات المعدة بحب</p>
        </div>

        <div class="categories-preview-grid">
            @forelse($categories ?? [] as $category)
                @if($category->products->count() > 0)
                    <a class="category-preview-card">
                        <div class="category-icon-box">
                            <i class="fa-solid fa-cake-candles"></i>
                        </div>
                        <h3>{{ $category->name }}</h3>
                    </a>
                @endif
            @empty
                <p>سيتم عرض الأقسام قريباُ</p>
            @endforelse
        </div>
    </div>

    @if(isset($shown_messages) && $shown_messages->count() > 0)
        <div class="messages-section-container">
            <div class="messages-section-header">
                <h2>بعض الرسائل التي تصلنا</h2>
                <p>رسائل وكلمات نعتز بها من عملاء ميسو سويت المميزين</p>
            </div>

            <div class="messages-marquee-wrapper">
                <div class="messages-marquee-track">
                    {{-- First loop of messages --}}
                    @foreach($shown_messages as $msg)
                        <div class="message-testimonial-card">
                            <div class="message-card-header">
                                <div class="message-user-info">
                                    <img src="{{ $msg->user && $msg->user->picture ? asset('storage/' . $msg->user->picture) : "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%238B5A2B' viewBox='0 0 24 24'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>" }}"
                                         alt="صورة العميل" class="message-user-avatar">
                                    <div>
                                        <h4 class="message-user-name">{{ $msg->user ? $msg->user->name : 'عميل ميسو سويت' }}</h4>
                                    </div>
                                </div>
                                <i class="fa-solid fa-quote-right quote-icon"></i>
                            </div>

                            <div class="message-card-body">
                                {{ $msg->message }}
                            </div>

                            <div class="message-card-footer">
                                <span><i class="fa-regular fa-clock" style="margin-left: 4px;"></i> {{ $msg->created_at ? $msg->created_at->locale('ar')->diffForHumans() : '' }}</span>
                            </div>
                        </div>
                    @endforeach

                    {{-- Duplicate loop for seamless infinite smooth marquee scrolling --}}
                    @foreach($shown_messages as $msg)
                        <div class="message-testimonial-card">
                            <div class="message-card-header">
                                <div class="message-user-info">
                                    <img src="{{ $msg->user && $msg->user->picture ? asset('storage/' . $msg->user->picture) : "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%238B5A2B' viewBox='0 0 24 24'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>" }}"
                                         alt="صورة العميل" class="message-user-avatar">
                                    <div>
                                        <h4 class="message-user-name">{{ $msg->user ? $msg->user->name : 'عميل ميسو سويت' }}</h4>
                                    </div>
                                </div>
                                <i class="fa-solid fa-quote-right quote-icon"></i>
                            </div>

                            <div class="message-card-body">
                                {{ $msg->message }}
                            </div>

                            <div class="message-card-footer">
                                <span><i class="fa-regular fa-clock" style="margin-left: 4px;"></i> {{ $msg->created_at ? $msg->created_at->locale('ar')->diffForHumans() : '' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection