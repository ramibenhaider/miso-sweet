<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\PasswordReset;    
class ResetPasswordController extends Controller
{
    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                function ($attribute, $value, $fail) {
                    if ($value && !preg_match('/[A-Z]/', $value)) {
                        $fail('يجب أن تحتوي كلمة المرور على حرف كبير واحد على الأقل (A-Z)');
                    }
                    if ($value && !preg_match('/[^\w\s]|_/', $value)) {
                        $fail('يجب أن تحتوي كلمة المرور على رمز خاص واحد على الأقل (مثل @#$%)');
                    }
                },
            ],
        ], [
            'token.required' => 'رمز إعادة التعيين مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يجب إدخال بريد إلكتروني صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 8 خانات',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'تمت إعادة تعيين كلمة المرور بنجاح، يمكنك الآن تسجيل الدخول.')
            : back()->withErrors(['email' => 'رابط إعادة تعيين كلمة المرور غير صالح أو انتهت صلاحيته.']);
    }
    
}
