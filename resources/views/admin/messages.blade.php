@extends('layouts.admin-layout')

@section('title', 'إدارة الرسائل - ميسو سويت')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">
        <i class="fa-solid fa-comments"></i>
        <span>إدارة الرسائل</span>
    </h1>
</div>

<div class="admin-card">
    <div class="admin-card-title">
        <i class="fa-solid fa-inbox"></i>
        <span>الرسائل الواردة من العملاء</span>
    </div>

    @forelse ($messages ?? [] as $message)
        <div style="background: #FFFFFF; border: 1px solid #EFEBE4; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 2px 10px rgba(44, 26, 17, 0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #F5F0EB;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 1.1rem; font-weight: 800; color: var(--admin-dark);">رسالة #{{ $loop->iteration }}</span>
                    <span style="font-size: 0.85rem; color: #8E7C70; background: #F5F0EB; padding: 3px 10px; border-radius: 15px;">
                        <i class="fa-regular fa-clock"></i> {{ $message->created_at->format('Y-m-d H:i') }}
                    </span>
                </div>

                <div>
                    @if ($message->is_shown)
                        <span style="color: #2E7D32; background: #E8F5E9; padding: 5px 14px; border-radius: 20px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 6px;">
                            <i class="fa-solid fa-eye"></i> معروضة في الصفحة الرئيسية
                        </span>
                    @else
                        <span style="color: #7E6B5D; background: #F5F0EB; padding: 5px 14px; border-radius: 20px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 6px;">
                            <i class="fa-solid fa-eye-slash"></i> مخفية من الصفحة الرئيسية
                        </span>
                    @endif
                </div>
            </div>

            <!-- Sender Info Grid -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 18px; background: #FDFBF7; padding: 16px; border-radius: 8px;">
                <div>
                    <span style="font-size: 0.82rem; font-weight: 700; color: #8E7C70; display: block;">المرسل:</span>
                    @if ($message->user)
                        <strong style="color: var(--admin-dark); font-size: 0.95rem;">{{ $message->user->name }}</strong>
                    @else
                        <em style="color: #8E7C70; font-size: 0.9rem;">مرسل غير معروف / غير مسجل</em>
                    @endif
                </div>

                @if ($message->user && $message->user->email)
                    <div>
                        <span style="font-size: 0.82rem; font-weight: 700; color: #8E7C70; display: block;">البريد الإلكتروني:</span>
                        <span style="color: var(--admin-dark); font-size: 0.95rem;">{{ $message->user->email }}</span>
                    </div>
                @endif

                @if ($message->phone)
                    <div>
                        <span style="font-size: 0.82rem; font-weight: 700; color: #8E7C70; display: block;">رقم الهاتف:</span>
                        <span style="color: var(--admin-dark); font-size: 0.95rem; font-weight: 700; dir: ltr;">{{ $message->phone }}</span>
                    </div>
                @endif
            </div>

            <!-- Message Body -->
            <div style="margin-bottom: 20px;">
                <span style="font-size: 0.85rem; font-weight: 700; color: var(--admin-dark); display: block; margin-bottom: 6px;">نص الرسالة:</span>
                <div style="background: #FDFBF7; border: 1px solid #EFEBE4; border-radius: 8px; padding: 16px; font-size: 0.98rem; line-height: 1.8; color: #3A2A20; white-space: pre-line;">
                    {{ $message->message }}
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <form action="{{ route('messages.toggle-show', $message->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" style="background-color: {{ $message->is_shown ? '#E65100' : '#2E7D32' }}; color: #FFFFFF; border: none; padding: 9px 18px; border-radius: 6px; font-family: inherit; font-size: 0.88rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid {{ $message->is_shown ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        <span>{{ $message->is_shown ? 'إخفاء من الرئيسية' : 'عرض في الصفحة الرئيسية' }}</span>
                    </button>
                </form>

                <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('هل أنت تأكد من حذف هذه الرسالة؟')" class="admin-btn-danger">
                        <i class="fa-solid fa-trash-can"></i>
                        <span>حذف الرسالة</span>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 40px; color: #8E7C70;">
            <i class="fa-solid fa-inbox" style="font-size: 2.5rem; margin-bottom: 12px; display: block;"></i>
            لا توجد رسائل واردة حتى الآن.
        </div>
    @endforelse
</div>
@endsection