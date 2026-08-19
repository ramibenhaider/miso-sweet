@extends('layouts.admin-layout')

@section('title', 'تعديل الملف الشخصي - Profile')

@section('content')
    <h1>تعديل الملف الشخصي (Profile)</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('profile.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">اسم المستخدم:</label>
            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
            @error('name') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label for="current_password">كلمة المرور الحالية:</label>
            <input type="password" id="current_password" name="current_password">
            @error('current_password') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label for="password">كلمة المرور الجديدة :</label>
            <input type="password" id="password" name="password">
            @error('password') <span style="color: red;">{{ $message }}</span> @enderror
        </div>
        <br>

        <div>
            <label for="password_confirmation">تأكيد كلمة المرور الجديدة:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        <br>

        <button type="submit">حفظ البيانات</button>
        <a href="{{ url()->previous() }}">عودة</a>
    </form>
@endsection
