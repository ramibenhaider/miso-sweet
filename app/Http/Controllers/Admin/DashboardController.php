<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::orderByDesc('created_at')->get();
        $contact = Contact::first() ?? new Contact();

        return view('admin.categories-contacts', compact('categories', 'contact'));
    }
}
