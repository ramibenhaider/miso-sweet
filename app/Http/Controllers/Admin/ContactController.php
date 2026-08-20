<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function update(ContactUpdateRequest $request, $id = 1)
    {
        $contact = Contact::firstOrCreate();

        $new_data = $request->validated();

        $contact->fill($new_data);

        if (!$contact->isDirty()) {
            return redirect()->back()->with('warning', 'لم تقم بأي تعديل');
        }

        $contact->save();
        return redirect()->back()->with('success', 'تم حفظ وتحديث معلومات التواصل بنجاح');
    }
}
