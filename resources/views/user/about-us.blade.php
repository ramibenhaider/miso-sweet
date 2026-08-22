@extends('layouts.user-layout')

@section('title',  'من نحن')

@section('content')
<style>
    .about-page-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 10px 20px 60px;
    }

    .about-hero-header {
        text-align: center;
        padding: 45px 20px;
        background: linear-gradient(135deg, #2C1A11 0%, #1F120B 100%);
        color: #FFFFFF;
        border-radius: 16px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(44, 26, 17, 0.15);
        position: relative;
        overflow: hidden;
    }

    .about-hero-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 50% 0%, rgba(139, 90, 43, 0.25), transparent 70%);
        pointer-events: none;
    }

    .about-hero-badge {
        display: inline-block;
        background: rgba(139, 90, 43, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #FDFBF7;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 6px 18px;
        border-radius: 30px;
        margin-bottom: 16px;
        backdrop-filter: blur(4px);
    }

    .about-hero-header h1 {
        font-size: 2.4rem;
        font-weight: 900;
        margin: 0 0 12px 0;
        color: #FFFFFF;
    }

    .about-hero-header p {
        font-size: 1.05rem;
        color: #E6DCD3;
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.7;
        font-weight: 500;
    }

    .about-card-box {
        background: #FFFFFF;
        border: 1px solid rgba(44, 26, 17, 0.08);
        border-radius: 14px;
        padding: 32px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(44, 26, 17, 0.04);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .about-card-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(44, 26, 17, 0.08);
    }

    .about-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 2px solid #F0EAE1;
    }

    .about-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: rgba(139, 90, 43, 0.1);
        color: #8B5A2B;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .about-card-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #2C1A11;
        margin: 0;
    }

    .about-card-body {
        font-size: 1.02rem;
        line-height: 1.85;
        color: #4A3B32;
        margin: 0;
        white-space: pre-line;
        font-weight: 500;
    }

    .about-two-columns-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 30px;
    }

    .about-two-columns-grid .about-card-box {
        margin-bottom: 0;
        height: 100%;
        box-sizing: border-box;
    }

    .about-empty-state {
        text-align: center;
        padding: 50px 20px;
        background: #FFFFFF;
        border-radius: 14px;
        border: 1px solid rgba(44, 26, 17, 0.08);
        color: #7E6B5D;
    }

    .about-empty-state i {
        font-size: 3rem;
        color: #C5B8AC;
        margin-bottom: 16px;
    }

    .about-empty-state h3 {
        font-size: 1.3rem;
        color: #2C1A11;
        margin-bottom: 8px;
    }

    @media (max-width: 768px) {
        .about-page-container {
            padding: 10px 15px 40px;
        }

        .about-hero-header {
            padding: 30px 16px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .about-hero-header h1 {
            font-size: 1.75rem;
        }

        .about-hero-header p {
            font-size: 0.92rem;
        }

        .about-card-box {
            padding: 22px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .about-icon-wrap {
            width: 40px;
            height: 40px;
            font-size: 1.15rem;
        }

        .about-card-title {
            font-size: 1.15rem;
        }

        .about-card-body {
            font-size: 0.95rem;
            line-height: 1.75;
        }

        .about-two-columns-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<div class="about-page-container">
    <div class="about-hero-header">
        <span class="about-hero-badge">ميسو سويت ✨</span>
        <h1>من نحن</h1>
        <p>قصتنا وشغفنا في تقديم أشهى المخبوزات والحلويات المصنوعة بجودة عالية ونكهة لا تُنسى</p>
    </div>

    @php
        $hasData = !empty($aboutUs?->about_us) || !empty($aboutUs?->our_vision) || !empty($aboutUs?->our_mission) || !empty($aboutUs?->why_us);
    @endphp

    @if($hasData)
        @if(!empty($aboutUs?->about_us))
            <div class="about-card-box">
                <div class="about-card-header">
                    <div class="about-icon-wrap">
                        <i class="fa-solid fa-cookie-bite"></i>
                    </div>
                    <h2 class="about-card-title">من نحن؟</h2>
                </div>
                <div class="about-card-body">
                    {{ $aboutUs->about_us }}
                </div>
            </div>
        @endif

        @if(!empty($aboutUs?->our_vision) || !empty($aboutUs?->our_mission))
            <div class="about-two-columns-grid">
                @if(!empty($aboutUs?->our_vision))
                    <div class="about-card-box">
                        <div class="about-card-header">
                            <div class="about-icon-wrap">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <h2 class="about-card-title">رؤيتنا</h2>
                        </div>
                        <div class="about-card-body">
                            {{ $aboutUs->our_vision }}
                        </div>
                    </div>
                @endif

                @if(!empty($aboutUs?->our_mission))
                    <div class="about-card-box">
                        <div class="about-card-header">
                            <div class="about-icon-wrap">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <h2 class="about-card-title">مهمتنا</h2>
                        </div>
                        <div class="about-card-body">
                            {{ $aboutUs->our_mission }}
                        </div>
                    </div>
                @endif
            </div>
        @endif

        @if(!empty($aboutUs?->why_us))
            <div class="about-card-box">
                <div class="about-card-header">
                    <div class="about-icon-wrap">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h2 class="about-card-title">لماذا نحن؟</h2>
                </div>
                <div class="about-card-body">
                    {{ $aboutUs->why_us }}
                </div>
            </div>
        @endif
    @else
        <div class="about-empty-state">
            <i class="fa-solid fa-mug-hot"></i>
            <h3>مرحباً بك في صفحة من نحن!</h3>
            <p>سيتم إضافة المعلومات والقصة الخاصة بميسو سويت قريباً.</p>
        </div>
    @endif
</div>
@endsection