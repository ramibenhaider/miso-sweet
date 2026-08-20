<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        if (auth()->check() && auth()->user()->role == 'user') {
            $user = User::where('id', auth()->id())->first();
            return view('user.products', compact('user', 'products', 'categories'));
        } else {
            return view('user.products', compact('products', 'categories'));
        }
    }
}
