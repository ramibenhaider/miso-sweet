<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;

use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function update(ContactUpdateRequest $request, $id = 1)
    {
        $contact = Contact::firstOrCreate();

        $new_data = $request->validated();

        $oldVideo = $contact->hero_video;

        if ($request->hasFile('hero_video_file')) {
            $videoPath = $request->file('hero_video_file')->store('hero', 'public');
            $new_data['hero_video'] = $videoPath;
        }

        if (array_key_exists('hero_video', $new_data) && $oldVideo && $new_data['hero_video'] !== $oldVideo) {
            if (!str_starts_with($oldVideo, 'http') && Storage::disk('public')->exists($oldVideo)) {
                Storage::disk('public')->delete($oldVideo);
            }
        }

        $contact->fill($new_data);

        if (!$contact->isDirty()) {
            return redirect()->back()->with('warning', 'لم تقم بأي تعديل');
        }

        $contact->save();
        return redirect()->back()->with('success', 'تم حفظ وتحديث الإعدادات والمعلومات بنجاح');
    }
}
