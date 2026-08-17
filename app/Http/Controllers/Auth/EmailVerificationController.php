<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    public function notice(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->route('login')
            : view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        $user = $request->user();
        $user->update([
            'is_active' => true,
        ]);
        
        return redirect()->route('login')->with('success', 'تم تأكيد البريد الإلكتروني بنجاح');  
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('login')->with('success', 'البريد الإلكتروني مفعل بالفعل');
        }
        
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'تم إرسال رابط التحقق من جديد');
    }
}
