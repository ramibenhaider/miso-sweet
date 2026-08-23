@extends('layouts.admin-layout')

@section('title', 'الأقسام والمعلومات - ميسو سويت')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">
        <i class="fa-solid fa-sliders"></i>
        <span>الأقسام وتفاصيل التواصل</span>
    </h1>
</div>

<div class="admin-card">
    <div class="admin-card-title">
        <i class="fa-solid fa-layer-group"></i>
        <span>إدارة الأقسام</span>
    </div>

    <form action="{{ route('category.store') }}" method="POST" style="margin-bottom: 30px; background: #FDFBF7; padding: 20px; border-radius: 8px; border: 1px solid #EFEBE4;">
        @csrf
        <h4 style="font-size: 1rem; font-weight: 800; color: var(--admin-dark); margin-bottom: 12px;">إضافة قسم جديد</h4>
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 240px;">
                <input type="text" id="category_name" name="name" class="admin-input" placeholder="اسم القسم الجديد..." required>
            </div>
            <button type="submit" class="admin-btn-primary">
                <i class="fa-solid fa-plus"></i>
                <span>إضافة قسم</span>
            </button>
        </div>
    </form>

    <h4 style="font-size: 1rem; font-weight: 800; color: var(--admin-dark); margin-bottom: 14px;">قائمة الأقسام الحالية</h4>
    <div class="admin-table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">#</th>
                    <th style="min-width: 250px;">اسم القسم</th>
                    <th style="width: 140px;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories ?? [] as $category)
                    <tr>
                        <td><strong>#{{ $loop->iteration }}</strong></td>
                        <td>
                            <form action="{{ route('category.update', $category->id) }}" method="POST" style="display:flex; gap: 10px; align-items: center; flex-wrap: wrap; width: 100%;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $category->name }}" class="admin-input" style="flex: 1; min-width: 180px; width: 100%;" required>
                                <button type="submit" class="admin-btn-primary" style="padding: 9px 18px; font-size: 0.88rem; white-space: nowrap;">
                                    <i class="fa-solid fa-pen"></i>
                                    <span>تعديل</span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذا القسم؟')" class="admin-btn-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                    <span>حذف</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 25px; color: #8E7C70;">
                            لا توجد أقسام مضافة بعد.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-title">
        <i class="fa-solid fa-address-book"></i>
        <span>إدارة معلومات التواصل وإعدادات الواجهة الرئيسية</span>
    </div>

    <form action="{{ route('contact.update', $contact->id ?? 1) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--admin-dark); margin-bottom: 18px; padding-bottom: 8px; border-bottom: 1px solid #EFEBE4;">
            <i class="fa-solid fa-phone" style="color: var(--admin-primary);"></i> معلومات الاتصال وسوشيال ميديا
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 18px;" class="admin-form-group">
            <div>
                <label for="whatsapp">واتساب:</label>
                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp ?? '') }}" class="admin-input" placeholder="05xxxxxxxx">
                @error('whatsapp') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone1">الهاتف الأول:</label>
                <input type="text" id="phone1" name="phone1" value="{{ old('phone1', $contact->phone1 ?? '') }}" class="admin-input">
                @error('phone1') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone2">الهاتف الثاني:</label>
                <input type="text" id="phone2" name="phone2" value="{{ old('phone2', $contact->phone2 ?? '') }}" class="admin-input">
                @error('phone2') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone3">الهاتف الثالث:</label>
                <input type="text" id="phone3" name="phone3" value="{{ old('phone3', $contact->phone3 ?? '') }}" class="admin-input">
                @error('phone3') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 18px;" class="admin-form-group">
            <div>
                <label for="email">البريد الإلكتروني:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $contact->email ?? '') }}" class="admin-input">
                @error('email') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="facebook">فيسبوك:</label>
                <input type="text" id="facebook" name="facebook" value="{{ old('facebook', $contact->facebook ?? '') }}" class="admin-input">
                @error('facebook') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="instagram">إنستغرام:</label>
                <input type="text" id="instagram" name="instagram" value="{{ old('instagram', $contact->instagram ?? '') }}" class="admin-input">
                @error('instagram') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="tiktok">تيك توك:</label>
                <input type="text" id="tiktok" name="tiktok" value="{{ old('tiktok', $contact->tiktok ?? '') }}" class="admin-input">
                @error('tiktok') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="youtube">يوتيوب:</label>
                <input type="text" id="youtube" name="youtube" value="{{ old('youtube', $contact->youtube ?? '') }}" class="admin-input">
                @error('youtube') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>
        </div>

        <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--admin-dark); margin: 30px 0 18px 0; padding-bottom: 8px; border-bottom: 1px solid #EFEBE4;">
            <i class="fa-solid fa-circle-play" style="color: var(--admin-primary);"></i> إعدادات الواجهة الرئيسية
        </h3>

        <div class="admin-form-group">
            <label for="hero_title">العنوان الرئيسي للواجهة:</label>
            <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title', $contact->hero_title ?? '') }}" class="admin-input" placeholder="مثال: أشهى الحلويات والكيك الطازج يومياً">
            @error('hero_title') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
            <label for="hero_subtitle">الوصف الفرعي للواجهة:</label>
            <textarea id="hero_subtitle" name="hero_subtitle" rows="3" class="admin-textarea" placeholder="مثال: نعد لكم أطيب أطباق الكيك والحلويات بأعلى جودة وطعم استثنائي لا يُنسى">{{ old('hero_subtitle', $contact->hero_subtitle ?? '') }}</textarea>
            @error('hero_subtitle') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px;" class="admin-form-group">
            <div>
                <label for="hero_video_file">رفع مقطع فيديو:</label>
                <input type="file" id="hero_video_file" name="hero_video_file" accept="video/*" class="admin-input">
                @if(!empty($contact->hero_video) && !str_starts_with($contact->hero_video, 'http'))
                    <span style="font-size: 0.82rem; color: #7E6B5D; margin-top: 4px; display: block;">المقطع الحالي: <code>{{ $contact->hero_video }}</code></span>
                @endif
                @error('hero_video_file') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="hero_video">أو رابط فيديو مباشر:</label>
                <input type="text" id="hero_video" name="hero_video" value="{{ old('hero_video', $contact->hero_video ?? '') }}" class="admin-input" placeholder="https://example.com/video.mp4">
                @error('hero_video') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 18px;" class="admin-form-group">
            <div>
                <label for="hero_button_text">نص زر التصفح:</label>
                <input type="text" id="hero_button_text" name="hero_button_text" value="{{ old('hero_button_text', $contact->hero_button_text ?? '') }}" class="admin-input" placeholder="مثال: استعرض قائمة المنتجات">
                @error('hero_button_text') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="hero_button_link">رابط زر التصفح:</label>
                <input type="text" id="hero_button_link" name="hero_button_link" value="{{ old('hero_button_link', $contact->hero_button_link ?? '') }}" class="admin-input" placeholder="مثال: /products">
                @error('hero_button_link') <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600;">{{ $message }}</span> @enderror
            </div>
        </div>

        <button type="submit" class="admin-btn-primary" style="margin-top: 10px;">
            <i class="fa-solid fa-floppy-disk"></i>
            <span>حفظ التغييرات وإعدادات الواجهة</span>
        </button>
    </form>
</div>
@endsection
