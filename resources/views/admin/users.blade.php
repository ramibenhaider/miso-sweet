@extends('layouts.admin-layout')

@section('title', 'إدارة المستخدمين - Users')

@section('content')
    <h1>إدارة المستخدمين (Users)</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <hr>

    <h2>قائمة المستخدمين والمعلومات</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الرتبة (Role)</th>
                <th>حالة الحساب (Status)</th>
                <th>تاريخ التسجيل</th>
                <th>الإجراءات (Actions)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users ?? [] as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->is_active)
                            <span style="color: green;">نشط (Active)</span>
                        @else
                            <span style="color: red;">غير نشط (Inactive)</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <form action="{{ route('users.toggle-status', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit">
                                {{ $user->is_active ? 'تعطيل الحساب' : 'تفعيل الحساب' }}
                            </button>
                        </form>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذا المستخدم؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">لا يوجد مستخدمون مسجلون.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
