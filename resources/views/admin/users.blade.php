@extends('layouts.admin-layout')

@section('title', 'إدارة المستخدمين - ميسو سويت')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">
        <i class="fa-solid fa-users-gear"></i>
        <span>إدارة المستخدمين</span>
    </h1>
</div>

<div class="admin-card">
    <div class="admin-card-title">
        <i class="fa-solid fa-list-check"></i>
        <span>قائمة المستخدمين المسجلين</span>
    </div>

    <div class="admin-table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الصورة الشخصية</th>
                    <th>حالة الحساب</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users ?? [] as $user)
                    <tr>
                        <td><strong>#{{ $loop->iteration }}</strong></td>
                        <td>
                            <strong style="color: var(--admin-dark);">{{ $user->name }}</strong>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->picture)
                                <img src="{{ asset('storage/' . $user->picture) }}" alt="{{ $user->name }}" width="45" height="45" style="border-radius: 50%; object-fit: cover; border: 2px solid var(--admin-primary);">
                            @else
                                <span style="font-size: 0.85rem; color: #8E7C70; background: #F5F0EB; padding: 4px 10px; border-radius: 20px;">لا توجد صورة</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->is_active)
                                <span style="color: #2E7D32; background: #E8F5E9; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 5px;">
                                    <i class="fa-solid fa-circle-check"></i> نشط
                                </span>
                            @else
                                <span style="color: #C62828; background: #FFEBEE; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 5px;">
                                    <i class="fa-solid fa-circle-xmark"></i> غير نشط
                                </span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <form action="{{ route('users.toggle-status', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background-color: {{ $user->is_active ? '#E65100' : '#2E7D32' }}; color: #FFFFFF; border: none; padding: 7px 14px; border-radius: 6px; font-family: inherit; font-size: 0.85rem; font-weight: 700; cursor: pointer; transition: opacity 0.2s ease;">
                                        <i class="fa-solid {{ $user->is_active ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                                        <span>{{ $user->is_active ? 'تعطيل الحساب' : 'تفعيل الحساب' }}</span>
                                    </button>
                                </form>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذا المستخدم؟')" class="admin-btn-danger">
                                        <i class="fa-solid fa-trash-can"></i>
                                        <span>حذف</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px; color: #8E7C70;">
                            <i class="fa-solid fa-users-slash" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
                            لا يوجد مستخدمون مسجلون حتى الآن.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
