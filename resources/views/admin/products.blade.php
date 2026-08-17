<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المنتجات - Products</title>
</head>
<body>
    <h1>إدارة المنتجات (Products)</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <hr>

    <!-- 1. نموذج إضافة منتج جديد -->
    <section>
        <h2>إضافة منتج جديد</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">اسم المنتج:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="price">السعر:</label>
                <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}" required>
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
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="is_available">
                    <input type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }}>
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

    <!-- 2. عرض المنتجات على شكل كروت مع مدخلات التعديل والحذف -->
    <section>
        <h2>قائمة المنتجات الحالية</h2>

        @forelse ($products ?? [] as $product)
            <div style="border: 1px solid #000; padding: 15px; margin-bottom: 20px;">
                <h3>كارت المنتج رقم #{{ $product->id }}</h3>

                <!-- الصورة الرئيسية الحالية إن وجدت -->
                @if ($product->image)
                    <div>
                        <strong>الصورة الرئيسية الحالية:</strong><br>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="120">
                    </div>
                    <br>
                @endif

                <!-- نموذج التعديل (Update Product) -->
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label>اسم المنتج:</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <br>

                    <div>
                        <label>السعر:</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
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
                    </div>
                    <br>

                    <div>
                        <label>وصف المنتج:</label>
                        <textarea name="description">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <br>

                    <div>
                        <label>
                            <input type="checkbox" name="is_available" value="1" {{ $product->is_available ? 'checked' : '' }}>
                            متوفر
                        </label>
                    </div>
                    <br>

                    <div>
                        <label>تغيير الصورة الرئيسية (Main Photo):</label>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <br>

                    <div>
                        <label>إضافة/تحديث صور إضافية (Other Photos):</label>
                        <input type="file" name="other_photos[]" accept="image/*" multiple>
                    </div>
                    <br>

                    <button type="submit">تحديث البيانات</button>
                </form>

                <br>

                <!-- نموذج الحذف (Delete Product) -->
                <form action="#" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذا المنتج؟')">حذف المنتج</button>
                </form>
            </div>
        @empty
            <p>لا توجد منتجات مضافة بعد.</p>
        @endforelse
    </section>
</body>
</html>
