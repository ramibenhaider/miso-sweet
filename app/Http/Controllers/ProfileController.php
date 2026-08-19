<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'current_password' => ['nullable', 'required_with:password', function ($attribute, $value, $fail) use ($user) {
                if ($value && !Hash::check($value, $user->password)) {
                    $fail('كلمة المرور الحالية غير صحيحة');
                }
            }],
            'password' => 'nullable|required_with:current_password|min:8|confirmed',
        ], [
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'يجب أن يكون الاسم من حروف',
            'name.max' => 'يجب ألا يتجاوز الاسم 150 حرفاً',
            'current_password.required_with' => 'يرجى إدخال كلمة المرور الحالية لتغيير كلمة المرور',
            'password.required_with' => 'يرجى إدخال كلمة المرور الجديدة',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 8 خانات',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين',
        ]);

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = ($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit', $user->id)->with('success', 'تم تعديل البيانات بنجاح');
    }
}

