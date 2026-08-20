<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
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

    public function verify(Request $request, $id, $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('login')->with('error', 'رابط التأكيد غير صالح.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('success', 'البريد الإلكتروني مفعل بالفعل. يمكنك تسجيل الدخول.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

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
