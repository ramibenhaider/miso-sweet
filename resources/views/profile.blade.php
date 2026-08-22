@extends(auth()->check() && auth()->user()->role == 'admin' ? 'layouts.admin-layout' : 'layouts.user-layout')

@section('title', 'الملف الشخصي - ' . auth()->user()->name)

@section('content')
<style>
    .profile-card-container {
        max-width: 680px;
        margin: 20px auto 50px;
        padding: 0 15px;
        font-family: 'Tajawal', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .profile-card {
        background: #FFFFFF;
        border: 1px solid rgba(44, 26, 17, 0.08);
        border-radius: 16px;
        padding: 35px 30px;
        box-shadow: 0 6px 24px rgba(44, 26, 17, 0.05);
    }

    .profile-card-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #F0EAE1;
    }

    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 15px;
    }

    .profile-avatar-img {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #8B5A2B;
        box-shadow: 0 4px 15px rgba(139, 90, 43, 0.2);
        background: #FDFBF7;
    }

    .profile-user-name {
        font-size: 1.5rem;
        font-weight: 800;
        color: #2C1A11;
        margin: 0 0 6px 0;
    }

    .profile-form-section {
        margin-bottom: 25px;
    }

    .section-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #2C1A11;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: #8B5A2B;
    }

    .form-group-item {
        margin-bottom: 20px;
    }

    .form-group-item label {
        display: block;
        font-size: 0.92rem;
        font-weight: 700;
        color: #4A3B32;
        margin-bottom: 8px;
    }

    .form-control-input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 8px;
        border: 1.5px solid #EFEBE4;
        background-color: #FDFBF7;
        font-family: inherit;
        font-size: 0.95rem;
        color: #2C1A11;
        transition: all 0.25s ease;
        box-sizing: border-box;
    }

    .form-control-input:focus {
        outline: none;
        border-color: #8B5A2B;
        background-color: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(139, 90, 43, 0.12);
    }

    .form-control-input:disabled {
        background-color: #F5F0EB;
        color: #8E7C70;
        cursor: not-allowed;
    }

    .delete-photo-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
        font-size: 0.88rem;
        color: #C62828;
        cursor: pointer;
    }

    .delete-photo-checkbox input {
        cursor: pointer;
        accent-color: #C62828;
    }

    .error-msg-text {
        color: #DC2626;
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 5px;
        display: block;
    }

    .profile-actions-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #F0EAE1;
    }

    .btn-save-profile {
        background: linear-gradient(135deg, #8B5A2B 0%, #6E4420 100%);
        color: #FFFFFF;
        border: none;
        padding: 13px 30px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(139, 90, 43, 0.25);
    }

    .btn-save-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(139, 90, 43, 0.35);
    }

    .btn-back-link {
        color: #7E6B5D;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.92rem;
        padding: 12px 20px;
        border-radius: 8px;
        background: #F5F0EB;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-back-link:hover {
        background: #EFEBE4;
        color: #2C1A11;
    }

    @media (max-width: 576px) {
        .profile-card {
            padding: 24px 18px;
        }

        .profile-actions-row {
            flex-direction: column;
            gap: 12px;
        }

        .btn-save-profile, .btn-back-link {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="profile-card-container">
    <div class="profile-card">
        <div class="profile-card-header">
            <div class="profile-avatar-wrapper">
                <img src="{{ $user->picture ? asset('storage/' . $user->picture) : "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%238B5A2B' viewBox='0 0 24 24'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>" }}"
                     alt="{{ $user->name }}" class="profile-avatar-img">
            </div>
            <h1 class="profile-user-name">{{ $user->name }}</h1>
        </div>

        <form action="{{ route('profile.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="profile-form-section">
                <div class="section-title">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>المعلومات الشخصية</span>
                </div>

                @if($user->picture)
                    <div class="form-group-item">
                        <label class="delete-photo-checkbox">
                            <input type="checkbox" id="delete_picture" name="delete_picture" value="1">
                            <span>حذف الصورة الشخصية الحالية</span>
                        </label>
                    </div>
                @endif

                <div class="form-group-item">
                    <label for="picture">تغيير الصورة الشخصية:</label>
                    <input type="file" id="picture" name="picture" accept="image/*" class="form-control-input">
                    @error('picture') <span class="error-msg-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group-item">
                    <label for="email">البريد الإلكتروني:</label>
                    <input type="email" id="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="form-control-input" disabled>
                </div>

                <div class="form-group-item">
                    <label for="name">اسم المستخدم:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" class="form-control-input" required>
                    @error('name') <span class="error-msg-text">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="profile-form-section" style="margin-top: 30px;">
                <div class="section-title">
                    <i class="fa-solid fa-key"></i>
                    <span>تغيير كلمة المرور (اختياري)</span>
                </div>

                <div class="form-group-item">
                    <label for="current_password">كلمة المرور الحالية:</label>
                    <input type="password" id="current_password" name="current_password" class="form-control-input" placeholder="أدخل كلمة المرور الحالية لتغييرها">
                    @error('current_password') <span class="error-msg-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group-item">
                    <label for="password">كلمة المرور الجديدة:</label>
                    <input type="password" id="password" name="password" class="form-control-input" placeholder="كلمة المرور الجديدة">
                    @error('password') <span class="error-msg-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group-item">
                    <label for="password_confirmation">تأكيد كلمة المرور الجديدة:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control-input" placeholder="أعد كتابة كلمة المرور الجديدة">
                </div>
            </div>

            <div class="profile-actions-row">
                <button type="submit" class="btn-save-profile">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>حفظ البيانات</span>
                </button>

                <a href="{{ auth()->user()->role == 'admin' ? route('categories-contacts') : route('home') }}" class="btn-back-link">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>عودة</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
