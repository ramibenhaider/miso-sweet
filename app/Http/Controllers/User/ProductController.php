<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        if (!empty($search)) {
            $normalizedSearch = str_replace(['آ', 'أ', 'إ'], 'ا', $search);
            $normalizedSearch = str_replace('ة', 'ه', $normalizedSearch);
            $normalizedSearch = str_replace('ى', 'ي', $normalizedSearch);

            $categories = Category::whereHas('products', function ($q) use ($normalizedSearch) {
                $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(name, 'آ', 'ا'), 'أ', 'ا'), 'إ', 'ا'), 'ة', 'ه'), 'ى', 'ي') LIKE ?", ["%$normalizedSearch%"]);
            })->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(name, 'آ', 'ا'), 'أ', 'ا'), 'إ', 'ا'), 'ة', 'ه'), 'ى', 'ي') LIKE ?", ["%$normalizedSearch%"])
            ->with(['products' => function ($q) use ($normalizedSearch) {
                $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(name, 'آ', 'ا'), 'أ', 'ا'), 'إ', 'ا'), 'ة', 'ه'), 'ى', 'ي') LIKE ?", ["%$normalizedSearch%"]);
            }])->get();

            foreach ($categories as $category) {
                $catNameNormalized = str_replace(['آ', 'أ', 'إ', 'ة', 'ى'], ['ا', 'ا', 'ا', 'ه', 'ي'], $category->name);
                if (mb_stripos($catNameNormalized, $normalizedSearch) !== false && $category->products->isEmpty()) {
                    $category->load('products');
                }
            }

            $categories = $categories->filter(function ($category) {
                return $category->products->count() > 0;
            });
        } else {
            $categories = Category::with('products')->get();
        }

        return view('user.products', compact('categories', 'search'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'product_photos']);
        return view('user.product-show', compact('product'));
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
