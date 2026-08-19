@extends('layouts.admin-layout')

@section('title', 'إدارة المنتجات - Products')

@section('content')
    <h1>إدارة المنتجات (Products)</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <hr>

    <section>
        <h2>إضافة منتج جديد</h2>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">اسم المنتج:</label>
                <input type="text" id="name" name="name" required>
                @error('name') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="price">السعر:</label>
                <input type="number" step="0.01" id="price" name="price" required>
                @error('price') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="category_id">القسم:</label>
                <select id="category_id" name="category_id" required>
                    <option value="">إختر القسم</option>
                    @foreach ($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="description">وصف المنتج:</label>
                <textarea id="description" name="description"></textarea>
                @error('description') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="is_available">
                    <input type="checkbox" id="is_available" name="is_available" value="1">
                    المنتج متوفر؟
                </label>
            </div>
            <br>

            <div>
                <label for="image">الصورة الرئيسية للمنتج (Main Photo):</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                @error('image') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="other_photos">صور إضافية للمنتج (Other Photos):</label>
                <input type="file" id="other_photos" name="other_photos[]" accept="image/*" multiple>
                @error('other_photos') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <button type="submit">إضافة المنتج</button>
        </form>
    </section>

    <br><hr><br>

    <section>
        <h2>قائمة المنتجات الحالية</h2>

        @forelse ($products ?? [] as $product)
            <div style="border: 1px solid #000; padding: 15px; margin-bottom: 20px;">
                <h3>كارت المنتج رقم #{{ $loop->iteration }}</h3>

                @if ($product->image)
                    <div>
                        <strong>الصورة الرئيسية الحالية:</strong><br>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="120">
                    </div>
                    <br>
                @endif
                @if ($product->product_photos && $product->product_photos->count() > 0)
                    <div>
                        <strong>الصور الإضافية الحالية:</strong><br>
                        @foreach ($product->product_photos as $photo)
                            <div style="display: inline-block; text-align: center; margin-left: 10px;">
                                <img src="{{ asset('storage/' . $photo->photo) }}" alt="{{ $product->name }}" width="120" style="display: block; margin-bottom: 5px;">
                                <form action="{{ route('product-photo.destroy', $photo->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذه الصورة؟')" style="color: red; border: none; background: none; cursor: pointer; text-decoration: underline;">حذف</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <br>
                @endif

                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label>اسم المنتج:</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name', 'update_' . $product->id) <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <br>

                    <div>
                        <label>السعر:</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
                        @error('price', 'update_' . $product->id) <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <br>

                    <div>
                        <label>القسم:</label>
                        <select name="category_id" required>
                            @foreach ($categories ?? [] as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id', 'update_' . $product->id) <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <br>

                    <div>
                        <label>وصف المنتج:</label>
                        <textarea name="description">{{ old('description', $product->description) }}</textarea>
                        @error('description', 'update_' . $product->id) <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <br>

                    <div>
                        <label>
                            <input type="checkbox" name="is_available" value="1" {{ $product->is_available ? 'checked' : '' }}>
                            متوفر
                        </label>
                        @error('is_available', 'update_' . $product->id) <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <br>

                    <div>
                        <label>تغيير الصورة الرئيسية (Main Photo):</label>
                        <input type="file" name="image" accept="image/*">
                        @error('image', 'update_' . $product->id) <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <br>

                    <div>
                        <label>إضافة صور أخرى (Other Photos):</label>
                        <input type="file" name="other_photos[]" accept="image/*" multiple>
                        @error('other_photos', 'update_' . $product->id) <span style="color: red;">{{ $message }}</span> @enderror
                        @error('other_photos.*', 'update_' . $product->id) <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <br>

                    <button type="submit">تحديث البيانات</button>
                </form>

                <br>

                <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذا المنتج؟')">حذف المنتج</button>
                </form>
            </div>
        @empty
            <p>لا توجد منتجات مضافة بعد.</p>
        @endforelse
    </section>
@endsection
