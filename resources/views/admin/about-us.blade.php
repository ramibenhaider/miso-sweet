@extends('layouts.admin-layout')

@section('title', 'محتوى من نحن - ميسو سويت')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">
        <i class="fa-solid fa-pen-to-square"></i>
        <span>إدارة محتوى صفحة "من نحن"</span>
    </h1>
</div>

<div class="admin-card">
    <div class="admin-card-title">
        <i class="fa-solid fa-circle-info"></i>
        <span>تعديل الأقسام الرئيسية لصفحة "من نحن"</span>
    </div>

    <form action="{{ route('about-us.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="admin-form-group">
            <label for="about_us">
                <i class="fa-solid fa-cookie-bite" style="color: var(--admin-primary); margin-left: 6px;"></i>
                <span>من نحن؟</span>
            </label>
            <textarea id="about_us" name="about_us" rows="5" class="admin-textarea" placeholder="اكتب نبذة عن ميسو سويت وقصتها هنا...">{{ old('about_us', $aboutUs->about_us ?? '') }}</textarea>
            @error('about_us')
                <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="our_vision">
                <i class="fa-solid fa-eye" style="color: var(--admin-primary); margin-left: 6px;"></i>
                <span>رؤيتنا</span>
            </label>
            <textarea id="our_vision" name="our_vision" rows="4" class="admin-textarea" placeholder="اكتب رؤية المحل والمستقبل هنا...">{{ old('our_vision', $aboutUs->our_vision ?? '') }}</textarea>
            @error('our_vision')
                <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="our_mission">
                <i class="fa-solid fa-bullseye" style="color: var(--admin-primary); margin-left: 6px;"></i>
                <span>مهمتنا</span>
            </label>
            <textarea id="our_mission" name="our_mission" rows="4" class="admin-textarea" placeholder="اكتب مهمة المحل وأهدافه هنا...">{{ old('our_mission', $aboutUs->our_mission ?? '') }}</textarea>
            @error('our_mission')
                <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="why_us">
                <i class="fa-solid fa-star" style="color: var(--admin-primary); margin-left: 6px;"></i>
                <span>لماذا نحن؟</span>
            </label>
            <textarea id="why_us" name="why_us" rows="4" class="admin-textarea" placeholder="اكتب أسباب اختيار ميسو سويت ومميزاتها هنا...">{{ old('why_us', $aboutUs->why_us ?? '') }}</textarea>
            @error('why_us')
                <span style="color: #DC2626; font-size: 0.82rem; font-weight: 600; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="admin-btn-primary" style="margin-top: 10px;">
            <i class="fa-solid fa-floppy-disk"></i>
            <span>حفظ التعديلات</span>
        </button>
    </form>
</div>
@endsection