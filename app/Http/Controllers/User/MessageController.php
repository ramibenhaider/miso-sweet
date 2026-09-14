<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->user()) {
            return redirect()->back()->with('error', 'يجب عليك تسجيل الدخول لإرسال رسالة');
        }

        if (!auth()->user()->is_active) {
            return redirect()->back()->with('error', 'يجب عليك تفعيل حسابك لإرسال رسالة');
        }

        $data = $request->validate([
            'phone' => 'nullable|digits_between:10,15',
            'message' => 'required|string|max:500',
        ], [
            'phone.digits_between' => 'يجب أن يكون رقم الهاتف بين 10 و 15 رقمًا',
            'message.required' => 'الرسالة مطلوبة',
            'message.max' => 'الرسالة يجب أن لا تتجاوز 500 حرف',
            'message.string' => 'الرسالة يجب أن تكون نصية',
        ]);

        $data['user_id'] = auth()->user()->id;
        Message::create($data);
        return redirect()->back()->with('success', 'تم استلام رسالتك بنجاح');
    }
}
