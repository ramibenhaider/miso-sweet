<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Message;

class HomeController extends Controller
{
    public function index()
    {
        $shown_messages = Message::where('is_shown', true)->get();
        $heroSettings = Contact::first();
        $categories = Category::has('products')->get();

        return view('user.home', compact('heroSettings', 'categories', 'shown_messages'));
    }
}
