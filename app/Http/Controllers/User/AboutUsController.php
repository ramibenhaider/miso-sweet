<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('user.about-us', compact('aboutUs'));
    }

}
