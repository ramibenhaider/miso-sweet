<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->name = $validated['name'];

        // حذف الصورة القديمة إذا تم اختيار خيار الحذف
        if ($request->boolean('delete_picture')) {
            if ($user->picture && Storage::disk('public')->exists($user->picture)) {
                Storage::disk('public')->delete($user->picture);
            }
            $user->picture = null;
        }

        // حفظ الصورة الجديدة إن وجدت
        if ($request->hasFile('picture')) {
            if ($user->picture && Storage::disk('public')->exists($user->picture)) {
                Storage::disk('public')->delete($user->picture);
            }
            $user->picture = $request->file('picture')->store('users', 'public');
        }

        // تحديث كلمة المرور إذا تم إدخالها
        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        return redirect()->route('profile.edit', $user->id)->with('success', 'تم تعديل البيانات بنجاح');
    }
}

