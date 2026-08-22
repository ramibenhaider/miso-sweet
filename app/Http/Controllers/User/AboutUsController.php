<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('user.about-us', compact('aboutUs'));
    }

    public function edit()
    {
        $aboutUs = AboutUs::first();
        return view('admin.about-us', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        $new_data = $request->validate([
            'about_us' => 'nullable|string',
            'why_us' => 'nullable|string',
            'our_vision' => 'nullable|string',
            'our_mission' => 'nullable|string',
        ], [
            'about_us.string' => 'يجب أن تكون "من نحن" نصًا.',
            'why_us.string' => 'يجب أن تكون "لماذا نحن" نصًا.',
            'our_vision.string' => 'يجب أن تكون "رؤيتنا" نصًا.',
            'our_mission.string' => 'يجب أن تكون "مهمتنا" نصًا.',
        ]);

        $dataToSave = [
            'about_us' => $new_data['about_us'] ?? '',
            'our_vision' => $new_data['our_vision'] ?? '',
            'our_mission' => $new_data['our_mission'] ?? '',
            'why_us' => $new_data['why_us'] ?? '',
        ];

        $aboutUs = AboutUs::first();

        if ($aboutUs) {
            $aboutUs->update($dataToSave);
        } else {
            AboutUs::create($dataToSave);
        }

        return redirect()->back()->with('success', 'تم تحديث معلومات صفحة "من نحن" بنجاح.');
    }
}
