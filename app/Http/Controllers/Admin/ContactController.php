<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function update(Request $request, $id = 1)
    {
        $contact = Contact::first() ?? new Contact();

        $new_data = $request->validate([
            'whatsapp'  => 'nullable|max:255|string|unique:contacts,whatsapp,' . ($contact->id ?? ''),
            'phone1'    => 'nullable|max:255|string|unique:contacts,phone1,' . ($contact->id ?? ''),
            'phone2'    => 'nullable|max:255|string|unique:contacts,phone2,' . ($contact->id ?? ''),
            'phone3'    => 'nullable|max:255|string|unique:contacts,phone3,' . ($contact->id ?? ''),
            'email'     => 'nullable|max:255|email|unique:contacts,email,' . ($contact->id ?? ''),
            'facebook'  => 'nullable|max:255|string|unique:contacts,facebook,' . ($contact->id ?? ''),
            'tiktok'    => 'nullable|max:255|string|unique:contacts,tiktok,' . ($contact->id ?? ''),
            'instagram' => 'nullable|max:255|string|unique:contacts,instagram,' . ($contact->id ?? ''),
            'youtube'   => 'nullable|max:255|string|unique:contacts,youtube,' . ($contact->id ?? ''),
        ], [
            'whatsapp.unique'  => 'رقم الواتساب موجود مسبقاً',
            'phone1.unique'    => 'رقم الهاتف الأول موجود مسبقاً',
            'phone2.unique'    => 'رقم الهاتف الثاني موجود مسبقاً',
            'phone3.unique'    => 'رقم الهاتف الثالث موجود مسبقاً',
            'email.unique'     => 'البريد الإلكتروني موجود مسبقاً',
            'email.email'      => 'يجب أن يكون البريد الإلكتروني صيغة صحيحة',
            'facebook.unique'  => 'رابط الفيسبوك موجود مسبقاً',
            'tiktok.unique'    => 'رابط التيك توك موجود مسبقاً',
            'instagram.unique' => 'رابط الإنستغرام موجود مسبقاً',
            'youtube.unique'   => 'رابط اليوتيوب موجود مسبقاً',
        ]);

        $contact->fill($new_data);

        if (!$contact->isDirty()) {
            return redirect()->back()->with('warning', 'لم تقم بأي تعديل');
        }

        $contact->save();
        return redirect()->back()->with('success', 'تم حفظ وتحديث معلومات التواصل بنجاح');
    }
}
