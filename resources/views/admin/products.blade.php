@extends('layouts.admin-layout')

@section('title', 'إدارة المنتجات - ميسو سويت')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">
        <i class="fa-solid fa-boxes-packing"></i>
        <span>إدارة المنتجات</span>
    </h1>
</div>

<!-- Section 1: Add New Product Form -->
<div class="admin-card">
    <div class="admin-card-title">
        <i class="fa-solid fa-square-plus"></i>
        <span>إضافة منتج جديد</span>
    </div>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div class="admin-form-group">
                <label for="name">اسم المنتج:</label>
                <input type="text" id="name" name="name" class="admin-input" placeholder="اسم المنتج..." required>
                @error('name') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group">
                <label for="price">السعر (ر.س):</label>
                <input type="number" step="0.01" id="price" name="price" class="admin-input" placeholder="0.00" required>
                @error('price') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group">
                <label for="price_by">سعر المنتج حسب:</label>
                <select id="price_by" name="price_by" class="admin-select">
                    <option value="لم يتم التحديد" {{ old('price_by') == 'لم يتم التحديد' ? 'selected' : '' }}>لم يتم التحديد</option>
                    <option value="للكيلو" {{ old('price_by') == 'للكيلو' ? 'selected' : '' }}>للكيلو</option>
                    <option value="للقطعة" {{ old('price_by') == 'للقطعة' ? 'selected' : '' }}>للقطعة</option>
                </select>
                @error('price_by') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div class="admin-form-group">
                <label for="category_id">القسم:</label>
                <select id="category_id" name="category_id" class="admin-select" required>
                    <option value="">إختر القسم</option>
                    @foreach ($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="admin-form-group">
            <label for="description">وصف المنتج:</label>
            <textarea id="description" name="description" rows="3" class="admin-textarea" placeholder="تفاصيل ومعلومات المنتج..."></textarea>
            @error('description') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
            <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; user-select: none;">
                <input type="checkbox" id="is_available" name="is_available" value="1" style="width: 18px; height: 18px; accent-color: var(--admin-primary);">
                <span>المنتج متوفر للبيع حالياً؟</span>
            </label>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;" class="admin-form-group">
            <div>
                <label for="image">الصورة الرئيسية للمنتج:</label>
                <input type="file" id="image" name="image" accept="image/*" class="admin-input" required>
                @error('image') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="other_photos">صور إضافية للمنتج:</label>
                <input type="file" id="other_photos" name="other_photos[]" accept="image/*" class="admin-input" multiple>
                @error('other_photos') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>
        </div>

        <button type="submit" class="admin-btn-primary">
            <i class="fa-solid fa-plus"></i>
            <span>إضافة المنتج</span>
        </button>
    </form>
</div>

<!-- Section 2: Products List -->
<div class="admin-card">
    <div class="admin-card-title">
        <i class="fa-solid fa-cubes"></i>
        <span>قائمة المنتجات الحالية</span>
    </div>

    @forelse ($products ?? [] as $product)
        <div style="background: #FDFBF7; border: 1px solid #EFEBE4; border-radius: 12px; padding: 24px; margin-bottom: 25px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid #EFEBE4;">
                <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--admin-dark); margin: 0;">
                    <i class="fa-solid fa-tag" style="color: var(--admin-primary);"></i>
                    <span>منتج #{{ $loop->iteration }}: {{ $product->name }}</span>
                </h3>

                <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذا المنتج؟')" class="admin-btn-danger">
                        <i class="fa-solid fa-trash-can"></i>
                        <span>حذف المنتج</span>
                    </button>
                </form>
            </div>

            <!-- Existing Photos Preview -->
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
                @if ($product->image)
                    <div>
                        <span style="font-size: 0.85rem; font-weight: 700; color: var(--admin-dark); display: block; margin-bottom: 6px;">الصورة الرئيسية:</span>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="110" height="110" style="object-fit: cover; border-radius: 8px; border: 2px solid var(--admin-primary);">
                    </div>
                @endif

                @if ($product->product_photos && $product->product_photos->count() > 0)
                    <div>
                        <span style="font-size: 0.85rem; font-weight: 700; color: var(--admin-dark); display: block; margin-bottom: 6px;">الصور الإضافية:</span>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @foreach ($product->product_photos as $photo)
                                <div style="text-align: center;">
                                    <img src="{{ asset('storage/' . $photo->photo) }}" alt="{{ $product->name }}" width="90" height="90" style="object-fit: cover; border-radius: 8px; border: 1px solid #EFEBE4; display: block; margin-bottom: 4px;">
                                    <form action="{{ route('product-photo.destroy', $photo->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذه الصورة؟')" style="color: #DC2626; border: none; background: none; cursor: pointer; font-size: 0.78rem; font-weight: 700;">
                                            <i class="fa-solid fa-xmark"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Update Product Form -->
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
                    <div class="admin-form-group">
                        <label>اسم المنتج:</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="admin-input" required>
                        @error('name', 'update_' . $product->id) <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
                    </div>

                    <div class="admin-form-group">
                        <label>السعر (ر.س):</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="admin-input" required>
                        @error('price', 'update_' . $product->id) <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
                    </div>

                    <div class="admin-form-group">
                        <label>سعر المنتج حسب:</label>
                        <select name="price_by" class="admin-select">
                            <option value="لم يتم التحديد" {{ old('price_by', $product->price_by) == 'لم يتم التحديد' ? 'selected' : '' }}>لم يتم التحديد</option>
                            <option value="للكيلو" {{ old('price_by', $product->price_by) == 'للكيلو' ? 'selected' : '' }}>للكيلو</option>
                            <option value="للقطعة" {{ old('price_by', $product->price_by) == 'للقطعة' ? 'selected' : '' }}>للقطعة</option>
                        </select>
                        @error('price_by', 'update_' . $product->id) <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
                    </div>

                    <div class="admin-form-group">
                        <label>القسم:</label>
                        <select name="category_id" class="admin-select" required>
                            @foreach ($categories ?? [] as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id', 'update_' . $product->id) <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="admin-form-group">
                    <label>وصف المنتج:</label>
                    <textarea name="description" rows="2" class="admin-textarea">{{ old('description', $product->description) }}</textarea>
                    @error('description', 'update_' . $product->id) <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
                </div>

                <div class="admin-form-group">
                    <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; user-select: none;">
                        <input type="checkbox" name="is_available" value="1" {{ $product->is_available ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: var(--admin-primary);">
                        <span>المنتج متوفر للبيع</span>
                    </label>
                    @error('is_available', 'update_' . $product->id) <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;" class="admin-form-group">
                    <div>
                        <label>تغيير الصورة الرئيسية:</label>
                        <input type="file" name="image" accept="image/*" class="admin-input">
                        @error('image', 'update_' . $product->id) <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>إضافة صور أخرى إضافية:</label>
                        <input type="file" name="other_photos[]" accept="image/*" class="admin-input" multiple>
                        @error('other_photos', 'update_' . $product->id) <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="admin-btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>تحديث بيانات المنتج</span>
                </button>
            </form>
        </div>
    @empty
        <div style="text-align: center; padding: 40px; color: #8E7C70;">
            <i class="fa-solid fa-box-open" style="font-size: 2.5rem; margin-bottom: 12px; display: block;"></i>
            لا توجد منتجات مضافة بعد.
        </div>
    @endforelse
</div>
@endsection
