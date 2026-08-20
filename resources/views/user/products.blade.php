@extends('layouts.user-layout')

@section('title', 'صفحة المنتجات')

@section('content')

    <div>
        <form action="{{ route('products') ?? '#' }}" method="GET">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث عن منتج...">
            <button type="submit">بحث</button>
            @if (request('search'))
                <a href="{{ route('products') ?? '#' }}">إلغاء البحث</a>
            @endif
        </form>
    </div>

    <br>

    @forelse($categories as $category)
        @if ($category->products->count() > 0)
            <div>
                <h2>{{ $category->name }}</h2>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">
                    @foreach ($category->products as $product)
                        <div>
                            <a href="{{ route('product.show', $product->id) ?? '#' }}" style="color: inherit; text-decoration: none;">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%23eee' viewBox='0 0 100 100'><rect width='100' height='100'/><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='%23aaa' font-size='10'>صورة المنتج</text></svg>" }}"
                                    alt="{{ $product->name }}" style="width: 100%; height: 150px; object-fit: cover;">
                                <h3>{{ $product->name }}</h3>
                            </a>
                            <p>{{ $product->description }}</p>
                            <p><strong>السعر:</strong> {{ $product->price }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
        @endif
    @empty
        <p>لا توجد أقسام أو منتجات تفي ببحثك.</p>
    @endforelse

@endsection