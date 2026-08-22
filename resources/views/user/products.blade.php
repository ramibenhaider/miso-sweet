@extends('layouts.user-layout')

@section('title', 'قائمة المنتجات')

@section('content')
<style>
    .products-page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 10px 15px 50px;
    }

    .search-section-card {
        background: #FFFFFF;
        border-radius: 0;
        padding: 20px 24px;
        box-shadow: 0 4px 20px rgba(44, 26, 17, 0.04);
        border: 1px solid rgba(44, 26, 17, 0.06);
        margin-bottom: 35px;
    }

    .search-form {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-input-wrapper {
        position: relative;
        flex: 1;
        min-width: 260px;
    }

    .search-input-wrapper i {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #A09085;
        font-size: 1.1rem;
    }

    .search-input {
        width: 100%;
        padding: 12px 45px 12px 16px;
        border-radius: 0;
        border: 1.5px solid #EFEBE4;
        background-color: #FDFBF7;
        font-family: inherit;
        font-size: 0.95rem;
        color: #2C1A11;
        transition: all 0.25s ease;
        box-sizing: border-box;
    }

    .search-input:focus {
        outline: none;
        border-color: #8B5A2B;
        background-color: #FFFFFF;
        box-shadow: 0 0 0 4px rgba(139, 90, 43, 0.12);
    }

    .search-btn {
        background: linear-gradient(135deg, #8B5A2B 0%, #6E4420 100%);
        color: #FFFFFF;
        border: none;
        padding: 12px 26px;
        border-radius: 0;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(139, 90, 43, 0.25);
    }

    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(139, 90, 43, 0.35);
    }

    .clear-search-btn {
        background: #F5F0EB;
        color: #7E6B5D;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 0;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .clear-search-btn:hover {
        background: #EFEBE4;
        color: #2C1A11;
    }

    .search-active-notice {
        margin-top: 12px;
        font-size: 0.9rem;
        color: #7E6B5D;
    }

    .search-active-notice strong {
        color: #8B5A2B;
    }

    .category-block {
        margin-bottom: 45px;
    }

    .category-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
        padding-bottom: 12px;
        border-bottom: 2px solid #F0EAE1;
    }

    .category-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #2C1A11;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .category-title::before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 22px;
        background-color: #8B5A2B;
        border-radius: 0;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
    }

    .product-card {
        background: #FFFFFF;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid rgba(44, 26, 17, 0.07);
        box-shadow: 0 4px 15px rgba(44, 26, 17, 0.03);
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 32px rgba(139, 90, 43, 0.12);
        border-color: rgba(139, 90, 43, 0.3);
    }

    .product-img-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
        background-color: #FDFBF7;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.08);
    }

    .product-info {
        padding: 18px 20px 14px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: #2C1A11;
        margin: 0 0 8px 0;
        line-height: 1.4;
        transition: color 0.25s ease;
    }

    .product-card:hover .product-name {
        color: #8B5A2B;
    }

    .product-description {
        font-size: 0.88rem;
        color: #7E6B5D;
        margin: 0 0 14px 0;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-price-row {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 12px;
        border-top: 1px dashed #F0EAE1;
    }

    .price-label {
        font-size: 0.85rem;
        color: #A09085;
        font-weight: 600;
    }

    .price-value-box {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #8B5A2B;
        font-size: 1.25rem;
        font-weight: 800;
    }

    .saudi-riyal-symbol {
        font-size: 0.85rem;
        font-weight: 700;
        background: rgba(139, 90, 43, 0.12);
        color: #8B5A2B;
        padding: 3px 9px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
    }

    .card-footer-cta {
        background-color: #FDFBF7;
        padding: 12px 20px;
        font-size: 0.82rem;
        color: #7E6B5D;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #F5F0EB;
        transition: all 0.3s ease;
    }

    .product-card:hover .card-footer-cta {
        background-color: #8B5A2B;
        color: #FFFFFF;
    }

    .cta-icon {
        transition: transform 0.3s ease;
    }

    .product-card:hover .cta-icon {
        transform: translateX(-5px);
    }

    .availability-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 2;
        padding: 4px 10px;
        font-size: 0.78rem;
        font-weight: 700;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        backdrop-filter: blur(4px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .availability-badge.is-available {
        background-color: rgba(46, 125, 50, 0.9);
        color: #FFFFFF;
    }

    .availability-badge.not-available {
        background-color: rgba(198, 40, 40, 0.9);
        color: #FFFFFF;
    }

    .empty-state-box {
        text-align: center;
        padding: 60px 20px;
        background: #FFFFFF;
        border-radius: 0;
        border: 1px dashed #E5DCD3;
        margin: 30px 0;
    }

    .empty-state-icon {
        font-size: 3.2rem;
        color: #D5C8BD;
        margin-bottom: 15px;
    }

    .empty-state-box h3 {
        font-size: 1.3rem;
        color: #2C1A11;
        margin-bottom: 8px;
    }

    .empty-state-box p {
        color: #7E6B5D;
        font-size: 0.95rem;
    }

    @media (max-width: 992px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .products-page-container {
            padding: 5px 12px 40px;
        }

        .search-section-card {
            padding: 16px 18px;
            margin-bottom: 25px;
        }

        .category-header {
            margin-bottom: 18px;
        }

        .category-title {
            font-size: 1.25rem;
        }

        .product-img-wrapper {
            height: 180px;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }
    }

    @media (max-width: 576px) {
        .search-form {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }

        .search-input-wrapper {
            min-width: 100%;
        }

        .search-btn, .clear-search-btn {
            justify-content: center;
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
        }

        .products-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .product-img-wrapper {
            height: 210px;
        }

        .product-name {
            font-size: 1.1rem;
        }

        .card-footer-cta {
            font-size: 0.8rem;
            padding: 10px 16px;
        }
    }
</style>

<div class="products-page-container">
    <div class="search-section-card">
        <form action="{{ route('products') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="search" value="{{ request('search') }}" class="search-input" placeholder="ابحث عن منتج...">
            </div>
            <button type="submit" class="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>بحث</span>
            </button>
            @if (request('search'))
                <a href="{{ route('products') ?? '#' }}" class="clear-search-btn">
                    <i class="fa-solid fa-xmark"></i>
                    <span>إلغاء البحث</span>
                </a>
            @endif
        </form>
        @if (request('search'))
            <div class="search-active-notice">
                نتائج البحث عن: <strong>"{{ request('search') }}"</strong>
            </div>
        @endif
    </div>

    @forelse($categories as $category)
        @if ($category->products->count() > 0)
            <div class="category-block">
                <div class="category-header">
                    <h2 class="category-title">{{ $category->name }}</h2>
                </div>

                <div class="products-grid">
                    @foreach ($category->products as $product)
                        <a href="{{ route('product.show', $product->id) ?? '#' }}" class="product-card">
                            <div class="product-img-wrapper">
                                @if($product->is_available)
                                    <span class="availability-badge is-available">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span>متوفر</span>
                                    </span>
                                @else
                                    <span class="availability-badge not-available">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        <span>غير متوفر</span>
                                    </span>
                                @endif
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%23FDFBF7' viewBox='0 0 100 100'><rect width='100' height='100'/><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='%23C5B8AC' font-size='10'>ميسو سويت</text></svg>" }}"
                                     alt="{{ $product->name }}" class="product-img">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">{{ $product->name }}</h3>
                                @if(!empty($product->description))
                                    <p class="product-description">{{ $product->description }}</p>
                                @endif
                                <div class="product-price-row">
                                    <span class="price-label">السعر</span>
                                    <div class="price-value-box">
                                        <span>{{ $product->price }}</span>
                                        <span class="saudi-riyal-symbol">ر.س</span>
                                        @if(!empty($product->price_by) && $product->price_by !== 'لم يتم التحديد')
                                            <span style="font-size: 0.82rem; color: #7E6B5D; font-weight: 600; margin-right: 4px;">({{ $product->price_by }})</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer-cta">
                                <span>اضغط للحصول على المزيد من التفاصيل</span>
                                <i class="fa-solid fa-chevron-left cta-icon"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @empty
        <div class="empty-state-box">
            <i class="fa-solid fa-cookie-bite empty-state-icon"></i>
            <h3>لا توجد منتجات مطابقة</h3>
            <p>لم نجد أي أقسام أو منتجات تفي ببحثك حالياً.</p>
        </div>
    @endforelse
</div>
@endsection