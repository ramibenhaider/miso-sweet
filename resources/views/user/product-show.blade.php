@extends('layouts.user-layout')

@section('title', $product->name . ' - ميسو سويت')

@section('content')
<style>
    .product-details-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 10px 15px 60px;
    }

    .back-btn-wrapper {
        margin-bottom: 25px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #7E6B5D;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 8px 16px;
        background: #FFFFFF;
        border: 1px solid #EFEBE4;
        border-radius: 0;
        transition: all 0.25s ease;
    }

    .back-link:hover {
        background: #8B5A2B;
        color: #FFFFFF;
        border-color: #8B5A2B;
    }

    .product-header-info {
        margin-bottom: 20px;
    }

    .category-badge-link {
        display: inline-block;
        background: #F5F0EB;
        color: #8B5A2B;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 4px 12px;
        margin-bottom: 10px;
        border-radius: 0;
    }

    .product-main-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: #2C1A11;
        margin: 0;
        line-height: 1.3;
    }

    .main-image-container {
        width: 100%;
        max-height: 480px;
        background-color: #FDFBF7;
        border: 1px solid #F0EAE1;
        border-radius: 0;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
    }

    .main-product-img {
        width: 100%;
        max-height: 480px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .main-image-container:hover .main-product-img {
        transform: scale(1.02);
    }

    .product-price-section {
        background: #FDFBF7;
        border: 1px solid #F5F0EB;
        border-radius: 0;
        padding: 16px 20px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .price-title-label {
        font-size: 1rem;
        color: #7E6B5D;
        font-weight: 700;
    }

    .price-value-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .price-amount {
        font-size: 1.8rem;
        font-weight: 900;
        color: #8B5A2B;
    }

    .currency-badge {
        font-size: 0.95rem;
        font-weight: 700;
        background: rgba(139, 90, 43, 0.12);
        color: #8B5A2B;
        padding: 4px 10px;
        border-radius: 0;
        display: inline-flex;
        align-items: center;
    }

    .product-description-card-frame {
        background: #FFFFFF;
        border: 1px solid rgba(139, 90, 43, 0.18);
        border-radius: 12px;
        box-shadow: 0 4px 18px rgba(44, 26, 17, 0.04);
        margin-bottom: 32px;
        overflow: hidden;
    }

    .description-card-header {
        background: #FDFBF7;
        padding: 14px 20px;
        border-bottom: 1px solid #EFEBE4;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .description-card-header i {
        color: #8B5A2B;
        font-size: 1.15rem;
    }

    .description-card-header h3 {
        font-size: 1.08rem;
        font-weight: 800;
        color: #2C1A11;
        margin: 0;
    }

    .description-card-body {
        padding: 22px 24px;
        background: #FFFFFF;
    }

    .description-text {
        font-size: 1.02rem;
        color: #3A2A20;
        line-height: 1.85;
        font-weight: 500;
        margin: 0;
        white-space: pre-line;
        word-break: break-word;
    }

    .horizontal-gallery-section {
        margin-top: 30px;
        padding-top: 15px;
    }

    .gallery-scroll-wrapper {
        display: flex;
        gap: 15px;
        overflow-x: auto;
        padding: 10px 5px 15px;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }

    .gallery-scroll-wrapper::-webkit-scrollbar {
        height: 6px;
    }

    .gallery-scroll-wrapper::-webkit-scrollbar-track {
        background: #F5F0EB;
    }

    .gallery-scroll-wrapper::-webkit-scrollbar-thumb {
        background: #8B5A2B;
    }

    .gallery-thumb-item {
        flex: 0 0 120px;
        width: 120px;
        height: 100px;
        border: 2px solid #EFEBE4;
        background-color: #FDFBF7;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.25s ease;
        position: relative;
        border-radius: 0;
    }

    .gallery-thumb-item.active,
    .gallery-thumb-item:hover {
        border-color: #8B5A2B;
        box-shadow: 0 4px 12px rgba(139, 90, 43, 0.25);
        transform: translateY(-2px);
    }

    .gallery-thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .lightbox-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.9);
        z-index: 99999;
        align-items: center;
        justify-content: center;
        padding: 20px;
        backdrop-filter: blur(5px);
    }

    .lightbox-modal.active {
        display: flex;
    }

    .lightbox-content {
        max-width: 90vw;
        max-height: 85vh;
        object-fit: contain;
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    }

    .lightbox-close-btn {
        position: absolute;
        top: 20px;
        right: 25px;
        color: #FFFFFF;
        font-size: 2.2rem;
        cursor: pointer;
        background: none;
        border: none;
        transition: transform 0.2s ease;
        line-height: 1;
    }

    .lightbox-close-btn:hover {
        transform: scale(1.2);
        color: #E53935;
    }

    .availability-badge-show {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        font-size: 0.84rem;
        font-weight: 700;
        border-radius: 0;
    }

    .availability-badge-show.is-available {
        background: rgba(46, 125, 50, 0.1);
        color: #2E7D32;
        border: 1px solid rgba(46, 125, 50, 0.25);
    }

    .availability-badge-show.not-available {
        background: rgba(198, 40, 40, 0.1);
        color: #C62828;
        border: 1px solid rgba(198, 40, 40, 0.25);
    }

    @media (max-width: 768px) {
        .product-details-container {
            padding: 10px 10px 40px;
        }

        .main-image-container {
            max-height: 350px;
        }

        .main-product-img {
            max-height: 350px;
        }

        .product-main-title {
            font-size: 1.4rem;
        }

        .price-amount {
            font-size: 1.5rem;
        }

        .gallery-thumb-item {
            flex: 0 0 100px;
            width: 100px;
            height: 85px;
        }
    }
</style>

<div class="product-details-container">
    <div class="back-btn-wrapper">
        <a href="{{ route('products') }}" class="back-link">
            <i class="fa-solid fa-arrow-right"></i>
            <span>العودة لقائمة المنتجات</span>
        </a>
    </div>

    <div class="product-header-info">
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            @if($product->category)
                <span class="category-badge-link">{{ $product->category->name }}</span>
            @endif
            @if($product->is_available)
                <span class="availability-badge-show is-available"><i class="fa-solid fa-circle-check"></i> متوفر</span>
            @else
                <span class="availability-badge-show not-available"><i class="fa-solid fa-circle-xmark"></i> غير متوفر حالياً</span>
            @endif
        </div>
        <h1 class="product-main-title">{{ $product->name }}</h1>
    </div>

    <div class="main-image-container" id="mainImageContainer" onclick="openLightbox()">
        @php
            $mainImgUrl = $product->image ? asset('storage/' . $product->image) : "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%23FDFBF7' viewBox='0 0 100 100'><rect width='100' height='100'/><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='%23C5B8AC' font-size='10'>ميسو سويت</text></svg>";
        @endphp
        <img src="{{ $mainImgUrl }}" alt="{{ $product->name }}" id="displayedMainImage" class="main-product-img">
    </div>

    <div class="product-price-section">
        <span class="price-title-label">السعر:</span>
        <div class="price-value-container">
            <span class="price-amount">{{ $product->price }}</span>
            <span class="currency-badge">ر.س</span>
            @if(!empty($product->price_by) && $product->price_by !== 'لم يتم التحديد')
                <span class="currency-badge" style="background: rgba(44, 26, 17, 0.06); color: #4A3B32;">{{ $product->price_by }}</span>
            @endif
        </div>
    </div>

    @php
        $hasOtherPhotos = $product->product_photos && $product->product_photos->count() > 0;
    @endphp

    <div class="horizontal-gallery-section">
        <div class="gallery-scroll-wrapper" id="galleryScrollWrapper">
            <div class="gallery-thumb-item active" onclick="switchMainImage('{{ $mainImgUrl }}', this)">
                <img src="{{ $mainImgUrl }}" alt="{{ $product->name }}" class="gallery-thumb-img">
            </div>
            @if($hasOtherPhotos)
                @foreach($product->product_photos as $photoItem)
                    @php
                        $otherPhotoUrl = asset('storage/' . $photoItem->photo);
                    @endphp
                    <div class="gallery-thumb-item" onclick="switchMainImage('{{ $otherPhotoUrl }}', this)">
                        <img src="{{ $otherPhotoUrl }}" alt="صورة إضافية" class="gallery-thumb-img">
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div class="lightbox-modal" id="lightboxModal" onclick="closeLightbox(event)">
    <button class="lightbox-close-btn" onclick="closeLightbox(event)">&times;</button>
    <img src="" alt="عرض مكبر" id="lightboxImg" class="lightbox-content">
</div>

<div class="product-description-card-frame">
    <div class="description-card-header">
        <i class="fa-solid fa-circle-info"></i>
        <h3>تفاصيل ومعلومات المنتج</h3>
    </div>
    <div class="description-card-body">
        <p class="description-text">{{ $product->description ?? 'لا يوجد وصف تفصيلي لهذا المنتج حالياً.' }}</p>
    </div>
</div>

<script>
    function switchMainImage(imageUrl, element) {
        const mainImg = document.getElementById('displayedMainImage');
        if (mainImg) {
            mainImg.src = imageUrl;
        }

        const thumbs = document.querySelectorAll('.gallery-thumb-item');
        thumbs.forEach(t => t.classList.remove('active'));
        if (element) {
            element.classList.add('active');
        }
    }

    function openLightbox() {
        const currentSrc = document.getElementById('displayedMainImage').src;
        const lightbox = document.getElementById('lightboxModal');
        const lightboxImg = document.getElementById('lightboxImg');
        if (lightbox && lightboxImg) {
            lightboxImg.src = currentSrc;
            lightbox.classList.add('active');
        }
    }

    function closeLightbox(event) {
        if (event.target.id === 'lightboxModal' || event.target.classList.contains('lightbox-close-btn')) {
            const lightbox = document.getElementById('lightboxModal');
            if (lightbox) {
                lightbox.classList.remove('active');
            }
        }
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const lightbox = document.getElementById('lightboxModal');
            if (lightbox && lightbox.classList.contains('active')) {
                lightbox.classList.remove('active');
            }
        }
    });
</script>
@endsection