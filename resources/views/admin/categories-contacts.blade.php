@extends('layouts.admin-layout')

@section('title', 'لوحة التحكم - Admin Dashboard')

@section('content')
    <h1>لوحة التحكم (Admin Dashboard)</h1>

    {{-- عرض الرسائل الناجحة أو الأخطاء --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <hr>

    <!-- ==================== 1. إدارة الأقسام (Categories) ==================== -->
    <section>
        <h2>إدارة الأقسام (Categories)</h2>

        <!-- نموذج إضافة قسم جديد -->
        <h3>إضافة قسم جديد</h3>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div>
                <label for="category_name">اسم القسم (name):</label>
                <input type="text" id="category_name" name="name" required>
            </div>
            <br>
            <button type="submit">إضافة قسم</button>
            <br>
            @error('name')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </form>

        <br>

        <!-- قائمة الأقسام المضافة -->
        <h3>قائمة الأقسام الحالية</h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم القسم (name)</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories ?? [] as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <!-- نموذج تعديل القسم -->
                            <form action="{{ route('category.update', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $category->name }}" required>
                                <button type="submit">تعديل</button>
                            </form>
                        </td>
                        <td>
                            <!-- نموذج حذف القسم -->
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('هل أنت تأكد من الحذف؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">لا توجد أقسام مضافة بعد.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <br><hr><br>

    <!-- ==================== 2. إدارة معلومات التواصل (Contacts) ==================== -->
    <section>
        <h2>إدارة معلومات التواصل (Contacts)</h2>

        <form action="{{ route('contact.update', $contact->id ?? 1) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="whatsapp">واتساب (whatsapp):</label>
                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp ?? '') }}">
                @error('whatsapp') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="phone1">الهاتف الأول (phone1):</label>
                <input type="text" id="phone1" name="phone1" value="{{ old('phone1', $contact->phone1 ?? '') }}">
                @error('phone1') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="phone2">الهاتف الثاني (phone2):</label>
                <input type="text" id="phone2" name="phone2" value="{{ old('phone2', $contact->phone2 ?? '') }}">
                @error('phone2') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="phone3">الهاتف الثالث (phone3):</label>
                <input type="text" id="phone3" name="phone3" value="{{ old('phone3', $contact->phone3 ?? '') }}">
                @error('phone3') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="email">البريد الإلكتروني (email):</label>
                <input type="email" id="email" name="email" value="{{ old('email', $contact->email ?? '') }}">
                @error('email') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="facebook">فيسبوك (facebook):</label>
                <input type="text" id="facebook" name="facebook" value="{{ old('facebook', $contact->facebook ?? '') }}">
                @error('facebook') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="tiktok">تيك توك (tiktok):</label>
                <input type="text" id="tiktok" name="tiktok" value="{{ old('tiktok', $contact->tiktok ?? '') }}">
                @error('tiktok') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="instagram">إنستغرام (instagram):</label>
                <input type="text" id="instagram" name="instagram" value="{{ old('instagram', $contact->instagram ?? '') }}">
                @error('instagram') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <div>
                <label for="youtube">يوتيوب (youtube):</label>
                <input type="text" id="youtube" name="youtube" value="{{ old('youtube', $contact->youtube ?? '') }}">
                @error('youtube') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
            <br>

            <button type="submit">حفظ بيانات التواصل</button>
        </form>
    </section>
@endsection
