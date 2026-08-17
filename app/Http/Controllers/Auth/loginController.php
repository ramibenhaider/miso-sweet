<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function doLogin(Request $request){
       $credintials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
       ],
       [
            'email.required' => "البريد الإلكتروني مطلوب",
            'email.email' => "البريد الإلكتروني غير صحيح",
            'password.required' => "كلمة المرور مطلوبة",
            'password.min' => "كلمة المرور يجب أن تكون 8 أحرف على الأقل",
        ]);

        if(Auth::attempt($credintials) === true && Auth::user()->email_verified_at == null){
            return redirect()->route('verification.notice');
        }else if(Auth::attempt($credintials) === true && Auth::user()->role == 'admin'){
            return redirect()->route('categories-contacts');
        }else if(Auth::attempt($credintials) === true && Auth::user()->email_verified_at != null){
            return redirect()->route('home');
        }else {
            return redirect()->back()->with('error', 'البريد الإلكتروني أو كلمة المرور غير صحيحة!');
        }
    }
}